// resources/views/admin/partials/sidebar.blade.php
<div class="sidebar-sticky pt-3">
    <ul class="nav flex-column">
        <li class="nav-item">
            <a class="nav-link {{ Route::is('admin.dashboard') ? 'active main-text' : 'text-white' }}" href="{{ route('admin.dashboard') }}">
                <i class="bi bi-house"></i> Dashboard
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ Route::is('admin.desk') ? 'active main-text' : 'text-white' }}" href="{{ route('admin.frontdesk') }}">
                <i class="bi bi-reception"></i> Front Desk
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ Route::is('admin.guest') ? 'active main-text' : 'text-white' }}" href="{{ route('admin.guest') }}">
                <i class="bi bi-person"></i> Guest
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ Route::is('admin.rooms') ? 'active main-text' : 'text-white' }}" href="{{ route('admin.rooms') }}">
                <i class="bi bi-door-open"></i> Rooms
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ Route::is('admin.deals') ? 'active main-text' : 'text-white' }}" href="{{ route('admin.deals') }}">
                <i class="bi bi-tag"></i> Deals
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ Route::is('admin.rate') ? 'active main-text' : 'text-white' }}" href="{{ route('admin.rate') }}">
                <i class="bi bi-currency-dollar"></i> Rate
            </a>
        </li>
    </ul>
</div>
