<?php
use App\Models\LoyaltyTier;
?>
@extends('layouts.app')

@section('title', 'Booking Details')

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

    .detail-group {
      margin-bottom: 20px;
    }

    .detail-group label {
      font-weight: 500;
      color: #333;
      display: inline-block;
      width: 150px;
    }

    .detail-group span {
      color: #555;
    }

    .cost-table {
      width: 100%;
      margin-top: 20px;
      border-collapse: collapse;
    }

    .cost-table th,
    .cost-table td {
      padding: 10px;
      text-align: left;
      border-bottom: 1px solid #ddd;
    }

    .cost-table th {
      background-color: #f8cb45;
      color: #000;
    }

    .cost-table .total {
      font-weight: 600;
      color: #000;
    }

    .btn {
      border-radius: 25px;
      padding: 10px 20px;
      font-family: "Poppins", sans-serif;
      margin: 10px;
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

    .no-bookings {
      text-align: center;
      color: #555;
      margin-top: 20px;
    }
  </style>

  <div class="booking-container">
    <div class="booking-content">
      <h2>Booking Details</h2>

      {{-- @dd($booking) --}}
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
          <span>{{ $booking->room->RoomTypeName }}</span>
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
            @if ($booking->services->isEmpty())
              None
            @else
              {{ $booking->services->pluck('ServiceName')->implode(', ') }}
            @endif
          </span>
        </div>

        <table class="cost-table">
          <tr>
            <th>Description</th>
            <th>Amount</th>
          </tr>
          <tr>
            <td>Room Price</td>
            <td>{{ number_format($roomPrice, 2) }}</td>
          </tr>
          <tr>
            <td>Guest Fee ({{ $booking->NumberOfGuests }} x {{ number_format($booking->roomSize->PricePerPerson, 2) }})
            </td>
            <td>{{ number_format($guestFee, 2) }}</td>
          </tr>
          <tr>
            <td>Services</td>
            <td>{{ number_format($serviceCost, 2) }}</td>
          </tr>
          <tr>
            <td>Subtotal</td>
            <td>{{ number_format($subtotal, 2) }}</td>
          </tr>
          @if ($discount > 0)
            <tr>
              <td>Loyalty Discount ({{ $tier->Discount }}%)</td>
              <td>-{{ number_format($discount, 2) }}</td>
            </tr>
          @endif
          <tr class="total">
            <td>Total Amount</td>
            <td>{{ number_format($totalAmount, 2) }}</td>
          </tr>
        </table>

        @if (!$PaymentProcessed)
          <div style="text-align: center; margin-top: 30px;">
            <form action="{{ route('cancel.booking', $booking->ID) }}" method="POST" style="display: inline;">
              @csrf
              @method('POST')
              <button type="submit" class="btn btn-cancel">Cancel Booking</button>
            </form>
            <form action="{{ route('checkout.form') }}" method="POST" style="display: inline;">
              @csrf
              <button type="submit" class="btn btn-confirm">Proceed to Payment</button>
            </form>
          </div>
        @else
          <div class="alert alert-warning mt-2">Your payment is being currently processed.</div>
        @endif
      @else
        <div class="no-bookings">
          <p>You have no pending bookings.</p>
          <a href="{{ route('booking') }}" class="btn btn-confirm">Book Now</a>
        </div>
      @endif
    </div>
  </div>

@endsection

{{-- @dd($Room) --}}
