@extends('layouts.admin_layout')

@section('title', 'Master Admin Dashboard')

@section('content')
    <h1 class="h2 main-text">Master Admin Dashboard</h1>

    <div class="row">
        <div class="col-md-4 mb-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Total Users</h5>
                    <p class="card-text display-4">{{ $totalUsers }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Total Bookings</h5>
                    <p class="card-text display-4">{{ $totalBookings }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Total Revenue</h5>
                    <p class="card-text display-4">₱{{ number_format($totalRevenue, 2) }}</p>
                </div>
            </div>
        </div>
    </div>
@endsection
