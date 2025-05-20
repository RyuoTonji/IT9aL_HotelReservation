// resources/views/checkout.blade.php (new version, original remains)
@extends('layouts.app')

@section('title', 'Checkout')

@section('content')
    <div class="container">
        <h1 class="main-text">Checkout</h1>
        <div class="card">
            <div class="card-header">
                <h5>Booking Summary</h5>
            </div>
            <div class="card-body">
                <p><strong>Room:</strong> {{ $Room->RoomTypeName }}</p>
                <p><strong>Check-in:</strong> {{ $booking->CheckInDate->format('Y-m-d') }}</p>
                <p><strong>Check-out:</strong> {{ $booking->CheckOutDate->format('Y-m-d') }}</p>
                <p><strong>Guests:</strong> {{ $booking->NumberOfGuests }}</p>
                <p><strong>Total Amount:</strong> ₱{{ number_format($totalAmount, 2) }}</p>
                <p><strong>Discount:</strong> {{ $discount }}%</p>
                <p><strong>Final Amount:</strong> ₱{{ number_format($finalAmount, 2) }}</p>
            </div>
        </div>

        <div class="card mt-4">
            <div class="card-header">
                <h5>Payment Method</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('checkout.process') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Payment Method</label>
                        <select class="form-control" name="PaymentMethod" required>
                            <option value="Cash">Cash</option>
                            <option value="Card">Card</option>
                            <option value="GCash">GCash</option>
                        </select>
                    </div>
                    <div id="cashFields" style="display: none;">
                        <div class="mb-3">
                            <label for="cashAmount" class="form-label">Amount</label>
                            <input type="number" class="form-control" id="cashAmount" name="cashAmount" step="0.01">
                        </div>
                    </div>
                    <div id="cardFields" style="display: none;">
                        <div class="mb-3">
                            <label for="cardName" class="form-label">Name on Card</label>
                            <input type="text" class="form-control" id="cardName" name="cardName">
                        </div>
                        <div class="mb-3">
                            <label for="cardNumber" class="form-label">Card Number</label>
                            <input type="text" class="form-control" id="cardNumber" name="cardNumber">
                        </div>
                        <div class="mb-3">
                            <label for="cardExpiry" class="form-label">Expiry</label>
                            <input type="text" class="form-control" id="cardExpiry" name="cardExpiry" placeholder="MM/YY">
                        </div>
                        <div class="mb-3">
                            <label for="cardCVC" class="form-label">CVC</label>
                            <input type="text" class="form-control" id="cardCVC" name="cardCVC">
                        </div>
                    </div>
                    <div id="gcashFields" style="display: none;">
                        <div class="mb-3">
                            <label for="gcashName" class="form-label">Name</label>
                            <input type="text" class="form-control" id="gcashName" name="gcashName">
                        </div>
                        <div class="mb-3">
                            <label for="gcashNumber" class="form-label">Number</label>
                            <input type="text" class="form-control" id="gcashNumber" name="gcashNumber">
                        </div>
                        <div class="mb-3">
                            <label for="gcashAmount" class="form-label">Amount</label>
                            <input type="number" class="form-control" id="gcashAmount" name="gcashAmount" step="0.01">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Process Payment</button>
                </form>
            </div>
        </div>
    </div>

    @section('scripts')
        <script>
            document.querySelector('[name="PaymentMethod"]').addEventListener('change', function() {
                document.getElementById('cashFields').style.display = this.value === 'Cash' ? 'block' : 'none';
                document.getElementById('cardFields').style.display = this.value === 'Card' ? 'block' : 'none';
                document.getElementById('gcashFields').style.display = this.value === 'GCash' ? 'block' : 'none';
            });
        </script>
    @endsection
  @endsection
