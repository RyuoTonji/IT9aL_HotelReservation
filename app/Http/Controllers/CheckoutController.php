<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\CashbackThreshold;
use App\Models\PaymentInfo;
use App\Models\PaymentType_Cash;
use App\Models\PaymentType_Card;
use App\Models\PaymentType_GCash;
use App\Models\LoyaltyPointTransaction;
use App\Models\LoyaltyTier;
use App\Models\UserLoyalty;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class CheckoutController extends Controller {
  public function CheckoutForm(Request $request) {
    $bookingDetailID = $request->session()->get('bookingDetailID');
    $totalAmount = $request->session()->get('totalAmount');

    // dd($bookingDetailID, $totalAmount);

    if (!$bookingDetailID || !$totalAmount) {
      return redirect()->route('booking')->with('toast_error', 'No booking information available.');
    }

    $booking = Booking::with(['room', 'roomSize', 'services'])
      ->where('ID', $bookingDetailID)
      ->where('UserID', Auth::id())
      ->where('BookingStatus', 'Pending')
      ->first();

    // dd($booking);

    if (!$booking) {
      return redirect()->route('booking')->with('toast_error', 'Invalid or completed booking.');
    }

    // dd($booking);

    // Calculate costs
    $roomPrice = $booking->room->RoomPrice;
    $guestFee = $booking->roomSize->PricePerPerson * $booking->NumberOfGuests;
    $serviceCost = $booking->services->sum('ServicePrice');
    $subtotal = $roomPrice + $guestFee + $serviceCost;
    $discount = 0;
    $discountPercent = 0;
    $userLoyalty = Auth::user()->Loyalty;

    // dd($userLoyalty);

    if ($userLoyalty && $userLoyalty->LoyaltyTierID) {
      $tier = $userLoyalty->loyaltyTier;
      $discountPercent = $tier->Discount;
      $discount = $subtotal * ($tier->Discount / 100);
    }
    $totalAmount = $subtotal - $discount;

    // Validate totalAmount matches
    // if (abs($totalAmount - $totalAmount) > 0.01) {
    //   return redirect()->route('booking.details')->with('toast_error', 'Invalid total amount.');
    // }

    // Calculate potential points
    $potentialPoints = 0;
    $cashback = CashbackThreshold::where('MinPaidAmount', '<=', $totalAmount)
      ->orderBy('MinPaidAmount', 'desc')
      ->first();

    if ($cashback) {
      $potentialPoints = $totalAmount * ($cashback->CashbackPercentile / 100);
    }
    // dd($booking, $subtotal, $discount, $discountPercent, $totalAmount, $potentialPoints);

    return view('customer.checkout', [
      'booking' => $booking,
      'subtotal' => $subtotal,
      'discount' => $discount,
      'discountPercent' => $discountPercent,
      'totalAmount' => $totalAmount,
      'potentialPoints' => $potentialPoints,
    ]);
  }
  public function ProcessPayment(Request $request) {
    $bookingDetailID = $request->session()->get('bookingDetailID');
    $totalAmount = $request->session()->get('totalAmount');

    $rules = [
      'BookingDetailID' => 'required|exists:BookingDetails,ID',
      'TotalAmount' => 'required|numeric|min:0',
      'PaymentMethod' => 'required|in:Cash,Card,Gcash',
    ];

    if ($request->PaymentMethod === 'Cash') {
      $rules['CashAmount'] = 'required|numeric|min:0';
    } elseif ($request->PaymentMethod === 'Card') {
      $rules['CardName'] = 'required|string|max:255';
      $rules['CardCardNumber'] = 'required|string|regex:/^\d{16}$/';
      $rules['CardExpiry'] = 'required|string|regex:/^\d{2}\/\d{2}$/';
      $rules['CardCVC'] = 'required|string|regex:/^\d{3,4}$/';
    } elseif ($request->PaymentMethod === 'Gcash') {
      $rules['GcashName'] = 'required|string|max:255';
      $rules['GcashNumber'] = 'required|string|regex:/^09\d{9}$/';
      $rules['GcashAmount'] = 'required|numeric|min:0';
      $rules['GcashReceipt'] = 'required|string|max:255';
    }

    $validator = Validator::make($request->all(), $rules);
    if ($validator->fails()) {
      return back()
        ->withErrors($validator)
        ->withInput();
    }

    DB::beginTransaction();
    try {
      $userLoyalty = UserLoyalty::firstOrCreate(
        ['UserID' => Auth::id()],
        ['LoyaltyPoints' => 0, 'LoyaltyTierID' => null]
      );

      $totalAmount = $request->session()->get('totalAmount');
      if ($userLoyalty->LoyaltyTierID) {
        $tier = LoyaltyTier::find($userLoyalty->LoyaltyTierID);
        $discount = $tier->Discount / 100;
        $totalAmount *= 1 - $discount;
      }

      $paymentInfo = PaymentInfo::create([
        'BookingDetailID' => $request->session()->get('bookingDetailID'),
        'TotalAmount' => $request->session()->get('totalAmount'),
        'PaymentStatus' => 'Pending',
        'PaymentMethod' => $request->PaymentMethod,
      ]);

      if ($request->PaymentMethod === 'Cash') {
        PaymentType_Cash::create([
          'PaymentInfoID' => $paymentInfo->ID,
          'CashAmount' => $request->input('CashAmount'),
        ]);
      } elseif ($request->PaymentMethod === 'Card') {
        PaymentType_Card::create([
          'PaymentInfoID' => $paymentInfo->ID,
          'Name' => $request->input('CardName'),
          'CardNumber' => $request->input('CardNumber'),
          'Expiry' => $request->input('CardExpiry'),
          'CVC' => $request->input('CardCVC'),
        ]);
      } elseif ($request->PaymentMethod === 'Gcash') {
        PaymentType_GCash::create([
          'PaymentInfoID' => $paymentInfo->ID,
          'Name' => $request->input('GcashName'),
          'Number' => $request->input('GcashNumber'),
          'Amount' => $request->input('GcashAmount'),
          'ReceiptNumber' => $request->input('GcashReceipt'),
        ]);
      }

      $cashback = CashbackThreshold::where('MinPaidAmount', '<=', $totalAmount)
        ->orderBy('MinPaidAmount', 'desc')
        ->first();
      if ($cashback) {
        $points = $totalAmount * ($cashback->CashbackPercentile / 100);
        $userLoyalty->increment('LoyaltyPoints', $points);

        LoyaltyPointTransaction::create([
          'UserID' => Auth::id(),
          'Points' => $points,
          'TransactionType' => 'Earned',
          'PaymentInfoID' => $paymentInfo->ID,
          'Description' => "Cashback for payment of {$totalAmount} at {$cashback->CashbackPercentile}%",
        ]);
      }

      // Update loyalty tier
      $newTier = LoyaltyTier::where('MinPoints', '<=', $userLoyalty->LoyaltyPoints)
        ->orderBy('MinPoints', 'desc')
        ->first();
      if ($newTier && $newTier->ID != $userLoyalty->LoyaltyTierID) {
        $userLoyalty->update(['LoyaltyTierID' => $newTier->ID]);
      }
      // Update PaymentStatus based on processing (e.g., API call for Card/Gcash)
      $paymentInfo->update(['PaymentStatus' => 'Completed']); // Exampleche

      DB::commit();
      return redirect()->route('booking')->with('toast_success', 'Payment processed successfully!');
    } catch (\Exception $e) {
      DB::rollBack();
      return back()->with('toast_error', 'Payment failed: ' . $e->getMessage());
    }
  }
}
