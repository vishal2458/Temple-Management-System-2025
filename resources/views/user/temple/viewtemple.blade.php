@extends('user.userlayouts.main')

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
    .confetti-text {
            position: fixed;
            font-size: 30px;
            font-weight: bold;
            color: orange;
            opacity: 0.9;
            animation: confetti-fall 2.5s ease-out forwards;
            white-space: nowrap;
        }

        @keyframes confetti-fall {
            0% {
                opacity: 1;
                transform: translate(0, 0) scale(1) rotate(0);
            }
            100% {
                opacity: 0;
                transform: translate(var(--x), var(--y)) scale(0.8) rotate(720deg);
            }
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
                                <button type="button" class="btn btn-warning" id="booking_button">
                                    Visit Temple
                                </button>
                                <button type="button" class="btn btn-info" id="donate_button">
                                    Donate
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
    {{-- Uncomment it --}}


    {{-- <div class="card card-primary">
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
    </div> --}}
  </section>
    {{-- Live Darshan Modal --}}
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
                                    <input type="text" class="form-control"  value="{{ Auth::user()->first_name.' '.Auth::user()->last_name }}" disabled style="min-width: 100%">
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="booking_date">Booking Date</label>
                            <input type="date" name="booking_date" class="form-control" id="booking_date" required>
                        </div>
                        <div class="mb-3">
                            <label for="temple_name">Temple Name</label>
                            <input type="text" name="temple_name" class="form-control" value="{{ $temple->name }}" disabled >
                        </div>
                        <input type="hidden" name="temple_id" id="temple_id" value={{ $temple->id }}>
                        <input type="hidden" name="user_id" id="user_id" value={{ Auth::user()->id }}>
                        <button type="submit" class="btn btn-warning">Book Now</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div id="donationModal" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0, 0, 0, 0.6); backdrop-filter: blur(5px); z-index: 1000; justify-content: center; align-items: center;">
        <div style="width: 400px; background: white; border-radius: 10px; padding: 20px; box-shadow: 4px 4px 20px rgba(0, 0, 0, 0.2); position: relative; animation: fadeIn 0.3s ease-in-out;">
            <div style="display: flex; justify-content: space-between; align-items: center;">
                <h6 style="margin: 0;">Donation for</h6>
                <p style="margin: 0;"> <b>{{ $temple->name }}</b></p>
                <span id="closeModal" style="font-size: 22px; cursor: pointer;">&times;</span>
            </div>
            <!-- Modal Content -->
            <div style="margin-top: 15px;">
                <input type="text" id="name" required class="form-control"
                    style="width: 100%; margin: 10px 0; padding: 10px; border-radius: 5px; border: 1px solid #ddd;" value="{{ Auth::User()->first_name .' '.Auth::User()->last_name }}" disabled>
                <input type="number" id="donationAmount2" placeholder="Enter amount in INR" min="1" class="form-control"
                    style="width: 100%; margin: 10px 0; padding: 10px; border-radius: 5px; border: 1px solid #ddd;">
                <h3>Select Payment Method:</h3>
                <div style="justify-content: space-around; margin-top: 10px;">
                    <img src="{{ asset('assets/img/upi.png') }}" alt="UPI" id="upiOption" style="width: 81px;margin-left:45px; cursor: pointer; transition: transform 0.3s;"
                        onmouseover="this.style.transform='scale(1.1)'" onmouseout="this.style.transform='scale(1)'">
                    <img src="{{ asset('assets/img/mastercard.png') }}" alt="Credit Card" id="cardOption" style="width: 83px;margin-left:85px;height:50px cursor: pointer; transition: transform 0.3s;"
                        onmouseover="this.style.transform='scale(1.1)'" onmouseout="this.style.transform='scale(1)'">
                </div>

                <!-- UPI Payment -->
                <div id="qrCodeContainer" style="display: none; text-align: center; margin-top: 15px;">
                    <h3>Scan to Pay</h3>
                    <img src="{{ asset('assets/img/QRcode.png') }}" alt="QR Code" width="200">
                    {{-- <button type="button" id="donatebutton" style="width: 100%; margin: 10px 0; padding: 10px; border-radius: 5px; border: none; background-color: #2ecc71; color: white; font-size: 18px; cursor: pointer;">Donate</button> --}}
                </div>

                <!-- Credit Card Form -->
                <div id="cardForm" style="display: none; margin-top: 15px;">
                    <input type="text" placeholder="Card Number" maxlength="16" required
                        style="width: 100%; margin: 10px 0; padding: 10px; border-radius: 5px; border: 1px solid #ddd;">
                    <input type="text" placeholder="Card Holder Name" required
                        style="width: 100%; margin: 10px 0; padding: 10px; border-radius: 5px; border: 1px solid #ddd;">
                    <input type="text" placeholder="Expiry MM/YY" maxlength="5" required
                        style="width: 100%; margin: 10px 0; padding: 10px; border-radius: 5px; border: 1px solid #ddd;">
                    <input type="text" placeholder="CVV" maxlength="3" required
                        style="width: 100%; margin: 10px 0; padding: 10px; border-radius: 5px; border: 1px solid #ddd;">
                    {{-- <button type="button" id="donatebutton" style="width: 100%; margin: 10px 0; padding: 10px; border-radius: 5px; border: none; background-color: #2ecc71; color: white; font-size: 18px; cursor: pointer;">Donate</button> --}}
                </div>
                <button type="button" id="donatebutton" style="display:none;width: 100%; margin: 10px 0; padding: 10px; border-radius: 5px; border: none; background-color: #2ecc71; color: white; font-size: 18px; cursor: pointer;">Donate</button>
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

@push('script')

<script>
    document.addEventListener("DOMContentLoaded", function () {
        let selectedPaymentMethod = null;

        // Open Modal
        document.getElementById("donate_button").addEventListener("click", function () {
            document.getElementById("donationModal").style.display = "flex";
        });

        // Close Modal
        document.getElementById("closeModal").addEventListener("click", function () {
            let selectedPaymentMethod = null;
            document.getElementById("donationAmount2").value = "";
            document.getElementById("qrCodeContainer").style.display = "none";
            document.getElementById("cardForm").style.display = "none";
            document.getElementById("donationModal").style.display = "none";
        });

        document.getElementById("upiOption").addEventListener("click", function () {
            handlePaymentSelection("UPI");
        });

        document.getElementById("cardOption").addEventListener("click", function () {
            handlePaymentSelection("Credit Card");
        });
        // Handle Donation
        document.getElementById("donatebutton").addEventListener("click", function () {
            let amount = document.getElementById("donationAmount2").value;

            if (!amount || amount <= 0) {
                alert("Please enter a valid donation amount.");
                return;
            }

            if (!selectedPaymentMethod) {
                alert("Please select a payment method.");
                return;
            }

            // document.getElementById("paymentprocess").style.display = "flex"; // Show processing modal
            document.getElementById("donationModal").style.display = "none"; // Hide donation modal
            Swal.fire({
                title: "Processing...",
                text: "Please wait while we process your Donation.",
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });


            fetch('/user/donations', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({
                    amount: amount,
                    payment_method: selectedPaymentMethod,
                    temple_id: "{{ $temple->id }}"
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    setTimeout(() => {
                        // document.getElementById("paymentprocess").style.display = "none"; // Hide processing modal
                        createCornerFireworksConfetti(); // Fireworks animation

                        Swal.fire({
                            title: "🙏 Thank You for Your Donation! 🙏",
                            text: "Your contribution has been received successfully. You can download your receipt below.",
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

                    }, 5000);
                } else {
                    alert("Failed to process donation.");
                }
            })
            .catch(error => {
                console.error("Error:", error);
                alert("An error occurred.");
            });
        });

        function createCornerFireworksConfetti() {
            var duration = 3000;
            var end = Date.now() + duration;
            (function frame() {
                confetti({ particleCount: 10, angle: 60, spread: 70, origin: { x: 0, y: Math.random() } });
                confetti({ particleCount: 10, angle: 120, spread: 70, origin: { x: 1, y: Math.random() } });
                if (Date.now() < end) {
                    requestAnimationFrame(frame);
                }
            })();
        }
        function handlePaymentSelection(method) {
            selectedPaymentMethod = method; // Set selected method

            if (selectedPaymentMethod === "UPI") {
                document.getElementById("qrCodeContainer").style.display = "block";
                document.getElementById("cardForm").style.display = "none";
            } else if (selectedPaymentMethod === "Credit Card") {
                document.getElementById("qrCodeContainer").style.display = "none";
                document.getElementById("cardForm").style.display = "block";
            }

            // Show the payment button if a method is selected
            if (selectedPaymentMethod !== "") {
                document.getElementById("donatebutton").style.display = "block";
            }
        }
    });
</script>

<script>
    $(document).ready(function() {
        $('#booking_button').on('click', function() {
            $('#bookingModal').modal('show');
        });
    });
    document.addEventListener("DOMContentLoaded", function () {
        $("#bookingForm").submit(function (event) {
            event.preventDefault(); // Prevent default form submission

            let form = $(this);
            let formData = form.serializeArray();
            let bookingDate = formData.find(item => item.name === 'booking_date')?.value || '';
            let finalData = $.param(formData);
            let today = new Date().toISOString().split("T")[0];
            if (bookingDate < today) {
                Swal.fire({
                    icon: "error",
                    title: "Invalid Date",
                    text: "You cannot book for past days!",
                });
                return;
            }
            let threeMonthsLater = new Date();
            threeMonthsLater.setMonth(threeMonthsLater.getMonth() + 3);
            threeMonthsLater = threeMonthsLater.toISOString().split("T")[0];

            if (bookingDate < today || bookingDate > threeMonthsLater) {
                Swal.fire({
                    icon: "error",
                    title: "Invalid Date",
                    text: "You can only book within the next 3 months!",
                });
                return;
            }
            // document.getElementById("bookingprocess").style.display = "flex"; // Show processing modal
            Swal.fire({
                title: "Booking...",
                text: "Please wait Your Booking is in Progress",
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
         function generateAndSendPDF(bookingDate,generateReferenceNumber) {
            if (!window.jspdf) {
                console.error("jsPDF library not loaded");
                return;
            }
            const { jsPDF } = window.jspdf;
            const doc = new jsPDF();
            const tableData = [
                ["Temple Name", "{{ $temple->name }}"],
                ["Darshan Date", bookingDate],
                ["Booking Number", generateReferenceNumber],
            ];

            doc.autoTable({
                head: [['', '']],
                body: tableData,
                startY: 20,
            });

            // Convert the PDF to Base64
            const pdfBase64 = doc.output("datauristring");

            // Send PDF to Laravel backend
            fetch('/store-booking-pdf', {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({
                    pdf: pdfBase64,
                    reference_number: generateReferenceNumber
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    setTimeout(() => {
                        document.getElementById("donationModal").style.display = "none";
                        createCornerFireworksConfetti();
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
                                createCornerFireworksConfetti();
                                showJaiShreeRam();
                                const link = document.createElement("a");
                                link.href = data.file_path;
                                link.download = `Darshan_Receipt_${generateReferenceNumber}.pdf`;
                                document.body.appendChild(link);
                                link.click();
                                document.body.removeChild(link);
                                document.getElementById("bookingForm").reset();
                            }
                        });
                    }, 2000);
                } else {
                    console.error("Failed to store PDF:", data.message);
                }
            })
            .catch(error => {
                console.error("Error storing PDF:", error);
            });
        }

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






















  {{-- <script>
    $(document).ready(function() {
        $('#booking_button').on('click', function() {
            $('#bookingModal').modal('show');
        });
    });
    document.addEventListener("DOMContentLoaded", function () {
        $("#bookingForm").submit(function (event) {
            event.preventDefault(); // Prevent default form submission

            let form = $(this);
            let formData = form.serializeArray(); // Convert form data to an array
            let generateReferenceNumber  = "Darshan" + Math.floor(Math.random() * 1000000);
            formData.push({ name: 'booking_id', value: generateReferenceNumber });
            let bookingDate = formData.find(item => item.name === 'booking_date')?.value || '';
            let finalData = $.param(formData);
            let today = new Date().toISOString().split("T")[0];
            if (bookingDate < today) {
                Swal.fire({
                    icon: "error",
                    title: "Invalid Date",
                    text: "You cannot book for past days!",
                });
                return;
            }
            $.ajax({
                url: "{{ route('user.bookings.store') }}",
                type: "POST",
                data: formData,
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                },
                success: function (response) {
                    $('#bookingModal').modal('hide');
                    generateAndSendPDF(bookingDate,generateReferenceNumber);
                    // Swal.fire({
                    //     title: "🎉 Booking Successful! 🎉",
                    //     html: "<p>Dear Devotee, your temple visit is confirmed. 🙏</p>" +
                    //         "<p><strong>See you at the Darshan! May you be blessed with peace and prosperity. 🕉️</strong></p>",
                    //     icon: "success",
                    //     confirmButtonText: "Jai Shri Ram 🚩"
                    // }).then(() => {
                    //     createCornerFireworksConfetti();
                    //     showJaiShreeRam();
                    //     form[0].reset();
                    // });
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
         function generateAndSendPDF(bookingDate,generateReferenceNumber) {
            if (!window.jspdf) {
                console.error("jsPDF library not loaded");
                return;
            }
            const { jsPDF } = window.jspdf;
            const doc = new jsPDF();
            const tableData = [
                ["Temple Name", "{{ $temple->name }}"],
                ["Darshan Date", bookingDate],
                ["Booking Number", generateReferenceNumber],
            ];

            doc.autoTable({
                head: [['', '']],
                body: tableData,
                startY: 20,
            });

            // Convert the PDF to Base64
            const pdfBase64 = doc.output("datauristring");

            // Send PDF to Laravel backend
            fetch('/store-booking-pdf', {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({
                    pdf: pdfBase64,
                    reference_number: generateReferenceNumber
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    setTimeout(() => {
                        document.getElementById("donationModal").style.display = "none";
                        document.getElementById("paymentprocess").style.display = "none"; // Show modal
                        createCornerFireworksConfetti();
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
                                createCornerFireworksConfetti();
                                showJaiShreeRam();
                                const link = document.createElement("a");
                                link.href = data.file_path;
                                link.download = `Darshan_Receipt_${generateReferenceNumber}.pdf`;
                                document.body.appendChild(link);
                                link.click();
                                document.body.removeChild(link);
                                document.getElementById("bookingForm").reset();
                            }
                        });
                    }, 2000);
                } else {
                    console.error("Failed to store PDF:", data.message);
                }
            })
            .catch(error => {
                console.error("Error storing PDF:", error);
            });
        }

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
</script> --}}
@endpush
