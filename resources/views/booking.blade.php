@extends('layouts.app')

@section('title', 'Booking')

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

    /* Payment Section Styles */
    .payment-section {
      margin-top: 30px;
    }

    .payment-section h3 {
      color: #000;
      font-weight: 600;
      margin-bottom: 20px;
      font-size: 1.2rem;
    }

    .payment-option {
      display: flex;
      align-items: center;
      padding: 15px;
      border: 1px solid #ddd;
      border-radius: 25px;
      margin-bottom: 15px;
      cursor: pointer;
      background-color: #fff;
    }

    .payment-option input[type="radio"] {
      margin-right: 15px;
    }

    .payment-option label {
      font-weight: 500;
      color: #333;
      cursor: pointer;
      flex-grow: 1;
    }

    .payment-option .icon-container {
      display: flex;
      align-items: center;
      gap: 10px;
    }

    .payment-option img {
      object-fit: contain;
    }

    .payment-option#gcashPaymaya img{
      width: 80px;
      height: 50px;
    }

    .payment-option#paypalCreditCard img{
      width: 150px;
      height: 150px;
    }

    .payment-option#bankTransfer img {
      width: 40px;
      height: 40px;
    }

    .payment-details {
      display: none;
      margin-top: 10px;
      padding: 15px;
      border: 1px solid #ddd;
      border-radius: 10px;
      background-color: #f9f9f9;
    }

    .payment-details.active {
      display: block;
    }

    .payment-details img.qr-code {
      width: 100px;
      height: 100px;
      margin-top: 10px;
    }
  </style>

  <div class="booking-container">
    <div class="booking-content">
      <h2>Book Your Stay</h2>
      <form>
        <div class="form-group">
          <label for="checkIn">Check-In Date</label>
          <div class="position-relative">
            <input type="date" class="form-control" id="checkIn" placeholder="mm/dd/yyyy" required>
            <i class="bi position-absolute" style="right: 15px; top: 50%; transform: translateY(-50%);"></i>
          </div>
        </div>
        <div class="form-group">
          <label for="checkOut">Check-Out Date</label>
          <div class="position-relative">
            <input type="date" class="form-control" id="checkOut" placeholder="mm/dd/yyyy" required>
            <i class="bi position-absolute" style="right: 15px; top: 50%; transform: translateY(-50%);"></i>
          </div>
        </div>
        <div class="form-group">
          <label for="guests">Number of Guests</label>
          <input type="number" class="form-control" id="guests" min="1" required>
        </div>
        <div class="form-group">
          <label for="roomType">Room Type</label>
          <select class="form-control" id="roomType" required>
            <option value="" disabled selected>Select Room Type</option>
            <option value="standard">Standard Room</option>
            <option value="deluxe">Deluxe Room</option>
            <option value="suite">Suite</option>
          </select>
        </div>

        <!-- Payment Section -->
        <div class="payment-section">
          <h3>Choose Payment Option</h3>

          <!-- GCash and PayMaya Option -->
          <div class="payment-option" id="gcashPaymaya">
            <input type="radio" name="paymentMethod" id="gcashPaymaya" value="gcashPaymaya">
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
            <img src="https://via.placeholder.com/100?text=GCash+PayMaya+QR" alt="GCash QR Code" class="qr-code">
            <img src="https://via.placeholder.com/100?text=GCash+PayMaya+QR" alt="PayMaya QR Code" class="qr-code">
          </div>

          <!-- PayPal and Credit/Debit Card Option -->
          <div class="payment-option" id="paypalCreditCard">
            <input type="radio" name="paymentMethod" id="paypalCreditCard" value="paypalCreditCard">
            <label for="paypalCreditCard">PayPal / Credit/Debit Card</label>
            <div class="icon-container">
              <img src="{{ asset('img/transactions/creditdebit.jpg') }}" alt="Credit/Debit Card Icon">
            </div>
          </div>
          <div id="paypalCreditCard-details" class="payment-details">
            <p><strong>PayPal Email:</strong> payments@kagayakukin.com</p>
            <img src="https://via.placeholder.com/100?text=PayPal+QR" alt="PayPal QR Code" class="qr-code">
            <div class="form-group">
              <label for="cardNumber">Card Number</label>
              <input type="text" class="form-control" id="cardNumber" placeholder="1234 5678 9012 3456" required>
            </div>
            <div class="form-group">
              <label for="cardName">Name on Card</label>
              <input type="text" class="form-control" id="cardName" placeholder="John Doe" required>
            </div>
          </div>

          <!-- Bank Transfer Option -->
          <div class="payment-option" id="bankTransfer">
            <input type="radio" name="paymentMethod" id="bankTransfer" value="bankTransfer">
            <label for="bankTransfer">Bank Transfer</label>
            <div class="icon-container">
              <img src="{{ asset('img/transactions/bank.png') }}" alt="Bank Transfer Icon">
            </div>
          </div>
          <div id="bankTransfer-details" class="payment-details">
            <div class="form-group">
              <label for="accountName">Account Name</label>
              <input type="text" class="form-control" id="accountName" placeholder="KagayakuKin Yume Hotel" required>
            </div>
            <div class="form-group">
              <label for="accountNumber">Account Number</label>
              <input type="text" class="form-control" id="accountNumber" placeholder="1234567890" required>
            </div>
            <div class="form-group">
              <label for="routingNumber">Routing Number</label>
              <input type="text" class="form-control" id="routingNumber" placeholder="987654321" required>
            </div>
          </div>
        </div>

        <div class="text-center">
          <button type="button" class="btn btn-confirm" data-bs-toggle="modal" data-bs-target="#confirmModal">Confirm
            Booking</button>
          <button type="button" class="btn btn-cancel" data-bs-toggle="modal" data-bs-target="#cancelModal">Cancel
            Booking</button>
          <button type="button" class="btn btn-draft">Save Draft</button>
        </div>
      </form>
    </div>
  </div>

  <!-- Confirm Modal -->
  <div class="modal fade" id="confirmModal" tabindex="-1" aria-labelledby="confirmModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-body">
          <h5>Confirm Your Booking</h5>
          <p>Are you sure you want to confirm your booking?</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-confirm" data-bs-dismiss="modal">Yes</button>
          <button type="button" class="btn btn-cancel" data-bs-dismiss="modal">No</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Cancel Modal -->
  <div class="modal fade" id="cancelModal" tabindex="-1" aria-labelledby="cancelModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-body">
          <h5>Cancel Your Booking</h5>
          <p>Are you sure you want to cancel your booking?</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-confirm" data-bs-dismiss="modal">Yes</button>
          <button type="button" class="btn btn-cancel" data-bs-dismiss="modal">No</button>
        </div>
      </div>
    </div>
  </div>

    <script>
    // JavaScript to toggle payment details visibility
    document.querySelectorAll('input[name="paymentMethod"]').forEach((radio) => {
      radio.addEventListener('change', function() {
        // Hide all payment details
        document.querySelectorAll('.payment-details').forEach((details) => {
          details.classList.remove('active');
        });

        // Show the selected payment details
        const selectedDetails = document.getElementById(`${this.value}-details`);
        if (selectedDetails) {
          selectedDetails.classList.add('active');
        }
      });
    });
  </script>

@endsection
