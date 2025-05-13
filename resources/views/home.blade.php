@extends('layouts.app')

@section('title', 'Home')

@section('content')

  <main class="container my-5">
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
          <img src="{{ asset('images/hotel-lobby.jpg') }}" class="img-fluid"
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
          <div class="card h-100">
            <div class="card-body">
              <h3 class="card-title fs-5">Luxurious Rooms</h3>
              <p class="card-text">Elegant and comfortable rooms with modern amenities.</p>
            </div>
          </div>
        </div>
        <div class="col">
          <div class="card h-100">
            <div class="card-body">
              <h3 class="card-title fs-5">Fine Dining</h3>
              <p class="card-text">Exquisite cuisine prepared by world-class chefs.</p>
            </div>
          </div>
        </div>
        <div class="col">
          <div class="card h-100">
            <div class="card-body">
              <h3 class="card-title fs-5">Swimming Pool</h3>
              <p class="card-text">Refreshing pool with stunning views and poolside service.</p>
            </div>
          </div>
        </div>
        <div class="col">
          <div class="card h-100">
            <div class="card-body">
              <h3 class="card-title fs-5">Spa & Wellness</h3>
              <p class="card-text">Rejuvenating treatments and therapies for complete relaxation.</p>
            </div>
          </div>
        </div>
        <div class="col">
          <div class="card h-100">
            <div class="card-body">
              <h3 class="card-title fs-5">Fitness Center</h3>
              <p class="card-text">State-of-the-art equipment and personal training options.</p>
            </div>
          </div>
        </div>
        <div class="col">
          <div class="card h-100">
            <div class="card-body">
              <h3 class="card-title fs-5">Concierge Service</h3>
              <p class="card-text">24/7 assistance for all your needs during your stay.</p>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Rooms Section -->
    <section class="bg-warning bg-opacity-25 py-5 mb-5">
      <h2 class="display-6 fw-bold text-center mb-3">Luxurious Rooms</h2>
      <p class="text-center text-muted mb-5">All rooms are designed for your comfort.</p>
      <div class="row row-cols-1 row-cols-md-3 g-4">
        <div class="col">
          <div class="card h-100">
            <div class="bg-light text-center" style="height: 200px; overflow: hidden;">
              <img src="{{ asset('images/deluxe-king-room.jpg') }}" class="img-fluid"
                style="width: 100%; height: 100%; object-fit: cover;" alt="Deluxe King Room">
            </div>
            <div class="card-body">
              <h3 class="card-title fs-5">Deluxe King Room</h3>
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
          <div class="card h-100">
            <div class="bg-light text-center" style="height: 200px; overflow: hidden;">
              <img src="{{ asset('images/executive-suite.jpg') }}" class="img-fluid"
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
          <div class="card h-100">
            <div class="bg-light text-center" style="height: 200px; overflow: hidden;">
              <img src="{{ asset('images/family-suite.jpg') }}" class="img-fluid"
                style="width: 100%; height: 100%; object-fit: cover;" alt="Family Suite">
            </div>
            <div class="card-body">
              <h3 class="card-title fs-5">Family Suite</h3>
              <p class="card-text">Ideal for families, our Family Suite includes multiple bedrooms, a cozy living area,
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

    <!-- Reviews Section -->
    <section class="mb-5">
      <h2 class="display-6 fw-bold text-center mb-5">Reviews</h2>
      <div class="row row-cols-1 row-cols-md-3 g-4">
        <div class="col">
          <div class="card h-100">
            <div class="card-body">
              <h4 class="card-title fw-semibold">Emily Richardson</h4>
              <div class="text-warning">
                <i class="bi bi-star-fill"></i>
                <i class="bi bi-star-fill"></i>
                <i class="bi bi-star-fill"></i>
                <i class="bi bi-star-fill"></i>
                <i class="bi bi-star-fill"></i>
              </div>
              <p class="card-text">"Absolutely stunning hotel with impeccable service. The rooms are spacious and
                luxurious, and the staff went above and beyond to make our stay special. Will definitely return!"</p>
            </div>
          </div>
        </div>
        <div class="col">
          <div class="card h-100">
            <div class="card-body">
              <h4 class="card-title fw-semibold">Michael Thompson</h4>
              <div class="text-warning">
                <i class="bi bi-star-fill"></i>
                <i class="bi bi-star-fill"></i>
                <i class="bi bi-star-fill"></i>
                <i class="bi bi-star-fill"></i>
                <i class="bi bi-star-half"></i>
              </div>
              <p class="card-text">"The hotel exceeded all my expectations. The room was immaculate, the dining options
                were excellent, and the location is perfect for both business and leisure. Highly recommend!"</p>
            </div>
          </div>
        </div>
        <div class="col">
          <div class="card h-100">
            <div class="card-body">
              <h4 class="card-title fw-semibold">Sophia Martinez</h4>
              <div class="text-warning">
                <i class="bi bi-star-fill"></i>
                <i class="bi bi-star-fill"></i>
                <i class="bi bi-star-fill"></i>
                <i class="bi bi-star-fill"></i>
                <i class="bi bi-star-fill"></i>
              </div>
              <p class="card-text">"We celebrated our anniversary here and it was magical. The spa treatments were
                rejuvenating, and the special dinner arranged by the staff was unforgettable. Thank you for making our
                occasion so special!"</p>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Proof of Reviews -->
    <section class="bg-light py-5">
      <h2 class="display-6 fw-bold text-center mb-5">Proof of Reviews</h2>
      <div class="d-flex flex-wrap justify-content-center gap-4">
        <div class="card p-4 d-flex flex-row align-items-center" style="width: 300px;">
          <div class="me-3">
            <i class="bi bi-tripadvisor fs-3 text-warning"></i>
          </div>
          <div>
            <div class="text-warning">
              <i class="bi bi-star-fill"></i>
              <i class="bi bi-star-fill"></i>
              <i class="bi bi-star-fill"></i>
              <i class="bi bi-star-fill"></i>
              <i class="bi bi-star-half"></i>
            </div>
            <p class="fw-semibold">4.8/5 based on 1,245 reviews</p>
          </div>
        </div>
        <div class="card p-4 d-flex flex-row align-items-center" style="width: 300px;">
          <div class="me-3">
            <i class="bi bi-building fs-3 text-warning"></i>
          </div>
          <div>
            <div class="text-warning">
              <i class="bi bi-star-fill"></i>
              <i class="bi bi-star-fill"></i>
              <i class="bi bi-star-fill"></i>
              <i class="bi bi-star-fill"></i>
              <i class="bi bi-star-fill"></i>
            </div>
            <p class="fw-semibold">5.0/5 based on 876 reviews</p>
          </div>
        </div>
        <div class="card p-4 d-flex flex-row align-items-center" style="width: 300px;">
          <div class="me-3">
            <i class="bi bi-google fs-3 text-warning"></i>
          </div>
          <div>
            <div class="text-warning">
              <i class="bi bi-star-fill"></i>
              <i class="bi bi-star-fill"></i>
              <i class="bi bi-star-fill"></i>
              <i class="bi bi-star-fill"></i>
              <i class="bi bi-star-half"></i>
            </div>
            <p class="fw-semibold">4.7/5 based on 2,103 reviews</p>
          </div>
        </div>
      </div>
    </section>
  </main>
@endsection
