@extends('layouts.admin_layout')

@section('title', 'Guest')

@section('content')
    <h1 class="h2 main-text">Guest</h1>

    <div class="card">
        <div class="card-header">
            <h5>Guest List</h5>
        </div>
        <div class="card-body">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Reservation ID</th>
                        <th>Name</th>
                        <th>Room Number</th>
                        <th>Total Amount</th>
                        <th>Amount Paid</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($bookings as $booking)
                        <tr>
                            <td>{{ $booking->ID }}</td>
                            <td>{{ $booking->user->Name }}</td>
                            <td>{{ $booking->roomType->RoomTypeName }}</td>
                            <td>₱{{ number_format($booking->paymentInfo->TotalAmount ?? 0, 2) }}</td>
                            <td>₱{{ number_format($booking->paymentInfo->TotalAmount ?? 0, 2) }}</td>
                            <td>{{ $booking->BookingStatus }}</td>
                            <td>
                                <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#guestModal{{ $booking->ID }}">View</button>
                            </td>
                        </tr>

                        <!-- Guest Modal -->
                        <div class="modal fade" id="guestModal{{ $booking->ID }}" tabindex="-1" aria-labelledby="guestModalLabel{{ $booking->ID }}" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title main-text" id="guestModalLabel{{ $booking->ID }}">Guest Details</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <p><strong>Guest Name:</strong> {{ $booking->user->Name }}</p>
                                        <p><strong>Registration Number:</strong> {{ $booking->ID }}</p>
                                        <p><strong>Check-in Date:</strong> {{ $booking->CheckInDate->format('Y-m-d') }}</p>
                                        <p><strong>Room Type:</strong> {{ $booking->roomType->RoomTypeName }}</p>
                                        <p><strong>Room Size:</strong> {{ $booking->roomSize->RoomSizeName }}</p>
                                        <p><strong>Stay:</strong> {{ $booking->CheckInDate->diffInDays($booking->CheckOutDate) }} nights</p>
                                        <p><strong>Total Amount:</strong> ₱{{ number_format($booking->paymentInfo->TotalAmount ?? 0, 2) }}</p>
                                        <p><strong>Discount:</strong> {{ $booking->user->loyalty ? $booking->user->loyalty->loyaltyTier->Discount : 0 }}%</p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <tr>
                            <td colspan="7">No guests found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
