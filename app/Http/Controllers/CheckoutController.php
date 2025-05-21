<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\CashbackThreshold;
use App\Models\PaymentInfos;
use App\Models\PaymentType_BankTransfer;
use App\Models\PaymentType_Card;
use App\Models\PaymentType_Paypal;
use App\Models\LoyaltyPointTransaction;
use App\Models\LoyaltyTier;
use App\Models\PaymentType_EPayment;
use App\Models\UserLoyalty;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class CheckoutController extends Controller {
  public function CheckoutForm(Request $request) {
    $booking = null;
    $costDetails = null;
    $tier = null;

    // Try session BookingID first
    $bookingID = session('BookingID');
    if ($bookingID) {
      $booking = Booking::with(['roomType', 'roomSize', 'servicesAdded', 'costDetails'])
        ->where('ID', $bookingID)
        ->where('UserID', Auth::id())
        ->first();
    }
    // dd($booking);

    // If no session booking, get latest pending booking
    if (!$booking) {
      $booking = Booking::with(['roomType', 'roomSize', 'servicesAdded', 'costDetails'])
        ->where('UserID', Auth::id())
        ->where('BookingStatus', 'Pending')
        ->orderBy('created_at', 'desc')
        ->first();
    }

    if ($booking) {
      $costDetails = $booking->costDetails;
      $userLoyalty = UserLoyalty::where('UserID', Auth::id())->first();
      if ($userLoyalty && $userLoyalty->LoyaltyTierID) {
        $tier = LoyaltyTier::where('ID', $userLoyalty->LoyaltyTierID)->first();
      }

      $request->session()->put('BookingID', $booking->ID);
    }

    return view('customer.payment', [
      'title' => 'Booking Details',
      'tier' => $tier,
      'booking' => $booking,
      'costDetails' => $costDetails,
      'PaymentProcessed' => $booking ? PaymentInfos::where('BookingDetailID', $booking->ID)
        ->where('PaymentStatus', 'Submitted')
        ->first() : null,
    ]);
  }
  public function ProcessPayment(Request $request) {
    // dd($request);
    $rules = [
      'BookingDetailID' => 'required|exists:BookingDetails,ID',
      'TotalAmount' => 'required|numeric|min:0',
      'paymentMethod' => 'required|in:gcashPaymaya,paypal,creditCard,bankTransfer',
    ];

    if ($request->paymentMethod === 'gcashPaymaya') {
      $rules['ECashMobileNum'] = 'required|string|max:11|regex:/^09\d{9}$/';
      $rules['ECashReference'] = 'required|string|max:20';
    } elseif ($request->paymentMethod === 'paypal') {
      $rules['PaypalReference'] = 'required|string|max:255';
    } elseif ($request->paymentMethod === 'creditCard') {
      $rules['CardNumber'] = 'required|string|regex:/^\d{16}$/';
      $rules['CardName'] = 'required|string|max:255';
      $rules['CardExpiry'] = 'required|string|regex:/^\d{2}\/\d{2}$/';
      $rules['CardCVC'] = 'required|string|regex:/^\d{3,4}$/';
    } elseif ($request->paymentMethod === 'bankTransfer') {
      $rules['AccountName'] = 'required|string|max:255';
      $rules['AccountNumber'] = 'required|string|max:255';
      $rules['RoutingNumber'] = 'required|string|max:255';
    }

    $validator = Validator::make($request->all(), $rules);
    // dd($validator);
    if ($validator->fails()) {
      return back()->withErrors($validator)->withInput($request->all());
    }

    DB::beginTransaction();
    try {
      $userLoyalty = UserLoyalty::firstOrCreate(
        ['UserID' => Auth::id()],
        ['LoyaltyPoints' => 0, 'LoyaltyTierID' => null]
      );

      $totalAmount = $request->TotalAmount;
      if ($userLoyalty->LoyaltyTierID) {
        $tier = LoyaltyTier::find($userLoyalty->LoyaltyTierID);
        $discount = $tier->Discount / 100;
        $totalAmount *= (1 - $discount);
      }

      $paymentInfo = PaymentInfos::where('BookingDetailID', $request->BookingDetailID)->first();

      if (!$paymentInfo) {
        $paymentInfo = PaymentInfos::create([
          'BookingDetailID' => $request->BookingDetailID,
          'TotalAmount' => $totalAmount,
          'PaymentStatus' => 'Submitted',
          'PaymentMethod' => $request->paymentMethod === 'gcashPaymaya' ? 'EPayment' : ucfirst($request->paymentMethod),
          'created_at' => now(),
          'updated_at' => now(),
        ]);
      } else {
        $paymentInfo->update([
          'TotalAmount' => $totalAmount,
          'PaymentStatus' => 'Submitted',
          'PaymentMethod' => $request->paymentMethod === 'gcashPaymaya' ? 'EPayment' : ucfirst($request->paymentMethod),
          'updated_at' => now(),
        ]);
      }


      if ($request->paymentMethod === 'gcashPaymaya') {
        PaymentType_EPayment::create([
          'PaymentInfoID' => $paymentInfo->ID,
          'Number' => $request->ECashMobileNum,
          'ReferenceNum' => $request->ECashReference,
          'Amount' => $totalAmount,
        ]);
      } elseif ($request->paymentMethod === 'paypal') {
        PaymentType_Paypal::create([
          'PaymentInfoID' => $paymentInfo->ID,
          'ReferenceNum' => $request->PaypalReference,
          'Amount' => $totalAmount,
        ]);
      } elseif ($request->paymentMethod === 'creditCard') {
        PaymentType_Card::create([
          'PaymentInfoID' => $paymentInfo->ID,
          'CardHolderName' => $request->CardName,
          'CardNumber' => $request->CardNumber,
          'ExpiryDate' => $request->CardExpiry,
          'CVC' => $request->CardCVC,
        ]);
      } elseif ($request->paymentMethod === 'bankTransfer') {
        PaymentType_BankTransfer::create([
          'PaymentInfoID' => $paymentInfo->ID,
          'AccountName' => $request->AccountName,
          'AccountNumber' => $request->AccountNumber,
          'RoutingNumber' => $request->RoutingNumber,
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

      $newTier = LoyaltyTier::where('MinPoints', '<=', $userLoyalty->LoyaltyPoints)
        ->orderBy('MinPoints', 'desc')
        ->first();
      if ($newTier && $newTier->ID != $userLoyalty->LoyaltyTierID) {
        $userLoyalty->update(['LoyaltyTierID' => $newTier->ID]);
      }

      DB::commit();
      $request->session()->forget(['BookingID', 'TotalAmount']);
      return redirect()->route('booking')->with('toast_success', 'Payment submitted successfully!');
    } catch (\Exception $e) {
      DB::rollBack();
      return back()->with('toast_error', 'Payment failed: ' . $e->getMessage());
    }
  }
}
