@extends('layouts.app')

@section('title', 'Contact Us')

@section('content')
  <main class="container my-5">
    <!-- Hero Section -->
    <section class="mb-5 text-center">
      <h1 class="display-4 fw-bold mb-3 heading-underline">Contact us</h1>
      <div class="rounded overflow-hidden" style="height: 300px;">
        <img src="{{ asset('img/Contact.jpg') }}" class="img-fluid w-100 h-100" style="object-fit: cover;" alt="Contact Us">
      </div>
    </section>

    <!-- Contact Information Section -->
    <section class="mb-5">
      <div class="row g-4">
        <!-- Contact Methods -->
        <div class="col-md-4">
          <div class="card h-100 facility-card">
            <div class="card-body">
              <h2 class="fs-4 fw-semibold mb-4">Get in Touch</h2>
              <div class="mb-4">
                <h3 class="fs-5 mb-2">Email Us</h3>
                <p><a href="mailto:reservations@kagayakukin.com"
                    class="text-decoration-none">reservations@kagayakukin.com</a></p>
                <p><a href="mailto:info@kagayakukin.com" class="text-decoration-none">info@kagayakukin.com</a></p>
              </div>
              <div class="mb-4">
                <h3 class="fs-5 mb-2">Call Us</h3>
                <p><a href="tel:+639123456789" class="text-decoration-none">+63 912 345 6789</a></p>
                <p><a href="tel:+639876543210" class="text-decoration-none">+63 987 654 3210</a></p>
              </div>
              <div class="mb-4">
                <h3 class="fs-5 mb-2">Visit Us</h3>
                <p>University of Mindanao<br>Matina, Davao City<br>Davao Del Sur, Philippines</p>
              </div>
              <div class="mt-4">
                <h3 class="fs-5 mb-2">Follow Us</h3>
                <div class="d-flex gap-3">
                  <a href="#" class="text-dark"><i class="bi bi-facebook fs-4"></i></a>
                  <a href="#" class="text-dark"><i class="bi bi-instagram fs-4"></i></a>
                  <a href="#" class="text-dark"><i class="bi bi-twitter-x fs-4"></i></a>
                  <a href="#" class="text-dark"><i class="bi bi-linkedin fs-4"></i></a>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Contact Form -->
        <div class="col-md-8">
          <div class="card facility-card">
            <div class="card-body">
              <h2 class="fs-4 fw-semibold mb-4">Send Us a Message</h2>
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
      <h2 class="display-6 fw-bold text-center mb-4 heading-underline">Our Location</h2>
      <div class="rounded overflow-hidden" style="height: 450px;">
        <!-- Embedding Google Maps for University of Mindanao -->
        <iframe
          src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3959.4935967000934!2d125.59977107462665!3d7.065507616755267!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x32f96d60230d0025%3A0x99c208fad5d6862d!2sUniversity%20of%20Mindanao!5e0!3m2!1sen!2sph!4v1716027879809!5m2!1sen!2sph"
          width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy"
          referrerpolicy="no-referrer-when-downgrade">
        </iframe>
      </div>
    </section>

    <!-- Hotel Images Grid Section -->
    <section class="mb-5">
      <h2 class="display-6 fw-bold text-center mb-4 heading-underline">Hotel Gallery</h2>
      <div class="row g-3">
        <div class="col-md-4">
          <div class="rounded overflow-hidden" style="height: 250px;">
            <img src="{{ asset('img/heroimage.jpg') }}" class="img-fluid w-100 h-100" style="object-fit: cover;"
              alt="Hotel Lobby">
          </div>
        </div>
        <div class="col-md-4">
          <div class="rounded overflow-hidden" style="height: 250px;">
            <img src="{{ asset('img/DeluxeRoom.jpg') }}" class="img-fluid w-100 h-100" style="object-fit: cover;"
              alt="Deluxe Room">
          </div>
        </div>
        <div class="col-md-4">
          <div class="rounded overflow-hidden" style="height: 250px;">
            <img src="{{ asset('img/pool.jpg') }}" class="img-fluid w-100 h-100" style="object-fit: cover;"
              alt="Swimming Pool">
          </div>
        </div>
      </div>
    </section>

    <!-- FAQ Section -->
    <section class="mb-5">
      <h2 class="display-6 fw-bold text-center mb-4 heading-underline">Frequently Asked Questions</h2>
      <div class="row justify-content-center">
        <div class="col-lg-10">
          <div class="accordion" id="faqAccordion">
            <div class="accordion-item">
              <h3 class="accordion-header">
                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#faq1">
                  What are your check-in and check-out times?
                </button>
              </h3>
              <div id="faq1" class="accordion-collapse collapse show" data-bs-parent="#faqAccordion">
                <div class="accordion-body">
                  Check-in time is 2:00 PM and check-out time is 12:00 PM. Early check-in and late check-out may be
                  available upon request, subject to availability and additional charges.
                </div>
              </div>
            </div>
            <div class="accordion-item">
              <h3 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                  data-bs-target="#faq2">
                  Do you offer airport transfers?
                </button>
              </h3>
              <div id="faq2" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                <div class="accordion-body">
                  Yes, we offer airport transfer services at additional cost. Please contact our concierge team at least
                  24 hours before your arrival to arrange this service.
                </div>
              </div>
            </div>
            <div class="accordion-item">
              <h3 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                  data-bs-target="#faq3">
                  What amenities are included with my stay?
                </button>
              </h3>
              <div id="faq3" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                <div class="accordion-body">
                  All room bookings include complimentary Wi-Fi, access to our fitness center, swimming pool, and daily
                  breakfast buffet. Premium room categories may include additional amenities.
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </main>
@endsection
