@extends('layouts.app')

@section('title', 'About')

@section('content')

  <main class="container my-5">
    <!-- Hero Section -->
    <section class="bg-light py-5 mb-5 text-center">
      <h1 class="display-4 fw-bold mb-3">About us</h1>
      <p class="lead">Some text here... and Background Image</p>
    </section>

    <!-- Team Members Section -->
    <section class="mb-5">
      <!-- Team Member 1 -->
      <div class="row align-items-center mb-5">
        <div class="col-md-4 mb-4 mb-md-0">
          <div class="bg-warning p-5 text-center" style="height: 400px;">
            <img src="{{ asset('img/alexa.jpg') }}" alt="alexa" class="memberImage">
          </div>
          <h3 class="fs-4 mt-3">Alexandra Marie M. Apas</h3>
          <p class="text-muted">Database Architects</p>
        </div>
        <div class="col-md-8">
          <h2 class="display-6 fw-bold mb-3">Some text here...</h2>
          <p class="mb-3">Some text here...</p>
          <p class="mb-3">Some text here...</p>
          <h4 class="fw-semibold mb-2">Some text here...</h4>
          <ul class="list-group list-group-flush">
            <li class="list-group-item">Some text here...</li>
            <li class="list-group-item">Some text here...</li>
            <li class="list-group-item">Some text here...</li>
          </ul>
        </div>
      </div>

      <!-- Team Member 2 -->
      <div class="row align-items-center mb-5">
        <div class="col-md-4 order-md-2 mb-4 mb-md-0">
          <div class="bg-warning p-5 text-center" style="height: 400px;">
            <img src="{{ asset('img/tonio.jpg') }}" alt="tonio" class="memberImage">
          </div>
          <h3 class="fs-4 mt-3">Antonio Jr. S. Del Rosario</h3>
          <p class="text-muted">Front End Developer</p>
        </div>
        <div class="col-md-8 order-md-1">
          <h2 class="display-6 fw-bold mb-3">Some text here...</h2>
          <p class="mb-3">Some text here...</p>
          <p class="mb-3">Some text here...</p>
          <h4 class="fw-semibold mb-2">Some text here...</h4>
          <ul class="list-group list-group-flush">
            <li class="list-group-item">Some text here...</li>
            <li class="list-group-item">Some text here...</li>
            <li class="list-group-item">Some text here...</li>
          </ul>
        </div>
      </div>

      <!-- Team Member 3 -->
      <div class="row align-items-center">
        <div class="col-md-4 mb-4 mb-md-0">
          <div class="bg-warning p-5 text-center" style="height: 400px;">
            <img src="{{ asset('img/Llander.jpg') }}" alt="llander" class="memberImage">
          </div>
          <h3 class="fs-4 mt-3">Christopher Llander L. Villacino</h3>
          <p class="text-muted">Back End Developer</p>
        </div>
        <div class="col-md-8">
          <h2 class="display-6 fw-bold mb-3">Some text here...</h2>
          <p class="mb-3">Some text here...</p>
          <p class="mb-3">Some text here...</p>
          <h4 class="fw-semibold mb-2">Some text here...</h4>
          <ul class="list-group list-group-flush">
            <li class="list-group-item">Some text here...</li>
            <li class="list-group-item">Some text here...</li>
            <li class="list-group-item">Some text here...</li>
            <li class="list-group-item">Some text here...</li>
          </ul>
        </div>
      </div>
    </section>

    <!-- Clients Section -->
    <section class="bg-light py-5">
      <h2 class="display-6 fw-bold text-center mb-5">Our Partners</h2>
      <div class="row row-cols-2 row-cols-md-5 g-4 text-center">
        <div class="col">
          <i class="bi bi-credit-card fs-3 text-warning mb-2"></i>
          <p>Visa</p>
        </div>
        <div class="col">
          <i class="bi bi-credit-card fs-3 text-warning mb-2"></i>
          <p>Mastercard</p>
        </div>
        <div class="col">
          <i class="bi bi-paypal fs-3 text-warning mb-2"></i>
          <p>PayPal</p>
        </div>
        <div class="col">
          <i class="bi bi-amazon fs-3 text-warning mb-2"></i>
          <p>Amazon</p>
        </div>
        <div class="col">
          <i class="bi bi-apple fs-3 text-warning mb-2"></i>
          <p>Apple</p>
        </div>
      </div>
    </section>
  </main>
@endsection
