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
                                                <td>{{ $user->created_at->format('d/m/Y') }}</td>
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
                                                <th>Booking</th>
                                                <th>Dosen</th>
                                                <th>Date</th>
                                                <th>Time</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($data['recent_jadwal'] as $jadwal)
                                            <tr>
                                                <td>{{ $jadwal->id ?? 'N/A' }}</td>
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
                                                <th>Jadwal</th>
                                                <th>Editor</th>
                                                <th>Status</th>
                                                <th>Progress</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($data['recent_progress'] as $progress)
                                            <tr>
                                                <td>{{ $progress->jadwalBooking->id ?? 'N/A' }}</td>
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
            const allMonths = Array.from({length: 12}, (_, i) => i + 1);
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
                    datasets: [
                        {
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
        });
    </script>

</main>

@include('layout.footer')