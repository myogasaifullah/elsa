@extends('layout.header')

@section('title', 'Dashboard')

@include('layout.sidebar')

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Dashboard</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                <li class="breadcrumb-item active">Dashboard</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
        <div class="row">

            <!-- Card Section -->
            <div class="col-lg-12">
                <div class="row">

                    <!-- Users Card -->
                    <div class="col-xxl-3 col-md-6">
                        <div class="card info-card sales-card">
                            <div class="card-body">
                                <h5 class="card-title">Total Users</h5>
                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-people"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6>{{ number_format($data['total_users']) }}</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Bookings Card -->
                    <div class="col-xxl-3 col-md-6">
                        <div class="card info-card revenue-card">
                            <div class="card-body">
                                <h5 class="card-title">Total Bookings</h5>
                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-calendar-check"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6>{{ number_format($data['total_bookings']) }}</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Jadwal Card -->
                    <div class="col-xxl-3 col-md-6">
                        <div class="card info-card customers-card">
                            <div class="card-body">
                                <h5 class="card-title">Total Jadwal</h5>
                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-calendar-event"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6>{{ number_format($data['total_jadwal']) }}</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Dosen Card -->
                    <div class="col-xxl-3 col-md-6">
                        <div class="card info-card revenue-card">
                            <div class="card-body">
                                <h5 class="card-title">Total Dosen</h5>
                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-person-badge"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6>{{ number_format($data['total_dosen']) }}</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Mooc Card -->
                    <div class="col-xxl-3 col-md-6">
                        <div class="card info-card sales-card">
                            <div class="card-body">
                                <h5 class="card-title">Total MOOC</h5>
                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-collection"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6>{{ number_format($data['total_mooc']) }}</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Studio Card -->
                    <div class="col-xxl-3 col-md-6">
                        <div class="card info-card customers-card">
                            <div class="card-body">
                                <h5 class="card-title">Total Studio</h5>
                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-building"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6>{{ number_format($data['total_studio']) }}</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Mata Kuliah Card -->
                    <div class="col-xxl-3 col-md-6">
                        <div class="card info-card revenue-card">
                            <div class="card-body">
                                <h5 class="card-title">Total Mata Kuliah</h5>
                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-book"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6>{{ number_format($data['total_matakuliah']) }}</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Fakultas Card -->
                    <div class="col-xxl-3 col-md-6">
                        <div class="card info-card sales-card">
                            <div class="card-body">
                                <h5 class="card-title">Total Fakultas</h5>
                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-building-fill"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6>{{ number_format($data['total_fakultas']) }}</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Prodi Card -->
                    <div class="col-xxl-3 col-md-6">
                        <div class="card info-card customers-card">
                            <div class="card-body">
                                <h5 class="card-title">Total Prodi</h5>
                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-mortarboard"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6>{{ number_format($data['total_prodi']) }}</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Progress Card -->
                    <div class="col-xxl-3 col-md-6">
                        <div class="card info-card revenue-card">
                            <div class="card-body">
                                <h5 class="card-title">Total Progress</h5>
                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-graph-up"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6>{{ number_format($data['total_progress']) }}</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Editors Card -->
                    <div class="col-xxl-3 col-md-6">
                        <div class="card info-card sales-card">
                            <div class="card-body">
                                <h5 class="card-title">Total Editors</h5>
                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-person-video3"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6>{{ number_format($data['total_editors']) }}</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Activity Logs Card -->
                    <div class="col-xxl-3 col-md-6">
                        <div class="card info-card customers-card">
                            <div class="card-body">
                                <h5 class="card-title">Total Activity Logs</h5>
                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-activity"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6>{{ number_format($data['total_activity_logs']) }}</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Charts Section -->
            <div class="col-lg-12 mt-4">
                <h4 class="section-title">Analytics</h4>
                <div class="row">
                    <!-- Bookings Chart -->
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Bookings by Month</h5>
                                <div class="chart-container" style="height: 300px;">
                                    <canvas id="bookingsChart"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Users Chart -->
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Users by Role</h5>
                                <div class="chart-container" style="height: 300px;">
                                    <canvas id="usersChart"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Progress Chart -->
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Progress by Status</h5>
                                <div class="chart-container" style="height: 300px;">
                                    <canvas id="progressChart"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- System Load Chart -->
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">System Load</h5>
                                <div class="chart-container" style="height: 300px;">
                                    <canvas id="systemChart"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Advanced Visualizations Section -->
            <div class="col-lg-12 mt-4">
                <h4 class="section-title">Advanced Analytics</h4>
                <div class="row">
                    <!-- Fakultas Distribution Pie Chart -->
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Fakultas Distribution</h5>
                                <div class="chart-container" style="height: 300px;">
                                    <canvas id="fakultasChart"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Prodi by Fakultas Bar Chart -->
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Prodi by Fakultas</h5>
                                <div class="chart-container" style="height: 300px;">
                                    <canvas id="prodiChart"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Dosen by Status Doughnut Chart -->
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Dosen by Status</h5>
                                <div class="chart-container" style="height: 300px;">
                                    <canvas id="dosenChart"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- MOOC by Fakultas Radar Chart -->
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">MOOC by Fakultas</h5>
                                <div class="chart-container" style="height: 300px;">
                                    <canvas id="moocChart"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Progress Completion Trend Line Chart -->
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Progress Completion Trend</h5>
                                <div class="chart-container" style="height: 300px;">
                                    <canvas id="progressTrendChart"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Activity Logs by Type Bar Chart -->
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Activity Logs by Type</h5>
                                <div class="chart-container" style="height: 300px;">
                                    <canvas id="activityChart"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Bookings Trend Weekly Area Chart -->
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Weekly Bookings Trend</h5>
                                <div class="chart-container" style="height: 300px;">
                                    <canvas id="weeklyBookingsChart"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Studio Utilization Horizontal Bar Chart -->
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Studio Utilization</h5>
                                <div class="chart-container" style="height: 300px;">
                                    <canvas id="studioChart"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Editor Performance Radar Chart -->
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Editor Performance</h5>
                                <div class="chart-container" style="height: 300px;">
                                    <canvas id="editorChart"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Monthly Growth Multi-Line Chart -->
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Monthly Growth Trends</h5>
                                <div class="chart-container" style="height: 400px;">
                                    <canvas id="growthChart"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Recent Data Tables -->
            <div class="col-lg-12 mt-4">
                <h4 class="section-title">Recent Activity</h4>
                <div class="row">
                    <!-- Recent Users -->
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Recent Users</h5>
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Role</th>
                                                <th>Created</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($data['recent_users'] as $user)
                                            <tr>
                                                <td>{{ $user->name }}</td>
                                                <td>{{ $user->email }}</td>
                                                <td><span class="badge bg-primary">{{ $user->role }}</span></td>
                                                <td>{{ $user->created_at ? $user->created_at->format('d/m/Y') : 'N/A' }}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Recent Bookings -->
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Recent Bookings</h5>
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th>User</th>
                                                <th>Studio</th>
                                                <th>Date</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($data['recent_bookings'] as $booking)
                                            <tr>
                                                <td>{{ $booking->user->name ?? 'N/A' }}</td>
                                                <td>{{ $booking->studio->nama_studio ?? 'N/A' }}</td>
                                                <td>{{ $booking->created_at->format('d/m/Y') }}</td>
                                                <td><span class="badge bg-success">{{ $booking->status ?? 'Active' }}</span></td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Recent Jadwal -->
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Recent Jadwal</h5>
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <!-- <th>Booking</th> -->
                                                <th>Dosen</th>
                                                <th>Date</th>
                                                <th>Time</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($data['recent_jadwal'] as $jadwal)
                                            <tr>
                                                <!-- <td>{{ $jadwal->id ?? 'N/A' }}</td> -->
                                                <td>{{ $jadwal->dosen->nama_dosen ?? 'N/A' }}</td>
                                                <td>{{\Carbon\Carbon::parse($jadwal->tanggal)->format('d/m/Y') }}</td>
                                                <td>{{ $jadwal->jam }}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Recent Progress -->
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Recent Progress</h5>
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <!-- <th>Jadwal</th> -->
                                                <th>Editor</th>
                                                <th>Status</th>
                                                <th>Progress</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($data['recent_progress'] as $progress)
                                            <tr>
                                                <!-- <td>{{ $progress->jadwalBooking->id ?? 'N/A' }}</td> -->
                                                <td>{{ $progress->editor->nama ?? 'N/A' }}</td>
                                                <td><span class="badge bg-info">{{ $progress->status ?? 'Pending' }}</span></td>
                                                <td>{{ $progress->persentase ?? 0 }}%</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- System Overview -->
            <div class="col-lg-12 mt-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">System Overview</h5>
                        <div class="alert alert-info">
                            <h6>Database Summary</h6>
                            <div class="row">
                                <div class="col-md-6">
                                    <ul>
                                        <li>Total Users: {{ number_format($data['total_users']) }}</li>
                                        <li>Total Bookings: {{ number_format($data['total_bookings']) }}</li>
                                        <li>Total Jadwal: {{ number_format($data['total_jadwal']) }}</li>
                                        <li>Total Dosen: {{ number_format($data['total_dosen']) }}</li>
                                        <li>Total MOOC: {{ number_format($data['total_mooc']) }}</li>
                                        <li>Total Studio: {{ number_format($data['total_studio']) }}</li>
                                    </ul>
                                </div>
                                <div class="col-md-6">
                                    <ul>
                                        <li>Total Mata Kuliah: {{ number_format($data['total_matakuliah']) }}</li>
                                        <li>Total Fakultas: {{ number_format($data['total_fakultas']) }}</li>
                                        <li>Total Prodi: {{ number_format($data['total_prodi']) }}</li>
                                        <li>Total Progress: {{ number_format($data['total_progress']) }}</li>
                                        <li>Total Editors: {{ number_format($data['total_editors']) }}</li>
                                        <li>Total Activity Logs: {{ number_format($data['total_activity_logs']) }}</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>

    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Bookings by Month Chart
            const bookingsCtx = document.getElementById('bookingsChart').getContext('2d');
            const bookingsData = @json($data['bookings_by_month']);

            // Format data untuk chart (mengisi bulan yang kosong dengan 0)
            const allMonths = Array.from({
                length: 12
            }, (_, i) => i + 1);
            const formattedBookingsData = allMonths.map(month => bookingsData[month] || 0);

            new Chart(bookingsCtx, {
                type: 'line',
                data: {
                    labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                    datasets: [{
                        label: 'Bookings',
                        data: formattedBookingsData,
                        borderColor: 'rgb(75, 192, 192)',
                        backgroundColor: 'rgba(75, 192, 192, 0.1)',
                        fill: true,
                        tension: 0.3
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false
                        }
                    }
                }
            });

            // Users by Role Chart
            const usersCtx = document.getElementById('usersChart').getContext('2d');
            const usersData = @json($data['users_by_role']);

            new Chart(usersCtx, {
                type: 'doughnut',
                data: {
                    labels: Object.keys(usersData),
                    datasets: [{
                        data: Object.values(usersData),
                        backgroundColor: [
                            'rgb(255, 99, 132)',
                            'rgb(54, 162, 235)',
                            'rgb(255, 205, 86)',
                            'rgb(75, 192, 192)',
                            'rgb(153, 102, 255)'
                        ],
                        hoverOffset: 4
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'bottom'
                        }
                    }
                }
            });

            // Progress by Status Chart
            const progressCtx = document.getElementById('progressChart').getContext('2d');
            const progressData = @json($data['progress_by_status']);

            // Format labels untuk progress
            const progressLabels = Object.keys(progressData).map(key => {
                // Mengubah format key menjadi lebih readable
                return key.toString().charAt(0).toUpperCase() + key.toString().slice(1).replace('_', ' ');
            });

            new Chart(progressCtx, {
                type: 'bar',
                data: {
                    labels: progressLabels,
                    datasets: [{
                        label: 'Jumlah',
                        data: Object.values(progressData),
                        backgroundColor: [
                            'rgba(75, 192, 192, 0.7)',
                            'rgba(54, 162, 235, 0.7)',
                            'rgba(255, 205, 86, 0.7)',
                            'rgba(255, 99, 132, 0.7)',
                            'rgba(153, 102, 255, 0.7)'
                        ],
                        borderColor: [
                            'rgba(75, 192, 192, 1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 205, 86, 1)',
                            'rgba(255, 99, 132, 1)',
                            'rgba(153, 102, 255, 1)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            title: {
                                display: true,
                                text: 'Jumlah'
                            }
                        },
                        x: {
                            title: {
                                display: true,
                                text: 'Status Progress'
                            }
                        }
                    }
                }
            });

            // System Load Chart - Data dari database
            const systemCtx = document.getElementById('systemChart').getContext('2d');
            const systemData = @json($data['system_load']);

            new Chart(systemCtx, {
                type: 'line',
                data: {
                    labels: systemData.labels,
                    datasets: [{
                            label: 'User Activity',
                            data: systemData.user_activity,
                            borderColor: 'rgb(255, 99, 132)',
                            backgroundColor: 'rgba(255, 99, 132, 0.1)',
                            fill: true,
                            tension: 0.3
                        },
                        {
                            label: 'Booking Activity',
                            data: systemData.booking_activity,
                            borderColor: 'rgb(54, 162, 235)',
                            backgroundColor: 'rgba(54, 162, 235, 0.1)',
                            fill: true,
                            tension: 0.3
                        },
                        {
                            label: 'Progress Activity',
                            data: systemData.progress_activity,
                            borderColor: 'rgb(75, 192, 192)',
                            backgroundColor: 'rgba(75, 192, 192, 0.1)',
                            fill: true,
                            tension: 0.3
                        }
                    ]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'bottom'
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            title: {
                                display: true,
                                text: 'Activity Count'
                            }
                        },
                        x: {
                            title: {
                                display: true,
                                text: 'Days'
                            }
                        }
                    }
                }
            });

            // Fakultas Distribution Pie Chart
            const fakultasCtx = document.getElementById('fakultasChart').getContext('2d');
            const fakultasData = @json($data['fakultas_distribution']);

            new Chart(fakultasCtx, {
                type: 'pie',
                data: {
                    labels: Object.keys(fakultasData),
                    datasets: [{
                        data: Object.values(fakultasData),
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.8)',
                            'rgba(54, 162, 235, 0.8)',
                            'rgba(255, 205, 86, 0.8)',
                            'rgba(75, 192, 192, 0.8)',
                            'rgba(153, 102, 255, 0.8)',
                            'rgba(255, 159, 64, 0.8)',
                            'rgba(201, 203, 207, 0.8)',
                            'rgba(255, 99, 71, 0.8)'
                        ],
                        borderWidth: 2,
                        borderColor: '#fff'
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'bottom',
                            labels: {
                                padding: 20,
                                usePointStyle: true
                            }
                        },
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    const total = context.dataset.data.reduce((a, b) => a + b, 0);
                                    const percentage = ((context.parsed / total) * 100).toFixed(1);
                                    return context.label + ': ' + context.parsed + ' (' + percentage + '%)';
                                }
                            }
                        }
                    },
                    animation: {
                        animateScale: true,
                        animateRotate: true
                    }
                }
            });

            // Prodi by Fakultas Bar Chart
            const prodiCtx = document.getElementById('prodiChart').getContext('2d');
            const prodiData = @json($data['prodi_by_fakultas']);

            new Chart(prodiCtx, {
                type: 'bar',
                data: {
                    labels: Object.keys(prodiData),
                    datasets: [{
                        label: 'Jumlah Prodi',
                        data: Object.values(prodiData),
                        backgroundColor: 'rgba(54, 162, 235, 0.8)',
                        borderColor: 'rgba(54, 162, 235, 1)',
                        borderWidth: 1,
                        borderRadius: 4,
                        borderSkipped: false,
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            title: {
                                display: true,
                                text: 'Jumlah Prodi'
                            }
                        },
                        x: {
                            title: {
                                display: true,
                                text: 'Fakultas'
                            }
                        }
                    },
                    animation: {
                        duration: 2000,
                        easing: 'easeInOutQuart'
                    }
                }
            });

            // Dosen by Status Doughnut Chart
            const dosenCtx = document.getElementById('dosenChart').getContext('2d');
            const dosenData = @json($data['dosen_by_status']);

            new Chart(dosenCtx, {
                type: 'doughnut',
                data: {
                    labels: Object.keys(dosenData),
                    datasets: [{
                        data: Object.values(dosenData),
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.8)',
                            'rgba(54, 162, 235, 0.8)',
                            'rgba(255, 205, 86, 0.8)',
                            'rgba(75, 192, 192, 0.8)',
                            'rgba(153, 102, 255, 0.8)'
                        ],
                        borderWidth: 2,
                        borderColor: '#fff',
                        hoverBorderWidth: 3
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'bottom'
                        },
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    const total = context.dataset.data.reduce((a, b) => a + b, 0);
                                    const percentage = ((context.parsed / total) * 100).toFixed(1);
                                    return context.label + ': ' + context.parsed + ' (' + percentage + '%)';
                                }
                            }
                        }
                    },
                    cutout: '60%',
                    animation: {
                        animateScale: true,
                        animateRotate: true
                    }
                }
            });

            // MOOC by Fakultas Radar Chart
            const moocCtx = document.getElementById('moocChart').getContext('2d');
            const moocData = @json($data['mooc_by_fakultas']);

            new Chart(moocCtx, {
                type: 'radar',
                data: {
                    labels: Object.keys(moocData),
                    datasets: [{
                        label: 'Jumlah MOOC',
                        data: Object.values(moocData),
                        backgroundColor: 'rgba(255, 99, 132, 0.2)',
                        borderColor: 'rgba(255, 99, 132, 1)',
                        borderWidth: 2,
                        pointBackgroundColor: 'rgba(255, 99, 132, 1)',
                        pointBorderColor: '#fff',
                        pointHoverBackgroundColor: '#fff',
                        pointHoverBorderColor: 'rgba(255, 99, 132, 1)'
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false
                        }
                    },
                    scales: {
                        r: {
                            beginAtZero: true,
                            ticks: {
                                stepSize: 1
                            }
                        }
                    },
                    animation: {
                        duration: 2000
                    }
                }
            });

            // Progress Completion Trend Line Chart
            const progressTrendCtx = document.getElementById('progressTrendChart').getContext('2d');
            const progressTrendData = @json($data['progress_completion_trend']);

            // Prepare data for last 30 days
            const progressDates = Object.keys(progressTrendData);
            const progressValues = Object.values(progressTrendData);

            new Chart(progressTrendCtx, {
                type: 'line',
                data: {
                    labels: progressDates.map(date => new Date(date).toLocaleDateString('id-ID')),
                    datasets: [{
                        label: 'Rata-rata Progress (%)',
                        data: progressValues,
                        borderColor: 'rgba(75, 192, 192, 1)',
                        backgroundColor: 'rgba(75, 192, 192, 0.1)',
                        borderWidth: 3,
                        fill: true,
                        tension: 0.4,
                        pointBackgroundColor: 'rgba(75, 192, 192, 1)',
                        pointBorderColor: '#fff',
                        pointBorderWidth: 2,
                        pointRadius: 4,
                        pointHoverRadius: 6
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false
                        },
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    return 'Progress: ' + context.parsed.y.toFixed(1) + '%';
                                }
                            }
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            max: 100,
                            title: {
                                display: true,
                                text: 'Progress (%)'
                            }
                        },
                        x: {
                            title: {
                                display: true,
                                text: 'Tanggal'
                            }
                        }
                    },
                    animation: {
                        duration: 2000,
                        easing: 'easeInOutQuart'
                    }
                }
            });

            // Activity Logs by Type Bar Chart
            const activityCtx = document.getElementById('activityChart').getContext('2d');
            const activityData = @json($data['activity_logs_by_type']);

            new Chart(activityCtx, {
                type: 'bar',
                data: {
                    labels: Object.keys(activityData),
                    datasets: [{
                        label: 'Jumlah Aktivitas',
                        data: Object.values(activityData),
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.8)',
                            'rgba(54, 162, 235, 0.8)',
                            'rgba(255, 205, 86, 0.8)',
                            'rgba(75, 192, 192, 0.8)',
                            'rgba(153, 102, 255, 0.8)',
                            'rgba(255, 159, 64, 0.8)'
                        ],
                        borderColor: [
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 205, 86, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)',
                            'rgba(255, 159, 64, 1)'
                        ],
                        borderWidth: 1,
                        borderRadius: 4,
                        borderSkipped: false,
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            title: {
                                display: true,
                                text: 'Jumlah Aktivitas'
                            }
                        },
                        x: {
                            title: {
                                display: true,
                                text: 'Tipe Aktivitas'
                            }
                        }
                    },
                    animation: {
                        duration: 1500,
                        easing: 'easeInOutBounce'
                    }
                }
            });

            // Weekly Bookings Trend Area Chart
            const weeklyBookingsCtx = document.getElementById('weeklyBookingsChart').getContext('2d');
            const weeklyBookingsData = @json($data['bookings_trend_weekly']);

            // Generate week labels for last 12 weeks
            const weekLabels = [];
            for (let i = 11; i >= 0; i--) {
                const weekStart = new Date();
                weekStart.setDate(weekStart.getDate() - (i * 7));
                weekLabels.push('Week ' + (52 - i));
            }

            const weeklyValues = Array.from({
                length: 12
            }, (_, i) => weeklyBookingsData[52 - i] || 0);

            new Chart(weeklyBookingsCtx, {
                type: 'line',
                data: {
                    labels: weekLabels,
                    datasets: [{
                        label: 'Weekly Bookings',
                        data: weeklyValues,
                        borderColor: 'rgba(153, 102, 255, 1)',
                        backgroundColor: 'rgba(153, 102, 255, 0.1)',
                        borderWidth: 3,
                        fill: true,
                        tension: 0.4,
                        pointBackgroundColor: 'rgba(153, 102, 255, 1)',
                        pointBorderColor: '#fff',
                        pointBorderWidth: 2,
                        pointRadius: 4,
                        pointHoverRadius: 6
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            title: {
                                display: true,
                                text: 'Jumlah Booking'
                            }
                        },
                        x: {
                            title: {
                                display: true,
                                text: 'Minggu'
                            }
                        }
                    },
                    animation: {
                        duration: 2000,
                        easing: 'easeInOutQuart'
                    }
                }
            });

            // Studio Utilization Horizontal Bar Chart
            const studioCtx = document.getElementById('studioChart').getContext('2d');
            const studioData = @json($data['studio_utilization']);

            new Chart(studioCtx, {
                type: 'bar',
                data: {
                    labels: Object.keys(studioData),
                    datasets: [{
                        label: 'Total Bookings',
                        data: Object.values(studioData),
                        backgroundColor: 'rgba(255, 159, 64, 0.8)',
                        borderColor: 'rgba(255, 159, 64, 1)',
                        borderWidth: 1,
                        borderRadius: 4,
                        borderSkipped: false,
                    }]
                },
                options: {
                    indexAxis: 'y',
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false
                        }
                    },
                    scales: {
                        x: {
                            beginAtZero: true,
                            title: {
                                display: true,
                                text: 'Jumlah Booking'
                            }
                        },
                        y: {
                            title: {
                                display: true,
                                text: 'Studio'
                            }
                        }
                    },
                    animation: {
                        duration: 1500,
                        easing: 'easeInOutBounce'
                    }
                }
            });

            // Editor Performance Radar Chart
            const editorCtx = document.getElementById('editorChart').getContext('2d');
            const editorData = @json($data['editor_performance']);

            new Chart(editorCtx, {
                type: 'radar',
                data: {
                    labels: Object.keys(editorData),
                    datasets: [{
                        label: 'Jumlah Progress',
                        data: Object.values(editorData),
                        backgroundColor: 'rgba(255, 205, 86, 0.2)',
                        borderColor: 'rgba(255, 205, 86, 1)',
                        borderWidth: 2,
                        pointBackgroundColor: 'rgba(255, 205, 86, 1)',
                        pointBorderColor: '#fff',
                        pointHoverBackgroundColor: '#fff',
                        pointHoverBorderColor: 'rgba(255, 205, 86, 1)'
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false
                        }
                    },
                    scales: {
                        r: {
                            beginAtZero: true,
                            ticks: {
                                stepSize: 1
                            }
                        }
                    },
                    animation: {
                        duration: 2000
                    }
                }
            });

            // Monthly Growth Multi-Line Chart
            const growthCtx = document.getElementById('growthChart').getContext('2d');
            const growthData = @json($data['monthly_growth']);

            const monthLabels = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];

            new Chart(growthCtx, {
                type: 'line',
                data: {
                    labels: monthLabels,
                    datasets: [{
                            label: 'Users',
                            data: monthLabels.map((_, i) => growthData.users[i + 1] || 0),
                            borderColor: 'rgba(255, 99, 132, 1)',
                            backgroundColor: 'rgba(255, 99, 132, 0.1)',
                            borderWidth: 3,
                            fill: false,
                            tension: 0.4,
                            pointBackgroundColor: 'rgba(255, 99, 132, 1)',
                            pointBorderColor: '#fff',
                            pointBorderWidth: 2,
                            pointRadius: 5,
                            pointHoverRadius: 7
                        },
                        {
                            label: 'Bookings',
                            data: monthLabels.map((_, i) => growthData.bookings[i + 1] || 0),
                            borderColor: 'rgba(54, 162, 235, 1)',
                            backgroundColor: 'rgba(54, 162, 235, 0.1)',
                            borderWidth: 3,
                            fill: false,
                            tension: 0.4,
                            pointBackgroundColor: 'rgba(54, 162, 235, 1)',
                            pointBorderColor: '#fff',
                            pointBorderWidth: 2,
                            pointRadius: 5,
                            pointHoverRadius: 7
                        },
                        {
                            label: 'Progress',
                            data: monthLabels.map((_, i) => growthData.progress[i + 1] || 0),
                            borderColor: 'rgba(75, 192, 192, 1)',
                            backgroundColor: 'rgba(75, 192, 192, 0.1)',
                            borderWidth: 3,
                            fill: false,
                            tension: 0.4,
                            pointBackgroundColor: 'rgba(75, 192, 192, 1)',
                            pointBorderColor: '#fff',
                            pointBorderWidth: 2,
                            pointRadius: 5,
                            pointHoverRadius: 7
                        }
                    ]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'top'
                        },
                        tooltip: {
                            mode: 'index',
                            intersect: false
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            title: {
                                display: true,
                                text: 'Jumlah'
                            }
                        },
                        x: {
                            title: {
                                display: true,
                                text: 'Bulan'
                            }
                        }
                    },
                    animation: {
                        duration: 2500,
                        easing: 'easeInOutQuart'
                    },
                    interaction: {
                        mode: 'nearest',
                        axis: 'x',
                        intersect: false
                    }
                }
            });
        });
    </script>

</main>

@include('layout.footer')