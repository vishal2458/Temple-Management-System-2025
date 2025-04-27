@extends('user.userlayouts.main')

@section('title', 'Dashboard')

@section('main-content')
    <section class="section">
        <!-- Header with Welcome Message -->
        <div class="section-header">
            <h1>Dashboard</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active">Welcome back, {{ Auth::user()->first_name }}!</div>
            </div>
        </div>

        <!-- Card Widgets -->
        <div class="row">
            <!-- Total Temples Card -->
            <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                {{-- <a href="{{ route('admin.temples') }}"> --}}
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-primary">
                            <i class="fas fa-gopuram"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Total Temples Visit</h4>
                            </div>
                            <div class="card-body">
                                {{ $totalTempleVisit }}
                            </div>
                        </div>
                    </div>
                {{-- </a> --}}
            </div>

            <!-- Total Donations Card -->
            <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                {{-- <a href="{{ route('admin.donations.index') }}"> --}}
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-danger">
                            <i class="fas fa-archive"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Total Donations Made</h4>
                            </div>
                            <div class="card-body">
                                {{ $totalDonationCount }}
                            </div>
                        </div>
                    </div>
                {{-- </a> --}}
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                {{-- <a href="{{ route('admin.donations.index') }}"> --}}
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-danger">
                            <i class="fas fa-rupee-sign"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Total Donated Amount</h4>
                            </div>
                            <div class="card-body">
                                <i class="fas fa-rupee-sign"></i> {{ number_format($totalDonationAmount, 2) }}
                            </div>
                        </div>
                    </div>
                {{-- </a> --}}
            </div>

            <!-- Total Bookings Card -->

        </div>

        <!-- Recent Bookings Table -->


        <div class="row">
            @if(count($lastTempleVisits) > 0)
                <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h4>Your Recent 5 Darshan Bookings</h4>
                    <div class="card-header-action">
                        <a href="{{ route('user.bookings') }}" class="btn btn-danger">View More <i class="fas fa-chevron-right"></i></a>
                    </div>
                    </div>
                    <div class="card-body p-0">
                    <div class="table-responsive table-invoice">
                        <table class="table table-striped">
                        <tr>
                            <th>#</th>
                            <th><i class="fas fa-synagogue"></i> Temple Name</th>
                            <th><i class="fas fa-calendar-alt"></i> Darshan Date</th>
                            <th><i class="fas fa-id-card"></i> Booking ID</th>
                        </tr>
                            @php
                                $i = 1;
                            @endphp
                            @foreach ($lastTempleVisits as $booking)
                                <tr>
                                    <td><a href="#">{{ $i }}</a></td>
                                    <td class="font-weight-600">{{ $booking->temple->name }}</td>
                                    <td>{{ date("F d, Y", strtotime($booking->booking_date)) }}</td>
                                    <td>
                                        @php
                                            $badgeClass = match($booking->status) {
                                                'pending' => 'badge-warning',
                                                'confirmed' => 'badge-success',
                                                'cancelled' => 'badge-danger',
                                                default => 'badge-secondary'
                                            };
                                        @endphp
                                        <div class="badge {{ $badgeClass }}">{{ ucfirst($booking->booking_id) }}</div>
                                    </td>
                                </tr>
                                @php
                                    $i++
                                @endphp
                            @endforeach

                        </table>
                    </div>
                    </div>
                </div>
                </div>
            @endif
            <div class="col-md-4">
            <div class="card card-hero">
                <div class="card-header">
                <div class="card-icon">
                    <i class="far fa-question-circle"></i>
                </div>
                <p>Todays Date : </p>
                <h4>{{ date("F d, Y") }}</h4>
                <div class="card-description">Current and Upcoming Events Celebrations</div>
                </div>
                <div class="card-body p-0">
                <div class="tickets-list">
                    @foreach ($upcomingFestivals as $festival)
                    @php
                        $today = now()->toDateString(); // Get today's date
                        $startDate = $festival->start_date;
                        $endDate = $festival->end_date;

                        // Determine the status of the festival
                        if ($today >= $startDate && $today <= $endDate) {
                            $status = 'current';
                            $badgeClass = 'background: green; color: white; padding: 3px 7px; border-radius: 5px;';
                            $badgeText = 'Current';
                        } elseif ($today < $startDate) {
                            $status = 'upcoming';
                            $badgeClass = 'background: blue; color: white; padding: 3px 7px; border-radius: 5px;';
                            $badgeText = 'Upcoming';
                        } else {
                            continue; // Skip past festivals
                        }
                    @endphp

                    <a href="{{ route('user.temples.show', $festival->temple->id) }}" class="ticket-item" style="display: block; border: 1px solid #ddd; padding: 10px; margin-bottom: 10px; border-radius: 10px; text-decoration: none; color: black;">
                        <div class="ticket-title" style="display: flex; justify-content: space-between; align-items: center;">
                            <h4 style="margin: 0;">{{ $festival->name }}</h4>
                            <span style="{{ $badgeClass }}">{{ $badgeText }}</span>
                        </div>
                        <div class="ticket-info" style="display: flex; align-items: center; gap: 10px; margin-top: 5px;">
                            <div>{{ $festival->temple->name }}</div>
                            <div class="bullet" style="width: 6px; height: 6px; background: gray; border-radius: 50%;"></div>
                            <div class="text-primary">{{ date("F d, Y", strtotime($festival->start_date)) }} - {{ date("F d, Y", strtotime($festival->end_date)) }}</div>
                        </div>
                    </a>
                @endforeach

                </div>
                </div>
            </div>
            </div>
        </div>
        {{-- <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h4>Best Temples</h4>
                    </div>
                    <div class="card-body">
                        <div class="owl-carousel owl-theme" id="temples-carousel">
                            @foreach($temples as $temple)
                            <div>
                                <div class="product-item pb-3">
                                    <div class="product-image">
                                        <img alt="image" src="{{ asset($temple->main_image) }}" class="img-fluid">
                                    </div>
                                    <div class="product-details">
                                        <div class="product-name">{{ $temple->name }}</div>
                                        <div class="text-muted text-small">Temple</div>
                                        <div class="product-cta">
                                            <a href="#" class="btn btn-primary">Detail</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div> --}}
    </section>

    <!-- Chart.js Script -->
    @push('script')
    <script>
        $(document).ready(function(){
            $("#temples-carousel").owlCarousel({
                items: 3,
                margin: 10,
                autoplay: true,
                autoplayTimeout: 5000,
                loop: true,
                responsive: {
                    0: {
                        items: 2
                    },
                    768: {
                        items: 2
                    },
                    1200: {
                        items: 3
                    }
                }
            });
        });
    </script>
    <script>
        const ctx = document.getElementById('donationsChart').getContext('2d');
        const donationsChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                datasets: [{
                    label: 'Donations (₹)',
                    data: [/* Add monthly donation data here */],
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
    @endpush
@endsection
