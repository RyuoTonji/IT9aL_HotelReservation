@extends('layouts.admin_layout')

@section('title', 'Front Desk')

@section('content')
    <h1 class="h2 main-text">Front Desk</h1>

    <!-- Tabs -->
    <ul class="nav nav-tabs mb-4">
        <li class="nav-item">
            <a class="nav-link active" data-bs-toggle="tab" href="#checkIn">Check-in</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="tab" href="#checkOut">Check-out</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="tab" href="#dueOut">Due Out</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="tab" href="#checkedIn">Checked In</a>
        </li>
    </ul>

    <div class="tab-content">
        <!-- Check-in Tab -->
        <div class="tab-pane fade show active" id="checkIn">
            <div class="card">
                <div class="card-header">
                    <h5>Today's Check-ins</h5>
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
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($checkIns as $booking)
                                <tr>
                                    <td>{{ $booking->ID }}</td>
                                    <td>{{ $booking->user->Name }}</td>
                                    <td>{{ $booking->roomType->RoomTypeName }}</td>
                                    <td>₱{{ number_format($booking->paymentInfo->TotalAmount ?? 0, 2) }}</td>
                                    <td>₱{{ number_format($booking->paymentInfo->TotalAmount ?? 0, 2) }}</td>
                                    <td>{{ $booking->BookingStatus }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6">No check-ins today.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Check-out Tab -->
        <div class="tab-pane fade" id="checkOut">
            <div class="card">
                <div class="card-header">
                    <h5>Today's Check-outs</h5>
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
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($checkOuts as $booking)
                                <tr>
                                    <td>{{ $booking->ID }}</td>
                                    <td>{{ $booking->user->Name }}</td>
                                    <td>{{ $booking->roomType->RoomTypeName }}</td>
                                    <td>₱{{ number_format($booking->paymentInfo->TotalAmount ?? 0, 2) }}</td>
                                    <td>₱{{ number_format($booking->paymentInfo->TotalAmount ?? 0, 2) }}</td>
                                    <td>{{ $booking->BookingStatus }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6">No check-outs today.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Due Out Tab -->
        <div class="tab-pane fade" id="dueOut">
            <div class="card">
                <div class="card-header">
                    <h5>Due Out</h5>
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
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($dueOuts as $booking)
                                <tr>
                                    <td>{{ $booking->ID }}</td>
                                    <td>{{ $booking->user->Name }}</td>
                                    <td>{{ $booking->roomType->RoomTypeName }}</td>
                                    <td>₱{{ number_format($booking->paymentInfo->TotalAmount ?? 0, 2) }}</td>
                                    <td>₱{{ number_format($booking->paymentInfo->TotalAmount ?? 0, 2) }}</td>
                                    <td>{{ $booking->BookingStatus }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6">No due outs today.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Checked In Tab -->
        <div class="tab-pane fade" id="checkedIn">
            <div class="card">
                <div class="card-header">
                    <h5>Currently Checked In</h5>
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
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($checkedIns as $booking)
                                <tr>
                                    <td>{{ $booking->ID }}</td>
                                    <td>{{ $booking->user->Name }}</td>
                                    <td>{{ $booking->roomType->RoomTypeName }}</td>
                                    <td>₱{{ number_format($booking->paymentInfo->TotalAmount ?? 0, 2) }}</td>
                                    <td>₱{{ number_format($booking->paymentInfo->TotalAmount ?? 0, 2) }}</td>
                                    <td>{{ $booking->BookingStatus }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6">No guests currently checked in.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Booking Calendar -->
    <div class="card mt-4">
        <div class="card-header">
            <h5>Booking Calendar</h5>
        </div>
        <div class="card-body">
            <div id="calendar"></div>
        </div>
    </div>

    <!-- Create Booking Button -->
    <div class="text-end mt-4">
        <a href="{{ route('booking') }}" class="btn btn-primary">Create Booking</a>
    </div>
@endsection

@section('styles')
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.0/main.min.css" rel="stylesheet">
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.0/main.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                events: [
                    @foreach($checkIns as $booking)
                        {
                            title: '{{ $booking->user->Name }} (Check-in)',
                            start: '{{ $booking->CheckInDate }}',
                            backgroundColor: '#28a745',
                            borderColor: '#28a745'
                        },
                    @endforeach
                    @foreach($checkOuts as $booking)
                        {
                            title: '{{ $booking->user->Name }} (Check-out)',
                            start: '{{ $booking->CheckOutDate }}',
                            backgroundColor: '#dc3545',
                            borderColor: '#dc3545'
                        },
                    @endforeach
                ],
                eventClick: function(info) {
                    alert('Booking: ' + info.event.title + '\nDate: ' + info.event.start.toLocaleDateString());
                }
            });
            calendar.render();
        });
    </script>
@endsection
