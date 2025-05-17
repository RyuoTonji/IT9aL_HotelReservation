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
        <div class="col">
          <div class="card h-100 room-card">
            <div class="bg-light text-center" style="height: 200px; overflow: hidden;">
              <img src="{{ asset('img/DeluxeRoom.jpg') }}" class="img-fluid"
                style="width: 100%; height: 100%; object-fit: cover;" alt="Deluxe King Room">
            </div>
            <div class="card-body">
              <h3 class="card-title fs-5">Deluxe King Room</h3>
              <p class="card-text">Spacious room with a plush king-sized bed, modern amenities, and a private balcony
                offering stunning city views. Perfect for solo travelers or couples.</p>
              <div class="d-flex justify-content-between align-items-center">
                <span class="fw-bold">₱30,000/night</span>
                <a href="booking.php" class="btn btn-primary">Book Now</a>
              </div>
            </div>
          </div>
        </div>
        <div class="col">
          <div class="card h-100 room-card">
            <div class="bg-light text-center" style="height: 200px; overflow: hidden;">
              <img src="{{ asset('img/SuperioRoom.png') }}" class="img-fluid"
                style="width: 100%; height: 100%; object-fit: cover;" alt="Executive Suite">
            </div>
            <div class="card-body">
              <h3 class="card-title fs-5">Executive Suite</h3>
              <p class="card-text">Perfect for business travelers, our Executive Suite offers a spacious living area,
                high-speed Wi-Fi, and a dedicated workspace for productivity.</p>
              <div class="d-flex justify-content-between align-items-center">
                <span class="fw-bold">₱20,000/night</span>
                <a href="booking.php" class="btn btn-primary">Book Now</a>
              </div>
            </div>
          </div>
        </div>
        <div class="col">
          <div class="card h-100 roomc-card">
            <div class="bg-light text-center" style="height: 200px; overflow: hidden;">
              <img src="{{ asset('img/standardroom.png') }}" class="img-fluid"
                style="width: 100%; height: 100%; object-fit: cover;" alt="Family Suite">
            </div>
            <div class="card-body">
              <h3 class="card-title fs-5">Family Suite</h3>
              <p class="card-text">Ideal for families, Couples, our Standard Suite includes multiple bedrooms, a cozy
                living area,
                and child-friendly amenities for a comfortable stay.</p>
              <div class="d-flex justify-content-between align-items-center">
                <span class="fw-bold">₱10,000/night</span>
                <a href="booking.php" class="btn btn-primary">Book Now</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </main>
@endsection
