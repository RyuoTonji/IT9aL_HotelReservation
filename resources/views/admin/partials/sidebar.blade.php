<div class="account-section">
<<<<<<< HEAD
  <img src="{{ asset('img/logo_hotelNservices.jpg') }}" alt="Profile Logo" class="rounded-circle">
  <p><strong>{{ Auth::user()->Name }}</strong></p>
  <p>{{ Auth::user()->email }}</p>
</div>
<ul class="nav flex-column mt-4">
  <li class="nav-item">
    <a class="nav-link {{ Route::is('admin.dashboard') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">
      <i class="bi bi-house"></i> Dashboard
    </a>
  </li>
  <li class="nav-item">
    <a class="nav-link {{ Route::is('admin.frontdesk') ? 'active' : '' }}" href="{{ route('admin.frontdesk') }}">
      <i class="bi bi-reception"></i> Front Desk
    </a>
  </li>
  <li class="nav-item">
    <a class="nav-link {{ Route::is('admin.guest') ? 'active' : '' }}" href="{{ route('admin.guest') }}">
      <i class="bi bi-person"></i> Guest
    </a>
  </li>
  <li class="nav-item">
    <a class="nav-link {{ Route::is('admin.rooms') ? 'active' : '' }}" href="{{ route('admin.rooms') }}">
      <i class="bi bi-door-open"></i> Rooms
    </a>
  </li>
  <li class="nav-item">
    <a class="nav-link {{ Route::is('admin.deals') ? 'active' : '' }}" href="{{ route('admin.deals') }}">
      <i class="bi bi-tag"></i> Deals
    </a>
  </li>
  <li class="nav-item">
    <a class="nav-link {{ Route::is('admin.rate') ? 'active' : '' }}" href="{{ route('admin.rate') }}">
      <i class="bi bi-currency-dollar"></i> Rate
    </a>
  </li>
  <li class="nav-item mt-4">
    <div class="nav-link">
      <form action="{{ route('logout') }}" method="POST">
        @csrf
        <button type="submit" class="btn btn-custom">
          <i class="bi bi-box-arrow-right"></i> Logout
        </button>
      </form>
    </div>
  </li>
=======
    <img src="{{ asset('img/logo_hotelNservices.jpg') }}" alt="Profile Logo" class="rounded-circle">
    <p><strong>John Doe</strong></p>
    <p>john.doe@example.com</p>
</div>
<ul class="nav flex-column mt-4">
    <li class="nav-item">
        <a class="nav-link {{ Route::is('admin.dashboard') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">
            <i class="bi bi-house"></i> Dashboard
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ Route::is('admin.frontdesk') ? 'active' : '' }}" href="{{ route('admin.frontdesk') }}">
            <i class="bi bi-reception"></i> Front Desk
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ Route::is('admin.guest') ? 'active' : '' }}" href="{{ route('admin.guest') }}">
            <i class="bi bi-person"></i> Guest
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ Route::is('admin.rooms') ? 'active' : '' }}" href="{{ route('admin.rooms') }}">
            <i class="bi bi-door-open"></i> Rooms
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ Route::is('admin.deals') ? 'active' : '' }}" href="{{ route('admin.deals') }}">
            <i class="bi bi-tag"></i> Deals
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ Route::is('admin.rate') ? 'active' : '' }}" href="{{ route('admin.rate') }}">
            <i class="bi bi-currency-dollar"></i> Rate
        </a>
    </li>
    <li class="nav-item mt-4">
        <a class="nav-link" href="{{ route('logout') }}">
            <i class="bi bi-box-arrow-right"></i> Logout
        </a>
    </li>
>>>>>>> 315a6fc3ef544ade10ca14731ef09ec41feee53c
</ul>
