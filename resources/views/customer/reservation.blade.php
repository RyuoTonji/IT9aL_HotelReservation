@extends('layouts.app')

@section('title', 'Reservation')

@section('content')

  <style>
    body {
      font-family: "Poppins", sans-serif;
      background-color: #f8f9fa;
    }

    .reservation-container {
      max-width: 800px;
      margin: 50px auto;
      padding: 30px;
      background: url("https://images.unsplash.com/photo-1590073242678-70ee3c9e8af3?q=80&w=2070&auto=format&fit=crop") no-repeat center center;
      background-size: cover;
      border-radius: 15px;
      box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
      position: relative;
    }

    .reservation-container::before {
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

    .reservation-content {
      position: relative;
      z-index: 2;
    }

    .reservation-container h2 {
      color: #000;
      text-align: center;
      margin-bottom: 30px;
      font-weight: 600;
    }

    .reservation-details {
      background-color: #fff;
      padding: 20px;
      border-radius: 10px;
      box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
    }

    .reservation-details p {
      margin: 10px 0;
      font-size: 16px;
      color: #333;
    }

    .reservation-details strong {
      color: #000;
      font-weight: 500;
    }

    .btn {
      border-radius: 25px;
      padding: 10px 20px;
      font-family: "Poppins", sans-serif;
      margin: 5px;
    }

    .btn-book {
      background-color: #f8cb45;
      border-color: #f8cb45;
      color: #000;
    }

    .btn-book:hover {
      background-color: #e0b33d;
      border-color: #e0b33d;
    }

    .alert-info {
      background-color: #e9f7fe;
      border-color: #b8e4fb;
      color: #31708f;
      padding: 15px;
      border-radius: 10px;
      text-align: center;
    }
  </style>

  <div class="reservation-container col-12">
    <div class="reservation-content">
      <h2>Your Reservation</h2>

      @if ($reservation)
        <table class="table table-bordered">
          <tr>
            <th class="col-5">Booking ID</th>
            <td>{{ $reservation->ID }}</td>
          </tr>
          <tr>
            <th class="col-5">Check-In Date</th>
            <td>{{ \Carbon\Carbon::parse($reservation->CheckInDate)->format('F j, Y') }}</td>
          </tr>
          <tr>
            <th class="col-5">Check-Out Date</th>
            <td>{{ \Carbon\Carbon::parse($reservation->CheckOutDate)->format('F j, Y') }}</td>
          </tr>
          <tr>
            <th class="col-5">Room Type</th>
            <td>{{ $reservation->roomType->RoomTypeName }}</td>
          </tr>
          <tr>
            <th class="col-5">Room Size</th>
            <td>{{ $reservation->roomSize->RoomSizeName }}</td>
          </tr>
          <tr>
            <th class="col-5">Number of Guests</th>
            <td>{{ $reservation->NumberOfGuests }}</td>
          </tr>
          <tr>
            <th class="col-5">Additional Services</th>
            <td>
              @if ($reservation->servicesAdded->isEmpty())
                None
              @else
                {{ $reservation->servicesAdded->pluck('ServiceName')->implode(', ') }}
              @endif
            </td>
          </tr>
        </table>

        <table class="table table-bordered">
          <tr>
            <th class="col-5">Assigned Room</th>
            <td>{{ $reservation->assignedRooms->first()->room->RoomName ?? 'N/A' }}</td>
          </tr>
          <tr>
            <th class="col-5">Booking Status</th>
            <td>{{ $reservation->BookingStatus }}</td>
          </tr>
          <tr>
            <th class="col-5">Total Amount</th>
            <td>₱{{ number_format($reservation->costDetails->TotalAmount, 2) }}</td>
          </tr>
        </table>
      @else
        <div class="alert alert-info">
          You have no active reservations. Start a new booking to reserve your stay!
          <div class="text-center mt-3">
            <a href="{{ route('booking') }}" class="btn btn-book">Book Now</a>
          </div>
        </div>
      @endif
    </div>
  </div>

@endsection
