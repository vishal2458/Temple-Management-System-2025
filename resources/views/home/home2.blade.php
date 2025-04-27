@extends('home.layouts.main')

@section('title', 'Ram')

@section('main-content')

  <!-- ================> Banner section start here <================== -->
    <div class="banner__slider banner-style3 overflow-hidden">
        <div class="swiper-wrapper">
            <div class="swiper-slide">
                <div class="banner" style="background-image: url({{ asset('assets/home/assets/images/banner/07.jpg') }});">
                    <div class="container">
                        <div class="banner__content ms-lg-auto">
                            <h2 class="text-white">Kindness to all brings true peace.</h2>
                            <p class="text-white">सर्वधर्मान्परित्यज्य मामेकं शरणं व्रज |
                                अहं त्वां सर्वपापेभ्यो मोक्षयिष्यामि मा शुच: || १८.६६ ||</p>
                            <a href="#" class="default-btn move-right"><span></span></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="swiper-slide">
                <div class="banner" style="background-image: url({{ asset('assets/home/assets/images/banner/08.jpg') }});">
                    <div class="container">
                        <div class="banner__content ms-lg-auto">
                            <h2>Love To Human Is Biggest Peace</h2>
                            <p>उद्धरेदात्मनाऽत्मानं नात्मानमवसादयेत् |
                                आत्मैव ह्यात्मनो बन्धुरात्मैव रिपुरात्मन: ||</p>
                            <a href="#" class="default-btn move-right"><span></span></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="swiper-slide">
                <div class="banner" style="background-image: url({{ asset('assets/home/assets/images/banner/09.jpg') }});">
                    <div class="container">
                        <div class="banner__content m-lg-auto text-lg-center">
                            <h2 class="text-white">Religion Can't Divide You And Others</h2>
                            <p class="text-white">कर्मण्येवाधिकारस्ते मा फलेषु कदाचन |
                                मा कर्मफलहेतुर्भूर्मा ते सङ्गोऽस्त्वकर्मणि ||</p>
                            <a href="#" class="default-btn move-right"><span></span></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ================> Banner section end here <================== -->
    <!-- ================> Event Time section start here <================== -->
    @php
        $festival = $festivals->first(); // Get the first festival from the array/collection
    @endphp
    @if ($festival != '')
        <div class="eventtime">
            <div class="container">
                <div class="eventtime__area">
                    <div class="eventtime__left">
                        <h2>Upcoming Events</h2>
                    </div>
                    <div class="eventtime__center">
                        <ul class="countdown count-down" data-date="{{ $upcomingFestival['start_date'] ?? '' }}">
                            <li class="clock-item">
                                <span class="count-number days">56</span>
                                <p class="count-text">Days</p>
                            </li>

                            <li class="clock-item">
                                <span class="count-number hours">16</span>
                                <p class="count-text">Hours</p>
                            </li>

                            <li class="clock-item">
                                <span class="count-number minutes">25</span>
                                <p class="count-text">Minutes</p>
                            </li>

                            <li class="clock-item">
                                <span class="count-number seconds">19</span>
                                <p class="count-text">Seconds</p>
                            </li>
                        </ul>
                    </div>
                    <div class="eventtime__right">
                        <a href="#" class="default-btn move-right"><span>ALL EVENTS</span></a>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <!-- ================> Event Time section end here <================== -->


    <!-- ================> Service section start here <================== -->
    <div class="service padding--top padding--bottom">
        <div class="container">
            <div class="section__header text-center">
                <h2>Our Services</h2>

            </div>
            <div class="section__wrapper">
                <div class="row g-4 align-items-center">
                    <div class="col-lg-3 col-12">
                        <div class="service__left">
                            <div class="service__item">
                                <div class="service__inner">
                                    <div class="service__icon">
                                        <i class="fas fa-certificate" style="line-height:77px !important;"></i>
                                    </div>
                                    <div class="service__content">
                                        <h5>Pooja( comming soon )</h5>
                                        <p>Assertively redefine end end potentialities for principle-centered synergy. Quickly promote granular.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="service__item">
                                <div class="service__inner">
                                    <div class="service__icon">
                                        <i class="fas fa-heart" style="line-height:77px !important;"></i>
                                    </div>
                                    <div class="service__content">
                                        <h5>Marriage( comming soon )</h5>
                                        <p>Assertively redefine end end potentialities for principle-centered synergy. Quickly promote granular.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="service__item">
                                <div class="service__inner">
                                    <div class="service__icon">
                                        <i class="far fa-gem fas" style="line-height:77px !important;"></i>
                                    </div>
                                    <div class="service__content">
                                        <h5>Bhoomi Pooja( comming soon )</h5>
                                        <p>Assertively redefine end end potentialities for principle-centered synergy. Quickly promote granular.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-12">
                        <div class="service__center">
                            <div class="service__text">
                                <p>WHAT</p>
                                <h3>Services</h3>
                                <h6>WE PROVID</h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-12">
                        <div class="service__right">
                            <div class="service__item">
                                <div class="service__inner">
                                    <div class="service__icon">
                                        <i class="fas fa-eye" style="line-height:77px !important;"></i>
                                    </div>
                                    <div class="service__content">
                                        <h5>Darshan</h5>
                                        <p>Assertively redefine end end potentialities for principle-centered synergy. Quickly promote granular.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="service__item">
                                <div class="service__inner">
                                    <div class="service__icon">
                                        <i class="fas fa-bullhorn" style="line-height:77px !important;"></i>
                                    </div>
                                    <div class="service__content">
                                        <h5>Prashad( comming soon )</h5>
                                        <p>Assertively redefine end end potentialities for principle-centered synergy. Quickly promote granular.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="service__item">
                                <div class="service__inner">
                                    <div class="service__icon">
                                        <i class="fas fa-car" style="line-height:77px !important;"></i>
                                    </div>
                                    <div class="service__content">
                                        <h5>Car Pooja ( comming soon )</h5>
                                        <p>Assertively redefine end end potentialities for principle-centered synergy. Quickly promote granular.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ================> Service section end here <================== -->


    <!-- ================> Temple section start here <================== -->
    <div class="event padding--top padding--bottom">
        <div class="container">

            <div class="section__header text-center" style="display: flex; justify-content: space-between; align-items: center; position: relative;">
                <!-- Season Filter (Left) -->
                <select id="seasonFilter" class="form-control" style="max-width: 160px;">
                    <option value="" selected disabled>Filter Season</option>
                    <option value="winter">Winter</option>
                    <option value="summer">Summer</option>
                    <option value="monsoon">Monsoon</option>
                    <option value="autumn">Autumn</option>
                    <option value="all">All Season</option>
                </select>

                <!-- Center Title -->
                <h2 style="margin: 0;">Temples</h2>

                <!-- State Filter (Right) -->
                <select id="stateFilter" class="form-control" style="max-width: 160px;">
                    <option value="" selected disabled>Filter by State</option>
                    <option value="all">All</option> <!-- Show all temples -->
                    @foreach ($states as $state)
                        <option value="{{ $state }}">{{ $state }}</option>
                    @endforeach
                </select>
            </div>


            <div class="section__wrapper">
                <div class="row g-4 justify-content-center" id="templeList">
                    @foreach ($temples as $temple)
                        <div class="col-lg-4 col-sm-6 col-12">
                            <div class="event__item">
                                <div class="event__inner">
                                    <div class="event__thumb">
                                        <a href="{{ route('home.viewtemple', $temple->id) }}">
                                            <img src="{{ asset($temple->main_image) }}" alt="event thumb" style="max-width: 366px; max-height: 205px; width: 100%; height: auto; object-fit: cover;">
                                        </a>
                                    </div>
                                    <div class="event__content">
                                        <a href="{{ route('home.viewtemple', $temple->id) }}">
                                            <h5>{{ $temple->name }}</h5>
                                        </a>
                                        <span class="badge bg-success" style=" color: white; padding: 5px 10px; font-size: 12px;">
                                            {{ ucfirst($temple->season) }}
                                        </span>
                                        <span class="badge bg-secondary" style=" color: white; padding: 5px 10px; font-size: 12px;">
                                            {{ ucfirst($temple->state) }}
                                        </span>
                                        <ul class="event__metapost-info">
                                            <li><i class="fas fa-map-marker-alt"></i> {{ $temple->city }}, {{ $temple->state }}, {{ $temple->country }}</li>
                                        </ul>
                                        <ul class="event__metapost-info">
                                            <li><i class="fas fa-id-badge"></i> {{ $temple->phone }}</li>
                                        </ul>
                                        <ul class="event__metapost-info">
                                            <li><i class="fas fa-envelope"></i> {{ $temple->email }}</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- View All Button -->
                <div class="text-center w-100">
                    <a href="{{ route('home.temples') }}" class="default-btn move-right mt-5" style="border: none;"><span>View All</span></a>
                </div>
            </div>
        </div>
    </div>

    <script>
        function applyFilters() {
            let selectedState = document.getElementById('stateFilter').value || "";
            let selectedSeason = document.getElementById('seasonFilter').value || "";

            let queryParams = new URLSearchParams();
            if (selectedState && selectedState !== "all") {
                queryParams.append("state", selectedState);
            }
            if (selectedSeason && selectedSeason !== "all") {
                queryParams.append("season", selectedSeason);
            }

            // Show SweetAlert loading animation
            Swal.fire({
                title: 'Loading...',
                text: 'Please wait while we fetch the data.',
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });

            fetch('{{ route("home") }}?' + queryParams.toString())
                .then(response => response.text())
                .then(html => {
                    let parser = new DOMParser();
                    let doc = parser.parseFromString(html, 'text/html');
                    let newContent = doc.getElementById('templeList').innerHTML.trim();

        if (newContent === "") {
            document.getElementById('templeList').innerHTML = '<div style="color:red" class="col-12 text-center"><h4>No Temples Found</h4></div>';
        } else {
            document.getElementById('templeList').innerHTML = newContent;
        }

        Swal.close();
                })
                .catch(error => {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops!',
                        text: 'Something went wrong. Please try again.',
                    });
                });
        }

        document.getElementById('stateFilter').addEventListener('change', applyFilters);
        document.getElementById('seasonFilter').addEventListener('change', applyFilters);
    </script>




    <!-- ================> Temple section end here <================== -->


    <!-- ================> Shedule Event section start here <================== -->
    <div class="shedule padding--top padding--bottom bg-img" style="background: url({{ asset('assets/home/assets/images/bg-img/07.jpg') }}) rgba(0,0,0,.4);">
        <div class="container">
            <div class="row g-4">
                <div class="col-xl-4 col-12">
                    <div class="section__header mb-xl-0 text-white">
                        <h2 class="text-white">Festival Schedule</h2>

                        <p class="mb-0">Holisticly extend sticky partnerships and cross functional markets. Monotonectally.</p>
                    </div>
                </div>
                <div class="col-xl-8 col-12">
                    <div class="section__wrapper">
                        <div class="shedule__top">
                            @foreach ($festivals as $festival)
                            <div class="shedule__item">
                                <div class="shedule__inner">
                                    <div class="shedule__content">
                                        <div class="shedule__left">
                                            <div class="shedule__title">
                                                <h6><a href="{{ route('home.singlefestival',$festival->id) }}">{{ $festival->name }}</a></h6>
                                                <a href="{{ route('home.viewtemple',$festival->temple->id) }}"><p style="font-size: 9px">{{ $festival->temple->name }}</p></a>
                                                <p>{{ \Carbon\Carbon::parse($festival->start_date)->format('d F Y') }}</p>
                                            </div>
                                        </div>
                                        <div class="shedule__right">
                                            <div class="shedule__time">
                                                <ul class="countdown count-down" data-date="{{ \Carbon\Carbon::parse($festival->start_date)->format('M d, Y H:i:s') }}">
                                                    <li class="clock-item">
                                                        <span class="count-number days">56</span>
                                                        <p class="count-text">Days</p>
                                                    </li>

                                                    <li class="clock-item">
                                                        <span class="count-number hours">16</span>
                                                        <p class="count-text">Hours</p>
                                                    </li>

                                                    <li class="clock-item">
                                                        <span class="count-number minutes">25</span>
                                                        <p class="count-text">Minutes</p>
                                                    </li>

                                                    <li class="clock-item">
                                                        <span class="count-number seconds">19</span>
                                                        <p class="count-text">Seconds</p>
                                                    </li>
                                                </ul>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        <div class="shedule__bottom">
                            <div class="shedule__sunrise">
                                <div class="shedule__sunrise-item">
                                    <div class="shedule__sunrise-inner">
                                        <div class="shedule__sunrise-thumb">
                                            <img src="{{ asset('assets/home/assets/images/shedule/sun.png') }}" alt="event sunrise">
                                        </div>
                                        <div class="shedule__sunrise-content">
                                            <h3>SUNRISE</h3>
                                            <p>{{ $sun[0] }}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="shedule__sunrise-item">
                                    <div class="shedule__sunrise-inner">
                                        <div class="shedule__sunrise-thumb">
                                            <img src="{{ asset('assets/home/assets/images/shedule/sun2.png') }}" alt="event sunrise">
                                        </div>
                                        <div class="shedule__sunrise-content">
                                            <h3>SUNSET</h3>
                                            <p>{{ $sun[1] }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ================> Shedule section end here <================== -->
    <!-- ================> Event section start here <================== -->

    @if(!empty($festivals) && $festivals->isNotEmpty())
        <div class="event padding--top padding--bottom">
            <div class="container">
                <div class="section__header text-center">
                    <h2>Events</h2>

                </div>
                <div class="section__wrapper">
                    <div class="row g-4 justify-content-center">
                        @foreach ($festivals as $festival)
                            <div class="col-lg-4 col-sm-6 col-12">
                                <div class="event__item">
                                    <div class="event__inner">
                                        <div class="event__thumb">
                                            <a href="{{ route('home.singlefestival',$festival->id) }}"><img src="{{ asset($festival->festival_image) }}" alt="event thumb" style=" min-width: 366px; min-height: 205px;max-width: 366px; max-height: 205px; width: 100%; height: auto; object-fit: cover;"></a>
                                            <div class="event__thumb-date">
                                                <h6>{{ \Carbon\Carbon::parse($festival->start_date)->format('d') }}</h6>
                                                <p>{{ \Carbon\Carbon::parse($festival->start_date)->format('M') }}</p>
                                            </div>
                                        </div>
                                        <div class="event__content">
                                            <a href="{{ route('home.singlefestival',$festival->id) }}">
                                                <h5>{{ $festival->name }}</h5>
                                            </a>
                                            <div class="event__metapost">
                                                <ul class="event__metapost-info">
                                                    {{-- <li><i class="far fa-clock"></i> 10am - 12pm</li> --}}
                                                    <li><i class="fas fa-gopuram"></i> {{ $festival->temple->name }}</li>
                                                </ul>
                                                <ul class="event__metapost-info">
                                                    {{-- <li><i class="far fa-clock"></i> 10am - 12pm</li> --}}
                                                    <li><i class="fas fa-map-marker-alt"></i> {{ $festival->temple->city.' , '.$festival->temple->state.' , '.$festival->temple->country }}</li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <!-- View All Button -->
                    <div class="text-center w-100">
                        <a href="{{ route('home.festivals') }}"class="default-btn move-right" style="border: none;"><span>View All</span></a>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <!-- ================> Sponsor section start here <================== -->
    {{-- <div class="sponsor">
        <div class="container">
            <div class="sponsor__slider overflow-hidden">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <div class="sponsor__item">
                            <div class="sponsor__inner">
                                <div class="sponsor__thumb">
                                    <img src="{{ asset('assets/home/assets/images/sponsor/01.png') }}" alt="sponsor thumb">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="sponsor__item">
                            <div class="sponsor__inner">
                                <div class="sponsor__thumb">
                                    <img src="{{ asset('assets/home/assets/images/sponsor/01.png') }}" alt="sponsor thumb">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="sponsor__item">
                            <div class="sponsor__inner">
                                <div class="sponsor__thumb">
                                    <img src="{{ asset('assets/home/assets/images/sponsor/01.png') }}" alt="sponsor thumb">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="sponsor__item">
                            <div class="sponsor__inner">
                                <div class="sponsor__thumb">
                                    <img src="{{ asset('assets/home/assets/images/sponsor/01.png') }}" alt="sponsor thumb">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
    <!-- ================> Sponsor section end here <================== -->


    <!-- ================> Contact section start here <================== -->
    <div class="contact padding--top padding--bottom bg-light" style="background: url({{ asset('assets/home/assets/images/bg-img/07.jpg') }}) rgba(0,0,0,.4);">
        <div class="container" >
            <div class="section__header text-center">
                <h2 class="text-white">Contact Us</h2>
                <p>Proin gravida nibh vel velit auctor aliquet. Aenean sollicitudin, lorem quis bibendum auctor, nisi elit consequat ipsum, nec sagittis sem nibh id elit.</p>
            </div>
            <div class="section__wrapper" >
                <div class="contact__form">
                    <form class="d-flex flex-wrap justify-content-between" id="contact-form">
                        @csrf
                        <div class="w-100 d-flex flex-wrap">
                            <div class="col-6">
                                <span class="error-message text-danger"></span>
                                <input type="text" placeholder="Your Full Name" id="name" name="name" class="form-control" style="width:98%">
                            </div>
                            <div class="col-6">
                                <span class="error-message text-danger"></span>
                                <input type="text" placeholder="Your Email" id="email" name="email" class="form-control" style="width:100%">
                            </div>
                        </div>
                        <div class="w-100">
                            <span class="error-message text-danger"></span>
                            <input type="text" placeholder="Subject" id="subject" name="subject" class="form-control" style="width:100%">
                        </div>
                        <div class="w-100">
                            <span class="error-message text-danger"></span>
                            <textarea placeholder="Your Message" rows="8" name="message" id="message" class="form-control"></textarea>
                        </div>
                        <div class="text-center w-100">
                            <button type="button" id="contact_form_btn"  class="default-btn move-right"><span>SEND NOW</span></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <!-- ================> Contact section end here <================== -->


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
<a href="#" class="scrollToTop"><i class="fas fa-arrow-up"></i><span class="pluse_1"></span><span class="pluse_2"></span></a>


@push('script')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>

@if(session('status'))
<script>
    iziToast.success({
        title: 'success',
        message: @json(session('status')),
        position: 'topRight'
    });
</script>
@endif
<!-- jQuery Library -->

<script>
     $('#contact_form_btn').click(function () {
        $("#contact-form").submit();
    });
    $(document).ready(function() {
    $("#contact-form").validate({
        rules: {
            name: {
                required: true,
                minlength: 4,
            },
            email: {
                required: true,
                email: true,
            },
            subject: {
                required: true,
            },
            message: {
                required: true,
                minlength: 20,
            },
        },
        messages: {
            name: {
                required: "Please enter your name",
                minlength: "Full Name must be at least 4 characters long",
            },
            email: {
                required: "Please enter your email",
                email: "Enter a valid email address",
            },
            subject: {
                required: "Please enter the subject",
            },
            message: {
                required: "Please enter your message",
                minlength: "Message must be at least 20 characters long",
            },
        },
        errorPlacement: function (error, element) {
            element.siblings(".error-message").html(error);
        },
        highlight: function (element) {
            $(element).addClass("is-invalid");
        },
        unhighlight: function (element) {
            $(element).removeClass("is-invalid");
        },
        submitHandler: function (form) {
            event.preventDefault();
            var formData = $(form).serialize();

            // AJAX request
            $.ajax({
                url: "{{ route('contact.store') }}",
                type: "POST",
                data: formData,
                beforeSend: function() {
                    Swal.fire({
                        title: "Sending...",
                        text: "Please wait while we submit your query.",
                        allowOutsideClick: false,
                        didOpen: () => {
                            Swal.showLoading();
                        }
                    });
                },
                success: function(response) {
                    Swal.fire("Success!", response.message, "success");
                    $("#contact-form")[0].reset(); // Clear form
                },
                error: function(xhr) {
                    Swal.fire("Error!", xhr.responseJSON.message || "Something went wrong!", "error");
                }
            });

            return false; // Prevent actual form submission
        }
    });
});

</script>


@endpush
