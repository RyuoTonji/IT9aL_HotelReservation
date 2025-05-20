@extends('layouts.admin_layout')
@section('title', 'Rooms')
@section('content')
    <h1 class="main-text">Rooms</h1>
    <div class="row">
        <div class="col-md-12">
            <div class="card p-3">
                <h4>All Rooms</h4>
                <table class="table">
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
                        <tr>
                            <td colspan="5">No rooms available.</td>
                        </tr>
                    </tbody>
                </table>
                <button class="btn btn-custom" data-bs-toggle="modal" data-bs-target="#addRoomModal">Add Room</button>
            </div>
        </div>
    </div>
@endsection
