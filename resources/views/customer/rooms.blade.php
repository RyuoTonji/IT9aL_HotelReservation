@extends('layouts.app')

@section('title', 'Rooms')

@section('content')

  <style>
    .room-card {
      transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .room-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
    }
  </style>

  <!-- Hero Section -->
  <section class="position-relative mb-5" style="height: 400px; overflow: hidden;">
    <div class="position-absolute w-100 h-100" style="z-index: -1;">
      <img src="{{ asset('img/rooms.jpg') }}" class="w-100 h-100" style="object-fit: cover;" alt="Luxurious Hotel Rooms">
      <div class="position-absolute top-0 left-0 w-100 h-100 bg-dark" style="opacity: 0.5;"></div>
    </div>
    <div class="container h-100 d-flex flex-column justify-content-center align-items-center">
      <h1 class="display-4 fw-bold mb-3 text-white">Rooms and Suites</h1>
      <p class="lead text-white">Experience unparalleled comfort in our luxurious accommodations</p>
    </div>
  </section>

  <main class="container my-5">
    <!-- Rooms Section -->
    <section class="mb-5">
      <div class="row row-cols-1 row-cols-md-3 g-4">
        @forelse($Rooms as $room)
          <div class="col">
            <div class="card h-100 room-card">
              <div class="bg-light text-center" style="height: 200px; overflow: hidden;">
                <img src="{{ asset($room->ImagePathname) }}" class="img-fluid"
                  style="width: 100%; height: 100%; object-fit: cover;" alt="Deluxe King Room">
              </div>
              <div class="card-body">
                <h3 class="card-title fs-5">{{ $room->RoomName }}</h3>
                <p class="card-text">{{ $room->RoomDescription }}</p>
                <div class="d-flex justify-content-between align-items-center">
                  <span class="fw-bold">₱{{ $room->RoomPrice }}/night</span>
                  <a href="booking.php" class="btn btn-primary">Book Now</a>
                </div>
              </div>
            </div>
          </div>
        @empty
          <div class="col">
            <div class="card h-100 room-card">
              <div class="card-body">
                <h3 class="card-title fs-5">No Rooms</h3>
                <p class="card-text">Currently no rooms at the moment, check back later.</p>
                <div class="d-flex justify-content-between align-items-center">
                </div>
              </div>
            </div>
          </div>
        @endforelse
      </div>
    </section>
  </main>
@endsection
