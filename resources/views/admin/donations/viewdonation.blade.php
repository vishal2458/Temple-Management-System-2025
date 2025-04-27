@extends('layouts.main')

@section('title', 'donation Detail')
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


</style>
@endpush

@section('main-content')
<section class="section">
    <div class="section-header">
      <h1>Donation Detail</h1>
      <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
        <div class="breadcrumb-item"><a href="#">Donation</a></div>
        <div class="breadcrumb-item"><a href="#">View Donation Details</a></div>
      </div>
    </div>
      <div class="row">
        <div class="col-12 col-sm-6 col-lg-6">
          <div class="card card-primary">
            <div class="card-header">
              <h5 class="text-center section-title">{{ $donation->temple['name'] }}</h5>
            </div>
            <div class="card-body">
              <div class="chocolat-parent">
                  <div data-crop-image="285">
                    <img alt="image" src="{{ asset($donation->temple['main_image']) }}" class="img-fluid">
                  </div>
                </a>
              </div>
            </div>
          </div>
        </div>
        <div class="col-12 col-sm-6 col-lg-6">
          <div class="card card-primary">
            <div class="card-header">
              <h5 class="text-center section-title">Donation and Temple Details</h5>
            </div>
            <div class="card-body">
              <div class="chocolat-parent">
                    <div data-crop-image="285">
                        <div class="row">
                            <div class="col-6">
                                <h6 class="mt-2">User Details<br></h6>
                                <p>Name : 
                                    {{ optional($donation->user)->first_name ?? 'Anonymous' }} 
                                    {{ optional($donation->user)->middle_name ?? '' }} 
                                    {{ optional($donation->user)->last_name ?? '' }}
                                </p>
                                
                                <p>Amount : {{ $donation->amount }}</p>
                                <p>Receipt No : {{ $donation->receipt_number }}</p>
                                <p>Transation Id : {{ $donation->transaction_id }}</p>
                                <p>Donated on : {{ $donation->donation_date}}</p>
                                <p>Country : {{ optional(optional($donation->user)->userDetails)->country->name ?? 'N/A' }}</p>
                            </div>
                            <div class="col-6">
                                <h6 class="mt-2">Temple Details<br></h6>
                                <p>Name : {{ $donation->temple['name'] }}</p>
                                <p>Email : {{ $donation->temple['email'] }} </p>
                                <p>Mobile No : {{ $donation->temple['phone'] }} </p>
                                <p>Location : {{ $donation->temple->city.' - '.$donation->temple->State.' - '.$donation->temple->country }}</p>
                        </div>
                    </div>
                  </div>
              </div>
            </div>
          </div>
        </div>
    </div>
    <div class="card card-primary">
        <div class="card-header">
          <h5 class="text-center section-title">Temple Images</h5>
        </div>
        {{-- {{ dd($donation->temple->images) }} --}}
        <div class="card-body">
            <div class="photobanner__wrap">
                <div class="photobanner">
                    @foreach ($donation->temple->images as $image)
                        @foreach ($donation->temple->images as $image)
                            <img src="{{ asset($image->image_url) }}" alt="" />
                        @endforeach
                    @endforeach
                </div>
              <div>
        </div>
    </div>
  </section>


@endsection
