@extends('layouts.admin_layout')

@section('title', 'Rate')

@section('content')
    <h1 class="h2 main-text">Rate</h1>

    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5>Room Rates</h5>
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addRateModal">Add Rate</button>
        </div>
        <div class="card-body">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Room Type</th>
                        <th>Deals</th>
                        <th>Cancellation Policy</th>
                        <th>Deal Price</th>
                        <th>Rate</th>
                        <th>Availability</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($rooms as $room)
                        <tr>
                            <td>{{ $room->RoomTypeName }}</td>
                            <td>{{ $services->random()->ServiceName }}</td>
                            <td>Free cancellation 48 hours prior</td>
                            <td>₱{{ number_format($room->RoomPrice * 0.9, 2) }}</td>
                            <td>₱{{ number_format($room->RoomPrice, 2) }}</td>
                            <td>{{ $room->bookingDetails()->exists() ? 'Booked' : 'Available' }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6">No rates available.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
