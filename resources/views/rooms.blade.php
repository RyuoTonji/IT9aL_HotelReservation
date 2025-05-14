@extends('layouts.app')

@section('title', 'Rooms')

@section('content')

  <main class="container my-5">
    <!-- Hero Section -->
    <section class="bg-light py-5 mb-5 text-center">
      <h1 class="display-4 fw-bold mb-3">Rooms and Suites</h1>
      <div class="col">
      <div class="card h-100">
        <div class="bg-light text-center" style="height: 350px; overflow: hidden;">
          <main class="container my-5">
  <div class="position-relative" style="z-index: 2;">
    <img src="{{ asset('img/lobby3.png') }}" alt="hotel" class="img-fluid w-100 lobbyImage" style="max-height: 600px; object-fit: cover;">
  </div>
</main>
      </div>
    </section>

   <section class="bg-warning bg-opacity-25 py-5 mb-5">
  <h2 class="display-6 fw-bold text-center mb-3">Luxurious Rooms</h2>
  <p class="text-center text-muted mb-5">All rooms are designed for your comfort.</p>
  <div class="row row-cols-1 row-cols-md-3 g-4">
    <div class="col">
      <div class="card h-100">
        <div class="bg-light text-center" style="height: 350px; overflow: hidden;">
          <main class="container my-5">
  <div class="position-relative" style="z-index: 2;">
    <img src="{{ asset('img/bedroom.png') }}" alt="hotel" class="img-fluid w-100 lobbyImage" style="max-height: 600px; object-fit: cover;">
  </div>
</main>

          style="width: 100%; height: 100%; object-fit: cover;" alt="Deluxe King Room">
        </div>
        <div class="card-body">
          <h3 class="card-title fs-5">Deluxe King Room</h3>
          <p class="card-text">Experience elegance in our Deluxe King Room, featuring a plush king-sized bed, modern amenities, and a private balcony with city views.</p>
          <div class="d-flex justify-content-between align-items-center">
            <span class="fw-bold">₱30,000/night</span>
            <a href="booking.php" class="btn btn-primary">Book Now</a>
          </div>
        </div>
      </div>
    </div>
    <div class="col">
      <div class="card h-100">
        <div class="bg-light text-center" style="height: 350px; overflow: hidden;">
          <main class="container my-5">
  <div class="position-relative" style="z-index: 2;">
    <img src="{{ asset('img/bedroom1.jpg') }}" alt="hotel" class="img-fluid w-100 lobbyImage" style="max-height: 600px; object-fit: cover;">
  </div>
</main>

          style="width: 100%; height: 100%; object-fit: cover;" alt="Executive Suite">
        </div>
        <div class="card-body">
          <h3 class="card-title fs-5">Executive Suite</h3>
          <p class="card-text">Perfect for business travelers, our Executive Suite offers a spacious living area, high-speed Wi-Fi, and a dedicated workspace for productivity.</p>
          <div class="d-flex justify-content-between align-items-center">
            <span class="fw-bold">₱20,000/night</span>
            <a href="booking.php" class="btn btn-primary">Book Now</a>
          </div>
        </div>
      </div>
    </div>
    <div class="col">
      <div class="card h-100">
        <div class="bg-light text-center" style="height: 350px; overflow: hidden;">
          <main class="container my-5">
  <div class="position-relative" style="z-index: 2;">
    <img src="{{ asset('img/bedroom2.jpg') }}" alt="hotel" class="img-fluid w-200 lobbyImage" style="height: 600x; object-fit: cover;">
  </div>
</main>

          style="width: 100%; height: 100%; object-fit: cover;" alt="Family Suite">
        </div>
        <div class="card-body">
          <h3 class="card-title fs-5">Family Suite</h3>
          <p class="card-text">Ideal for families, our Family Suite includes multiple bedrooms, a cozy living area, and child-friendly amenities for a comfortable stay.</p>
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
