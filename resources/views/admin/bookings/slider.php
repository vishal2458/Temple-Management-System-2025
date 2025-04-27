@extends('layouts.main')

@section('title', 'Bookings')
@push('css')
<style>

.container {
	width: auto;
	overflow: hidden;
	margin: 50px auto;
	background: white;
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
            <h1>Darshan Bookings</h1>
        </div>

        <div class="container">
            <header>
             <h1>Automatic Multiple Image Slider</h1>
            </header>
          <div class="photobanner__wrap">
            <div class="photobanner">
                <img src="https://picsum.photos/350/250" alt="" />
                <button class="btn btn-primary">viw</button>
               <img src="https://picsum.photos/350/250" alt="" />
              <img src="https://picsum.photos/350/250" alt="" />
              <img src="https://picsum.photos/350/250" alt="" />
              <img src="https://picsum.photos/350/250" alt="" />
              <img src="https://picsum.photos/350/250" alt="" />
            </div>
            <div class="photobanner">
                <img src="https://picsum.photos/350/250" alt="" />
              <img src="https://picsum.photos/350/250" alt="" />
              <img src="https://picsum.photos/350/250" alt="" />
              <img src="https://picsum.photos/350/250" alt="" />
              <img src="https://picsum.photos/350/250" alt="" />
              <img src="https://picsum.photos/350/250" alt="" />
            </div>
          <div>
        </div>
    </section>
@endsection

@push('script')

<style>
    #slider {
  position: relative;
  width: 50%;
  height: 32vw;
  margin: 150px auto;
  font-family: 'Helvetica Neue', sans-serif;
  perspective: 1400px;
  transform-style: preserve-3d;
}

input[type=radio] {
  position: relative;
  top: 108%;
  left: 50%;
  width: 18px;
  height: 18px;
  margin: 0 15px 0 0;
  opacity: 0.4;
  transform: translateX(-83px);
  cursor: pointer;
}

input[type=radio]:nth-child(5) {
  margin-right: 0px;
}

input[type=radio]:checked {
  opacity: 1;
}

#slider label, #slider label img {
  position: absolute;
  width: 100%;
  height: 100%;
  left: 0;
  top: 0;
  color: white;
  font-size: 70px;
  font-weight: bold;
  border-radius: 3px;
  cursor: pointer;
  display: flex;
  align-items: center;
  justify-content: center;
  transition: transform 400ms ease;
}

/* Active Slide */
#s1:checked ~ #slide1,
 #s2:checked ~ #slide2,
  #s3:checked ~ #slide3,
   #s4:checked ~ #slide4,
    #s5:checked ~ #slide5 {
  box-shadow: 0 13px 26px rgba(0,0,0, 0.3), 0 12px 6px rgba(0,0,0, 0.2);
  transform: translate3d(0%, 0, 0px);
}

/* Next Slide */
#s1:checked ~ #slide2,
 #s2:checked ~ #slide3,
  #s3:checked ~ #slide4,
   #s4:checked ~ #slide5,
    #s5:checked ~ #slide1 {
  box-shadow: 0 6px 10px rgba(0,0,0, 0.3), 0 2px 2px rgba(0,0,0, 0.2);
  transform: translate3d(20%, 0, -100px);
  filter: brightness(50%);
  -webkit-backdrop-filter: blur(10px);
  backdrop-filter: blur(10px);
}

/* Next to Next Slide */
#s1:checked ~ #slide3,
 #s2:checked ~ #slide4,
  #s3:checked ~ #slide5,
   #s4:checked ~ #slide1,
    #s5:checked ~ #slide2 {
  box-shadow: 0 1px 4px rgba(0,0,0, 0.4);
  transform: translate3d(40%, 0, -250px);
  filter: brightness(50%);
  -webkit-backdrop-filter: blur(10px);
  backdrop-filter: blur(10px);
}

/* Previous to Previous Slide */
#s1:checked ~ #slide4,
 #s2:checked ~ #slide5,
  #s3:checked ~ #slide1,
   #s4:checked ~ #slide2,
    #s5:checked ~ #slide3 {
  box-shadow: 0 1px 4px rgba(0,0,0, 0.4);
  transform: translate3d(-40%, 0, -250px);
  filter: brightness(50%);
  -webkit-backdrop-filter: blur(10px);
  backdrop-filter: blur(10px);
}

/* Previous Slide */
#s1:checked ~ #slide5,
 #s2:checked ~ #slide1,
  #s3:checked ~ #slide2,
   #s4:checked ~ #slide3,
    #s5:checked ~ #slide4 {
  box-shadow: 0 6px 10px rgba(0,0,0, 0.3), 0 2px 2px rgba(0,0,0, 0.2);
  transform: translate3d(-20%, 0, -100px);
  filter: brightness(50%);
  -webkit-backdrop-filter: blur(10px);
  backdrop-filter: blur(10px);
}
</style>
@endpush
