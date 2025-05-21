@extends('layouts.app')

@section('title', 'Booking Details')
{{-- @dd($error ?? null) --}}

@section('content')

  <link rel="stylesheet" href="{{ asset('css/customer/payment.css') }}">

  <div class="booking-container">
    <div class="booking-content">
      <h2>Booking Details</h2>

      @if ($booking)
        <div class="detail-group">
          <label>Check-In Date:</label>
          <span>{{ $booking->CheckInDate->format('M d, Y') }}</span>
        </div>
        <div class="detail-group">
          <label>Check-Out Date:</label>
          <span>{{ $booking->CheckOutDate->format('M d, Y') }}</span>
        </div>
        <div class="detail-group">
          <label>Room Type:</label>
          <span>{{ $booking->roomType->RoomTypeName }}</span>
        </div>
        <div class="detail-group">
          <label>Room Size:</label>
          <span>{{ $booking->roomSize->RoomSizeName }}</span>
        </div>
        <div class="detail-group">
          <label>Number of Guests:</label>
          <span>{{ $booking->NumberOfGuests }}</span>
        </div>
        <div class="detail-group">
          <label>Services:</label>
          <span>
            @if ($booking->servicesAdded->isEmpty())
              None
            @else
              {{ $booking->servicesAdded->pluck('ServiceName')->implode(', ') }}
            @endif
          </span>
        </div>

        @php
          $costDetails = $booking->costDetails;
        @endphp

        <table class="cost-table">
          <tr>
            <th>Description</th>
            <th>Amount</th>
          </tr>
          <tr>
            <td>Room Base Price (1 night)</td>
            <td>{{ number_format($costDetails->RoomBasePrice, 2) }}</td>
          </tr>
          @if ($costDetails->Nights > 1)
            <tr>
              <td>Succeeding Nights ({{ $costDetails->Nights - 1 }} x
                {{ number_format($booking->roomType->SucceedingNights, 2) }})</td>
              <td>{{ number_format($costDetails->RoomSucceedingNightsPrice, 2) }}</td>
            </tr>
          @endif
          @if ($costDetails->GuestFee > 0)
            <tr>
              <td>Guest Fee (Excluding Self) ({{ $booking->NumberOfGuests - 1 }} x
                {{ number_format($booking->roomSize->PricePerPerson, 2) }})</td>
              <td>{{ number_format($costDetails->GuestFee, 2) }}</td>
            </tr>
          @endif
          @if ($costDetails->ServiceBasePrice > 0)
            <tr>
              <td>Service Base Price (1 night)</td>
              <td>{{ number_format($costDetails->ServiceBasePrice, 2) }}</td>
            </tr>
          @endif
          @if ($costDetails->ServiceSucceedingNightsPrice > 0)
            <tr>
              <td>Service Succeeding Nights ({{ $costDetails->Nights - 1 }} nights)</td>
              <td>{{ number_format($costDetails->ServiceSucceedingNightsPrice, 2) }}</td>
            </tr>
          @endif
          <tr>
            <td>Subtotal</td>
            <td>{{ number_format($costDetails->Subtotal, 2) }}</td>
          </tr>
          @if ($costDetails->Discount > 0)
            <tr>
              <td>Loyalty Discount ({{ $tier->Discount }}%)</td>
              <td>-{{ number_format($costDetails->Discount, 2) }}</td>
            </tr>
          @endif
          <tr class="total">
            <td>Total Amount</td>
            <td>{{ number_format($costDetails->TotalAmount, 2) }}</td>
          </tr>
        </table>

        @if (!$booking->paymentInfo || $booking->paymentInfo->PaymentStatus === 'Pending')
          <form action="{{ route('process.payment') }}" method="POST" id="payment-form">
            @csrf
            <input type="hidden" name="BookingDetailID" value="{{ $booking->ID }}">
            <input type="hidden" name="TotalAmount" value="{{ $costDetails->TotalAmount }}">
            <div class="payment-section">
              <h3>Choose Payment Option</h3>
              @if ($errors->any())
                <div class="alert alert-danger mt-2">
                  You have the following errors:<br>
                  @foreach ($errors->all() as $error)
                    {{ $error }}<br>
                  @endforeach
                </div>
              @endif

              <!-- GCash and PayMaya Option -->
              <div class="payment-option" id="gcashPaymaya">
                <input type="radio" name="paymentMethod" id="gcashPaymaya" value="gcashPaymaya" required>
                <label for="gcashPaymaya">GCash / PayMaya</label>
                <div class="icon-container">
                  <img src="{{ asset('img/transactions/GCash.png') }}" alt="GCash Icon">
                  <img src="{{ asset('img/transactions/PayMaya.png') }}" alt="PayMaya Icon">
                </div>
              </div>
              <div id="gcashPaymaya-details" class="payment-details">
                <p><strong>Hotel Name:</strong> KagayakuKin Yume Hotel</p>
                <p><strong>GCash Number:</strong> 0917-123-4567</p>
                <p><strong>PayMaya Number:</strong> 0917-987-6543</p>
                <p><strong>Scan either of the QR below</strong></p>
                <img src="{{ asset('img/transactions/qr/gcash.svg') }}" alt="GCash QR Code" class="qr-code">
                <img src="{{ asset('img/transactions/qr/paymaya.svg') }}" alt="PayMaya QR Code" class="qr-code">
                <div class="form-group">
                  <label for="ECashMobileNum">Mobile Number</label>
                  <input type="text" class="form-control" id="ECashMobileNum" name="ECashMobileNum"
                    placeholder="0991 234 5678" value="{{ old('ECashMobileNum') }}">
                  @error('ECashMobileNum')
                    <div class="alert alert-danger mt-2">
                      {{ $message }}
                    </div>
                  @enderror
                </div>
                <div class="form-group">
                  <label for="ECashReference">Reference Number</label>
                  <input type="text" class="form-control" id="ECashReference" name="ECashReference"
                    placeholder="12345678901234" value="{{ old('ECashReference') }}">
                  @error('ECashReference')
                    <div class="alert alert-danger mt-2">
                      {{ $message }}
                    </div>
                  @enderror
                </div>
              </div>

              <!-- PayPal Option -->
              <div class="payment-option" id="paypal">
                <input type="radio" name="paymentMethod" id="paypal" value="paypal" required>
                <label for="paypal">PayPal</label>
                <div class="icon-container">
                  <img src="{{ asset('img/transactions/creditdebit.jpg') }}" alt="PayPal Icon">
                </div>
              </div>
              <div id="paypal-details" class="payment-details">
                <p><strong>PayPal Email:</strong> payments@kagayakukin.com</p>
                <img src="{{ asset('img/transactions/qr/paypal.svg') }}" alt="PayPal QR Code" class="qr-code">
                <div class="form-group">
                  <label for="PaypalReference">Reference Number</label>
                  <input type="text" class="form-control" id="PaypalReference" name="PaypalReference"
                    placeholder="1234 5678 9012 3456">
                </div>
              </div>

              <!-- Credit/Debit Card Option -->
              <div class="payment-option" id="creditCard">
                <input type="radio" name="paymentMethod" id="creditCard" value="creditCard" required>
                <label for="creditCard">Credit/Debit Card</label>
                <div class="icon-container">
                  <img src="{{ asset('img/transactions/creditdebit.jpg') }}" alt="Credit/Debit Card Icon">
                </div>
              </div>
              <div id="creditCard-details" class="payment-details">
                <div class="form-group">
                  <label for="CardNumber">Card Number</label>
                  <input type="text" class="form-control" id="CardNumber" name="CardNumber"
                    placeholder="1234 5678 9012 3456">
                </div>
                <div class="form-group">
                  <label for="CardName">Name on Card</label>
                  <input type="text" class="form-control" id="CardName" name="CardName" placeholder="John Doe">
                </div>
                <div class="form-group">
                  <label for="CardExpiry">Expiry Date</label>
                  <input type="text" class="form-control" id="CardExpiry" name="CardExpiry" placeholder="MM/YY">
                </div>
                <div class="form-group">
                  <label for="CardCVC">CVC</label>
                  <input type="text" class="form-control" id="CardCVC" name="CardCVC" placeholder="123">
                </div>
              </div>

              <!-- Bank Transfer Option -->
              <div class="payment-option" id="bankTransfer">
                <input type="radio" name="paymentMethod" id="bankTransfer" value="bankTransfer" required>
                <label for="bankTransfer">Bank Transfer</label>
                <div class="icon-container">
                  <img src="{{ asset('img/transactions/bank.png') }}" alt="Bank Transfer Icon">
                </div>
              </div>
              <div id="bankTransfer-details" class="payment-details">
                <div class="form-group">
                  <label for="AccountName">Account Name</label>
                  <input type="text" class="form-control" id="AccountName" name="AccountName"
                    placeholder="KagayakuKin Yume Hotel">
                </div>
                <div class="form-group">
                  <label for="AccountNumber">Account Number</label>
                  <input type="text" class="form-control" id="AccountNumber" name="AccountNumber"
                    placeholder="1234567890">
                </div>
                <div class="form-group">
                  <label for="RoutingNumber">Routing Number</label>
                  <input type="text" class="form-control" id="RoutingNumber" name="RoutingNumber"
                    placeholder="987654321">
                </div>
              </div>
            </div>

            <button type="submit" class="btn btn-confirm">Confirm Payment</button>
          </form>

          <form action="{{ route('cancel.booking', $booking->ID) }}" method="POST" style="display: inline;">
            @csrf
            @method('POST')
            <button type="submit" class="btn btn-cancel">Cancel Booking</button>
          </form>
        @else
          <div class="alert alert-warning mt-2">
            @if ($booking->paymentInfo->PaymentStatus === 'Verified')
              Your payment has been verified.
            @elseif($booking->paymentInfo->PaymentStatus === 'Submitted')
              Your payment details has been submitted, we will verify it shortly.
            @elseif ($booking->paymentInfo->PaymentStatus === 'Failed')
              Your payment has failed. Please try again.
            @endif
          </div>
        @endif
      @else
        <div class="no-bookings">
          <p>You have no pending bookings.</p>
          <a href="{{ route('booking') }}" class="btn btn-confirm">Book Now</a>
        </div>
      @endif
    </div>

  </div>

  <script>
    // JavaScript to toggle payment details visibility and clear non-selected fields
    document.querySelectorAll('input[name="paymentMethod"]').forEach((radio) => {
      radio.addEventListener('change', function() {
        // Hide all payment details and clear inputs
        document.querySelectorAll('.payment-details').forEach((details) => {
          details.classList.remove('active');
          details.querySelectorAll('input').forEach((input) => {
            input.value = '';
            input.removeAttribute('required');
          });
        });

        // Show selected payment details and set required attributes
        const selectedDetails = document.getElementById(`${this.value}-details`);
        if (selectedDetails) {
          selectedDetails.classList.add('active');
          selectedDetails.querySelectorAll('input').forEach((input) => {
            input.setAttribute('required', 'required');
          });
        }
      });
    });

    // Clear all inputs on page load
    document.querySelectorAll('.payment-details input').forEach((input) => {
      input.value = '';
      input.removeAttribute('required');
    });

    // Ensure only the selected payment method's inputs are submitted
    document.getElementById('payment-form').addEventListener('submit', function(e) {
      const selectedMethod = document.querySelector('input[name="paymentMethod"]:checked');
      if (!selectedMethod) {
        e.preventDefault();
        alert('Please select a payment method.');
      }
    });
  </script>

@endsection

{{-- @dd($Room) --}}
