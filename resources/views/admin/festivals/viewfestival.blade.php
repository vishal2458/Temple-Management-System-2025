@extends('layouts.main')

@section('title', 'festival Detail')
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
      <h1>festival Detail</h1>
      <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
        <div class="breadcrumb-item"><a href="#">festival</a></div>
        <div class="breadcrumb-item"><a href="#">View festival Details</a></div>
      </div>
    </div>
      <div class="row">
        <div class="col-12 col-sm-6 col-lg-6">
          <div class="card card-primary">
            <div class="card-header">
              <h5 class="text-center section-title">{{ $festival->temple['name'] }}</h5>
            </div>
            <div class="card-body">
              <div class="chocolat-parent">
                  <div data-crop-image="285">
                    <img alt="image" src="{{ asset($festival->temple['main_image']) }}" class="img-fluid">
                  </div>
                </a>
              </div>
              <div class="col-12">
                <p>The Celebration of <b>{{ $festival->name}}</b> will starts from <b>{{ $festival->start_date}}</b> to <b>{{ $festival->end_date}} </b>
                    <br>at <b> <a href="#">{{ $festival->temple['name'] }}</a> </b> located at <b>{{ $festival->temple->city }} {{ $festival->temple->state }} </b><br>
                </p>
             </div>
            </div>
          </div>
        </div>
        <div class="col-12 col-sm-6 col-lg-6">
          <div class="card card-primary">
            <div class="card-header">
              <h5 class="text-center section-title">Festival Details</h5>
            </div>
            <div class="card-body">
                        {{-- <div class="row"> --}}
                            <div class="col-12">
                                <h6 class="mt-2">Festival Details<br></h6>
                                <p>Name : {{ $festival->name}} </p>
                                <p>Celebration Starts on: {{ $festival->start_date}}</p>
                                <p>Celebration ends on: {{ $festival->end_date}}</p>
                                <p>About Festival: {{ $festival->festival_desc }}</p>
                            </div>



                    {{-- </div>  --}}

            </div>
          </div>
        </div>
    </div>
    <div class="card card-primary">
        <div class="card-header">
          <h5 class="text-center section-title">{{ $festival->temple->name }} Images</h5>
        </div>
        {{-- {{ dd($festival->temple->images) }} --}}
        <div class="card-body">
            <div class="photobanner__wrap">
                <div class="photobanner">
                    @foreach ($festival->temple->images as $image)
                        @foreach ($festival->temple->images as $image)
                            <img src="{{ asset($image->image_url) }}" alt="" />
                        @endforeach
                    @endforeach
                </div>
              <div>
        </div>
    </div>
  </section>


@endsection
