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

        @forelse($Services as $service)
          <div class="col-12">
            <div class="card">
              <div class="bg-light text-center" style="height: 300px">
                <img src="{{ asset($service->ImagePathname) }}" alt=" {{ $service->ServiceName }} " class="img-fluid"
                  style="object-fit: cover; height: 100%; width: 100%;">
                {{-- <p class="text-muted">Image here</p> --}}
              </div>
              <div class="card-body text-center">
                <h3 class="card-title fs-5 text-warning">{{ $service->ServiceName }}</h3>
                <p class="card-text">{{ $service->ServiceDescription }}</p>
              </div>
            </div>
          </div>
        @empty
          <div class="col-12">
            <div class="card">
              <div class="card-body text-center">
                <h3 class="card-title fs-5 text-warning">Currently No Service Available</h3>
                <p class="card-text">Currently no service has been offered at the moment, check back later.</p>
              </div>
            </div>
          </div>
        @endforelse
      </div>
    </section>
  </main>
@endsection
