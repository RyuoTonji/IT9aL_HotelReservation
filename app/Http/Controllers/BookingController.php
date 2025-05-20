<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\BookingCostDetail;
use App\Models\RoomType;
use App\Models\RoomSize;
use App\Models\Service;
use App\Models\UserLoyalty;
use App\Models\LoyaltyTier;
use App\Models\PaymentInfo;
use App\Models\PaymentType_Card;
use App\Models\PaymentType_EPayment;
use App\Models\PaymentType_Paypal;
use App\Models\CashbackThreshold;
use App\Models\LoyaltyPointTransaction;
use App\Models\PaymentType_BankTransfer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Models\ServiceAdded;
use Carbon\Carbon;

class BookingController extends Controller {
  public function AppendBooking(Request $request) {
    $roomSize = RoomSize::where('RoomSizeName', $request->RoomSize)->firstOrFail();
    $maxGuests = $roomSize->RoomCapacity;

    $request->validate([
      'CheckInDate' => 'required|date|after_or_equal:today',
      'CheckOutDate' => 'required|date|after:CheckInDate',
      'RoomType' => 'required|string|in:Standard,Executive,Deluxe',
      'RoomSize' => 'required|string|in:Single,Double,Family',
      'NumberOfGuests' => "required|integer|min:1|max:$maxGuests",
      'Services' => 'nullable|array',
      'Services.*' => 'integer|exists:Services,ID|distinct',
    ]);

    // dd($request);

    DB::beginTransaction();
    try {
      $room = RoomType::where('RoomTypeName', $request->RoomType)->firstOrFail();
      $roomSize = RoomSize::where('RoomSizeName', $request->RoomSize)->firstOrFail();

      // Calculate number of nights
      $checkIn = Carbon::parse($request->CheckInDate);
      $checkOut = Carbon::parse($request->CheckOutDate);
      $nights = $checkIn->diffInDays($checkOut);

      // Room cost: base price + succeeding nights
      $roomBasePrice = $room->RoomPrice;
      $roomSucceedingNightsPrice = $nights > 1 ? $room->SucceedingNights * ($nights - 1) : 0;

      // Guest fee: 0 for Family rooms, otherwise PricePerPerson * NumberOfGuests
      $guestFee = $roomSize->PricePerPerson * ($request->NumberOfGuests - 1);

      // Service cost: base price + succeeding nights
      $serviceBasePrice = 0;
      $serviceSucceedingNightsPrice = 0;
      if ($request->filled('Services')) {
        $services = Service::whereIn('ID', $request->Services)->get();
        $serviceBasePrice = $services->sum('ServicePrice');
        $serviceSucceedingNightsPrice = $nights > 1 ? $serviceBasePrice * ($nights - 1) : 0;
      }

      // Calculate subtotal and apply loyalty discount
      $subtotal = $roomBasePrice + $roomSucceedingNightsPrice + $guestFee + $serviceBasePrice + $serviceSucceedingNightsPrice;
      $userLoyalty = UserLoyalty::firstOrCreate(
        ['UserID' => Auth::id()],
        ['LoyaltyPoints' => 0, 'LoyaltyTierID' => null]
      );
      $discount = 0;
      if ($userLoyalty->LoyaltyTierID) {
        $tier = LoyaltyTier::find($userLoyalty->LoyaltyTierID);
        $discount = $subtotal * ($tier->Discount / 100);
      }
      $totalAmount = $subtotal - $discount;

      $booking = new Booking();
      $booking->UserID = Auth::id();
      $booking->CheckInDate = $request->CheckInDate;
      $booking->CheckOutDate = $request->CheckOutDate;
      $booking->RoomTypeID = $room->ID;
      $booking->RoomSizeID = $roomSize->ID;
      $booking->NumberOfGuests = $request->NumberOfGuests;
      $booking->BookingStatus = 'Pending';
      $booking->save();

      if ($request->filled('Services')) {
        foreach ($request->Services as $serviceID) {
          ServiceAdded::create([
            'BookingDetailID' => $booking->ID,
            'ServiceID' => $serviceID,
          ]);
        }
      }

      BookingCostDetail::create([
        'BookingDetailID' => $booking->ID,
        'RoomBasePrice' => $roomBasePrice,
        'RoomSucceedingNightsPrice' => $roomSucceedingNightsPrice,
        'Nights' => $nights,
        'GuestFee' => $guestFee,
        'ServiceBasePrice' => $serviceBasePrice,
        'ServiceSucceedingNightsPrice' => $serviceSucceedingNightsPrice,
        'Subtotal' => $subtotal,
        'Discount' => $discount,
        'TotalAmount' => $totalAmount,
      ]);

      DB::commit();
      return redirect()->route('checkout')->with([
        'BookingID' => $booking->ID,
        'TotalAmount' => $totalAmount,
        'RoomBasePrice' => $roomBasePrice,
        'RoomSucceedingNightsPrice' => $roomSucceedingNightsPrice,
        'Nights' => $nights,
        'GuestFee' => $guestFee,
        'ServiceBasePrice' => $serviceBasePrice,
        'ServiceSucceedingNightsPrice' => $serviceSucceedingNightsPrice,
        'Subtotal' => $subtotal,
        'Discount' => $discount,
      ]);
    } catch (\Exception $e) {
      DB::rollBack();
      return back()->with('toast_error', 'Failed to save booking: ' . $e->getMessage());
    }
    // return back()->with('toast_success', 'Booking successful!');
  }

  public function CancelBooking(Request $request, $bookingID) {
    $this->middleware('auth');

    DB::beginTransaction();
    try {
      $booking = Booking::where('ID', $bookingID)
        ->where('UserID', Auth::id())
        ->firstOrFail();

      // Delete related records
      Booking::where('ID', $bookingID)->delete();
      ServiceAdded::where('BookingDetailID', $bookingID)->delete();
      $booking->delete();

      DB::commit();
      return redirect()->route('booking')->with('toast_success', 'Booking cancelled successfully!');
    } catch (\Exception $e) {
      DB::rollBack();
      // abort(0, $e->getMessage());
      return back()->with('toast_error', 'Failed to cancel booking: ' . $e->getMessage());
    }
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

      $paymentInfo = PaymentInfo::create([
        'BookingDetailID' => $request->BookingDetailID,
        'TotalAmount' => $totalAmount,
        'PaymentStatus' => 'Submitted',
        'PaymentMethod' => $request->paymentMethod === 'gcashPaymaya' ? 'EPayment' : ucfirst($request->paymentMethod),
      ]);

      if ($request->paymentMethod === 'gcashPaymaya') {
        PaymentType_EPayment::create([
          'PaymentInfoID' => $paymentInfo->ID,
          'MobileNumber' => $request->ECashMobileNum,
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
