@extends('layouts.admin_layout')
@section('title', 'Rooms')
@section('content')
  <h1 class="main-text">Rooms</h1>
  <div class="row">
    <div class="col-md-12">
      <!-- Search Form -->
      <div class="mb-3">
        <form action="{{ route('admin.rooms') }}" method="GET" class="d-flex">
          <input type="text" name="search" class="form-control me-2"
            placeholder="Search by room number, type, size, floor, or user" value="{{ $search ?? '' }}">
          <button type="submit" class="btn btn-custom">Search</button>
          @if ($search)
            <a href="{{ route('admin.rooms') }}" class="btn btn-secondary ms-2">Clear</a>
          @endif
        </form>
      </div>

      <!-- Occupied Rooms -->
      <div class="card p-3 mb-3">
        <h4>Occupied Rooms</h4>
        <table class="table">
          <thead>
            <tr>
              <th class="col-md-2">
                <a
                  href="{{ route('admin.rooms', array_merge(request()->query(), ['sort' => 'RoomName', 'direction' => $sort === 'RoomName' && $direction === 'asc' ? 'desc' : 'asc'])) }}">
                  Room Number
                  @if ($sort === 'RoomName')
                    <i class="fas fa-sort-{{ $direction === 'asc' ? 'up' : 'down' }}"></i>
                  @endif
                </a>
              </th>
              <!-- Modified: Added Status column -->
              <th>
                <a
                  href="{{ route('admin.rooms', array_merge(request()->query(), ['sort' => 'status', 'direction' => $sort === 'status' && $direction === 'asc' ? 'desc' : 'asc'])) }}">
                  Status
                  @if ($sort === 'status')
                    <i class="fas fa-sort-{{ $direction === 'asc' ? 'up' : 'down' }}"></i>
                  @endif
                </a>
              </th>
              <!-- End Modified -->
              <th>
                <a
                  href="{{ route('admin.rooms', array_merge(request()->query(), ['sort' => 'RoomTypeName', 'direction' => $sort === 'RoomTypeName' && $direction === 'asc' ? 'desc' : 'asc'])) }}">
                  Room Type
                  @if ($sort === 'RoomTypeName')
                    <i class="fas fa-sort-{{ $direction === 'asc' ? 'up' : 'down' }}"></i>
                  @endif
                </a>
              </th>
              <th>
                <a
                  href="{{ route('admin.rooms', array_merge(request()->query(), ['sort' => 'RoomSizeName', 'direction' => $sort === 'RoomSizeName' && $direction === 'asc' ? 'desc' : 'asc'])) }}">
                  Room Size
                  @if ($sort === 'RoomSizeName')
                    <i class="fas fa-sort-{{ $direction === 'asc' ? 'up' : 'down' }}"></i>
                  @endif
                </a>
              </th>
              <th>
                <a
                  href="{{ route('admin.rooms', array_merge(request()->query(), ['sort' => 'Floor', 'direction' => $sort === 'Floor' && $direction === 'asc' ? 'desc' : 'asc'])) }}">
                  Floor
                  @if ($sort === 'Floor')
                    <i class="fas fa-sort-{{ $direction === 'asc' ? 'up' : 'down' }}"></i>
                  @endif
                </a>
              </th>
              <th>
                <a
                  href="{{ route('admin.rooms', array_merge(request()->query(), ['sort' => 'Occupant', 'direction' => $sort === 'Occupant' && $direction === 'asc' ? 'desc' : 'asc'])) }}">
                  Occupant
                  @if ($sort === 'Occupant')
                    <i class="fas fa-sort-{{ $direction === 'asc' ? 'up' : 'down' }}"></i>
                  @endif
                </a>
              </th>
            </tr>
          </thead>
          <tbody>
            @forelse ($occupiedRooms as $room)
              <tr>
                <td>{{ $room->RoomName }}</td>
                <!-- Modified: Added Status column -->
                <td>{{ $room->status }}</td>
                <!-- End Modified -->
                <td>{{ $room->RoomTypeName }}</td>
                <td>{{ $room->RoomSizeName }}</td>
                <td>{{ $room->Floor }}</td>
                <td>{{ $room->Occupant }}</td>
              </tr>
            @empty
              <tr>
                <td colspan="6">No occupied rooms found.</td>
              </tr>
            @endforelse
          </tbody>
        </table>
        <div class="pagination-container">
          {{ $occupiedRooms->links() }}
        </div>
      </div>

      <!-- Available Rooms -->
      <div class="card p-3 mb-3">
        <h4>Available Rooms</h4>
        <table class="table">
          <thead>
            <tr>
              <th class="col-md-2">
                <a
                  href="{{ route('admin.rooms', array_merge(request()->query(), ['sort' => 'RoomName', 'direction' => $sort === 'RoomName' && $direction === 'asc' ? 'desc' : 'asc'])) }}">
                  Room Number
                  @if ($sort === 'RoomName')
                    <i class="fas fa-sort-{{ $direction === 'asc' ? 'up' : 'down' }}"></i>
                  @endif
                </a>
              </th>
              <th>
                <a
                  href="{{ route('admin.rooms', array_merge(request()->query(), ['sort' => 'RoomTypeName', 'direction' => $sort === 'RoomTypeName' && $direction === 'asc' ? 'desc' : 'asc'])) }}">
                  Room Type
                  @if ($sort === 'RoomTypeName')
                    <i class="fas fa-sort-{{ $direction === 'asc' ? 'up' : 'down' }}"></i>
                  @endif
                </a>
              </th>
              <th>
                <a
                  href="{{ route('admin.rooms', array_merge(request()->query(), ['sort' => 'RoomSizeName', 'direction' => $sort === 'RoomSizeName' && $direction === 'asc' ? 'desc' : 'asc'])) }}">
                  Room Size
                  @if ($sort === 'RoomSizeName')
                    <i class="fas fa-sort-{{ $direction === 'asc' ? 'up' : 'down' }}"></i>
                  @endif
                </a>
              </th>
              <th>
                <a
                  href="{{ route('admin.rooms', array_merge(request()->query(), ['sort' => 'Floor', 'direction' => $sort === 'Floor' && $direction === 'asc' ? 'desc' : 'asc'])) }}">
                  Floor
                  @if ($sort === 'Floor')
                    <i class="fas fa-sort-{{ $direction === 'asc' ? 'up' : 'down' }}"></i>
                  @endif
                </a>
              </th>
            </tr>
          </thead>
          <tbody>
            @forelse ($availableRooms as $room)
              <tr>
                <td>{{ $room->RoomName }}</td>
                <td>{{ $room->RoomTypeName }}</td>
                <td>{{ $room->RoomSizeName }}</td>
                <td>{{ $room->Floor }}</td>
              </tr>
            @empty
              <tr>
                <td colspan="4">No available rooms found.</td>
              </tr>
            @endforelse
          </tbody>
        </table>
        <div class="pagination-container">
          {{ $availableRooms->links() }}
        </div>
      </div>

      <!-- All Rooms -->
      <div class="card p-3 mb-3">
        <h4>All Rooms</h4>
        <table class="table">
          <thead>
            <tr>
              <th class="col-md-2">
                <a
                  href="{{ route('admin.rooms', array_merge(request()->query(), ['sort' => 'RoomName', 'direction' => $sort === 'RoomName' && $direction === 'asc' ? 'desc' : 'asc'])) }}">
                  Room Number
                  @if ($sort === 'RoomName')
                    <i class="fas fa-sort-{{ $direction === 'asc' ? 'up' : 'down' }}"></i>
                  @endif
                </a>
              </th>
              <th>
                <a
                  href="{{ route('admin.rooms', array_merge(request()->query(), ['sort' => 'RoomTypeName', 'direction' => $sort === 'RoomTypeName' && $direction === 'asc' ? 'desc' : 'asc'])) }}">
                  Room Type
                  @if ($sort === 'RoomTypeName')
                    <i class="fas fa-sort-{{ $direction === 'asc' ? 'up' : 'down' }}"></i>
                  @endif
                </a>
              </th>
              <th>
                <a
                  href="{{ route('admin.rooms', array_merge(request()->query(), ['sort' => 'RoomSizeName', 'direction' => $sort === 'RoomSizeName' && $direction === 'asc' ? 'desc' : 'asc'])) }}">
                  Room Size
                  @if ($sort === 'RoomSizeName')
                    <i class="fas fa-sort-{{ $direction === 'asc' ? 'up' : 'down' }}"></i>
                  @endif
                </a>
              </th>
              <th>
                <a
                  href="{{ route('admin.rooms', array_merge(request()->query(), ['sort' => 'Floor', 'direction' => $sort === 'Floor' && $direction === 'asc' ? 'desc' : 'asc'])) }}">
                  Floor
                  @if ($sort === 'Floor')
                    <i class="fas fa-sort-{{ $direction === 'asc' ? 'up' : 'down' }}"></i>
                  @endif
                </a>
              </th>
              <th>
                <a
                  href="{{ route('admin.rooms', array_merge(request()->query(), ['sort' => 'status', 'direction' => $sort === 'status' && $direction === 'asc' ? 'desc' : 'asc'])) }}">
                  Status
                  @if ($sort === 'status')
                    <i class="fas fa-sort-{{ $direction === 'asc' ? 'up' : 'down' }}"></i>
                  @endif
                </a>
              </th>
              <th>
                <a
                  href="{{ route('admin.rooms', array_merge(request()->query(), ['sort' => 'Occupant', 'direction' => $sort === 'Occupant' && $direction === 'asc' ? 'desc' : 'asc'])) }}">
                  Occupant
                  @if ($sort === 'Occupant')
                    <i class="fas fa-sort-{{ $direction === 'asc' ? 'up' : 'down' }}"></i>
                  @endif
                </a>
              </th>
            </tr>
          </thead>
          <tbody>
            @forelse ($allRooms as $room)
              <tr>
                <td>{{ $room->RoomName }}</td>
                <td>{{ $room->RoomTypeName }}</td>
                <td>{{ $room->RoomSizeName }}</td>
                <td>{{ $room->Floor }}</td>
                <td>{{ $room->status }}</td>
                <td>{{ $room->Occupant }}</td>
              </tr>
            @empty
              <tr>
                <td colspan="6">No rooms found.</td>
              </tr>
            @endforelse
          </tbody>
        </table>
        <div class="pagination-container">
          {{ $allRooms->links() }}
        </div>
      </div>

      <!-- Add Room Button -->
      <div class="mb-3">
        <button class="btn btn-custom col-sm-12" data-bs-toggle="modal" data-bs-target="#addRoomModal">Add Room</button>
      </div>
    </div>
  </div>
@endsection
