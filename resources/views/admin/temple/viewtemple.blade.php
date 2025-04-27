@extends('layouts.main')

@section('title', 'View Temple')
@push('css')
<style>
* {
	margin: 0;
	padding: 0;
}

.container {
	width: auto;
	overflow: hidden;
	margin: 50px auto;
	background: white;
}

/*header*/
header {
 width: 800px;
 margin: 40px auto;
}

header h1 {
 text-align: center;
 font: 100 60px/1.5 Helvetica, Verdana, sans-serif;
}

/*photobanner*/

.photobanner__wrap {
  display: flex;

  &:hover {
    .photobanner {
      animation-play-state: paused;
     }
  }
}

.photobanner {
	display: flex;
  animation-name: swiperAnimation;
  animation-duration: 120s;
  animation-timing-function: linear;
  animation-iteration-count: infinite;
}

.photobanner img {
  width: 350px;
  height: 350px;
  object-fit: cover;
  padding-right: 4px;
}

@keyframes swiperAnimation{
  0%{
    transform:translateX(0)
  }
  100% {
    transform:translateX(-100%)
  }
}

#card-body{
    overflow: hidden;
}
.modal-lg {
        max-width: 80%;
    }
</style>
@endpush

@section('main-content')
<section class="section">
    <div class="section-header">
      <h1>Temple Detail</h1>
      <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
        <div class="breadcrumb-item"><a href="#">temple</a></div>
        <div class="breadcrumb-item"><a href="#">View temple</a></div>
      </div>
    </div>
      <div class="row">
        <div class="col-12 col-sm-6 col-lg-6">
          <div class="card card-primary">
            <div class="card-header">
              <h5 class="text-center section-title">{{ $temple->name }}</h5>
            </div>
            <div class="card-body">
              <div class="chocolat-parent">
                  <div data-crop-image="285">
                    <img alt="image" src="{{ asset($temple->main_image) }}" class="img-fluid">
                  </div>
                </a>
              </div>
              <div class="col-12">
                <p class="mt-2">{{ $temple->description}}</p>
                {{-- <p>The Celebration of <b>{{ $temple->name}}</b> will starts from <b>{{ $temple->start_date}}</b> to <b>{{ $temple->end_date}} </b>
                    <br>at <b> <a href="#">{{ $temple->name }}</a> </b> located at <b>{{ $temple->city }} {{ $temple->state }} </b><br>
                </p> --}}
             </div>
            </div>
          </div>
        </div>
        <div class="col-12 col-sm-6 col-lg-6">
          <div class="card card-primary">
            <div class="card-header">
              <h5 class="text-center section-title">Temple Details</h5>
            </div>
            <div class="card-body">
                        {{-- <div class="row"> --}}
                            <div class="col-12">
                                <p>Name : {{ $temple->name}} </p>
                                <p>Temple Address : {{ $temple->address}}</p>
                                <p>Temple Located at : {{ $temple->city .','.$temple->state  .','.  $temple->country}}</p>
                                <p>Regular Darshan Timings: 9:00 AM to 7:00 PM (Every Day)</p>
                                @if ($temple->festivals && count($temple->festivals) > 0)
                                @php
                                $today = \Carbon\Carbon::today();
                                $ongoingFestivals = $festivals->filter(function ($festival) use ($today) {
                                    return $today->between(\Carbon\Carbon::parse($festival->start_date), \Carbon\Carbon::parse($festival->end_date));
                                });

                                $upcomingFestivals = $festivals->filter(function ($festival) use ($today) {
                                    return $today->lt(\Carbon\Carbon::parse($festival->start_date));
                                });
                            @endphp
                            <div class="section__header bg-success">
                                        <h2 class="text-white">Ongoing Festivals</h2>
                                    </div>
                                    <div class="section__wrapper">
                                        <ul class="sidebar__info-list mb-3" style="list-style: none; padding: 0;">
                                            @if ($ongoingFestivals->isNotEmpty())
                                                @php
                                                    $i=1;
                                                @endphp
                                                @foreach ($ongoingFestivals as $festival)
                                                <a href="{{ route('home.singlefestival',$festival->id) }}">
                                                    <li style="border: 2px solid #28a745; padding: 10px; border-radius: 8px; margin-bottom: 10px;">
                                                        <div style="font-weight: bold; color: #333;">{{ $i.')' }} Name:
                                                            <span style="color: #28a745;">{{ $festival->name }} (<small><span style="color: #007bff;">
                                                                {{ \Carbon\Carbon::parse($festival->start_date)->format('d F, Y') }}
                                                            </span></small>)</span>
                                                        </div>
                                                        @php $i++; @endphp
                                                    </li>
                                                </a>
                                                @endforeach
                                            @else
                                                <li style="border: 2px solid #28a745; padding: 10px; border-radius: 8px; margin-bottom: 10px;">
                                                    <div style="font-weight: bold; color: #333;"><i class="fas fa-times text-danger"> </i>  No Festivals Currently</div>
                                                </li>
                                            @endif
                                        </ul>
                                    </div>
                                    <div class="sidebar__info">
                                        <div class="section__header bg-primary">
                                            <h2 class="text-white">Upcoming Festivals</h2>
                                        </div>
                                        <div class="section__wrapper">
                                            <ul class="sidebar__info-list mb-3" style="list-style: none; padding: 0;">
                                                @if ($upcomingFestivals->isNotEmpty())
                                                    @php
                                                        $i=1;
                                                    @endphp
                                                    @foreach ($upcomingFestivals as $festival)
                                                    <a href="{{ route('home.singlefestival',$festival->id) }}">
                                                        <li style="border: 2px solid #007bff; padding: 10px; border-radius: 8px; margin-bottom: 10px;">
                                                            <div style="font-weight: bold; color: #333;">{{ $i.')' }} Name:
                                                                <span style="color: #007bff;">{{ $festival->name }} (<small><span style="color: #28a745;">
                                                                    {{ \Carbon\Carbon::parse($festival->start_date)->format('d F, Y') }}
                                                                </span></small>)</span>
                                                            </div>
                                                            @php
                                                            $i++;
                                                        @endphp
                                                        </li>
                                                    </a>
                                                    @endforeach
                                                @else
                                                <li style="border: 2px solid #007bff; padding: 10px; border-radius: 8px; margin-bottom: 10px;">
                                                    <div style="font-weight: bold; color: #333;"><i class="fas fa-times text-danger"> </i>  No Upcoming Festivals</div>
                                                </li>
                                                @endif
                                            </ul>
                                        </div>
                                    </div>
                                {{-- @foreach($temple->festivals as $festival)
                                    @php
                                        $startDate = \Carbon\Carbon::parse($festival['start_date']);
                                        $endDate = \Carbon\Carbon::parse($festival['end_date']);
                                        $now = now();
                                    @endphp

                                    @if ($startDate <= $now && $endDate >= $now)

                                        <p>
                                            <b>{{ $festival['name'] }} Festival (on-going)</b> <br>
                                            <span><b>From:</b> {{ $startDate->format('d M, Y') }}</span>
                                            <span><b>To:</b> {{ $endDate->format('d M, Y') }}</span>
                                        </p>
                                    @elseif ($startDate > $now)
                                        s
                                        <p>
                                            <b>{{ $festival['name'] }} Festival (Upcoming)</b> <br>
                                            <span><b>From:</b> {{ $startDate->format('d M, Y') }}</span>
                                            <span><b>To:</b> {{ $endDate->format('d M, Y') }}</span>
                                        </p>
                                    @endif
                                @endforeach --}}
                            @endif


                                {{-- <p>Temple Description : {{ $temple->description}}</p> --}}
                            </div>



                            <div class="text-center mb-4">
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#liveDarshanModal">
                                    Live Darshan
                                </button>
                            </div>
                    {{-- </div>  --}}

            </div>
          </div>
        </div>
    </div>

    <div class="card card-primary">
        <div class="card-header">
          <h5 class="text-center section-title">{{ $temple->name }} Images</h5>
        </div>
        <div class="card-body" id="card-body">
            <div class="photobanner__wrap">
                <div class="photobanner">
                    @foreach ($temple->images as $image)
                        @foreach ($temple->images as $image)
                            <img src="{{ asset($image->image_url) }}" alt="" />
                        @endforeach
                    @endforeach
                </div>
              <div>
        </div>
    </div>
  </section>


  <div class="modal fade" id="liveDarshanModal" tabindex="-1" aria-labelledby="liveDarshanModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="liveDarshanModalLabel">Live Darshan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-center">
                @if(!empty($temple->live_darshan))
                    @php
                        // Ensure autoplay and mute parameters are added to the src
                        $embedSrc = $temple->live_darshan;
                        if (strpos($embedSrc, '?') === false) {
                            $embedSrc .= '?autoplay=1&mute=1';
                        } else {
                            $embedSrc .= '&autoplay=1&mute=1';
                        }
                    @endphp

                    <div class="iframe-container">
                        <iframe
                            width="80%"
                            height="600"
                            src="{{ $embedSrc }}"
                            frameborder="0"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                            allowfullscreen>
                        </iframe>
                    </div>
                @else
                    <p>Live Darshan is not available at the moment.</p>
                @endif
            </div>
        </div>
    </div>
</div>
<div class="col-12 col-sm-12 col-lg-12">
    <div class="card card-primary">
      <div class="card-header">
        <h5 class="text-center section-title">Temple Region Management Resoultion</h5>
      </div>
      <div class="card-body">
        <div class="row">
            <div class="col-12 col-md-6 col-lg-3">
              <div class="card card-primary">
                <div class="card-header">
                  <h4>Multipurpose Distribution And Operation Rooms</h4>
                </div>
                <div class="card-body">
                    <div class="temp_img">
                        <img class="temp" src="https://srjbtkshetra.org/wp-content/uploads/2021/03/icon32-1.png" alt="">
                    </div>
                </div>
              </div>
            </div>
            <div class="col-12 col-md-6 col-lg-3">
              <div class="card card-secondary">
                <div class="card-header">
                  <h4>Bank/ATM</h4>
                </div>
                <div class="card-body">
                    <div class="temp_img">
                        <img class="temp" src="https://srjbtkshetra.org/wp-content/uploads/2021/03/icon31-1.png" alt="">
                    </div>
                </div>
              </div>
            </div>
            <div class="col-12 col-md-6 col-lg-3">
              <div class="card card-danger">
                <div class="card-header">
                  <h4>Emergency Medical Aid</h4>
                </div>
                <div class="card-body">
                    <div class="temp_img">
                        <img class="temp" src="https://srjbtkshetra.org/wp-content/uploads/2021/03/icon29-1.png" alt="">
                    </div>
                </div>
              </div>
            </div>
            <div class="col-12 col-md-6 col-lg-3">
              <div class="card card-warning">
                <div class="card-header">
                  <h4>Ramps for Elder Devotees to reach the Temple</h4>
                </div>
                <div class="card-body">
                    <div class="temp_img">
                        <img class="temp" src="https://srjbtkshetra.org/wp-content/uploads/2021/03/icon28-1.png" alt="">
                    </div>
                </div>
              </div>
            </div>
            <div class="col-12 col-md-6 col-lg-3">
                <div class="card card-primary">
                  <div class="card-header">
                    <h4>Solar Energy  Center</h4>
                  </div>
                  <div class="card-body">
                      <div class="temp_img">
                          <img class="temp" src="https://srjbtkshetra.org/wp-content/uploads/2021/03/icon27-1.png" alt="">
                      </div>
                  </div>
                </div>
              </div>
              <div class="col-12 col-md-6 col-lg-3">
                <div class="card card-secondary">
                  <div class="card-header">
                    <h4>Pilgrim Facility Centre</h4>
                  </div>
                  <div class="card-body">
                      <div class="temp_img">
                          <img class="temp" src="https://srjbtkshetra.org/wp-content/uploads/2021/03/icon26-1.png" alt="">
                      </div>
                  </div>
                </div>
              </div>
              <div class="col-12 col-md-6 col-lg-3">
                <div class="card card-danger">
                  <div class="card-header">
                    <h4>Administrative Office</h4>
                  </div>
                  <div class="card-body">
                      <div class="temp_img">
                          <img class="temp" src="https://srjbtkshetra.org/wp-content/uploads/2021/03/icon24-1.png" alt="">
                      </div>
                  </div>
                </div>
              </div>
              <div class="col-12 col-md-6 col-lg-3">
                <div class="card card-warning">
                  <div class="card-header">
                    <h4>Visitor Management System</h4>
                  </div>
                  <div class="card-body">
                      <div class="temp_img">
                          <img class="temp" src="https://srjbtkshetra.org/wp-content/uploads/2021/03/icon22-1.png" alt="">
                      </div>
                  </div>
                </div>
              </div>


          </div>
      </div>
    </div>
</div>

@endsection
