@extends('layout.header')

@section('title', 'Home - Semua Data')

@php
// Process traffic data for the chart
$trafficData = [];
foreach($data['chart_data']['traffic_data'] as $name => $value) {
    $trafficData[] = [
        'value' => $value,
        'name' => $name
    ];
}

// Prepare real data for charts
$bookingsByMonth = $data['chart_data']['real_data']['bookings_by_month'];
$usersByRole = $data['chart_data']['real_data']['users_by_role'];
$progressByPersentase = $data['chart_data']['real_data']['progress_by_persentase'];
$dosensByStatus = $data['chart_data']['real_data']['dosens_by_status'];
$activityByDay = $data['chart_data']['real_data']['activity_by_day'];

// Month names for bookings chart
$monthNames = [
    1 => 'Jan', 2 => 'Feb', 3 => 'Mar', 4 => 'Apr', 5 => 'May', 6 => 'Jun',
    7 => 'Jul', 8 => 'Aug', 9 => 'Sep', 10 => 'Oct', 11 => 'Nov', 12 => 'Dec'
];
@endphp

@include('layout.sidebar')

<main id="main" class="main">
    <div class="pagetitle">
        <h1>Semua Data Sistem</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                <li class="breadcrumb-item active">Semua Data</li>
            </ol>
        </nav>
    </div>

    <section class="section">
        @include('home.home')

        <!-- Charts Section -->
        <div class="row">
            <!-- Bookings by Month Chart -->
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Bookings by Month</h5>
                        <canvas id="bookingsChart" style="max-height: 300px;"></canvas>
                    </div>
                </div>
            </div>

            
            <!-- Users by Role Chart -->
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Users by Role</h5>
                        <canvas id="usersRoleChart" style="max-height: 300px;"></canvas>
                    </div>
                </div>
            </div>

            <!-- Progress Distribution Chart -->
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Progress Distribution</h5>
                        <canvas id="progressChart" style="max-height: 300px;"></canvas>
                    </div>
                </div>
            </div>

            <!-- Dosen Status Chart -->
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Dosen Status</h5>
                        <canvas id="dosenStatusChart" style="max-height: 300px;"></canvas>
                    </div>
                </div>
            </div>

            <!-- Recent Activity Chart -->
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Recent Activity (Last 7 Days)</h5>
                        <canvas id="activityChart" style="max-height: 300px;"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Include the home data tables -->
    
</main>

@include('layout.footer')

<script>
document.addEventListener("DOMContentLoaded", () => {
    // Convert PHP arrays to JavaScript
    const bookingsByMonth = JSON.parse('{!! json_encode($bookingsByMonth) !!}');
    const usersByRole = JSON.parse('{!! json_encode($usersByRole) !!}');
    const progressByPersentase = JSON.parse('{!! json_encode($progressByPersentase) !!}');
    const dosensByStatus = JSON.parse('{!! json_encode($dosensByStatus) !!}');
    const activityByDay = JSON.parse('{!! json_encode($activityByDay) !!}');
    const monthNames = JSON.parse('{!! json_encode($monthNames) !!}');

    // Bookings by Month Chart
    const bookingsCtx = document.getElementById('bookingsChart').getContext('2d');
    const bookingsLabels = [];
    const bookingsData = [];

    // Prepare bookings data with all months
    for (let month = 1; month <= 12; month++) {
        bookingsLabels.push(monthNames[month]);
        bookingsData.push(bookingsByMonth[month] || 0);
    }

    new Chart(bookingsCtx, {
        type: 'bar',
        data: {
            labels: bookingsLabels,
            datasets: [{
                label: 'Bookings',
                data: bookingsData,
                backgroundColor: 'rgba(54, 162, 235, 0.8)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: 'Number of Bookings'
                    }
                },
                x: {
                    title: {
                        display: true,
                        text: 'Month'
                    }
                }
            }
        }
    });

    // Users by Role Chart
    const usersRoleCtx = document.getElementById('usersRoleChart').getContext('2d');
    const usersRoleLabels = Object.keys(usersByRole);
    const usersRoleData = Object.values(usersByRole);

    new Chart(usersRoleCtx, {
        type: 'pie',
        data: {
            labels: usersRoleLabels,
            datasets: [{
                data: usersRoleData,
                backgroundColor: [
                    'rgba(255, 99, 132, 0.8)',
                    'rgba(54, 162, 235, 0.8)',
                    'rgba(255, 205, 86, 0.8)',
                    'rgba(75, 192, 192, 0.8)',
                    'rgba(153, 102, 255, 0.8)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'right'
                }
            }
        }
    });

    // Progress Distribution Chart
    const progressCtx = document.getElementById('progressChart').getContext('2d');
    const progressLabels = Object.keys(progressByPersentase);
    const progressData = Object.values(progressByPersentase);

    new Chart(progressCtx, {
        type: 'doughnut',
        data: {
            labels: progressLabels,
            datasets: [{
                data: progressData,
                backgroundColor: [
                    'rgba(255, 99, 132, 0.8)',
                    'rgba(54, 162, 235, 0.8)',
                    'rgba(255, 205, 86, 0.8)',
                    'rgba(75, 192, 192, 0.8)',
                    'rgba(153, 102, 255, 0.8)',
                    'rgba(201, 203, 207, 0.8)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'right'
                }
            }
        }
    });

    // Dosen Status Chart
    const dosenStatusCtx = document.getElementById('dosenStatusChart').getContext('2d');
    const dosenStatusLabels = Object.keys(dosensByStatus);
    const dosenStatusData = Object.values(dosensByStatus);

    new Chart(dosenStatusCtx, {
        type: 'pie',
        data: {
            labels: dosenStatusLabels,
            datasets: [{
                data: dosenStatusData,
                backgroundColor: [
                    'rgba(75, 192, 192, 0.8)',
                    'rgba(54, 162, 235, 0.8)',
                    'rgba(255, 205, 86, 0.8)',
                    'rgba(255, 99, 132, 0.8)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'right'
                }
            }
        }
    });

    // Recent Activity Chart
    const activityCtx = document.getElementById('activityChart').getContext('2d');
    const activityLabels = Object.keys(activityByDay).map(date => {
        return new Date(date).toLocaleDateString('id-ID', { 
            weekday: 'short', 
            day: 'numeric', 
            month: 'short' 
        });
    });
    const activityData = Object.values(activityByDay);

    new Chart(activityCtx, {
        type: 'line',
        data: {
            labels: activityLabels,
            datasets: [{
                label: 'Activities',
                data: activityData,
                fill: false,
                borderColor: 'rgb(75, 192, 192)',
                tension: 0.1,
                pointBackgroundColor: 'rgb(75, 192, 192)',
                pointBorderColor: '#fff',
                pointRadius: 5,
                pointHoverRadius: 7
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: 'Number of Activities'
                    }
                },
                x: {
                    title: {
                        display: true,
                        text: 'Date'
                    }
                }
            }
        }
    });
});
</script>
