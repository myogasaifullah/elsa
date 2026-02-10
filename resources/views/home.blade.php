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
$prodiPerFakultas = $data['chart_data']['real_data']['prodi_per_fakultas'];
$moocPerKategori = $data['chart_data']['real_data']['mooc_per_kategori'];
$progressPerStatus = $data['chart_data']['real_data']['progress_per_status'];
$bookingsByStatus = $data['chart_data']['real_data']['bookings_by_status'];
$mataKuliahPerFakultas = $data['chart_data']['real_data']['mata_kuliah_per_fakultas'];
$dosenPerFakultas = $data['chart_data']['real_data']['dosen_per_fakultas'];
$studiosByLocation = $data['chart_data']['real_data']['studios_by_location'];
$editorPerformance = $data['chart_data']['real_data']['editor_performance'] ?? [];
$editorCompletionRate = $data['chart_data']['real_data']['editor_completion_rate'] ?? [];
$editorWorkload = $data['chart_data']['real_data']['editor_workload'] ?? [];
$editorEfficiency = $data['chart_data']['real_data']['editor_efficiency'] ?? [];
$editorProgressDistribution = $data['chart_data']['real_data']['editor_progress_distribution'] ?? [];
$editorActivityTimeline = $data['chart_data']['real_data']['editor_activity_timeline'] ?? [];
$editorQualityScore = $data['chart_data']['real_data']['editor_quality_score'] ?? [];
$editorCompletionTrend = $data['chart_data']['real_data']['editor_completion_trend'] ?? [];

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

            <!-- Prodi per Fakultas Chart -->
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Prodi per Fakultas</h5>
                        <canvas id="prodiFakultasChart" style="max-height: 300px;"></canvas>
                    </div>
                </div>
            </div>

            <!-- Mooc per Judul Chart -->
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Mooc per Judul</h5>
                        <canvas id="moocKategoriChart" style="max-height: 300px;"></canvas>
                    </div>
                </div>
            </div>

            <!-- Progress per Status Chart -->
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Progress per Status</h5>
                        <canvas id="progressStatusChart" style="max-height: 300px;"></canvas>
                    </div>
                </div>
            </div>

            <!-- Bookings by Status Chart -->
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Bookings by Status</h5>
                        <canvas id="bookingsStatusChart" style="max-height: 300px;"></canvas>
                    </div>
                </div>
            </div>

            <!-- Mata Kuliah per Fakultas Chart -->
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Mata Kuliah per Fakultas</h5>
                        <canvas id="mataKuliahFakultasChart" style="max-height: 300px;"></canvas>
                    </div>
                </div>
            </div>

            <!-- Dosen per Fakultas Chart -->
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Dosen per Fakultas</h5>
                        <canvas id="dosenFakultasChart" style="max-height: 300px;"></canvas>
                    </div>
                </div>
            </div>

            <!-- Studios by Location Chart -->
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Studios by Location</h5>
                        <canvas id="studiosLocationChart" style="max-height: 300px;"></canvas>
                    </div>
                </div>
            </div>

            <!-- Editor Performance Chart -->
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Editor Performance</h5>
                        <canvas id="editorPerformanceChart" style="max-height: 300px;"></canvas>
                    </div>
                </div>
            </div>

            <!-- Editor Completion Rate Chart -->
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Editor Completion Rate</h5>
                        <canvas id="editorCompletionChart" style="max-height: 300px;"></canvas>
                    </div>
                </div>
            </div>

            <!-- Editor Workload Chart -->
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Editor Workload Distribution</h5>
                        <canvas id="editorWorkloadChart" style="max-height: 300px;"></canvas>
                    </div>
                </div>
            </div>

            <!-- Editor Efficiency Chart -->
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Editor Efficiency (Tasks/Day)</h5>
                        <canvas id="editorEfficiencyChart" style="max-height: 300px;"></canvas>
                    </div>
                </div>
            </div>

            <!-- Editor Quality Score Chart -->
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Editor Quality Score</h5>
                        <canvas id="editorQualityChart" style="max-height: 300px;"></canvas>
                    </div>
                </div>
            </div>

            <!-- Editor Activity Timeline Chart -->
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Editor Activity Timeline</h5>
                        <canvas id="editorActivityTimelineChart" style="max-height: 300px;"></canvas>
                    </div>
                </div>
            </div>

            <!-- Editor Progress Distribution Chart -->
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Editor Progress Distribution</h5>
                        <canvas id="editorProgressDistChart" style="max-height: 400px;"></canvas>
                    </div>
                </div>
            </div>

            <!-- Editor Completion Trend Chart -->
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Editor Completion Trend (Last 30 Days)</h5>
                        <canvas id="editorTrendChart" style="max-height: 400px;"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Include the home data tables -->

</main>

@include('layout.footer')

<style>
    /* Indikator gambar aktif */
    .gambar-indicator {
        display: flex;
        justify-content: center;
        margin-top: 10px;
        gap: 5px;
    }

    .gambar-indicator .indicator-dot {
        width: 10px;
        height: 10px;
        border-radius: 50%;
        background-color: #6c757d;
        cursor: pointer;
        transition: background-color 0.3s;
    }

    .gambar-indicator .indicator-dot.active {
        background-color: #0d6efd;
    }
</style>

<script>
    document.addEventListener("DOMContentLoaded", () => {
        // Convert PHP arrays to JavaScript
        const bookingsByMonth = JSON.parse('{!! json_encode($bookingsByMonth) !!}');
        const usersByRole = JSON.parse('{!! json_encode($usersByRole) !!}');
        const progressByPersentase = JSON.parse('{!! json_encode($progressByPersentase) !!}');
        const dosensByStatus = JSON.parse('{!! json_encode($dosensByStatus) !!}');
        const activityByDay = JSON.parse('{!! json_encode($activityByDay) !!}');
        const prodiPerFakultas = JSON.parse('{!! json_encode($prodiPerFakultas) !!}');
        const moocPerKategori = JSON.parse('{!! json_encode($moocPerKategori) !!}');
        const progressPerStatus = JSON.parse('{!! json_encode($progressPerStatus) !!}');
        const bookingsByStatus = JSON.parse('{!! json_encode($bookingsByStatus) !!}');
        const mataKuliahPerFakultas = JSON.parse('{!! json_encode($mataKuliahPerFakultas) !!}');
        const dosenPerFakultas = JSON.parse('{!! json_encode($dosenPerFakultas) !!}');
        const studiosByLocation = JSON.parse('{!! json_encode($studiosByLocation) !!}');
        const editorPerformance = JSON.parse('{!! json_encode($editorPerformance) !!}');
        const editorCompletionRate = JSON.parse('{!! json_encode($editorCompletionRate) !!}');
        const editorWorkload = JSON.parse('{!! json_encode($editorWorkload) !!}');
        const editorEfficiency = JSON.parse('{!! json_encode($editorEfficiency) !!}');
        const editorProgressDistribution = JSON.parse('{!! json_encode($editorProgressDistribution) !!}');
        const editorActivityTimeline = JSON.parse('{!! json_encode($editorActivityTimeline) !!}');
        const editorQualityScore = JSON.parse('{!! json_encode($editorQualityScore) !!}');
        const editorCompletionTrend = JSON.parse('{!! json_encode($editorCompletionTrend) !!}');
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

        // Prodi per Fakultas Chart
        const prodiFakultasCtx = document.getElementById('prodiFakultasChart').getContext('2d');
        const prodiFakultasLabels = Object.keys(prodiPerFakultas);
        const prodiFakultasData = Object.values(prodiPerFakultas);

        new Chart(prodiFakultasCtx, {
            type: 'bar',
            data: {
                labels: prodiFakultasLabels,
                datasets: [{
                    label: 'Number of Prodi',
                    data: prodiFakultasData,
                    backgroundColor: 'rgba(255, 159, 64, 0.8)',
                    borderColor: 'rgba(255, 159, 64, 1)',
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
                            text: 'Number of Prodi'
                        }
                    },
                    x: {
                        title: {
                            display: true,
                            text: 'Fakultas'
                        }
                    }
                }
            }
        });

        // Mooc Count Chart
        const moocKategoriCtx = document.getElementById('moocKategoriChart').getContext('2d');

        new Chart(moocKategoriCtx, {
            type: 'bar',
            data: {
                labels: ['Total MOOC'],
                datasets: [{
                    label: 'Number of MOOC',
                    data: [moocPerKategori],
                    backgroundColor: 'rgba(255, 159, 64, 0.8)',
                    borderColor: 'rgba(255, 159, 64, 1)',
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
                            text: 'Number of MOOC'
                        }
                    }
                }
            }
        });

        // Progress per Status Chart
        const progressStatusCtx = document.getElementById('progressStatusChart').getContext('2d');
        const progressStatusLabels = Object.keys(progressPerStatus);
        const progressStatusData = Object.values(progressPerStatus);

        new Chart(progressStatusCtx, {
            type: 'doughnut',
            data: {
                labels: progressStatusLabels,
                datasets: [{
                    data: progressStatusData,
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.8)',
                        'rgba(54, 162, 235, 0.8)',
                        'rgba(255, 205, 86, 0.8)',
                        'rgba(75, 192, 192, 0.8)',
                        'rgba(153, 102, 255, 0.8)',
                        'rgba(255, 159, 64, 0.8)',
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

        // Bookings by Status Chart
        const bookingsStatusCtx = document.getElementById('bookingsStatusChart').getContext('2d');
        const bookingsStatusLabels = Object.keys(bookingsByStatus);
        const bookingsStatusData = Object.values(bookingsByStatus);

        new Chart(bookingsStatusCtx, {
            type: 'bar',
            data: {
                labels: bookingsStatusLabels,
                datasets: [{
                    label: 'Number of Bookings',
                    data: bookingsStatusData,
                    backgroundColor: 'rgba(153, 102, 255, 0.8)',
                    borderColor: 'rgba(153, 102, 255, 1)',
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
                            text: 'Status'
                        }
                    }
                }
            }
        });

        // Mata Kuliah per Fakultas Chart
        const mataKuliahFakultasCtx = document.getElementById('mataKuliahFakultasChart').getContext('2d');
        const mataKuliahFakultasLabels = Object.keys(mataKuliahPerFakultas);
        const mataKuliahFakultasData = Object.values(mataKuliahPerFakultas);

        new Chart(mataKuliahFakultasCtx, {
            type: 'bar',
            data: {
                labels: mataKuliahFakultasLabels,
                datasets: [{
                    label: 'Number of Mata Kuliah',
                    data: mataKuliahFakultasData,
                    backgroundColor: 'rgba(75, 192, 192, 0.8)',
                    borderColor: 'rgba(75, 192, 192, 1)',
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
                            text: 'Number of Mata Kuliah'
                        }
                    },
                    x: {
                        title: {
                            display: true,
                            text: 'Fakultas'
                        }
                    }
                }
            }
        });

        // Dosen per Fakultas Chart
        const dosenFakultasCtx = document.getElementById('dosenFakultasChart').getContext('2d');
        const dosenFakultasLabels = Object.keys(dosenPerFakultas);
        const dosenFakultasData = Object.values(dosenPerFakultas);

        new Chart(dosenFakultasCtx, {
            type: 'bar',
            data: {
                labels: dosenFakultasLabels,
                datasets: [{
                    label: 'Number of Dosen',
                    data: dosenFakultasData,
                    backgroundColor: 'rgba(255, 205, 86, 0.8)',
                    borderColor: 'rgba(255, 205, 86, 1)',
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
                            text: 'Number of Dosen'
                        }
                    },
                    x: {
                        title: {
                            display: true,
                            text: 'Fakultas'
                        }
                    }
                }
            }
        });

        // Studios by Location Chart
        const studiosLocationCtx = document.getElementById('studiosLocationChart').getContext('2d');
        const studiosLocationLabels = Object.keys(studiosByLocation);
        const studiosLocationData = Object.values(studiosByLocation);

        new Chart(studiosLocationCtx, {
            type: 'bar',
            data: {
                labels: studiosLocationLabels,
                datasets: [{
                    label: 'Number of Studios',
                    data: studiosLocationData,
                    backgroundColor: 'rgba(201, 203, 207, 0.8)',
                    borderColor: 'rgba(201, 203, 207, 1)',
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
                            text: 'Number of Studios'
                        }
                    },
                    x: {
                        title: {
                            display: true,
                            text: 'Location'
                        }
                    }
                }
            }
        });

        // Editor Performance Chart
        const editorPerformanceCtx = document.getElementById('editorPerformanceChart').getContext('2d');
        const editorPerformanceLabels = Object.keys(editorPerformance);
        const editorPerformanceData = Object.values(editorPerformance);

        new Chart(editorPerformanceCtx, {
            type: 'bar',
            data: {
                labels: editorPerformanceLabels,
                datasets: [{
                    label: 'Average Progress (%)',
                    data: editorPerformanceData,
                    backgroundColor: 'rgba(255, 99, 132, 0.8)',
                    borderColor: 'rgba(255, 99, 132, 1)',
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
                            text: 'Average Progress (%)'
                        }
                    },
                    x: {
                        title: {
                            display: true,
                            text: 'Editor'
                        }
                    }
                }
            }
        });

        // Editor Completion Rate Chart
        const editorCompletionCtx = document.getElementById('editorCompletionChart').getContext('2d');
        const editorCompletionLabels = Object.keys(editorCompletionRate);
        const editorCompletionData = Object.values(editorCompletionRate);

        new Chart(editorCompletionCtx, {
            type: 'bar',
            data: {
                labels: editorCompletionLabels,
                datasets: [{
                    label: 'Completion Rate (%)',
                    data: editorCompletionData,
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
                        max: 100,
                        title: {
                            display: true,
                            text: 'Completion Rate (%)'
                        }
                    },
                    x: {
                        title: {
                            display: true,
                            text: 'Editor'
                        }
                    }
                }
            }
        });

        // Editor Workload Chart
        const editorWorkloadCtx = document.getElementById('editorWorkloadChart').getContext('2d');
        const editorWorkloadLabels = Object.keys(editorWorkload);
        const editorWorkloadData = Object.values(editorWorkload);

        new Chart(editorWorkloadCtx, {
            type: 'bar',
            data: {
                labels: editorWorkloadLabels,
                datasets: [{
                    label: 'Total Tasks Assigned',
                    data: editorWorkloadData,
                    backgroundColor: 'rgba(255, 159, 64, 0.8)',
                    borderColor: 'rgba(255, 159, 64, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                indexAxis: 'y',
                responsive: true,
                scales: {
                    x: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Number of Tasks'
                        }
                    },
                    y: {
                        title: {
                            display: true,
                            text: 'Editor'
                        }
                    }
                }
            }
        });

        // Editor Efficiency Chart
        const editorEfficiencyCtx = document.getElementById('editorEfficiencyChart').getContext('2d');
        const editorEfficiencyLabels = Object.keys(editorEfficiency);
        const editorEfficiencyData = Object.values(editorEfficiency);

        new Chart(editorEfficiencyCtx, {
            type: 'radar',
            data: {
                labels: editorEfficiencyLabels,
                datasets: [{
                    label: 'Tasks per Day (Last 30 Days)',
                    data: editorEfficiencyData,
                    backgroundColor: 'rgba(153, 102, 255, 0.2)',
                    borderColor: 'rgba(153, 102, 255, 1)',
                    borderWidth: 2,
                    pointBackgroundColor: 'rgba(153, 102, 255, 1)',
                    pointBorderColor: '#fff',
                    pointHoverBackgroundColor: '#fff',
                    pointHoverBorderColor: 'rgba(153, 102, 255, 1)'
                }]
            },
            options: {
                responsive: true,
                scales: {
                    r: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Tasks/Day'
                        }
                    }
                }
            }
        });

        // Editor Quality Score Chart
        const editorQualityCtx = document.getElementById('editorQualityChart').getContext('2d');
        const editorQualityLabels = Object.keys(editorQualityScore);
        const editorQualityData = Object.values(editorQualityScore);

        new Chart(editorQualityCtx, {
            type: 'polarArea',
            data: {
                labels: editorQualityLabels,
                datasets: [{
                    label: 'Quality Score',
                    data: editorQualityData,
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.8)',
                        'rgba(54, 162, 235, 0.8)',
                        'rgba(255, 205, 86, 0.8)',
                        'rgba(75, 192, 192, 0.8)',
                        'rgba(153, 102, 255, 0.8)',
                        'rgba(255, 159, 64, 0.8)'
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
                },
                scales: {
                    r: {
                        beginAtZero: true
                    }
                }
            }
        });

        // Editor Activity Timeline Chart
        const editorActivityTimelineCtx = document.getElementById('editorActivityTimelineChart').getContext('2d');
        const editorActivityLabels = Object.keys(editorActivityTimeline).map(date => {
            return new Date(date).toLocaleDateString('id-ID', {
                weekday: 'short',
                day: 'numeric',
                month: 'short'
            });
        });
        const editorActivityData = Object.values(editorActivityTimeline);

        new Chart(editorActivityTimelineCtx, {
            type: 'line',
            data: {
                labels: editorActivityLabels,
                datasets: [{
                    label: 'Editor Activities',
                    data: editorActivityData,
                    fill: false,
                    borderColor: 'rgb(255, 159, 64)',
                    tension: 0.1,
                    pointBackgroundColor: 'rgb(255, 159, 64)',
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

        // Editor Progress Distribution Chart
        const editorProgressDistCtx = document.getElementById('editorProgressDistChart').getContext('2d');
        const editorProgressLabels = Object.keys(editorProgressDistribution);
        const datasets = [];

        // Create datasets for each progress status
        const statusColors = {
            not_started: 'rgba(255, 99, 132, 0.8)',
            in_progress: 'rgba(255, 205, 86, 0.8)',
            completed: 'rgba(75, 192, 192, 0.8)'
        };

        const statusLabels = {
            not_started: 'Not Started',
            in_progress: 'In Progress',
            completed: 'Completed'
        };

        Object.keys(statusColors).forEach(status => {
            const data = editorProgressLabels.map(editor => editorProgressDistribution[editor][status] || 0);
            datasets.push({
                label: statusLabels[status],
                data: data,
                backgroundColor: statusColors[status],
                borderColor: statusColors[status].replace('0.8', '1'),
                borderWidth: 1
            });
        });

        new Chart(editorProgressDistCtx, {
            type: 'bar',
            data: {
                labels: editorProgressLabels,
                datasets: datasets
            },
            options: {
                responsive: true,
                scales: {
                    x: {
                        stacked: true,
                        title: {
                            display: true,
                            text: 'Editor'
                        }
                    },
                    y: {
                        stacked: true,
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Number of Tasks'
                        }
                    }
                },
                plugins: {
                    legend: {
                        position: 'top'
                    }
                }
            }
        });

        // Editor Completion Trend Chart
        const editorTrendCtx = document.getElementById('editorTrendChart').getContext('2d');
        const trendDatasets = [];
        const allDates = new Set();

        // Collect all dates from the array structure
        Object.values(editorCompletionTrend).forEach(editorData => {
            editorData.forEach(entry => {
                allDates.add(entry.activity_date);
            });
        });

        const sortedDates = Array.from(allDates).sort();

        // Create datasets for each editor
        const editorColors = [
            'rgba(255, 99, 132, 1)',
            'rgba(54, 162, 235, 1)',
            'rgba(255, 205, 86, 1)',
            'rgba(75, 192, 192, 1)',
            'rgba(153, 102, 255, 1)',
            'rgba(255, 159, 64, 1)'
        ];

        let colorIndex = 0;
        Object.keys(editorCompletionTrend).forEach(editor => {
            // Create a map of date to completed tasks for this editor
            const dateMap = {};
            editorCompletionTrend[editor].forEach(entry => {
                dateMap[entry.activity_date] = entry.completed_tasks;
            });

            const data = sortedDates.map(date => dateMap[date] || 0);
            trendDatasets.push({
                label: editor,
                data: data,
                borderColor: editorColors[colorIndex % editorColors.length],
                backgroundColor: editorColors[colorIndex % editorColors.length].replace('1)', '0.1)'),
                borderWidth: 2,
                fill: false,
                tension: 0.4,
                pointBackgroundColor: editorColors[colorIndex % editorColors.length],
                pointBorderColor: '#fff',
                pointRadius: 4,
                pointHoverRadius: 6
            });
            colorIndex++;
        });

        new Chart(editorTrendCtx, {
            type: 'line',
            data: {
                labels: sortedDates,
                datasets: trendDatasets
            },
            options: {
                responsive: true,
                scales: {
                    x: {
                        title: {
                            display: true,
                            text: 'Date'
                        }
                    },
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Completed Tasks'
                        }
                    }
                },
                plugins: {
                    legend: {
                        position: 'top'
                    }
                }
            }
        });
    });
</script>