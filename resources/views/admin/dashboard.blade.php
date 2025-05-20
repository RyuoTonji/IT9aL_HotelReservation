  @extends('layouts.admin_layout')

  @section('title', 'Admin Dashboard')

  @section('content')
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
          <h1 class="h2 main-text">Dashboard</h1>
          <div class="input-group w-50">
              <input type="text" class="form-control" placeholder="Search for rooms and offers">
              <button class="btn btn-primary" type="button"><i class="bi bi-search"></i></button>
          </div>
      </div>

      <!-- Overview Section -->
      <div class="row">
          @foreach(['Check-in' => $todayCheckIn, 'Check-out' => $todayCheckOut, 'Total In Hotel' => $totalInHotel, 'Available Rooms' => $availableRooms, 'Occupied Rooms' => $occupiedRooms] as $title => $count)
              <div class="col-md-2 mb-4">
                  <div class="card">
                      <div class="card-body">
                          <h5 class="card-title">{{ $title }}</h5>
                          <p class="card-text display-4">{{ $count }}</p>
                      </div>
                  </div>
              </div>
          @endforeach
      </div>

      <!-- Rooms Section -->
      <div class="card mb-4">
          <div class="card-header d-flex justify-content-between align-items-center">
              <h5 class="mb-0">Rooms</h5>
              <a href="{{ route('admin.rooms') }}" class="btn btn-primary">Manage Rooms</a>
          </div>
          <div class="card-body">
              <div class="row">
                  @foreach($roomTypes as $roomType)
                      <div class="col-md-3 mb-3">
                          <div class="card">
                              <div class="card-body">
                                  <h6 class="card-title">{{ $roomType->RoomTypeName }}</h6>
                                  <p class="card-text">₱{{ number_format($roomType->RoomPrice, 2) }}</p>
                              </div>
                          </div>
                      </div>
                  @endforeach
              </div>
          </div>
      </div>

      <!-- Room Status Section -->
      <div class="card mb-4">
          <div class="card-header">
              <h5>Room Status</h5>
          </div>
          <div class="card-body">
              <canvas id="roomStatusChart"></canvas>
          </div>
      </div>

      <!-- Floor Status Section -->
      <div class="card mb-4">
          <div class="card-header">
              <h5>Floor Status</h5>
          </div>
          <div class="card-body">
              <canvas id="floorStatusChart"></canvas>
          </div>
      </div>

      <!-- Occupancy Statistics Chart -->
      <div class="card mb-4">
          <div class="card-header">
              <h5>Occupancy Statistics</h5>
          </div>
          <div class="card-body">
              <canvas id="occupancyChart"></canvas>
          </div>
      </div>
  @endsection

  @section('scripts')
      <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
      <script>
          // Occupancy Chart
          new Chart(document.getElementById('occupancyChart').getContext('2d'), {
              type: 'bar',
              data: {
                  labels: @json(array_keys($occupancyData)),
                  datasets: [{
                      label: 'Bookings',
                      data: @json(array_values($occupancyData)),
                      backgroundColor: '#EFBF04',
                      borderColor: '#FFFFFF',
                      borderWidth: 1
                  }]
              },
              options: {
                  scales: {
                      y: { beginAtZero: true, ticks: { color: '#FFFFFF' }, grid: { color: 'rgba(255, 255, 255, 0.1)' } },
                      x: { ticks: { color: '#FFFFFF' }, grid: { display: false } }
                  },
                  plugins: {
                      legend: { labels: { color: '#FFFFFF' } }
                  }
              }
          });

          // Room Status Chart
          new Chart(document.getElementById('roomStatusChart').getContext('2d'), {
              type: 'pie',
              data: {
                  labels: @json(array_keys($roomStatus)),
                  datasets: [{
                      data: @json(array_values($roomStatus)),
                      backgroundColor: ['#EFBF04', '#28a745', '#dc3545', '#17a2b8'],
                      borderColor: '#FFFFFF',
                      borderWidth: 1
                  }]
              },
              options: {
                  plugins: {
                      legend: { labels: { color: '#FFFFFF' } }
                  }
              }
          });

          // Floor Status Chart
          new Chart(document.getElementById('floorStatusChart').getContext('2d'), {
              type: 'pie',
              data: {
                  labels: @json(array_keys($floorStatus)),
                  datasets: [{
                      data: @json(array_values($floorStatus)),
                      backgroundColor: ['#EFBF04', '#28a745', '#dc3545', '#17a2b8'],
                      borderColor: '#FFFFFF',
                      borderWidth: 1
                  }]
              },
              options: {
                  plugins: {
                      legend: { labels: { color: '#FFFFFF' } }
                  }
              }
          });
      </script>
  @endsection
