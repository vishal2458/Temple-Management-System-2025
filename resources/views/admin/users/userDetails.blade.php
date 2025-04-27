@extends('layouts.main')

@section('title', 'User Details')
@section('main-content')

    <section class="section">
      <div class="section-header">
        <h1>User Details</h1>
        <div class="section-header-breadcrumb">
          <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
          <div class="breadcrumb-item">Users</div>
          <div class="breadcrumb-item">User Details</div>
        </div>
      </div>
      <div class="section-body">
        <div class="row mt-sm-4">
          <div class="col-12 col-md-12 col-lg-5">
            <div class="card profile-widget animated fadeIn">
              <div class="profile-widget-header">
                <img id="profile-picture-preview"
                        alt="Profile Picture"
                        src="{{ asset($user->profile_picture ?? 'assets/img/avatar/avatar-1.png') }}"
                        class="rounded-circle profile-widget-picture"
                        style="cursor: pointer; width: 100px; height: 100px; object-fit: cover;">
                <div class="profile-widget-items">
                  <div class="profile-widget-item">
                    <div class="profile-widget-item-label">Darshans</div>
                    <div class="profile-widget-item-value">{{ $totalBookings  }}</div>
                  </div>
                  <div class="profile-widget-item">
                    <div class="profile-widget-item-label">Donations</div>
                    <div class="profile-widget-item-value">Rs {{ $totalDonationAmount  }}</div>
                  </div>
                </div>
              </div>
              <div class="profile-widget-description">
                <div class="profile-widget-name">{{ $user->first_name.' '.$user->middle_name.' '.$user->last_name }}
                  <div class="text-muted d-inline font-weight-normal"><div class="slash"></div> {{ $user->userDetails->country['name'] ?? '' }}</div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-12 col-md-12 col-lg-7">
            <div class="card animated fadeInUp">
              <div class="card-header">
                <h4>Basic Details</h4>
              </div>
              <div class="card-body">
                <div class="row">
                  <div class="form-group col-md-4 col-12">
                    <label>First Name</label>
                    <p class="form-control-static">{{ $user->first_name }}</p>
                  </div>
                  <div class="form-group col-md-4 col-12">
                    <label>Middle Name</label>
                    <p class="form-control-static">{{ $user->middle_name }}</p>
                  </div>
                  <div class="form-group col-md-4 col-12">
                    <label>Last Name</label>
                    <p class="form-control-static">{{ $user->last_name }}</p>
                  </div>
                </div>
                <div class="row">
                  <div class="form-group col-md-4 col-12">
                    <label>Email</label>
                    <p class="form-control-static">{{ $user->email }}</p>
                  </div>
                  <div class="form-group col-md-4 col-12">
                    <label>Phone</label>
                    <p class="form-control-static">{{ $user->mobile_no }}</p>
                  </div>
                  <div class="form-group col-md-4 col-12">
                    <label>Gender</label>
                    <p class="form-control-static">{{ $user->gender }}</p>
                  </div>
                </div>
              </div>
            </div>

            <div class="card animated fadeInUp delay-1">
              <div class="card-header">
                <h4>Necessary Details</h4>
              </div>
              <div class="card-body">
                <div class="row">
                  <div class="form-group col-md-4 col-12">
                    <label>Country</label>
                    <p class="form-control-static">{{ $user->userDetails->country['name'] ?? 'N/A' }}</p>
                  </div>
                  <div class="form-group col-md-4 col-12">
                    <label>State</label>
                    <p class="form-control-static">{{ $user->userDetails->state['name'] ?? 'N/A' }}</p>
                  </div>
                  <div class="form-group col-md-4 col-12">
                    <label>City</label>
                    <p class="form-control-static">{{ $user->userDetails->city['name'] ?? 'N/A' }}</p>
                  </div>
                </div>
                <div class="row">
                  <div class="form-group col-md-6 col-12">
                    <label>Pincode / Zipcode</label>
                    <p class="form-control-static">{{ $user->userDetails->pincode ?? 'N/A' }}</p>
                  </div>
                  <div class="form-group col-md-6 col-12">
                    <label>Birth Date</label>
                    <p class="form-control-static">{{ $user->userDetails->dob ?? 'N/A' }}</p>
                  </div>
                </div>
                @if (!empty($user->userDetails->adhar_card_number) && !empty($user->userDetails->pan_card_number))
                    <div class="row">
                        <div class="form-group col-md-6 col-6">
                            <label>Adharcard Number</label>
                            <p class="form-control-static">{{ $user->userDetails->adhar_card_number }}</p>
                        </div>
                        <div class="form-group col-md-6 col-6">
                            <label>Pancard Number</label>
                            <p class="form-control-static">{{ $user->userDetails->pan_card_number }}</p>
                        </div>
                    </div>
                @endif
                @if (!empty($user->userDetails->passport_number))
                <div class="row">
                    <div class="form-group col-md-6 col-12">
                        <label>Passport Number</label>
                        <p class="form-control-static">{{ $user->userDetails->passport_number ?? 'N/A' }}</p>
                      </div>
                  </div>
                </div>
                @endif
            </div>
            @if(isset($user->userDetails) && $user->userDetails->adhar_card_image || isset($user->userDetails) && $user->userDetails->pan_card_image || isset($user->userDetails) && $user->userDetails->passport_image )
                <div class="card animated fadeInUp delay-2">
                <div class="card-header">
                    <h4>Document Images</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                    @if(isset($user->userDetails) && $user->userDetails->adhar_card_image)
                        <div class="form-group col-md-4 col-12">
                        <label>Aadhaar Card Image</label>
                        <a href="javascript:void(0);" class="document-link" data-image="{{ asset($user->userDetails->adhar_card_image) }}">
                            <img src="{{ asset($user->userDetails->adhar_card_image) }}" alt="Aadhaar Card" class="img-thumbnail document-thumbnail">
                        </a>
                        </div>
                    @endif
                    @if(isset($user->userDetails) && $user->userDetails->pan_card_image)
                        <div class="form-group col-md-4 col-12">
                        <label>Pan Card Image</label>
                        <a href="javascript:void(0);" class="document-link" data-image="{{ asset($user->userDetails->pan_card_image) }}">
                            <img src="{{ asset($user->userDetails->pan_card_image) }}" alt="Pan Card" class="img-thumbnail document-thumbnail">
                        </a>
                        </div>
                    @endif
                    @if(isset($user->userDetails) && $user->userDetails->passport_image)
                        <div class="form-group col-md-4 col-12">
                        <label>Passport Image</label>
                        <a href="javascript:void(0);" class="document-link" data-image="{{ asset($user->userDetails->passport_image) }}">
                            <img src="{{ asset($user->userDetails->passport_image) }}" alt="Passport" class="img-thumbnail document-thumbnail">
                        </a>
                        </div>
                    @endif
                    </div>
                </div>
                </div>
            @endif
          </div>
        </div>
      </div>
    </section>

    <!-- Document Modal -->
    <div class="modal fade" id="documentModal" tabindex="-1" aria-labelledby="documentModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="documentModalLabel">Document Image</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body text-center">
            <img id="document-img" src="" alt="Document Image" class="img-fluid">
          </div>
        </div>
      </div>
    </div>
@endsection

@push('script')
<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Handle document image clicks
        document.querySelectorAll(".document-link").forEach(function(link) {
            link.addEventListener("click", function() {
                let imageUrl = this.getAttribute("data-image");
                document.getElementById("document-img").src = imageUrl;
                $("#documentModal").modal("show");
            });
        });
    });
</script>
@endpush

@push('style')
<style>
    .animated {
        animation-duration: 1s;
    }
    .delay-1 {
        animation-delay: 0.2s;
    }
    .delay-2 {
        animation-delay: 0.4s;
    }
    .document-thumbnail {
        width: 100%;
        height: 150px;
        object-fit: cover;
        transition: transform 0.3s ease;
    }
    .document-thumbnail:hover {
        transform: scale(1.05);
    }
</style>
@endpush
