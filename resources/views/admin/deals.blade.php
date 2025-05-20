@extends('layouts.admin_layout')

@section('title', 'Deals')

@section('content')
    <h1 class="h2 main-text">Deals</h1>

    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5>Available Deals</h5>
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addDealModal">Add Deal</button>
        </div>
        <div class="card-body">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Reference Number</th>
                        <th>Deal Name</th>
                        <th>Reservations Left</th>
                        <th>End Date</th>
                        <th>Room Type</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($services as $service)
                        <tr>
                            <td>{{ $service->ID }}</td>
                            <td>{{ $service->ServiceName }}</td>
                            <td>{{ rand(1, 50) }}</td>
                            <td>{{ now()->addMonths(3)->format('Y-m-d') }}</td>
                            <td>{{ $rooms->random()->RoomTypeName }}</td>
                            <td>{{ $service->ServiceStatus }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6">No deals available.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
