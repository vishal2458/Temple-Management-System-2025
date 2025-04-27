@extends('home.layouts.main')

@section('title', 'Event Details')
@section('main-content')


    <!-- ================> PageHeader section start here <================== -->
    <div class="pageheader">
        <div class="container">
            <div class="pageheader__area">
                <div class="pageheader__left">
                    <h3>Event Details</h3>
                </div>
                <div class="pageheader__right">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('home.festivals') }}">Event</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Event Details</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <!-- ================> PageHeader section end here <================== -->


    <!-- ================> Event section start here <================== -->
    @php
        $today = now();
        $startDate = \Carbon\Carbon::parse($festival->start_date);
        $endDate = \Carbon\Carbon::parse($festival->end_date);

        if ($today->lt($startDate)) {
            $status = 'Upcoming';
            $statusClass = 'badge-upcoming';
        } elseif ($today->between($startDate, $endDate)) {
            $status = 'Ongoing';
            $statusClass = 'badge-ongoing';
        } else {
            $status = 'Completed';
            $statusClass = 'badge-completed';
        }
    @endphp
    <div class="event event-single padding--top padding--bottom bg-light">
        <div class="container">
            <div class="section__wrapper">
                <div class="row g-4 justify-content-center">
                    <div class="col-lg-8 col-12">
                        <div class="event__item">
                            <div class="event__inner">
                                <div class="event__content pt-0">
                                    <h3>{{ $festival->name }}</h3>
                                    <div class="event__metapost">
                                        <ul class="event__metapost-info" style="margin-bottom:-35px;">
                                            <li><a href="{{ route('home.viewtemple',$festival->temple->id) }}"><i class="fas fa-gopuram"></i> {{ $festival->temple->name }}</a></li>
                                            <li><i class="fas fa-map-marker-alt"></i> {{ $festival->temple->city.' , '.$festival->temple->state.' , '.$festival->temple->country }}</li>
                                        </ul>
                                    </div>
                                    <div class="event__thumb mb-3">
                                        <img src="{{ asset($festival->festival_image) }}" alt="event thumb">
                                        <div class="event__thumb-date">
                                            <h6>{{ $startDate->format('d') }}</h6>
                                            <p>{{ $startDate->format('M') }}</p>
                                        </div>
                                    </div>
                                    <div class="section__header">
                                        <h2>About Event</h2>
                                    </div>
                                    <p>{{ $festival->festival_desc }}</p>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-12">
                        <div class="sidebar">
                            <div class="sidebar__info">
                                <div class="section__header">
                                    <h2>Event Details </h2>
                                    <button id="booking_button" type="button"class="default-btn" style="border: none;height: 40px;width: 93px;border-radius: 30px;line-height:0px;"><span style="margin-left:-14px">Attend</span></button>
                                </div>
                                <div class="section__wrapper">
                                    <ul class="sidebar__info-list mb-3">
                                        <li>
                                            <div class="sidebar__info-left"><i class="fas fa-map-marker-alt"></i></div>
                                            <div class="sidebar__info-right">{{ $festival->temple->address }}</div>
                                        </li>
                                        <li>
                                            <div class="sidebar__info-left"><i class="far fa-calendar-alt"></i></div>
                                            <div class="sidebar__info-right">  {{ \Carbon\Carbon::parse($festival->start_date)->format('d F, Y') }}</div>
                                        </li>
                                        <li>
                                            <div class="sidebar__info-left"><i class="fas fa-gopuram"></i></div>
                                            <div class="sidebar__info-right"><a href="{{ route('home.viewtemple',$festival->temple->id) }}">{{ $festival->temple->name }}</a></div>
                                        </li>
                                        <li>
                                            <div class="sidebar__info-left"><i class="fas fa-envelope"></i></div>
                                            <div class="sidebar__info-right">{{ $festival->temple->email }}</div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="sidebar__info">
                                <div class="section__header">
                                    <h2>Temple Images</h2>
                                </div>
                                <div class="row g-3 grid">
                                    @foreach ($templeImages as $image)
                                    <div class="col-lg-4 col-sm-6 col-12 cate-1">
                                        <div class="gallery__item">
                                            <div class="gallery__inner">
                                                <div class="gallery__thumb">
                                                    <img src="{{ asset($image->image_url) }}" alt="gallery-thumb" class="w-100">
                                                </div>
                                                <div class="gallery__content text-center">
                                                    <a href="{{ asset($image->image_url) }}" data-rel="lightcase" class="gallery__icon"><i class="fas fa-plus"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ================> Event section end here <================== -->



    <!-- ================> Social section start here <================== -->
    <div class="social">
        <div class="container">
            <div class="social__area">
                <ul class="social__list">
                    <li class="social__list-facebook">
                        <a href="#">
                            <i class="fab fa-facebook-f"></i>
                            <span>facebook</span>
                        </a>
                    </li>
                    <li class="social__list-twitter">
                        <a href="#">
                            <i class="fab fa-twitter"></i>
                            <span>twitter</span>
                        </a>
                    </li>
                    <li class="social__list-linkedin">
                        <a href="#">
                            <i class="fab fa-linkedin-in"></i>
                            <span>linkedin</span>
                        </a>
                    </li>
                    <li class="social__list-instagram">
                        <a href="#">
                            <i class="fab fa-instagram"></i>
                            <span>instagram</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <!-- ================> Social section end here <================== -->


@endsection
{{-- Booking Modal --}}
<div class="modal fade" id="bookingModal" tabindex="-1" aria-labelledby="bookingModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-warning text-white">
                <h5 class="modal-title" id="bookingModalLabel">Temple Visit Booking</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="bookingForm">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 ">
                            <div class="mb-3">
                                <label for="full_name">Full Name</label>
                                <input type="text" class="form-control" id="full_name" name="full_name"  value="{{ Auth::check() ? Auth::user()->first_name . ' ' . Auth::user()->last_name : '' }}"  style="min-width: 100%" readonly>
                                {{-- <input type="text" class="form-control" id="full_name" name="full_name"  value="test"  style="min-width: 100%" required> --}}
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="booking_date">Booking Date</label>
                        <input type="date" name="booking_date" class="form-control" id="booking_date" value="{{ $festival->start_date }}" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="temple_name">Temple Name</label>
                        <input type="text" name="temple_name" class="form-control" value="{{ $festival->temple->name }}" readonly>
                    </div>
                    <input type="hidden" name="temple_id" id="temple_id" value={{ $festival->temple->id }}>
                    <input type="hidden" name="user_id" id="user_id" value="{{ Auth::check() ? Auth::user()->id : '' }}">
                    {{-- <input type="hidden" name="user_id" id="user_id" value="1"> --}}
                    <button type="submit" class="btn btn-warning">Book Now</button>
                </form>
            </div>
        </div>
    </div>
</div>

@push('script')
<script>
    $(document).ready(function() {
        $('#booking_button').on('click', function() {
            @if (!Auth::check())
            Swal.fire({
            title: 'Please Login',
            text: 'You need to log in first to book The visit.',
            icon: 'warning',
            confirmButtonText: 'Login Now'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "{{ route('login') }}";
                }
            });
            @else
            $('#bookingModal').modal('show');
            @endif
        });
    });
    document.addEventListener("DOMContentLoaded", function () {
        $("#bookingForm").submit(function (event) {
            event.preventDefault();

            let form = $(this);
            let formData = form.serializeArray();
            let bookingDate = formData.find(item => item.name === 'booking_date')?.value || '';
            let today = new Date().toISOString().split("T")[0];
            let finalData = $.param(formData);
            Swal.fire({
                        title: "Booking...",
                        text: "Please wait while we process your Booking.",
                        allowOutsideClick: false,
                        didOpen: () => {
                            Swal.showLoading();
                        }
                    });
            $.ajax({
                url: "{{ route('user.bookings.store') }}",
                type: "POST",
                data: finalData,
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                },
                success: function (data) {
                    $('#bookingModal').modal('hide');
                    if (data.success) {
                        console.log(data);

                    setTimeout(() => {
                        // document.getElementById("bookingprocess").style.display = "none"; // Hide processing modal
                        createCornerFireworksConfetti();
                        document.getElementById("bookingForm").reset();
                        Swal.fire({
                            title: "🎉 Booking Successful! 🎉",
                            html: "<p>Dear Devotee, your temple visit is confirmed. 🙏</p>" +
                            "<p><strong>See you at the Darshan! May you be blessed with peace and prosperity. 🕉️</strong></p>",
                            icon: "success",
                            confirmButtonText: "Download Receipt",
                            showCancelButton: true,
                            cancelButtonText: "Close",
                            allowOutsideClick: false,
                            allowEscapeKey: false
                        }).then((result) => {
                            if (result.isConfirmed) {
                                // window.location.href = data.file_path; // Corrected download link
                                const link = document.createElement("a");
                                link.href = data.file_path;
                                link.download = ""; // Ensures download instead of opening
                                document.body.appendChild(link);
                                link.click();
                                document.body.removeChild(link);
                            }
                        });
                    }, 2000);
                } else {
                    alert("Failed to process donation.");
                }
                },
                error: function (xhr) {
                    let errorMsg = "Something went wrong! Please try again.";
                    if (xhr.responseJSON && xhr.responseJSON.errors) {
                        let errors = xhr.responseJSON.errors;
                        errorMsg = Object.values(errors).flat().join("<br>");
                    }
                    Swal.fire({
                        icon: "error",
                        title: "Booking Failed",
                        html: errorMsg,
                    });
                }
            });

        });
     // Confetti Function
    function createCornerFireworksConfetti() {
        var duration = 2000; // 3 seconds duration
        var end = Date.now() + duration;

        (function frame() {
            confetti({ particleCount: 10, angle: 60, spread: 70, origin: { x: 0, y: Math.random() } });
            confetti({ particleCount: 10, angle: 120, spread: 70, origin: { x: 1, y: Math.random() } });
            confetti({ particleCount: 10, angle: 180, spread: 70, origin: { x: Math.random(), y: 0 } });
            confetti({ particleCount: 10, angle: 0, spread: 70, origin: { x: Math.random(), y: 1 } });

            if (Date.now() < end) {
                requestAnimationFrame(frame);
            }
        })();
    }
    function showJaiShreeRam() {
            const confettiContainer = document.body;
            for (let i = 0; i < 30; i++) {
                let text = document.createElement("div");
                text.classList.add("confetti-text");
                text.innerHTML = "🚩 जय श्री राम 🚩";

                let startX = Math.random() * window.innerWidth;
                let startY = Math.random() * window.innerHeight;
                text.style.left = `${startX}px`;
                text.style.top = `${startY}px`;

                let randomX = (Math.random() - 0.5) * window.innerWidth;
                let randomY = (Math.random() - 0.5) * window.innerHeight;
                text.style.setProperty("--x", randomX + "px");
                text.style.setProperty("--y", randomY + "px");
                text.style.animationDuration = 2 + Math.random() * 1 + "s";

                confettiContainer.appendChild(text);

                setTimeout(() => {
                    text.remove();
                }, 3000);
            }
    }
});
</script>
@endpush
