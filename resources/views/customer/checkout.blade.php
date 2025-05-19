@extends('layouts.app')

@section('title', 'Checkout')

@section('content')
  <style>
    body {
      font-family: "Poppins", sans-serif;
      background-color: #f8f9fa;
    }

    .booking-container {
      max-width: 800px;
      margin: 50px auto;
      padding: 30px;
      background: url("https://images.unsplash.com/photo-1590073242678-70ee3c9e8af3?q=80&w=2070&auto=format&fit=crop") no-repeat center center;
      background-size: cover;
      border-radius: 15px;
      box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
      position: relative;
    }

    .booking-container::before {
      content: "";
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: rgba(255, 255, 255, 0.9);
      border-radius: 15px;
      z-index: 1;
    }

    .booking-content {
      position: relative;
      z-index: 2;
    }

    .booking-container h2 {
      color: #000;
      text-align: center;
      margin-bottom: 30px;
      font-weight: 600;
    }

    .form-group label {
      font-weight: 500;
      color: #333;
    }

    .form-control {
      border: 2px solid #f8cb45;
      border-radius: 25px;
      padding: 10px;
      margin-bottom: 15px;
      font-family: "Poppins", sans-serif;
    }

    .form-control:focus {
      border-color: #e0b33d;
      box-shadow: 0 0 5px rgba(248, 203, 69, 0.5);
    }

    .btn {
      border-radius: 25px;
      padding: 10px 20px;
      font-family: "Poppins", sans-serif;
      margin: 5px;
    }

    .btn-confirm {
      background-color: #f8cb45;
      border-color: #f8cb45;
      color: #000;
    }

    .btn-confirm:hover {
      background-color: #e0b33d;
      border-color: #e0b33d;
    }

    .btn-cancel {
      background-color: #dc3545;
      border-color: #dc3545;
      color: #fff;
    }

    .btn-cancel:hover {
      background-color: #c82333;
      border-color: #c82333;
    }

    .btn-draft {
      background-color: #6c757d;
      border-color: #6c757d;
      color: #fff;
    }

    .btn-draft:hover {
      background-color: #5a6268;
      border-color: #5a6268;
    }

    .modal-content {
      border-radius: 15px;
      font-family: "Poppins", sans-serif;
    }

    .modal-body {
      text-align: center;
      padding: 30px;
    }

    .modal-footer {
      justify-content: center;
      border-top: none;
    }
  </style>
  
  <div class="booking-container">
    <div class="booking-content">
      <h2>Payment Form</h2>

      @if ($booking)
        <table class="cost-table">
          <tr>
            <th>Description</th>
            <th>Amount</th>
          </tr>
          <tr>
            <td>Subtotal</td>
            <td>₱{{ number_format($subtotal, 2) }}</td>
          </tr>
          @if ($discount > 0)
            <tr>
              <td>Loyalty Discount ({{ $discountPercent }}%)</td>
              <td>-₱{{ number_format($discount, 2) }}</td>
            </tr>
          @endif
          <tr class="total">
            <td>Total Amount</td>
            <td>₱{{ number_format($totalAmount, 2) }}</td>
          </tr>
        </table>

        @if ($potentialPoints > 0)
          <p class="points-info">You will earn {{ number_format($potentialPoints, 2) }} loyalty points upon successful
            payment.</p>
        @else
          <p class="points-info">No loyalty points will be earned for this payment.</p>
        @endif

        <form action="{{ route('checkout.process') }}" method="POST">
          @csrf
          <input type="hidden" name="BookingDetailID" value="{{ $booking->ID }}">
          <input type="hidden" name="TotalAmount" value="{{ $totalAmount }}">

          <div class="form-group">
            <label for="PaymentMethod">Payment Method</label>
            <select class="form-control" id="PaymentMethod" name="PaymentMethod" required>
              <option value="" disabled selected>Select Payment Method</option>
              <option value="Cash">Cash</option>
              <option value="Card">Credit/Debit Card</option>
              <option value="Gcash">GCash</option>
            </select>
            @error('PaymentMethod')
              <div class="alert alert-danger mt-2">{{ $message }}</div>
            @enderror
          </div>

          <!-- Cash Fields -->
          <div class="form-group payment-fields" id="cash-fields" style="display: none;">
            <label for="CashAmount">Amount</label>
            <input type="number" class="form-control" id="CashAmount" name="Cash.Amount" step="0.01" min="0"
              value="{{ old('Cash.Amount') }}">
            @error('Cash.Amount')
              <div class="alert alert-danger mt-2">{{ $message }}</div>
            @enderror
          </div>

          <!-- Card Fields -->
          <div class="form-group payment-fields" id="card-fields" style="display: none;">
            <label for="CardName">Name on Card</label>
            <input type="text" class="form-control" id="CardName" name="Card.Name" value="{{ old('Card.Name') }}">
            @error('Card.Name')
              <div class="alert alert-danger mt-2">{{ $message }}</div>
            @enderror

            <label for="CardNumber">Card Number</label>
            <input type="text" class="form-control" id="CardNumber" name="Card.CardNumber"
              value="{{ old('Card.CardNumber') }}">
            @error('Card.CardNumber')
              <div class="alert alert-danger mt-2">{{ $message }}</div>
            @enderror

            <label for="CardExpiry">Expiry (MM/YY)</label>
            <input type="text" class="form-control" id="CardExpiry" name="Card.Expiry"
              value="{{ old('Card.Expiry') }}">
            @error('Card.Expiry')
              <div class="alert alert-danger mt-2">{{ $message }}</div>
            @enderror

            <label for="CardCVC">CVC</label>
            <input type="text" class="form-control" id="CardCVC" name="Card.CVC" value="{{ old('Card.CVC') }}">
            @error('Card.CVC')
              <div class="alert alert-danger mt-2">{{ $message }}</div>
            @enderror
          </div>

          <!-- GCash Fields -->
          <div class="form-group payment-fields" id="gcash-fields" style="display: none;">
            <label for="GcashName">Name</label>
            <input type="text" class="form-control" id="GcashName" name="Gcash.Name" value="{{ old('Gcash.Name') }}">
            @error('Gcash.Name')
              <div class="alert alert-danger mt-2">{{ $message }}</div>
            @enderror

            <label for="GcashNumber">Mobile Number</label>
            <input type="text" class="form-control" id="GcashNumber" name="Gcash.Number"
              value="{{ old('Gcash.Number') }}">
            @error('Gcash.Number')
              <div class="alert alert-danger mt-2">{{ $message }}</div>
            @enderror

            <label for="GcashAmount">Amount</label>
            <input type="number" class="form-control" id="GcashAmount" name="Gcash.Amount" step="0.01" min="0"
              value="{{ old('Gcash.Amount') }}">
            @error('Gcash.Amount')
              <div class="alert alert-danger mt-2">{{ $message }}</div>
            @enderror

            <label for="GcashReceipt">Receipt/Transaction Reference</label>
            <input type="text" class="form-control" id="GcashReceipt" name="Gcash.Receipt"
              value="{{ old('Gcash.Receipt') }}">
            @error('Gcash.Receipt')
              <div class="alert alert-danger mt-2">{{ $message }}</div>
            @enderror
          </div>

          <div class="text-center">
            <a href="{{ route('booking.details') }}" class="btn btn-cancel">Back</a>
            <button type="submit" class="btn btn-confirm">Submit Payment</button>
          </div>
        </form>
      @else
        <div class="no-bookings">
          <p>Invalid or missing booking information.</p>
          <a href="{{ route('booking') }}" class="btn btn-confirm">Book Now</a>
        </div>
      @endif
    </div>
  </div>

  <script>
    document.addEventListener('DOMContentLoaded', function() {
      const paymentMethodSelect = document.getElementById('PaymentMethod');
      const cashFields = document.getElementById('cash-fields');
      const cardFields = document.getElementById('card-fields');
      const gcashFields = document.getElementById('gcash-fields');

      function togglePaymentFields() {
        cashFields.style.display = paymentMethodSelect.value === 'Cash' ? 'block' : 'none';
        cardFields.style.display = paymentMethodSelect.value === 'Card' ? 'block' : 'none';
        gcashFields.style.display = paymentMethodSelect.value === 'Gcash' ? 'block' : 'none';
      }

      paymentMethodSelect.addEventListener('change', togglePaymentFields);
      togglePaymentFields(); // Initialize on page load
    });
  </script>

@endsection

{{-- @dd($Room) --}}
