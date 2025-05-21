<!DOCTYPE html>
<html lang="en">
<<<<<<< HEAD

  <head>
=======
<head>
>>>>>>> 315a6fc3ef544ade10ca14731ef09ec41feee53c
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <style>
<<<<<<< HEAD
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
        padding-top: 20px;
        z-index: 100;
        height: 100vh;
        overflow-y: auto;
      }

      .sidebar .nav-link {
        color: #fff;
        padding: 12px 20px;
        margin: 0 10px;
        display: block;
        border-radius: 0;
        font-weight: 600;
        font-size: 1.1rem;
        transition: all 0.3s;
      }

      .sidebar .nav-link.active {
        background-color: #EFBF04;
        color: #000;
      }

      .sidebar .nav-link:hover {
        background-color: #EFBF04;
        color: #000;
        padding: 12px 20px;
        margin: 0 10px;
      }

      .sidebar .nav-item {
        margin-bottom: 5px;
      }

      .content {
        margin-left: 250px;
        padding: 30px;
        min-height: 100vh;
      }

      .btn-custom {
        background-color: #EFBF04;
        border-color: #EFBF04;
        font-size: 1rem;
        padding: 8px 16px;
      }

      .btn-custom:hover {
        background-color: #d8a803;
        border-color: #d8a803;
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
      }

      .account-section img {
        width: 80px;
        height: 80px;
        margin-bottom: 10px;
      }

      .account-section p {
        color: #fff;
        margin: 0;
        font-size: 1rem;
        font-weight: 600;
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
    </style>
    @yield('styles')
  </head>

  <body>
    <div class="container-fluid p-0">
      <div class="row">
        <nav class="col-md-2 col-12 sidebar">
          @include('admin.partials.sidebar')
        </nav>
        <main class="col-md-10 col-12 content">
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

=======
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
            padding-top: 20px;
            z-index: 100;
            height: 100vh;
            overflow-y: auto;
        }
        .sidebar .nav-link {
            color: #fff;
            padding: 12px 20px;
            margin: 0 10px;
            display: block;
            border-radius: 0;
            font-weight: 600;
            font-size: 1.1rem;
            transition: all 0.3s;
        }
        .sidebar .nav-link.active {
            background-color: #EFBF04;
            color: #000;
        }
        .sidebar .nav-link:hover {
            background-color: #EFBF04;
            color: #000;
            padding: 12px 20px;
            margin: 0 10px;
        }
        .sidebar .nav-item {
            margin-bottom: 5px;
        }
        .content {
            margin-left: 250px;
            padding: 30px;
            min-height: 100vh;
        }
        .btn-custom {
            background-color: #EFBF04;
            border-color: #EFBF04;
            font-size: 1rem;
            padding: 8px 16px;
        }
        .btn-custom:hover {
            background-color: #d8a803;
            border-color: #d8a803;
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
        }
        .account-section img {
            width: 80px;
            height: 80px;
            margin-bottom: 10px;
        }
        .account-section p {
            color: #fff;
            margin: 0;
            font-size: 1rem;
            font-weight: 600;
        }
        .card {
            margin-bottom: 20px;
            padding: 20px;
            font-size: 1.1rem;
        }
        .row > * {
            flex-grow: 1;
        }
        #calendar {
            font-size: 1.1rem;
            height: 500px; /* Adjusted to match image proportion */
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
            <main class="col-md-10 col-12 content">
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
>>>>>>> 315a6fc3ef544ade10ca14731ef09ec41feee53c
</html>
