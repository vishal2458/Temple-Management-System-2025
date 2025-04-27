
@extends('home.layouts.main')

@section('title', 'Festivals')

@push('css')
    <style>
        .badge {
    display: inline-block;
    padding: 5px 10px;
    font-size: 12px;
    font-weight: bold;
    color: white;
    border-radius: 5px;
}

.badge-upcoming {
    background-color: #28a745; /* Green */
}

.badge-ongoing {
    background-color: #ffc107; /* Yellow */
    color: #000;
}

.badge-completed {
    background-color: #6c757d; /* Gray */
}

    </style>
@endpush

@section('main-content')
    <!-- ================> PageHeader section start here <================== -->
    <div class="pageheader">
        <div class="container">
            <div class="pageheader__area">
                <div class="pageheader__left">
                    <h3>Event</h3>
                </div>
                <div class="pageheader__right">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Festivals</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <!-- ================> PageHeader section end here <================== -->


    <!-- ================> Event section start here <================== -->
    <div class="event padding--top padding--bottom bg-light">
        <div class="container">
            <div class="section__header text-center">
                <h2>Recent Event</h2>
                {{-- <p>Enthusiastically underwhelm quality benefits rather than professional outside the box thinking. Distinctively network highly efficient leadership skills</p> --}}
            </div>
            <div class="section__wrapper">
                <div class="row g-4 justify-content-center">
                    @if(!empty($festivals))
                    @foreach ($festivals as $festival)
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

                        <div class="col-lg-4 col-sm-6 col-12">
                            <div class="event__item">
                                <div class="event__inner">
                                    <div class="event__thumb">
                                        <a href="{{ route('home.singlefestival',$festival->id) }}">
                                            <img src="{{ asset($festival->festival_image) }}" alt="event thumb" style="max-height: 252px !important">
                                        </a>
                                        <div class="event__thumb-date">
                                            <h6>{{ $startDate->format('d') }}</h6>
                                            <p>{{ $startDate->format('M') }}</p>
                                        </div>
                                    </div>
                                    <div class="event__content">
                                        <a href="{{ route('home.singlefestival',$festival->id) }}">
                                            <h5>
                                                {{ $festival->name }}
                                                <span class="badge {{ $statusClass }}">{{ $status }}</span>
                                            </h5>
                                        </a>
                                        <div class="event__metapost">
                                            <ul class="event__metapost-info">
                                                <li><i class="fas fa-gopuram"></i> {{ $festival->temple->name }}</li>
                                            </ul>
                                            <ul class="event__metapost-info">
                                                <li><i class="fas fa-map-marker-alt"></i>
                                                    {{ $festival->temple->city.' , '.$festival->temple->state.' , '.$festival->temple->country }}
                                                </li>
                                            </ul>
                                        </div>
                                        <p>{{ $festival->festival_desc }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach


                    @endif

                    {{-- <div class="col-lg-4 col-sm-6 col-12">
                        <div class="event__item">
                            <div class="event__inner">
                                <div class="event__thumb">
                                    <a href="event-single.html"><img src="assets/images/event/02.jpg" alt="event thumb"></a>
                                    <div class="event__thumb-date">
                                        <h6>09</h6>
                                        <p>Nov</p>
                                    </div>
                                </div>
                                <div class="event__content">
                                    <a href="event-single.html">
                                        <h5>Big Event This Year</h5>
                                    </a>
                                    <div class="event__metapost">
                                        <ul class="event__metapost-info">
                                            <li><i class="far fa-clock"></i> 10am - 12pm</li>
                                            <li><i class="fas fa-map-marker-alt"></i> PO Box 16122, Collins Street</li>
                                        </ul>
                                        <ul class="event__metapost-comentshare">
                                            <li class="event__metapost-coment">
                                                <i class="far fa-comments"></i>
                                                <a href="#" class="event__metapost-count">10</a>
                                            </li>
                                            <li class="event__metapost-share">
                                                <i class="fas fa-share-alt"></i>
                                                <ul>
                                                    <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                                                    <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                                                    <li><a href="#"><i class="fab fa-linkedin-in"></i></a></li>
                                                    <li><a href="#"><i class="fab fa-dribbble"></i></a></li>
                                                </ul>
                                            </li>
                                        </ul>
                                    </div>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore consectetur adipisicing elit</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-6 col-12">
                        <div class="event__item">
                            <div class="event__inner">
                                <div class="event__thumb">
                                    <a href="event-single.html"><img src="assets/images/event/03.jpg" alt="event thumb"></a>
                                    <div class="event__thumb-date">
                                        <h6>09</h6>
                                        <p>Nov</p>
                                    </div>
                                </div>
                                <div class="event__content">
                                    <a href="event-single.html">
                                        <h5>Church Evert</h5>
                                    </a>
                                    <div class="event__metapost">
                                        <ul class="event__metapost-info">
                                            <li><i class="far fa-clock"></i> 10am - 12pm</li>
                                            <li><i class="fas fa-map-marker-alt"></i> PO Box 16122, Collins Street</li>
                                        </ul>
                                        <ul class="event__metapost-comentshare">
                                            <li class="event__metapost-coment">
                                                <i class="far fa-comments"></i>
                                                <a href="#" class="event__metapost-count">10</a>
                                            </li>
                                            <li class="event__metapost-share">
                                                <i class="fas fa-share-alt"></i>
                                                <ul>
                                                    <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                                                    <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                                                    <li><a href="#"><i class="fab fa-linkedin-in"></i></a></li>
                                                    <li><a href="#"><i class="fab fa-dribbble"></i></a></li>
                                                </ul>
                                            </li>
                                        </ul>
                                    </div>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore consectetur adipisicing elit</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-6 col-12">
                        <div class="event__item">
                            <div class="event__inner">
                                <div class="event__thumb">
                                    <a href="event-single.html"><img src="assets/images/event/01.jpg" alt="event thumb"></a>
                                    <div class="event__thumb-date">
                                        <h6>09</h6>
                                        <p>Nov</p>
                                    </div>
                                </div>
                                <div class="event__content">
                                    <a href="event-single.html">
                                        <h5>Open Rededication</h5>
                                    </a>
                                    <div class="event__metapost">
                                        <ul class="event__metapost-info">
                                            <li><i class="far fa-clock"></i> 10am - 12pm</li>
                                            <li><i class="fas fa-map-marker-alt"></i> PO Box 16122, Collins Street</li>
                                        </ul>
                                        <ul class="event__metapost-comentshare">
                                            <li class="event__metapost-coment">
                                                <i class="far fa-comments"></i>
                                                <a href="#" class="event__metapost-count">10</a>
                                            </li>
                                            <li class="event__metapost-share">
                                                <i class="fas fa-share-alt"></i>
                                                <ul>
                                                    <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                                                    <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                                                    <li><a href="#"><i class="fab fa-linkedin-in"></i></a></li>
                                                    <li><a href="#"><i class="fab fa-dribbble"></i></a></li>
                                                </ul>
                                            </li>
                                        </ul>
                                    </div>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore consectetur adipisicing elit</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-6 col-12">
                        <div class="event__item">
                            <div class="event__inner">
                                <div class="event__thumb">
                                    <a href="event-single.html"><img src="assets/images/event/02.jpg" alt="event thumb"></a>
                                    <div class="event__thumb-date">
                                        <h6>09</h6>
                                        <p>Nov</p>
                                    </div>
                                </div>
                                <div class="event__content">
                                    <a href="event-single.html">
                                        <h5>Big Event This Year</h5>
                                    </a>
                                    <div class="event__metapost">
                                        <ul class="event__metapost-info">
                                            <li><i class="far fa-clock"></i> 10am - 12pm</li>
                                            <li><i class="fas fa-map-marker-alt"></i> PO Box 16122, Collins Street</li>
                                        </ul>
                                        <ul class="event__metapost-comentshare">
                                            <li class="event__metapost-coment">
                                                <i class="far fa-comments"></i>
                                                <a href="#" class="event__metapost-count">10</a>
                                            </li>
                                            <li class="event__metapost-share">
                                                <i class="fas fa-share-alt"></i>
                                                <ul>
                                                    <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                                                    <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                                                    <li><a href="#"><i class="fab fa-linkedin-in"></i></a></li>
                                                    <li><a href="#"><i class="fab fa-dribbble"></i></a></li>
                                                </ul>
                                            </li>
                                        </ul>
                                    </div>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore consectetur adipisicing elit</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-6 col-12">
                        <div class="event__item">
                            <div class="event__inner">
                                <div class="event__thumb">
                                    <a href="event-single.html"><img src="assets/images/event/03.jpg" alt="event thumb"></a>
                                    <div class="event__thumb-date">
                                        <h6>09</h6>
                                        <p>Nov</p>
                                    </div>
                                </div>
                                <div class="event__content">
                                    <a href="event-single.html">
                                        <h5>Church Evert</h5>
                                    </a>
                                    <div class="event__metapost">
                                        <ul class="event__metapost-info">
                                            <li><i class="far fa-clock"></i> 10am - 12pm</li>
                                            <li><i class="fas fa-map-marker-alt"></i> PO Box 16122, Collins Street</li>
                                        </ul>
                                        <ul class="event__metapost-comentshare">
                                            <li class="event__metapost-coment">
                                                <i class="far fa-comments"></i>
                                                <a href="#" class="event__metapost-count">10</a>
                                            </li>
                                            <li class="event__metapost-share">
                                                <i class="fas fa-share-alt"></i>
                                                <ul>
                                                    <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                                                    <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                                                    <li><a href="#"><i class="fab fa-linkedin-in"></i></a></li>
                                                    <li><a href="#"><i class="fab fa-dribbble"></i></a></li>
                                                </ul>
                                            </li>
                                        </ul>
                                    </div>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore consectetur adipisicing elit</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-6 col-12">
                        <div class="event__item">
                            <div class="event__inner">
                                <div class="event__thumb">
                                    <a href="event-single.html"><img src="assets/images/event/01.jpg" alt="event thumb"></a>
                                    <div class="event__thumb-date">
                                        <h6>09</h6>
                                        <p>Nov</p>
                                    </div>
                                </div>
                                <div class="event__content">
                                    <a href="event-single.html">
                                        <h5>Open Rededication</h5>
                                    </a>
                                    <div class="event__metapost">
                                        <ul class="event__metapost-info">
                                            <li><i class="far fa-clock"></i> 10am - 12pm</li>
                                            <li><i class="fas fa-map-marker-alt"></i> PO Box 16122, Collins Street</li>
                                        </ul>
                                        <ul class="event__metapost-comentshare">
                                            <li class="event__metapost-coment">
                                                <i class="far fa-comments"></i>
                                                <a href="#" class="event__metapost-count">10</a>
                                            </li>
                                            <li class="event__metapost-share">
                                                <i class="fas fa-share-alt"></i>
                                                <ul>
                                                    <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                                                    <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                                                    <li><a href="#"><i class="fab fa-linkedin-in"></i></a></li>
                                                    <li><a href="#"><i class="fab fa-dribbble"></i></a></li>
                                                </ul>
                                            </li>
                                        </ul>
                                    </div>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore consectetur adipisicing elit</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-6 col-12">
                        <div class="event__item">
                            <div class="event__inner">
                                <div class="event__thumb">
                                    <a href="event-single.html"><img src="assets/images/event/02.jpg" alt="event thumb"></a>
                                    <div class="event__thumb-date">
                                        <h6>09</h6>
                                        <p>Nov</p>
                                    </div>
                                </div>
                                <div class="event__content">
                                    <a href="event-single.html">
                                        <h5>Big Event This Year</h5>
                                    </a>
                                    <div class="event__metapost">
                                        <ul class="event__metapost-info">
                                            <li><i class="far fa-clock"></i> 10am - 12pm</li>
                                            <li><i class="fas fa-map-marker-alt"></i> PO Box 16122, Collins Street</li>
                                        </ul>
                                        <ul class="event__metapost-comentshare">
                                            <li class="event__metapost-coment">
                                                <i class="far fa-comments"></i>
                                                <a href="#" class="event__metapost-count">10</a>
                                            </li>
                                            <li class="event__metapost-share">
                                                <i class="fas fa-share-alt"></i>
                                                <ul>
                                                    <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                                                    <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                                                    <li><a href="#"><i class="fab fa-linkedin-in"></i></a></li>
                                                    <li><a href="#"><i class="fab fa-dribbble"></i></a></li>
                                                </ul>
                                            </li>
                                        </ul>
                                    </div>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore consectetur adipisicing elit</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-6 col-12">
                        <div class="event__item">
                            <div class="event__inner">
                                <div class="event__thumb">
                                    <a href="event-single.html"><img src="assets/images/event/03.jpg" alt="event thumb"></a>
                                    <div class="event__thumb-date">
                                        <h6>09</h6>
                                        <p>Nov</p>
                                    </div>
                                </div>
                                <div class="event__content">
                                    <a href="event-single.html">
                                        <h5>Church Evert</h5>
                                    </a>
                                    <div class="event__metapost">
                                        <ul class="event__metapost-info">
                                            <li><i class="far fa-clock"></i> 10am - 12pm</li>
                                            <li><i class="fas fa-map-marker-alt"></i> PO Box 16122, Collins Street</li>
                                        </ul>
                                        <ul class="event__metapost-comentshare">
                                            <li class="event__metapost-coment">
                                                <i class="far fa-comments"></i>
                                                <a href="#" class="event__metapost-count">10</a>
                                            </li>
                                            <li class="event__metapost-share">
                                                <i class="fas fa-share-alt"></i>
                                                <ul>
                                                    <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                                                    <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                                                    <li><a href="#"><i class="fab fa-linkedin-in"></i></a></li>
                                                    <li><a href="#"><i class="fab fa-dribbble"></i></a></li>
                                                </ul>
                                            </li>
                                        </ul>
                                    </div>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore consectetur adipisicing elit</p>
                                </div>
                            </div>
                        </div>
                    </div> --}}
                </div>
                <nav aria-label="Page navigation example">
                    <ul class="pagination justify-content-center mt-5">
                        {{-- Previous Page Link --}}
                        @if ($festivals->onFirstPage())
                            <li class="page-item disabled"><span class="page-link">Previous</span></li>
                        @else
                            <li class="page-item">
                                <a class="page-link" href="{{ $festivals->previousPageUrl() }}">Previous</a>
                            </li>
                        @endif

                        {{-- Page Numbers --}}
                        @foreach ($festivals->links()->elements[0] as $page => $url)
                            <li class="page-item {{ $page == $festivals->currentPage() ? 'active' : '' }}">
                                <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                            </li>
                        @endforeach

                        {{-- Next Page Link --}}
                        @if ($festivals->hasMorePages())
                            <li class="page-item">
                                <a class="page-link" href="{{ $festivals->nextPageUrl() }}">Next</a>
                            </li>
                        @else
                            <li class="page-item disabled"><span class="page-link">Next</span></li>
                        @endif
                    </ul>
                </nav>

            </div>
        </div>
    </div>
    <!-- ================> Event section end here <================== -->
@endsection



