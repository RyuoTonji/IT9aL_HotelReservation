@extends('layouts.admin_layout')
@section('title', 'Admin Dashboard')
@section('content')
    <h1 class="main-text">Dashboard</h1>
    <div class="row">
        <div class="col-md-3 col-6 mb-3">
            <div class="card p-3 text-center">
                <h4>Check-in</h4>
                <h2>0</h2>
            </div>
        </div>
        <div class="col-md-3 col-6 mb-3">
            <div class="card p-3 text-center">
                <h4>Check-out</h4>
                <h2>0</h2>
            </div>
        </div>
        <div class="col-md-3 col-6 mb-3">
            <div class="card p-3 text-center">
                <h4>Total In Hotel</h4>
                <h2>0</h2>
            </div>
        </div>
        <div class="col-md-3 col-6 mb-3">
            <div class="card p-3 text-center">
                <h4>Available Rooms</h4>
                <h2>0</h2>
            </div>
        </div>
        <div class="col-md-3 col-6 mb-3">
            <div class="card p-3 text-center">
                <h4>Occupied Rooms</h4>
                <h2>0</h2>
            </div>
        </div>
    </div>
    <div class="card p-3">
        <h4>Rooms</h4>
        <p>No rooms available.</p>
        <a href="{{ route('admin.rooms') }}" class="btn btn-custom">Manage Rooms</a>
    </div>
    <div class="card p-3 mt-3">
        <h4>Room Status</h4>
        <div class="d-flex justify-content-between" style="width: 200px;">

        </div>
    </div>
@endsection
