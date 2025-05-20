@extends('layouts.admin_layout')

@section('title', 'Rooms')

@section('content')
    <h1 class="h2 main-text">Rooms</h1>

    <!-- Tabs -->
    <ul class="nav nav-tabs mb-4">
        <li class="nav-item">
            <a class="nav-link active" data-bs-toggle="tab" href="#allRooms">All Rooms</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="tab" href="#availableRooms">Available Rooms</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="tab" href="#bookedRooms">Booked Rooms</a>
        </li>
    </ul>

    <div class="tab-content">
        <!-- All Rooms Tab -->
        <div class="tab-pane fade show active" id="allRooms">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5>All Rooms</h5>
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addRoomModal">Add Room</button>
                </div>
                <div class="card-body">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Room Number</th>
                                <th>Bed Type</th>
                                <th>Room Floor</th>
                                <th>Room Facility</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($rooms as $room)
                                <tr>
                                    <td>{{ $room->RoomTypeName }}</td>
                                    <td>{{ $roomSizes->where('ID', $room->RoomSizeID)->first()->RoomSizeName ?? 'N/A' }}</td>
                                    <td>Floor {{ rand(1, 10) }}</td>
                                    <td>Wi-Fi, TV, AC</td>
                                    <td>{{ $room->bookingDetails()->exists() ? 'Booked' : 'Available' }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5">No rooms available.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Available Rooms Tab -->
        <div class="tab-pane fade" id="availableRooms">
            <div class="card">
                <div class="card-header">
                    <h5>Available Rooms</h5>
                </div>
                <div class="card-body">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Room Number</th>
                                <th>Bed Type</th>
                                <th>Room Floor</th>
                                <th>Room Facility</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($rooms->filter(fn($room) => !$room->bookingDetails()->exists()) as $room)
                                <tr>
                                    <td>{{ $room->RoomTypeName }}</td>
                                    <td>{{ $roomSizes->where('ID', $room->RoomSizeID)->first()->RoomSizeName ?? 'N/A' }}</td>
                                    <td>Floor {{ rand(1, 10) }}</td>
                                    <td>Wi-Fi, TV, AC</td>
                                    <td>Available</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5">No available rooms.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Booked Rooms Tab -->
        <div class="tab-pane fade" id="bookedRooms">
            <div class="card">
                <div class="card-header">
                    <h5>Booked Rooms</h5>
                </div>
                <div class="card-body">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Room Number</th>
                                <th>Bed Type</th>
                                <th>Room Floor</th>
                                <th>Room Facility</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($rooms->filter(fn($room) => $room->bookingDetails()->exists()) as $room)
                                <tr>
                                    <td>{{ $room->RoomTypeName }}</td>
                                    <td>{{ $roomSizes->where('ID', $room->RoomSizeID)->first()->RoomSizeName ?? 'N/A' }}</td>
                                    <td>Floor {{ rand(1, 10) }}</td>
                                    <td>Wi-Fi, TV, AC</td>
                                    <td>Booked</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5">No booked rooms.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
