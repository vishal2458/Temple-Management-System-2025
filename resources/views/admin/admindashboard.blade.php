
@extends('layouts.main')

@section('title', 'Dashboard')

@section('main-content')
    <section class="section">
        <!-- Header with Welcome Message -->
        <div class="section-header">
            <h1>Dashboard</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active">Welcome back, {{ Auth::user()->name }}!</div>
            </div>
        </div>

        <!-- Card Widgets -->
        <div class="row">
            <!-- Total Temples Card -->
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <a href="{{ route('admin.temples') }}">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-primary">
                            <i class="fas fa-gopuram"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Total Temples</h4>
                            </div>
                            <div class="card-body">
                                {{ $totalTemples }}
                            </div>
                        </div>
                    </div>
                </a>
            </div>

            <!-- Total Donations Card -->
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <a href="{{ route('admin.donations.index') }}">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-danger">
                            <i class="fas fa-rupee-sign"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Total Donations</h4>
                            </div>
                            <div class="card-body">
                                {{ '₹ ' . number_format($totalDonations, 2) }}
                            </div>
                        </div>
                    </div>
                </a>
            </div>

            <!-- Total Bookings Card -->
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <a href="{{ route('admin.bookings.index') }}">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-warning">
                            <i class="fas fa-calendar-check"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Total Bookings</h4>
                            </div>
                            <div class="card-body">
                                {{ $totalBookings }}
                            </div>
                        </div>
                    </div>
                </a>
            </div>

            <!-- Total Users Card -->
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                {{-- <a href="{{ route('admin.users.index') }}"> --}}
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-success">
                            <i class="fas fa-users"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Total Users</h4>
                            </div>
                            <div class="card-body">
                                {{ $totaluser }}
                            </div>
                        </div>
                    </div>
                {{-- </a> --}}
            </div>
        </div>

        <!-- Donations Chart -->
        <div class="row">
            <div class="col-12">
                <div class="card shadow-lg border-0">
                    <div class="card-header bg-primary text-white">
                        <h4 class="mb-0">📊 Monthly Donations Overview</h4>
                    </div>
                    <div class="card-body">
                        <canvas id="donationsChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Bookings Table -->
        @if (count($recentBookings) > 0 || count($recentdonations) > 0)
            <div class="row">
                @if (count($recentBookings) > 0)
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>Recent 5 Bookings</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th><i class="fas fa-user"></i> User</th>
                                                <th><i class="fas fa-synagogue"></i> Temple Name</th>
                                                <th><i class="fas fa-calendar-alt"></i> Darshan Date</th>
                                                <th><i class="fas fa-id-card"></i> Booking ID</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($recentBookings as $booking)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $booking->user->name }}</td>
                                                    <td>{{ $booking->temple->name }}</td>
                                                    <td>{{ $booking->booking_date }}</td>
                                                    <td>{{ $booking->booking_id }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
                @if (count($recentdonations) > 0)
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>Recent 5 Donations</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th><i class="fas fa-user"></i> User</th>
                                                <th><i class="fas fa-synagogue"></i> Temple Name</th>
                                                <th><i class="fas fa-rupee-sign"></i> Amount</th>
                                                <th><i class="fas fa-calendar-alt"></i> Donation Date</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($recentdonations as $donation)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ optional($donation->user)->name ?? 'Anonymous' }}</td>
                                                    <td>{{ $donation->temple->name }}</td>
                                                    <td><i class="fas fa-rupee-sign"></i> {{ $donation->amount }}</td>
                                                    <td>{{ $donation->donation_date }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        @endif
    </section>

    <!-- Chart.js Script -->
    @endsection
    @push('script')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const ctx = document.getElementById('donationsChart').getContext('2d');

            const gradient = ctx.createLinearGradient(0, 0, 0, 400);
            gradient.addColorStop(0, 'rgba(54, 162, 235, 0.8)'); // Darker at top
            gradient.addColorStop(1, 'rgba(54, 162, 235, 0.2)'); // Lighter at bottom

            const donationsChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                    datasets: [{
                        label: 'Total Donations (₹)',
                        data: @json($donationsData),
                        backgroundColor: gradient, // Apply gradient
                        borderColor: 'rgba(54, 162, 235, 1)',
                        borderWidth: 2,
                        borderRadius: 10, // Rounded edges for bars
                        barThickness: 30
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false // Hide legend for cleaner look
                        },
                        tooltip: {
                            backgroundColor: 'rgba(0,0,0,0.8)',
                            titleColor: '#fff',
                            bodyColor: '#fff',
                            bodyFont: {
                                weight: 'bold'
                            }
                        }
                    },
                    scales: {
                        x: {
                            grid: {
                                display: false
                            }
                        },
                        y: {
                            beginAtZero: true,
                            grid: {
                                color: 'rgba(0, 0, 0, 0.1)' // Soft grid lines
                            },
                            ticks: {
                                callback: function(value) {
                                    return '$' + value; // Add $ sign to Y-axis labels
                                }
                            }
                        }
                    },
                    animation: {
                        duration: 1500, // Smooth animation
                        easing: 'easeOutBounce'
                    }
                }
            });
        });
    </script>
    @endpush
