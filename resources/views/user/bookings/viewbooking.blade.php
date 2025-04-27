@extends('layouts.main')

@section('title', 'Booking Detail')
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
  animation-duration: 40s;
  animation-timing-function: linear;
  animation-iteration-count: infinite;
}

.photobanner img {
  width: 350px;
  height: 250px;
  object-fit: cover;
  padding-right: 20px;
}

@keyframes swiperAnimation{
  0%{
    transform:translateX(0)
  }
  100% {
    transform:translateX(-100%)
  }
}
.temp_img{
    padding: 0px 57px;
}
img.temp {
    width: 70px;
}
</style>
@endpush

@section('main-content')
<section class="section">
    <div class="section-header">
      <h1>Booking Detail</h1>
      <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
        <div class="breadcrumb-item">Booking</div>
        <div class="breadcrumb-item"><a href="#">View Booking Details</a></div>
      </div>
    </div>
      <div class="row">
        <div class="col-12 col-sm-6 col-lg-6">
          <div class="card card-primary">
            <div class="card-header">
              <h5 class="text-center section-title">{{ $booking->temple['name'] }}</h5>
            </div>
            <div class="card-body">
              <div class="chocolat-parent">
                  <div data-crop-image="285">
                    <img alt="image" src="{{ asset($booking->temple['main_image']) }}" class="img-fluid">
                  </div>
                </a>
              </div>
              <div class="chocolat-parent">
                <div data-crop-image="285">
                    <div class="row">
                        <div class="col-6">
                            <h6 class="mt-2">User Details<br></h6>
                            <p>Name : {{ $booking->user->first_name.' '.$booking->user->middle_name.' '.$booking->user->last_name }} </p>
                            <p>Email : {{ $booking->user->email }}</p>
                            <p>Mobile No : {{ $booking->user->mobile_no }}</p>
                            <p>Birth Day : {{ $booking->user->userDetails->dob}}</p>
                            <p>From : {{ $booking->user->userDetails->city['name'].' - '.$booking->user->userDetails->state['name'].' - '.$booking->user->userDetails->country['name'] }}</p>
                        </div>
                        <div class="col-6">
                            <h6 class="mt-2">Temple Details<br></h6>
                            <p>Name : {{ $booking->temple['name'] }}</p>
                            <p>Email : {{ $booking->temple['email'] }} </p>
                            <p>Mobile No : {{ $booking->temple['phone'] }} </p>
                            <p>Darshan Date : {{ $booking->booking_date }} </p>
                            <p>Location : {{ $booking->temple->city.' - '.$booking->temple->state.' - '.$booking->temple->country }}</p>
                    </div>
                </div>
              </div>
          </div>
            </div>
          </div>
        </div>
        <div class="col-12 col-sm-6 col-lg-6">
          <div class="card card-primary">
            <div class="card-header">
              <h5 class="text-center section-title">User and Temple Details</h5>
            </div>
            <div class="card-body">
                <div class="mt-3">
                    <h6>Temple Address</h6>
                    <p>{{ $booking->temple->address }}</p>
                  </div>
                      <div class="mt-3">
                        <h6>About  {{ $booking->temple->name }}</h6>
                        <p>{{ $booking->temple->description }}</p>
                      </div>
            </div>
          </div>
        </div>

    <div class="card card-primary">
        <div class="card-header">
          <h5 class="text-center section-title">Temple Images</h5>
        </div>
        <div class="card-body">
            <div class="photobanner__wrap">
                <div class="photobanner">
                    @foreach ($booking->temple->images as $image)
                        @foreach ($booking->temple->images as $image)
                            <img src="{{ asset($image->image_url) }}" alt="" />
                        @endforeach
                    @endforeach
                </div>
            <div>
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


  </section>


@endsection
