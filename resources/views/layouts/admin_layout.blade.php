<!DOCTYPE html>
<html lang="en">

  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{ asset('css/admin/admin.css') }}">
    <link rel="stylesheet" href="{{ asset('css/pagination.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">

    <!-- Font Awesome for sort icons (assumed to be included in admin_layout) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
      body {
        background-color: #fff;
        margin: 0;
        padding: 0;
        font-family: 'Poppins', sans-serif;
      }

      .sidebar {
        position: fixed;
        top: 0;
        bottom: 0;
        left: 0;
        width: 250px;
        background-color: #000;
        padding: 20px 0 0 0;
        z-index: 100;
        height: 100vh;
        overflow-y: auto;

        .nav-link {
          color: #fff;
          padding: 12px 20px;
          margin: 0 10px;
          display: block;
          border-radius: 0;
          font-weight: 600;
          font-size: 1.1rem;
          transition: all 0.3s;

          &.active {
            background-color: #EFBF04;
            color: #000;
          }

          &:hover {
            background-color: #EFBF04;
            color: #000;
            padding: 12px 20px;
            margin: 0 10px;
          }
        }

        .nav-item {
          margin-bottom: 5px;
        }

        .content {
          margin-left: 250px;
          padding: 30px;
          min-height: 100vh;
        }
      }

      .btn-custom {
        background-color: #EFBF04;
        border-color: #EFBF04;
        font-size: 1rem;
        padding: 8px 16px;

        &:hover {
          background-color: #d8a803;
          border-color: #d8a803;
        }
      }

      h1.main-text {
        color: #EFBF04;
        font-weight: 600;
        font-size: 2.8rem;
      }

      .text-white {
        color: #fff !important;
        font-size: 1.1rem;
      }

      .account-section {
        text-align: center;
        padding-bottom: 20px;
        border-bottom: 1px solid #EFBF04;

        img {
          width: 80px;
          height: 80px;
          margin-bottom: 10px;
        }

        p {
          color: #fff;
          margin: 0;
          font-size: 1rem;
          font-weight: 600;
        }
      }

      .card {
        margin-bottom: 20px;
        padding: 20px;
        font-size: 1.1rem;
      }

      .row>* {
        flex-grow: 1;
      }

      #calendar {
        font-size: 1.1rem;
        height: 500px;
        /* Adjusted to match image proportion */
      }

      a {
        color: #d8a803;

        &:hover {
          color: #000;
        }
      }
    </style>
    @yield('styles')
  </head>

  <body>
    <div class="container-fluid p-0">
      <div class="row">
        <nav class="col-md-2 col-12 sidebar">
          @include('admin.partials.sidebar')
        </nav>
        <main class="col-md-9 col-10 content ps-5">
          @yield('content')
        </main>
      </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
      document.addEventListener('DOMContentLoaded', function() {
        const currentPath = window.location.pathname;
        document.querySelectorAll('.nav-link').forEach(link => {
          if (link.getAttribute('href') === currentPath) {
            link.classList.add('active');
          }
        });
      });
    </script>
    @yield('scripts')
  </body>

</html>
