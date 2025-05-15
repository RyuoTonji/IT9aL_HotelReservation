@extends('layouts.app')

@section('title', 'Home')

@section('content')

  <main class="container my-5">

    <style>
    .room-card, .facility-card {
      transition: transform 0.3s ease, box-shadow 0.3s ease;
      border-radius: 1rem;
      overflow: hidden;
    }
    .room-card:hover, .facility-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 10px 20px rgba(0,0,0,0.1);    
    }
    .card-img-container {
      overflow: hidden;
    }
  </style>

    <!-- Hero Section -->
    <section class="row align-items-center mb-5">
      <div class="col-md-6">
        <p class="logo fs-4 mb-2">KagayakuKin Yume Hotel</p>
        <h1 class="display-4 fw-bold mb-4">Experience Luxury<br>Like Never Before</h1>
        <p class="text-muted mb-4">Indulge in unparalleled comfort and sophistication at KagayakuKin Yume Hotel, where
          every moment is crafted for your delight.</p>
        <a href="booking.php" class="btn btn-primary">Book now</a>
      </div>
      <div class="col-md-6 mt-4 mt-md-0">
        <div class="bg-light text-center" style="height: 400px; overflow: hidden;">
          <img src="{{ asset('img/heroimage.jpg') }}" class="img-fluid"
            style="width: 100%; height: 100%; object-fit: cover;" alt="KagayakuKin Yume Hotel Lobby">
        </div>
      </div>
    </section>

    <!-- Facilities Section -->
    <section class="mb-5">
      <h2 class="display-6 fw-bold text-center mb-3">Our Facilities</h2>
      <p class="text-center text-muted mb-5">We offer modern (5 star) hotel facilities for your comfort.</p>
      <div class="row row-cols-1 row-cols-md-3 g-4">
        <div class="col">
          <div class="card h-100 facility-card">
            <div class="card-img-container">
              <img src="{{ asset('img/DeluxeRoom.jpg') }}" class="img-fluid"
                style="width: 100%; height: 200px; object-fit: cover;" alt="Luxurious Rooms">
            </div>
            <div class="card-body">
              <h3 class="card-title fs-5">Luxurious Rooms</h3>
              <p class="card-text">Elegant and comfortable rooms with modern amenities.</p>
            </div>
          </div>
        </div>
        <div class="col">
          <div class="card h-100 facility-card">
            <div class="card-img-container">
              <img src="{{ asset('img/foodsbuffet.png') }}" class="img-fluid"
                style="width: 100%; height: 200px; object-fit: cover;" alt="Fine Dining">
            </div>
            <div class="card-body">
              <h3 class="card-title fs-5">Fine Dining</h3>
              <p class="card-text">Exquisite cuisine prepared by world-class chefs.</p>
            </div>
          </div>
        </div>
        <div class="col">
          <div class="card h-100 facility-card">
            <div class="card-img-container">
              <img src="{{ asset('img/pool.jpg') }}" class="img-fluid"
                style="width: 100%; height: 200px; object-fit: cover;" alt="Swimming Pool">
            </div>
            <div class="card-body">
              <h3 class="card-title fs-5">Swimming Pool</h3>
              <p class="card-text">Refreshing pool with stunning views and poolside service.</p>
            </div>
          </div>
        </div>
        <div class="col">
          <div class="card h-100 facility-card">
            <div class="card-img-container">
              <img src="{{ asset('img/spa.png') }}" class="img-fluid"
                style="width: 100%; height: 200px; object-fit: cover;" alt="Spa & Wellness">
            </div>
            <div class="card-body">
              <h3 class="card-title fs-5">Spa & Wellness</h3>
              <p class="card-text">Rejuvenating treatments and therapies for complete relaxation.</p>
            </div>
          </div>
        </div>
        <div class="col">
          <div class="card h-100 facility-card">
            <div class="card-img-container">
              <img src="{{ asset('img/fitness.png') }}" class="img-fluid"
                style="width: 100%; height: 200px; object-fit: cover;" alt="Fitness Center">
            </div>
            <div class="card-body">
              <h3 class="card-title fs-5">Fitness Center</h3>
              <p class="card-text">State-of-the-art equipment and personal training options.</p>
            </div>
          </div>
        </div>
        <div class="col">
          <div class="card h-100 facility-card">
            <div class="card-img-container">
              <img src="{{ asset('img/concierge.png') }}" class="img-fluid"
                style="width: 100%; height: 200px; object-fit: cover;" alt="Concierge Service">
            </div>
            <div class="card-body">
              <h3 class="card-title fs-5">Concierge Service</h3>
              <p class="card-text">24/7 assistance for all your needs during your stay.</p>
            </div>
          </div>
        </div>
      </div>
    </section>
    </main>

    <!-- Rooms Section -->
    <section class="bg-warning bg-opacity-25 py-5 mb-5">
    <div class="container"><!-- Container inside for content alignment -->
      <h2 class="display-6 fw-bold text-center mb-3">Luxurious Rooms</h2>
      <p class="text-center text-muted mb-5">All rooms are designed for your comfort.</p>
      <div class="row row-cols-1 row-cols-md-3 g-4">
        <div class="col">
          <div class="card h-100 room-card">
            <div class="card-img-container">
              <img src="{{ asset('img/DeluxeRoom.jpg') }}" class="img-fluid"
                style="width: 100%; height: 200px; object-fit: cover;" alt="Deluxe King Room">
            </div>
            <div class="card-body">
              <h3 class="card-title fs-5">Deluxe Suite</h3>
              <p class="card-text">Experience elegance in our Deluxe King Room, featuring a plush king-sized bed, modern
                amenities, and a private balcony with city views.</p>
              <div class="d-flex justify-content-between align-items-center">
                <span class="fw-bold">₱30,000/night</span>
                <a href="booking.php" class="btn btn-primary">Book Now</a>
              </div>
            </div>
          </div>
        </div>
        <div class="col">
          <div class="card h-100 room-card">
            <div class="card-img-container">
              <img src="{{ asset('img/SuperioRoom.png') }}" class="img-fluid"
                style="width: 100%; height: 200px; object-fit: cover;" alt="Executive Suite">
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
          <div class="card h-100 room-card">
            <div class="card-img-container">
              <img src="{{ asset('img/standardroom.png') }}" class="img-fluid"
                style="width: 100%; height: 200px; object-fit: cover;" alt="Family Suite">
            </div>
            <div class="card-body">
              <h3 class="card-title fs-5">Standard Suite</h3>
              <p class="card-text">Ideal for families, Couple, and many more our Standard Suite includes multiple bedrooms, a cozy living area,
                and child-friendly amenities for a comfortable stay.</p>
              <div class="d-flex justify-content-between align-items-center">
                <span class="fw-bold">₱10,000/night</span>
                <a href="booking.php" class="btn btn-primary">Book Now</a>
              </div>
            </div>
          </div>  
        </div>
      </div>
    </div>
  </section>
  
@endsection