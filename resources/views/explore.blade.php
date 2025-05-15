@extends('layouts.app')

@section('title', 'Explore')

@section('content')
  <!-- Hero Section - Full width with background image -->
  <section class="position-relative mb-5" style="height: 400px; overflow: hidden;">
    <div class="position-absolute w-100 h-100" style="z-index: -1;">
      <img src="{{ asset('img/mainhotel.jpg') }}" class="w-100 h-100" style="object-fit: cover;" alt="Hotel Panorama">
      <div class="position-absolute top-0 left-0 w-100 h-100 bg-dark" style="opacity: 0.5;"></div>
    </div>
    <div class="container h-100 d-flex flex-column justify-content-center align-items-center">
      <h1 class="display-4 fw-bold mb-3 text-white">Take a Tour</h1>
      <p class="lead text-white">Discover our world-class accommodations and amenities for an unforgettable stay.</p>
    </div>
  </section>

  <main class="container my-5">
    <!-- Tour Section -->
    <section class="mb-5">
      <div class="row g-4">
        <div class="col-12">
          <div class="card">
            <div class="bg-light text-center" style="height: 300px; overflow: hidden;">
              <img src="{{ asset('img/fitness.png') }}" class="img-fluid" 
                   style="width: 100%; height: 100%; object-fit: cover;" alt="Fitness Center">
            </div>
            <div class="card-body text-center">
              <h3 class="card-title fs-5 text-warning">Fitness Center</h3>
              <p class="card-text">Stay active in our state-of-the-art fitness center, equipped with modern cardio
                machines, free weights, and personal training sessions available upon request.</p>
            </div>
          </div>
        </div>
        <div class="col-12">
          <div class="card">
            <div class="bg-light text-center" style="height: 300px; overflow: hidden;">
              <img src="{{ asset('img/spa.png') }}" class="img-fluid"
                   style="width: 100%; height: 100%; object-fit: cover;" alt="Spa & Wellness">
            </div>
            <div class="card-body text-center">
              <h3 class="card-title fs-5 text-warning">Spa & Wellness</h3>
              <p class="card-text">Indulge in relaxation with our luxurious spa, offering a range of treatments including
                massages, facials, and holistic therapies for ultimate rejuvenation.</p>
            </div>
          </div>
        </div>
        <div class="col-12">
          <div class="card">
            <div class="bg-light text-center" style="height: 300px; overflow: hidden;">
              <img src="{{ asset('img/pool.jpg') }}" class="img-fluid"
                   style="width: 100%; height: 100%; object-fit: cover;" alt="Rooftop Infinity Pool">
            </div>
            <div class="card-body text-center">
              <h3 class="card-title fs-5 text-warning">Rooftop Infinity Pool</h3>
              <p class="card-text">Enjoy breathtaking views of Davao City from our rooftop infinity pool, complete with
                poolside service and comfortable lounge areas.</p>
            </div>
          </div>
        </div>
      </div>
    </section>
  </main>
@endsection