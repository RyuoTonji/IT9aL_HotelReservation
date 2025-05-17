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
  </style>

  <div class="booking-container">
    <div class="booking-content">
      <h2>Book Your Stay</h2>
      <form action="{{ route('append.booking') }}" method="POST">
        @csrf

        <div class="form-group">
          <label for="checkIn">Check-In Date</label>
          <div class="position-relative">
            <input type="date" class="form-control" id="checkIn" placeholder="mm/dd/yyyy" name="CheckInDate"
              value="{{ old('CheckInDate') }}" required>
            <i class="bi position-absolute" style="right: 15px; top: 50%; transform: translateY(-50%);"></i>
          </div>
          @error('CheckInDate')
            <div class="alert alert-danger mt-2">{{ $message }}</div>
          @enderror
        </div>

        <div class="form-group">
          <label for="checkOut">Check-Out Date</label>
          <div class="position-relative">
            <input type="date" class="form-control" id="checkOut" placeholder="mm/dd/yyyy" name="CheckOutDate"
              value="{{ old('CheckOutDate') }}" required>
            <i class="bi position-absolute" style="right: 15px; top: 50%; transform: translateY(-50%);"></i>
          </div>
          @error('CheckOutDate')
            <div class="alert alert-danger mt-2">{{ $message }}</div>
          @enderror
        </div>

        <div class="form-group">
          <label for="roomType">Room Type</label>
          <select class="form-control" id="roomType" name="RoomType" required>
            <option value="" disabled {{ old('RoomType') ? '' : 'selected' }}>Select Room Type</option>
            <option value="Standard" {{ old('RoomType') == 'Standard' ? 'selected' : '' }}>Standard Room</option>
            <option value="Executive" {{ old('RoomType') == 'Executive' ? 'selected' : '' }}">Executive Room</option>
            <option value="Deluxe" {{ old('RoomType') == 'Deluxe' ? 'selected' : '' }}>Deluxe Room</option>
          </select>
          @error('RoomType')
            <div class="alert alert-danger mt-2">{{ $message }}</div>
          @enderror
        </div>

        <div class="form-group">
          <label for="roomType">Room Size</label>
          <select class="form-control" id="roomType" name="RoomSize" required>
            <option value="" disabled {{ old('RoomSize') ? '' : 'selected' }}>Select Room Size</option>
            <option value="Single" {{ old('RoomSize') == 'Single' ? 'selected' : '' }}>Single</option>
            <option value="Double" {{ old('RoomSize') == 'Double' ? 'selected' : '' }}>Double</option>
            <option value="Family" {{ old('RoomSize') == 'Family' ? 'selected' : '' }}>Family</option>
          </select>
          @error('RoomSize')
            <div class="alert alert-danger mt-2">{{ $message }}</div>
          @enderror
        </div>

        <div class="form-group">
          <label for="guests">Number of Guests</label>
          <input type="number" class="form-control" id="guests" min="1" name="NumberOfGuests"
            value={{ old('NumberOfGuests') }} required>
          @error('NumberOfGuests')
            <div class="alert alert-danger mt-2">{{ $message }}</div>
          @enderror
        </div>

        {{-- <div class="form-group">
          <label for="guests">Number of Guests</label>
          <input type="number" class="form-control" id="guests" min="1" name="NumberOfGuests"
            value={{ old('NumberOfGuests') }} required>
          @error('NumberOfGuests')
            <div class="alert alert-danger mt-2">{{ $message }}</div>
          @enderror
        </div> --}}

        <div class="text-center">
          <button type="submit" class="btn btn-confirm">Confirm
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
    document.addEventListener('DOMContentLoaded', function() {
      const roomSizeSelect = document.getElementById('roomSize');
      const guestsInput = document.getElementById('guests');

      function updateGuestsMax() {
        const selectedOption = roomSizeSelect.options[roomSizeSelect.selectedIndex];
        const maxGuests = selectedOption ? selectedOption.getAttribute('data-capacity') : 1;
        guestsInput.max = maxGuests || 1; // Fallback to 1 if undefined
        // Reset guests input if current value exceeds new max
        if (guestsInput.value > maxGuests) {
          guestsInput.value = maxGuests;
        }
      }

      // Update max on room size change
      roomSizeSelect.addEventListener('change', updateGuestsMax);

      // Initialize max on page load
      updateGuestsMax();
    });
  </script>
@endsection
