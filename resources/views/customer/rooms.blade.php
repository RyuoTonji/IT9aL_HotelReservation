@extends('layouts.app')

@section('title', 'Rooms')

@section('content')

  <main class="container my-5">
    <!-- Hero Section -->
    <section class="bg-light py-5 mb-5 text-center">
      <h1 class="display-4 fw-bold mb-3">Rooms and Suites</h1>
      <div class="bg-secondary p-5 text-center text-white" style="height: 300px;">
        <p>Background Image</p>
      </div>
    </section>

    <!-- Rooms Section -->
    <section class="mb-5">
      <div class="row row-cols-1 row-cols-md-3 g-4">
        @forelse($Rooms as $room)
          <div class="col">
            <div class="card h-100">
              <div class="bg-light text-center" style="height: 200px; overflow: hidden;">
                <img src="{{ asset($room->ImagePathname) }}" class="img-fluid"
                  style="width: 100%; height: 100%; object-fit: cover;" alt="{{ $room->ImageName }}">
              </div>
              <div class="card-body">
                <h3 class="card-title fs-5">{{ $room->RoomName }}</h3>
                <p class="card-text">{{ $room->RoomDescription }}</p>
                <div class="d-flex justify-content-between align-items-center">
                  <span class="fw-bold">₱{{ $room->RoomPrice }}/night</span>
                  <!-- Modified: Change link to button that triggers modal -->
                  @auth
                    <form action="{{ route('checkout', $room->RoomID) }}" method="GET">
                      <button class="btn btn-primary room-book-btn">Book Now</button>
                    </form>
                  @else
                    <button class="btn btn-primary room-book-btn" data-bs-toggle="modal" data-bs-target="#authModal"
                      data-form="login">Book Now</button>
                  @endauth

                  <!-- End Modified -->
                </div>
              </div>
            </div>
          </div>
        @empty
          <div class="col">
            <div class="card h-100">
              <div class="card-body">
                <h3 class="card-title fs-5">No Rooms Available</h3>
                <p class="card-text">No rooms available at this moment, please come back later.</p>
              </div>
            </div>
          </div>
        @endforelse
        {{-- <div class="col">
          <div class="card h-100">
            <div class="bg-light p-5 text-center" style="height: 200px;">
              <p class="text-muted">Image here...</p>
            </div>
            <div class="card-body">
              <h3 class="card-title fs-5">Executive Suite</h3>
              <p class="card-text">Elegant suite with a separate living area, premium furnishings, and access to exclusive
                lounge services. Ideal for business travelers seeking comfort.</p>
              <div class="d-flex justify-content-between align-items-center">
                <span class="fw-bold">₱20,000/night</span>
                <a href="booking.php" class="btn btn-primary">Book Now</a>
              </div>
            </div>
          </div>
        </div>
        <div class="col">
          <div class="card h-100">
            <div class="bg-light p-5 text-center" style="height: 200px;">
              <p class="text-muted">Image here...</p>
            </div>
            <div class="card-body">
              <h3 class="card-title fs-5">Family Suite</h3>
              <p class="card-text">Comfortable suite with two bedrooms, a cozy living space, and family-friendly
                amenities, designed for a relaxing stay with loved ones.</p>
              <div class="d-flex justify-content-between align-items-center">
                <span class="fw-bold">₱10,000/night</span>
                <a href="booking.php" class="btn btn-primary">Book Now</a>
              </div>
            </div>
          </div>
        </div> --}}
      </div>
    </section>
  </main>
@endsection
