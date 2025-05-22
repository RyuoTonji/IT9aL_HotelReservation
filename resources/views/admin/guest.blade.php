@extends('layouts.admin_layout')

@section('title', 'Guest')

@section('content')
  <h1 class="h2 main-text">Guest</h1>

  <div class="row">
    <div class="col-md-12">
      <!-- Search Form -->
      <div class="mb-3">
        <form action="{{ route('admin.guest') }}" method="GET" class="d-flex">
          <input type="text" name="search" class="form-control me-2"
            placeholder="Search by reservation ID, user name, room type, size, or room number"
            value="{{ $search ?? '' }}">
          <button type="submit" class="btn btn-custom">Search</button>
          @if ($search)
            <a href="{{ route('admin.guest') }}" class="btn btn-secondary ms-2">Clear</a>
          @endif
        </form>
      </div>

      <!-- Pending Reservations -->
      <div class="card p-3 mb-3">
        <h4>Pending Reservations</h4>
        <table class="table table-hover">
          <thead>
            <tr>
              <th>
                <a
                  href="{{ route('admin.guest', array_merge(request()->query(), ['sort' => 'ID', 'direction' => $sort === 'ID' && $direction === 'asc' ? 'desc' : 'asc'])) }}">
                  Reservation ID
                  @if ($sort === 'ID')
                    <i class="fas fa-sort-{{ $direction === 'asc' ? 'up' : 'down' }}"></i>
                  @endif
                </a>
              </th>
              <th>
                <a
                  href="{{ route('admin.guest', array_merge(request()->query(), ['sort' => 'UserName', 'direction' => $sort === 'UserName' && $direction === 'asc' ? 'desc' : 'asc'])) }}">
                  User Name
                  @if ($sort === 'UserName')
                    <i class="fas fa-sort-{{ $direction === 'asc' ? 'up' : 'down' }}"></i>
                  @endif
                </a>
              </th>
              <th>
                <a
                  href="{{ route('admin.guest', array_merge(request()->query(), ['sort' => 'RoomTypeName', 'direction' => $sort === 'RoomTypeName' && $direction === 'asc' ? 'desc' : 'asc'])) }}">
                  Room Type
                  @if ($sort === 'RoomTypeName')
                    <i class="fas fa-sort-{{ $direction === 'asc' ? 'up' : 'down' }}"></i>
                  @endif
                </a>
              </th>
              <th>
                <a
                  href="{{ route('admin.guest', array_merge(request()->query(), ['sort' => 'RoomSizeName', 'direction' => $sort === 'RoomSizeName' && $direction === 'asc' ? 'desc' : 'asc'])) }}">
                  Room Size
                  @if ($sort === 'RoomSizeName')
                    <i class="fas fa-sort-{{ $direction === 'asc' ? 'up' : 'down' }}"></i>
                  @endif
                </a>
              </th>
              <th>
                <a
                  href="{{ route('admin.guest', array_merge(request()->query(), ['sort' => 'HasServices', 'direction' => $sort === 'HasServices' && $direction === 'asc' ? 'desc' : 'asc'])) }}">
                  Has Services
                  @if ($sort === 'HasServices')
                    <i class="fas fa-sort-{{ $direction === 'asc' ? 'up' : 'down' }}"></i>
                  @endif
                </a>
              </th>
              <th>
                <a
                  href="{{ route('admin.guest', array_merge(request()->query(), ['sort' => 'CheckInDate', 'direction' => $sort === 'CheckInDate' && $direction === 'asc' ? 'desc' : 'asc'])) }}">
                  Check-In Date
                  @if ($sort === 'CheckInDate')
                    <i class="fas fa-sort-{{ $direction === 'asc' ? 'up' : 'down' }}"></i>
                  @endif
                </a>
              </th>
              <th>
                <a
                  href="{{ route('admin.guest', array_merge(request()->query(), ['sort' => 'CheckOutDate', 'direction' => $sort === 'CheckOutDate' && $direction === 'asc' ? 'desc' : 'asc'])) }}">
                  Check-Out Date
                  @if ($sort === 'CheckOutDate')
                    <i class="fas fa-sort-{{ $direction === 'asc' ? 'up' : 'down' }}"></i>
                  @endif
                </a>
              </th>
              <th>
                <a
                  href="{{ route('admin.guest', array_merge(request()->query(), ['sort' => 'TotalAmount', 'direction' => $sort === 'TotalAmount' && $direction === 'asc' ? 'desc' : 'asc'])) }}">
                  Total Amount
                  @if ($sort === 'TotalAmount')
                    <i class="fas fa-sort-{{ $direction === 'asc' ? 'up' : 'down' }}"></i>
                  @endif
                </a>
              </th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            @forelse ($pendingReservations as $reservation)
              <tr>
                <td>{{ $reservation->ID }}</td>
                <td>{{ $reservation->UserName }}</td>
                <td>{{ $reservation->RoomTypeName }}</td>
                <td>{{ $reservation->RoomSizeName }}</td>
                <td>{{ $reservation->HasServices ? 'Yes' : 'No' }}</td>
                <td>{{ Carbon\Carbon::parse($reservation->CheckInDate)->format('Y-m-d') }}</td>
                <td>{{ Carbon\Carbon::parse($reservation->CheckOutDate)->format('Y-m-d') }}</td>
                <td>₱{{ number_format($reservation->TotalAmount, 2) }}</td>
                <td>
                  <a href="{{ route('admin.booking.review', $reservation->ID) }}" class="btn btn-sm btn-custom">Review
                    Info</a>
                </td>
              </tr>
            @empty
              <tr>
                <td colspan="9">No pending reservations found.</td>
              </tr>
            @endforelse
          </tbody>
        </table>
        <div class="pagination-container">
          {{ $pendingReservations->links() }}
        </div>
      </div>

      <!-- Confirmed Reservations -->
      <div class="card p-3 mb-3">
        <h4>Confirmed Reservations</h4>
        <table class="table table-hover">
          <thead>
            <tr>
              <th>
                <a
                  href="{{ route('admin.guest', array_merge(request()->query(), ['sort' => 'ID', 'direction' => $sort === 'ID' && $direction === 'asc' ? 'desc' : 'asc'])) }}">
                  Reservation ID
                  @if ($sort === 'ID')
                    <i class="fas fa-sort-{{ $direction === 'asc' ? 'up' : 'down' }}"></i>
                  @endif
                </a>
              </th>
              <th>
                <a
                  href="{{ route('admin.guest', array_merge(request()->query(), ['sort' => 'UserName', 'direction' => $sort === 'UserName' && $direction === 'asc' ? 'desc' : 'asc'])) }}">
                  User Name
                  @if ($sort === 'UserName')
                    <i class="fas fa-sort-{{ $direction === 'asc' ? 'up' : 'down' }}"></i>
                  @endif
                </a>
              </th>
              <th>
                <a
                  href="{{ route('admin.guest', array_merge(request()->query(), ['sort' => 'RoomName', 'direction' => $sort === 'RoomName' && $direction === 'asc' ? 'desc' : 'asc'])) }}">
                  Assigned Room
                  @if ($sort === 'RoomName')
                    <i class="fas fa-sort-{{ $direction === 'asc' ? 'up' : 'down' }}"></i>
                  @endif
                </a>
              </th>
              <th>
                <a
                  href="{{ route('admin.guest', array_merge(request()->query(), ['sort' => 'RoomTypeName', 'direction' => $sort === 'RoomTypeName' && $direction === 'asc' ? 'desc' : 'asc'])) }}">
                  Room Type
                  @if ($sort === 'RoomTypeName')
                    <i class="fas fa-sort-{{ $direction === 'asc' ? 'up' : 'down' }}"></i>
                  @endif
                </a>
              </th>
              <th>
                <a
                  href="{{ route('admin.guest', array_merge(request()->query(), ['sort' => 'RoomSizeName', 'direction' => $sort === 'RoomSizeName' && $direction === 'asc' ? 'desc' : 'asc'])) }}">
                  Room Size
                  @if ($sort === 'RoomSizeName')
                    <i class="fas fa-sort-{{ $direction === 'asc' ? 'up' : 'down' }}"></i>
                  @endif
                </a>
              </th>
              <th>
                <a
                  href="{{ route('admin.guest', array_merge(request()->query(), ['sort' => 'HasServices', 'direction' => $sort === 'HasServices' && $direction === 'asc' ? 'desc' : 'asc'])) }}">
                  Has Services
                  @if ($sort === 'HasServices')
                    <i class="fas fa-sort-{{ $direction === 'asc' ? 'up' : 'down' }}"></i>
                  @endif
                </a>
              </th>
              <th>
                <a
                  href="{{ route('admin.guest', array_merge(request()->query(), ['sort' => 'CheckInDate', 'direction' => $sort === 'CheckInDate' && $direction === 'asc' ? 'desc' : 'asc'])) }}">
                  Check-In Date
                  @if ($sort === 'CheckInDate')
                    <i class="fas fa-sort-{{ $direction === 'asc' ? 'up' : 'down' }}"></i>
                  @endif
                </a>
              </th>
              <th>
                <a
                  href="{{ route('admin.guest', array_merge(request()->query(), ['sort' => 'CheckOutDate', 'direction' => $sort === 'CheckOutDate' && $direction === 'asc' ? 'desc' : 'asc'])) }}">
                  Check-Out Date
                  @if ($sort === 'CheckOutDate')
                    <i class="fas fa-sort-{{ $direction === 'asc' ? 'up' : 'down' }}"></i>
                  @endif
                </a>
              </th>
              <th>
                <a
                  href="{{ route('admin.guest', array_merge(request()->query(), ['sort' => 'TotalAmount', 'direction' => $sort === 'TotalAmount' && $direction === 'asc' ? 'desc' : 'asc'])) }}">
                  Total Amount
                  @if ($sort === 'TotalAmount')
                    <i class="fas fa-sort-{{ $direction === 'asc' ? 'up' : 'down' }}"></i>
                  @endif
                </a>
              </th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            @forelse ($confirmedReservations as $reservation)
              <tr>
                <td>{{ $reservation->ID }}</td>
                <td>{{ $reservation->UserName }}</td>
                <td>{{ $reservation->RoomName }}</td>
                <td>{{ $reservation->RoomTypeName }}</td>
                <td>{{ $reservation->RoomSizeName }}</td>
                <td>{{ $reservation->HasServices ? 'Yes' : 'No' }}</td>
                <td>{{ Carbon\Carbon::parse($reservation->CheckInDate)->format('Y-m-d') }}</td>
                <td>{{ Carbon\Carbon::parse($reservation->CheckOutDate)->format('Y-m-d') }}</td>
                <td>₱{{ number_format($reservation->TotalAmount, 2) }}</td>
                <td>
                  <a href="{{ route('admin.booking.review', $reservation->ID) }}" class="btn btn-custom btn-sm">Review
                    Info</a>
                </td>
              </tr>
            @empty
              <tr>
                <td colspan="10">No confirmed reservations found.</td>
              </tr>
            @endforelse
          </tbody>
        </table>
        <div class="pagination-container">
          {{ $confirmedReservations->links() }}
        </div>
      </div>

      <!-- Ongoing Reservations -->
      <div class="card p-3 mb-3">
        <h4>Ongoing Reservations</h4>
        <table class="table table-hover">
          <thead>
            <tr>
              <th>
                <a
                  href="{{ route('admin.guest', array_merge(request()->query(), ['sort' => 'ID', 'direction' => $sort === 'ID' && $direction === 'asc' ? 'desc' : 'asc'])) }}">
                  Reservation ID
                  @if ($sort === 'ID')
                    <i class="fas fa-sort-{{ $direction === 'asc' ? 'up' : 'down' }}"></i>
                  @endif
                </a>
              </th>
              <th>
                <a
                  href="{{ route('admin.guest', array_merge(request()->query(), ['sort' => 'UserName', 'direction' => $sort === 'UserName' && $direction === 'asc' ? 'desc' : 'asc'])) }}">
                  User Name
                  @if ($sort === 'UserName')
                    <i class="fas fa-sort-{{ $direction === 'asc' ? 'up' : 'down' }}"></i>
                  @endif
                </a>
              </th>
              <th>
                <a
                  href="{{ route('admin.guest', array_merge(request()->query(), ['sort' => 'RoomName', 'direction' => $sort === 'RoomName' && $direction === 'asc' ? 'desc' : 'asc'])) }}">
                  Assigned Room
                  @if ($sort === 'RoomName')
                    <i class="fas fa-sort-{{ $direction === 'asc' ? 'up' : 'down' }}"></i>
                  @endif
                </a>
              </th>
              <th>
                <a
                  href="{{ route('admin.guest', array_merge(request()->query(), ['sort' => 'RoomTypeName', 'direction' => $sort === 'RoomTypeName' && $direction === 'asc' ? 'desc' : 'asc'])) }}">
                  Room Type
                  @if ($sort === 'RoomTypeName')
                    <i class="fas fa-sort-{{ $direction === 'asc' ? 'up' : 'down' }}"></i>
                  @endif
                </a>
              </th>
              <th>
                <a
                  href="{{ route('admin.guest', array_merge(request()->query(), ['sort' => 'RoomSizeName', 'direction' => $sort === 'RoomSizeName' && $direction === 'asc' ? 'desc' : 'asc'])) }}">
                  Room Size
                  @if ($sort === 'RoomSizeName')
                    <i class="fas fa-sort-{{ $direction === 'asc' ? 'up' : 'down' }}"></i>
                  @endif
                </a>
              </th>
              <th>
                <a
                  href="{{ route('admin.guest', array_merge(request()->query(), ['sort' => 'HasServices', 'direction' => $sort === 'HasServices' && $direction === 'asc' ? 'desc' : 'asc'])) }}">
                  Has Services
                  @if ($sort === 'HasServices')
                    <i class="fas fa-sort-{{ $direction === 'asc' ? 'up' : 'down' }}"></i>
                  @endif
                </a>
              </th>
              <th>
                <a
                  href="{{ route('admin.guest', array_merge(request()->query(), ['sort' => 'CheckInDate', 'direction' => $sort === 'CheckInDate' && $direction === 'asc' ? 'desc' : 'asc'])) }}">
                  Check-In Date
                  @if ($sort === 'CheckInDate')
                    <i class="fas fa-sort-{{ $direction === 'asc' ? 'up' : 'down' }}"></i>
                  @endif
                </a>
              </th>
              <th>
                <a
                  href="{{ route('admin.guest', array_merge(request()->query(), ['sort' => 'CheckOutDate', 'direction' => $sort === 'CheckOutDate' && $direction === 'asc' ? 'desc' : 'asc'])) }}">
                  Check-Out Date
                  @if ($sort === 'CheckOutDate')
                    <i class="fas fa-sort-{{ $direction === 'asc' ? 'up' : 'down' }}"></i>
                  @endif
                </a>
              </th>
              <th>
                <a
                  href="{{ route('admin.guest', array_merge(request()->query(), ['sort' => 'TotalAmount', 'direction' => $sort === 'TotalAmount' && $direction === 'asc' ? 'desc' : 'asc'])) }}">
                  Total Amount
                  @if ($sort === 'TotalAmount')
                    <i class="fas fa-sort-{{ $direction === 'asc' ? 'up' : 'down' }}"></i>
                  @endif
                </a>
              </th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            @forelse ($ongoingReservations as $reservation)
              <tr>
                <td>{{ $reservation->ID }}</td>
                <td>{{ $reservation->UserName }}</td>
                <td>{{ $reservation->RoomName }}</td>
                <td>{{ $reservation->RoomTypeName }}</td>
                <td>{{ $reservation->RoomSizeName }}</td>
                <td>{{ $reservation->HasServices ? 'Yes' : 'No' }}</td>
                <td>{{ Carbon\Carbon::parse($reservation->CheckInDate)->format('Y-m-d') }}</td>
                <td>{{ Carbon\Carbon::parse($reservation->CheckOutDate)->format('Y-m-d') }}</td>
                <td>₱{{ number_format($reservation->TotalAmount, 2) }}</td>
                <td>
                  <a href="{{ route('admin.booking.review', $reservation->ID) }}" class="btn btn-sm btn-custom">Review
                    Info</a>
                </td>
              </tr>
            @empty
              <tr>
                <td colspan="10">No ongoing reservations found.</td>
              </tr>
            @endforelse
          </tbody>
        </table>
        <div class="pagination-container">
          {{ $ongoingReservations->links() }}
        </div>
      </div>

      <!-- Ended Reservations -->
      <div class="card p-3 mb-3">
        <h4>Ended Reservations</h4>
        <table class="table table-hover">
          <thead>
            <tr>
              <th>
                <a
                  href="{{ route('admin.guest', array_merge(request()->query(), ['sort' => 'ID', 'direction' => $sort === 'ID' && $direction === 'asc' ? 'desc' : 'asc'])) }}">
                  Reservation ID
                  @if ($sort === 'ID')
                    <i class="fas fa-sort-{{ $direction === 'asc' ? 'up' : 'down' }}"></i>
                  @endif
                </a>
              </th>
              <th>
                <a
                  href="{{ route('admin.guest', array_merge(request()->query(), ['sort' => 'UserName', 'direction' => $sort === 'UserName' && $direction === 'asc' ? 'desc' : 'asc'])) }}">
                  User Name
                  @if ($sort === 'UserName')
                    <i class="fas fa-sort-{{ $direction === 'asc' ? 'up' : 'down' }}"></i>
                  @endif
                </a>
              </th>
              <th>
                <a
                  href="{{ route('admin.guest', array_merge(request()->query(), ['sort' => 'RoomName', 'direction' => $sort === 'RoomName' && $direction === 'asc' ? 'desc' : 'asc'])) }}">
                  Assigned Room
                  @if ($sort === 'RoomName')
                    <i class="fas fa-sort-{{ $direction === 'asc' ? 'up' : 'down' }}"></i>
                  @endif
                </a>
              </th>
              <th>
                <a
                  href="{{ route('admin.guest', array_merge(request()->query(), ['sort' => 'RoomTypeName', 'direction' => $sort === 'RoomTypeName' && $direction === 'asc' ? 'desc' : 'asc'])) }}">
                  Room Type
                  @if ($sort === 'RoomTypeName')
                    <i class="fas fa-sort-{{ $direction === 'asc' ? 'up' : 'down' }}"></i>
                  @endif
                </a>
              </th>
              <th>
                <a
                  href="{{ route('admin.guest', array_merge(request()->query(), ['sort' => 'RoomSizeName', 'direction' => $sort === 'RoomSizeName' && $direction === 'asc' ? 'desc' : 'asc'])) }}">
                  Room Size
                  @if ($sort === 'RoomSizeName')
                    <i class="fas fa-sort-{{ $direction === 'asc' ? 'up' : 'down' }}"></i>
                  @endif
                </a>
              </th>
              <th>
                <a
                  href="{{ route('admin.guest', array_merge(request()->query(), ['sort' => 'HasServices', 'direction' => $sort === 'HasServices' && $direction === 'asc' ? 'desc' : 'asc'])) }}">
                  Has Services
                  @if ($sort === 'HasServices')
                    <i class="fas fa-sort-{{ $direction === 'asc' ? 'up' : 'down' }}"></i>
                  @endif
                </a>
              </th>
              <th>
                <a
                  href="{{ route('admin.guest', array_merge(request()->query(), ['sort' => 'CheckInDate', 'direction' => $sort === 'CheckInDate' && $direction === 'asc' ? 'desc' : 'asc'])) }}">
                  Check-In Date
                  @if ($sort === 'CheckInDate')
                    <i class="fas fa-sort-{{ $direction === 'asc' ? 'up' : 'down' }}"></i>
                  @endif
                </a>
              </th>
              <th>
                <a
                  href="{{ route('admin.guest', array_merge(request()->query(), ['sort' => 'CheckOutDate', 'direction' => $sort === 'CheckOutDate' && $direction === 'asc' ? 'desc' : 'asc'])) }}">
                  Check-Out Date
                  @if ($sort === 'CheckOutDate')
                    <i class="fas fa-sort-{{ $direction === 'asc' ? 'up' : 'down' }}"></i>
                  @endif
                </a>
              </th>
              <th>
                <a
                  href="{{ route('admin.guest', array_merge(request()->query(), ['sort' => 'TotalAmount', 'direction' => $sort === 'TotalAmount' && $direction === 'asc' ? 'desc' : 'asc'])) }}">
                  Total Amount
                  @if ($sort === 'TotalAmount')
                    <i class="fas fa-sort-{{ $direction === 'asc' ? 'up' : 'down' }}"></i>
                  @endif
                </a>
              </th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            @forelse ($endedReservations as $reservation)
              <tr>
                <td>{{ $reservation->ID }}</td>
                <td>{{ $reservation->UserName }}</td>
                <td>{{ $reservation->RoomName }}</td>
                <td>{{ $reservation->RoomTypeName }}</td>
                <td>{{ $reservation->RoomSizeName }}</td>
                <td>{{ $reservation->HasServices ? 'Yes' : 'No' }}</td>
                <td>{{ Carbon\Carbon::parse($reservation->CheckInDate)->format('Y-m-d') }}</td>
                <td>{{ Carbon\Carbon::parse($reservation->CheckOutDate)->format('Y-m-d') }}</td>
                <td>₱{{ number_format($reservation->TotalAmount, 2) }}</td>
                <td>
                  <a href="{{ route('admin.booking.review', $reservation->ID) }}" class="btn btn-sm btn-custom">Review
                    Info</a>
                </td>
              </tr>
            @empty
              <tr>
                <td colspan="10">No ended reservations found.</td>
              </tr>
            @endforelse
          </tbody>
        </table>
        <div class="pagination-container">
          {{ $endedReservations->links() }}
        </div>
      </div>

      <!-- Cancelled Reservations -->
      <div class="card p-3 mb-3">
        <h4>Cancelled Reservations</h4>
        <table class="table table-hover">
          <thead>
            <tr>
              <th>
                <a
                  href="{{ route('admin.guest', array_merge(request()->query(), ['sort' => 'ID', 'direction' => $sort === 'ID' && $direction === 'asc' ? 'desc' : 'asc'])) }}">
                  Reservation ID
                  @if ($sort === 'ID')
                    <i class="fas fa-sort-{{ $direction === 'asc' ? 'up' : 'down' }}"></i>
                  @endif
                </a>
              </th>
              <th>
                <a
                  href="{{ route('admin.guest', array_merge(request()->query(), ['sort' => 'UserName', 'direction' => $sort === 'UserName' && $direction === 'asc' ? 'desc' : 'asc'])) }}">
                  User Name
                  @if ($sort === 'UserName')
                    <i class="fas fa-sort-{{ $direction === 'asc' ? 'up' : 'down' }}"></i>
                  @endif
                </a>
              </th>
              <th>
                <a
                  href="{{ route('admin.guest', array_merge(request()->query(), ['sort' => 'RoomName', 'direction' => $sort === 'RoomName' && $direction === 'asc' ? 'desc' : 'asc'])) }}">
                  Assigned Room
                  @if ($sort === 'RoomName')
                    <i class="fas fa-sort-{{ $direction === 'asc' ? 'up' : 'down' }}"></i>
                  @endif
                </a>
              </th>
              <th>
                <a
                  href="{{ route('admin.guest', array_merge(request()->query(), ['sort' => 'RoomTypeName', 'direction' => $sort === 'RoomTypeName' && $direction === 'asc' ? 'desc' : 'asc'])) }}">
                  Room Type
                  @if ($sort === 'RoomTypeName')
                    <i class="fas fa-sort-{{ $direction === 'asc' ? 'up' : 'down' }}"></i>
                  @endif
                </a>
              </th>
              <th>
                <a
                  href="{{ route('admin.guest', array_merge(request()->query(), ['sort' => 'RoomSizeName', 'direction' => $sort === 'RoomSizeName' && $direction === 'asc' ? 'desc' : 'asc'])) }}">
                  Room Size
                  @if ($sort === 'RoomSizeName')
                    <i class="fas fa-sort-{{ $direction === 'asc' ? 'up' : 'down' }}"></i>
                  @endif
                </a>
              </th>
              <th>
                <a
                  href="{{ route('admin.guest', array_merge(request()->query(), ['sort' => 'HasServices', 'direction' => $sort === 'HasServices' && $direction === 'asc' ? 'desc' : 'asc'])) }}">
                  Has Services
                  @if ($sort === 'HasServices')
                    <i class="fas fa-sort-{{ $direction === 'asc' ? 'up' : 'down' }}"></i>
                  @endif
                </a>
              </th>
              <th>
                <a
                  href="{{ route('admin.guest', array_merge(request()->query(), ['sort' => 'CheckInDate', 'direction' => $sort === 'CheckInDate' && $direction === 'asc' ? 'desc' : 'asc'])) }}">
                  Check-In Date
                  @if ($sort === 'CheckInDate')
                    <i class="fas fa-sort-{{ $direction === 'asc' ? 'up' : 'down' }}"></i>
                  @endif
                </a>
              </th>
              <th>
                <a
                  href="{{ route('admin.guest', array_merge(request()->query(), ['sort' => 'CheckOutDate', 'direction' => $sort === 'CheckOutDate' && $direction === 'asc' ? 'desc' : 'asc'])) }}">
                  Check-Out Date
                  @if ($sort === 'CheckOutDate')
                    <i class="fas fa-sort-{{ $direction === 'asc' ? 'up' : 'down' }}"></i>
                  @endif
                </a>
              </th>
              <th>
                <a
                  href="{{ route('admin.guest', array_merge(request()->query(), ['sort' => 'TotalAmount', 'direction' => $sort === 'TotalAmount' && $direction === 'asc' ? 'desc' : 'asc'])) }}">
                  Total Amount
                  @if ($sort === 'TotalAmount')
                    <i class="fas fa-sort-{{ $direction === 'asc' ? 'up' : 'down' }}"></i>
                  @endif
                </a>
              </th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            @forelse ($cancelledReservations as $reservation)
              <tr>
                <td>{{ $reservation->ID }}</td>
                <td>{{ $reservation->UserName }}</td>
                <td>{{ $reservation->RoomName }}</td>
                <td>{{ $reservation->RoomTypeName }}</td>
                <td>{{ $reservation->RoomSizeName }}</td>
                <td>{{ $reservation->HasServices ? 'Yes' : 'No' }}</td>
                <td>{{ Carbon\Carbon::parse($reservation->CheckInDate)->format('Y-m-d') }}</td>
                <td>{{ Carbon\Carbon::parse($reservation->CheckOutDate)->format('Y-m-d') }}</td>
                <td>₱{{ number_format($reservation->TotalAmount, 2) }}</td>
                <td>
                  <a href="{{ route('admin.booking.review', $reservation->ID) }}" class="btn btn-sm btn-custom">Review
                    Info</a>
                </td>
              </tr>
            @empty
              <tr>
                <td colspan="10">No cancelled reservations found.</td>
              </tr>
            @endforelse
          </tbody>
        </table>
        <div class="pagination-container">
          {{ $cancelledReservations->links() }}
        </div>
      </div>
    </div>
  </div>
@endsection
