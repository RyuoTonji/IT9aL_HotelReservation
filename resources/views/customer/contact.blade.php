@extends('layouts.app')

@section('title', 'Contact Us')

@section('content')
  <main class="container my-5">
    <!-- Hero Section -->
    <section class="bg-light py-5 mb-5 text-center">
      <h1 class="display-4 fw-bold mb-3">Contact us</h1>
      <div class="bg-secondary p-5 text-center text-white" style="height: 300px;">
        <p>Background Image</p>
      </div>
    </section>

    <!-- Contact Information Section -->
    <section class="mb-5">
      <div class="row g-4">
        <!-- Contact Methods -->
        <div class="col-md-4">
          <div class="card h-100">
            <div class="card-body">
              <h2 class="fs-4 fw-semibold mb-4">Get in Touch</h2>
              <div class="mb-4">
                <h3 class="fs-5 mb-2">Email Us</h3>
                <p><a href="mailto:reservations@luxuryhotel.com"
                    class="text-decoration-none">reservations@luxuryhotel.com</a></p>
                <p><a href="mailto:info@luxuryhotel.com" class="text-decoration-none">info@luxuryhotel.com</a></p>
              </div>
              <div class="mb-4">
                <h3 class="fs-5 mb-2">Call Us</h3>
                <p><a href="tel:+18001234567" class="text-decoration-none">+1 (800) 123-4567</a></p>
                <p><a href="tel:+18009876543" class="text-decoration-none">+1 (800) 987-6543</a></p>
              </div>
              <div class="mb-4">
                <h3 class="fs-5 mb-2">Visit Us</h3>
                <p>123 Luxury Avenue<br>Beverly Hills, CA 90210<br>United States</p>
              </div>
            </div>
          </div>
        </div>

        <!-- Contact Form -->
        <div class="col-md-8">
          <div class="card">
            <div class="card-body">
              <h2 class="fs-4 fw-semibold mb-4">Emails Links and Location Map</h2>
              <form action="process_contact.php" method="POST">
                <div class="row mb-3">
                  <div class="col-md-6">
                    <label for="name" class="form-label">Full Name</label>
                    <input type="text" class="form-control" id="name" name="name" required>
                  </div>
                  <div class="col-md-6">
                    <label for="email" class="form-label">Email Address</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                  </div>
                </div>
                <div class="mb-3">
                  <label for="phone" class="form-label">Phone Number</label>
                  <input type="tel" class="form-control" id="phone" name="phone">
                </div>
                <div class="mb-3">
                  <label for="subject" class="form-label">Subject</label>
                  <input type="text" class="form-control" id="subject" name="subject" required>
                </div>
                <div class="mb-3">
                  <label for="message" class="form-label">Message</label>
                  <textarea class="form-control" id="message" name="message" rows="5" required></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Send Message</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Location Map Section -->
    <section class="mb-5">
      <h2 class="display-6 fw-bold text-center mb-4">Our Location</h2>
      <div class="bg-light p-5 text-center" style="height: 400px;">
        <p class="text-muted">Map placeholder here...</p>
      </div>
    </section>
  </main>
@endsection
