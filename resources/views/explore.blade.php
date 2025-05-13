@extends('layouts.app')

@section('title', 'Explore')

@section('content')

  <main class="container my-5">
    <!-- Hero Section -->
    <section class="bg-light py-5 mb-5 text-center">
      <h1 class="display-4 fw-bold mb-3">Take a Tour</h1>
      <p class="lead">Discover our world-class accommodations and amenities for an unforgettable stay.</p>
    </section>

    <!-- Tour Section -->
    <section class="mb-5">
      <div class="row g-4">
        <div class="col-12">
          <div class="card">
            <div class="bg-light p-5 text-center" style="height: 300px;">
              <p class="text-muted">Image here</p>
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
            <div class="bg-light p-5 text-center" style="height: 300px;">
              <p class="text-muted">Image here</p>
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
            <div class="bg-light p-5 text-center" style="height: 300px;">
              <p class="text-muted">Image here</p>
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
