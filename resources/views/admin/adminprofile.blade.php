@extends('layouts.main')

@section('title', 'Profile')
@section('main-content')

    <section class="section">
      <div class="section-header">
        <h1>Profile</h1>
        <div class="section-header-breadcrumb">
          <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
          <div class="breadcrumb-item">Profile</div>
        </div>
      </div>
      <div class="section-body">
        <h2 class="section-title">Hi, {{ $user->first_name }}</h2>
        <p class="section-lead">
          Change information about yourself on this page.
        </p>

        <div class="row mt-sm-4">
          <div class="col-12 col-md-12 col-lg-5">
            <div class="card profile-widget">
              <div class="profile-widget-header">
                {{-- <img alt="image" src="assets/img/avatar/avatar-1.png" class="rounded-circle profile-widget-picture"> --}}

                <form id="profile-picture-form" action="{{ route('user.updateProfilePicture') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <label for="profile-picture-input" class="cursor-pointer">
                        <img id="profile-picture-preview"
                        alt="Profile Picture"
                        src="{{ asset(Auth::user()->profile_picture ?? 'assets/img/avatar/avatar-1.png') }}"
                        class="rounded-circle profile-widget-picture"
                        style="cursor: pointer; width: 100px; height: 100px; object-fit: cover;">
                    </label>

                    <!-- Hidden File Input -->
                    <input type="file" name="profile_picture" id="profile-picture-input" class="d-none" accept="image/*">
                </form>



                <div class="profile-widget-items">
                  <div class="profile-widget-item">
                    <div class="profile-widget-item-label">Darshans</div>
                    <div class="profile-widget-item-value">0</div>
                  </div>
                  <div class="profile-widget-item">
                    <div class="profile-widget-item-label">Donations</div>
                    <div class="profile-widget-item-value">0</div>
                  </div>
                  <div class="profile-widget-item">
                    <div class="profile-widget-item-label">Following</div>
                    <div class="profile-widget-item-value">2,1K</div>
                  </div>
                </div>
              </div>
              <div class="profile-widget-description">
                <div class="profile-widget-name">{{ $user->first_name.' '.$user->middle_name.' '.$user->last_name }} <div class="text-muted d-inline font-weight-normal"><div class="slash"></div> </div></div>
                Ujang maman is a superhero name in <b>Indonesia</b>, especially in my family. He is not a fictional character but an original hero in my family, a hero for his children and for his wife. So, I use the name as a user in this template. Not a tribute, I'm just bored with <b>'John Doe'</b>.
              </div>
              <div class="card-footer text-center">
                <div class="font-weight-bold mb-2">Follow Ujang On</div>
                <a href="#" class="btn btn-social-icon btn-facebook mr-1">
                  <i class="fab fa-facebook-f"></i>
                </a>
                <a href="#" class="btn btn-social-icon btn-twitter mr-1">
                  <i class="fab fa-twitter"></i>
                </a>
                <a href="#" class="btn btn-social-icon btn-github mr-1">
                  <i class="fab fa-github"></i>
                </a>
                <a href="#" class="btn btn-social-icon btn-instagram">
                  <i class="fab fa-instagram"></i>
                </a>
              </div>
            </div>
          </div>
          <div class="col-12 col-md-12 col-lg-7">
            <div class="card">
              <form method="post" class="needs-validation" novalidate="" id="basic_detail_form">
                @csrf
                <div class="card-header">
                  <h4>Basic Details</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                      <div class="form-group col-md-4 col-12">
                        <label>First Name</label>
                        <input type="text" id="first_name" class="form-control" name="first_name" value="{{ $user->first_name }}" required="">
                        <div class="invalid-feedback">
                          Please fill in the first name
                        </div>
                      </div>
                      <div class="form-group col-md-4 col-12">
                        <label>Middle Name</label>
                        <input type="text" id="middle_name" class="form-control" name="middle_name" value="{{ $user->middle_name }}" required="">
                        <div class="invalid-feedback">
                          Please fill in the first name
                        </div>
                      </div>
                      <div class="form-group col-md-4 col-12">
                        <label>Last Name</label>
                        <input type="text" id="last_name" class="form-control" name="last_name" value="{{ $user->last_name }}" required="">
                        <div class="invalid-feedback">
                          Please fill in the last name
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="form-group col-md-4 col-12">
                        <label>Email</label>
                        <input type="email" class="form-control" value="{{ $user->email }}" required="" disabled>
                      </div>
                      <div class="form-group col-md-4 col-12">
                        <label>Phone</label>
                        <input type="tel" id="mobile" class="form-control" name="mobile" value="{{ $user->mobile_no }}">
                      </div>
                    <div class="form-group col-md-4 col-12">
                        <label for="gender">Gender</label>
                        <select class="form-control" name="gender" id="gender">
                            <option value="Male" <?= ($user->gender == 'Male') ? 'selected' : '' ?>>Male</option>
                            <option value="Female" <?= ($user->gender == 'Female') ? 'selected' : '' ?>>Female</option>
                            <option value="Other" <?= ($user->gender == 'Other') ? 'selected' : '' ?>>Other</option>
                        </select>
                      </div>
                </div>
                <div class="card-footer text-right">
                  <button class="btn btn-primary" type="button" id="basic_details">Save Basic Details</button>
                </div>
              </form>
            </div>
            <div class="card">
                <form method="post"novalidate="" id="necessary_details_form" enctype="multipart/form-data">
                    @csrf
                  <div class="card-header">
                    <h4>Necessary Details</h4>
                  </div>
                  <div class="card-body">
                        <div class="row" style="margin-right:0 !important;">
                            <div class="form-group col-md-4 col-12">
                                <label>Country</label>
                                <select id="country-dropdown" name="country" class="form-control select2">
                                    <option value="">Select Country</option>
                                </select>
                                @error('country')<div class="text-danger">{{ $message }}</div>@enderror
                            </div>
                            <div class="form-group col-md-4 col-12">
                                <label>State</label>
                                <select id="state-dropdown" name="state" class="form-control select2" disabled>
                                    <option value="">Select State</option>
                                </select>
                                @error('state')<div class="text-danger">{{ $message }}</div>@enderror
                            </div>
                            <div class="form-group col-md-4 col-12">
                                <label>City</label>
                                <select id="city-dropdown" name="city" class="form-control select2"  disabled>
                                    <option value="">Select City</option>
                                </select>
                                @error('city')<div class="text-danger">{{ $message }}</div>@enderror
                            </div>
                        </div>
                        <div class="row" >
                            <div class="form-group col-md-6 col-12">
                                <label>Pincode / Zipcode</label>
                                <input type="tel" name="pincode" id="pincode" class="form-control" placeholder="pincode / zipcode" value="{{ $user->userDetails->pincode ?? null }}" >
                                @error('pincode')<div class="text-danger">{{ $message }}</div>@enderror
                            </div>
                            <div class="form-group col-md-6 col-12">
                                <label>Birth Date</label>
                                <input type="date" name="dob" id="dob" class="form-control" placeholder="Date of birth" value="{{ $user->userDetails->dob ?? null  }}">
                                @error('dob')<div class="text-danger">{{ $message }}</div>@enderror
                            </div>
                        </div>
                        <div class="row" id="passport-fields" style="display: none">
                            <div class="form-group col-md-6 col-12">
                                <label>Passport Number</label>
                                <input type="text" class="form-control" name="passport_no" id="passport_no" placeholder="Passport Number" value="{{ $user->userDetails->passport_number  ?? null }}">
                            </div>
                            <div class="form-group col-md-6 col-12">
                                <label>Passport Image</label>
                                <input type="file" class="form-control" name="passport_img" id="passport_img" value="{{ $user->userDetails->passport_image ?? null }}">
                            </div>
                        </div>
                        <div class="row" id="adharcard-fields" style="display: none">
                          <div class="form-group col-md-6 col-12">
                            <label>Adharcard Number</label>
                            <input type="text" class="form-control" name="adhar_no" id="adhar_no" placeholder="Adharcard Number" value="{{ $user->userDetails->adhar_card_number ?? null }}">
                            @error('adhar_no')<div class="text-danger">{{ $message }}</div>@enderror
                          </div>
                          <div class="form-group col-md-6 col-12">
                            <label>Adharcard Image</label>
                            <input type="file" class="form-control" name="adhar_img" value="{{ $user->userDetails->adhar_card_image ?? null }}">
                            @error('adhar_img')<div class="text-danger">{{ $message }}</div>@enderror
                          </div>
                        </div>
                        <div class="row" id="pancard-fields" style="display: none">
                          <div class="form-group col-md-6 col-12">
                            <label>Pancard Number</label>
                            <input type="text" class="form-control" name="pan_no" id="pan_no" placeholder="Pancard Number" value="{{ $user->userDetails->pan_card_number ?? null }}">                            @error('pan_no')<div class="text-danger">{{ $message }}</div>@enderror
                          </div>
                          <div class="form-group col-md-6 col-12">
                            <label>Pancard Image</label>
                            <input type="file" class="form-control" name="Pancard_img" value="{{ $user->userDetails->pan_card_image ?? null }}">

                            @error('Pancard_img')<div class="text-danger">{{ $message }}</div>@enderror
                          </div>
                        </div>
                        <div class="row" id="passport-fields" style="display: none">
                            <div class="form-group col-md-6 col-12">
                                <label>View Adharcard</label>
                                <input type="text" class="form-control" name="passport_no" id="passport_no" placeholder="Passport Number" value="{{ $user->userDetails->passport_number  ?? null }}">
                            </div>
                            <div class="form-group col-md-6 col-12">
                                <label>View Pancard</label>
                                <input type="file" class="form-control" name="passport_img" id="passport_img" value="{{ $user->userDetails->passport_image ?? null }}">
                            </div>
                        </div>
                            @if(isset($user->userDetails) && $user->userDetails->adhar_card_image || isset($user->userDetails->passport_image) && $user->userDetails->passport_image != ''  || isset($user->userDetails->pan_card_image) && $user->userDetails->pan_card_image)
                                <div class="row">
                                    @if(isset($user->userDetails) && $user->userDetails->adhar_card_image)
                                        <div class="form-group col-md-6 col-12">
                                            <a href="javascript:void(0);" id="adharcard-link" style="cursor: pointer;"
                                                data-image="{{ asset( $user->userDetails->adhar_card_image) }}">
                                                View Aadhaar Card Image
                                            </a>
                                        </div>
                                    @endif
                                    @if(isset($user->userDetails) && $user->userDetails->pan_card_image)
                                        <div class="form-group col-md-6 col-12">
                                            <a href="javascript:void(0);" id="pancard-link" style="cursor: pointer;"
                                                data-image="{{ asset( $user->userDetails->pan_card_image) }}">
                                                View Pan Card Image
                                            </a>
                                        </div>
                                    @endif
                                    @if(isset($user->userDetails) && $user->userDetails->passport_image != '')
                                        <div class="form-group col-md-6 col-12">
                                            <a href="javascript:void(0);" id="passport-link" style="cursor: pointer;"
                                                data-image="{{ asset( $user->userDetails->passport_image) }}">
                                                View Passport Image
                                            </a>
                                        </div>
                                    @endif
                                </div>
                            @endif
                    </div>
                  <div class="card-footer text-right">
                    <button class="btn btn-primary">Save Changes</button>
                  </div>
                </form>
              </div>
          </div>
        </div>
        <!-- Modal -->
      </div>
    </section>
    <!-- Bootstrap Modal -->
<div class="modal fade" id="adharcardModal" tabindex="-1" aria-labelledby="adharcardModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="adharcardModalLabel">Aadhaar Card Image</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-center">
                <img id="adharcard-img" src="" alt="Aadhaar Card Image" class="img-fluid">
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="pancardModal" tabindex="-1" aria-labelledby="pancardModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="pancardModalLabel">Pan Card Image</h5> <!-- Updated ID -->
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-center">
                <img id="pancard-img" src="" alt="Pan Card Image" class="img-fluid">
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="passportModal" tabindex="-1" aria-labelledby="passportModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="passportModalLabel">Passport Image</h5> <!-- Updated ID -->
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-center">
                <img id="passport-img" src="" alt="Passport Image" class="img-fluid">
            </div>
        </div>
    </div>
</div>
@endsection

@push('script')
<script>
    document.addEventListener("DOMContentLoaded", function() {
        document.getElementById("adharcard-link").addEventListener("click", function() {
            let imageUrl = this.getAttribute("data-image");
            document.getElementById("adharcard-img").src = imageUrl;
            $("#adharcardModal").modal("show"); // Show Bootstrap modal
        });
    });
    document.addEventListener("DOMContentLoaded", function() {
        document.getElementById("pancard-link").addEventListener("click", function(event) {
            event.preventDefault(); // Prevent any default action (e.g., page scroll)
            let imageUrl = this.getAttribute("data-image");
            document.getElementById("pancard-img").src = imageUrl;
            $("#pancardModal").modal("show"); // Show Bootstrap modal
        });
    });
    document.addEventListener("DOMContentLoaded", function() {
        document.getElementById("passport-link").addEventListener("click", function(event) {
            event.preventDefault(); // Prevent any default action (e.g., page scroll)
            let imageUrl = this.getAttribute("data-image");
            document.getElementById("passport-img").src = imageUrl;
            $("#passportModal").modal("show"); // Show Bootstrap modal
        });
    });
</script>

<script>

$(document).ready(function () {
    var userData = @json($user->details_complete);

    if(!userData)
        Swal.fire({
            icon: 'info',
            title: 'Required',
            text: "Please in all Necessary Details To continue",
        });
 $('#adharcard-image').click(function() {
        var imageSrc = $(this).attr('src'); // Get the src attribute of the clicked image
        $('#modal-image').attr('src', imageSrc); // Set the image source in the modal
        $('#adharcardModal').modal('show'); // Show the modal
    });
    var selectedCountryId = "{{ $selectedCountryId }}";
    var selectedStateId = "{{ $selectedStateId }}";
    var selectedCityId = "{{ $selectedCityId }}";
    var countries = {!! json_encode($countries) !!};
    if (!selectedCountryId) {
            $('#adharcard-fields').hide();
            $('#pancard-fields').hide();
            $('#passport-fields').hide();
        } else if (selectedCountryId == '101') {
            $('#adharcard-fields').show();
            $('#pancard-fields').show();
            $('#passport-fields').hide();
        } else {
            $('#adharcard-fields').hide();
            $('#pancard-fields').hide();
            $('#passport-fields').show();
        }


    $.each(countries, function (index, country) {
        var isSelected = (country.id == selectedCountryId) ? 'selected' : ''; // Check if this country is selected
        $('#country-dropdown').append('<option value="' + country.id + '" ' + isSelected + '>' + country.name + '</option>');
    });

    $('#country-dropdown').change(function () {
        var countryId = $(this).val();

        if (!countryId) {
            $('#adharcard-fields').hide();
            $('#pancard-fields').hide();
            $('#passport-fields').hide();
        } else if (countryId == '101') {
            $('#adharcard-fields').show();
            $('#pancard-fields').show();
            $('#passport-fields').hide();
        } else {
            $('#adharcard-fields').hide();
            $('#pancard-fields').hide();
            $('#passport-fields').show();
        }
        if (countryId) {
            $.ajax({
                url: "/get-location-data/state/" + countryId,
                method: "GET",
                success: function (data) {
                    $('#state-dropdown').empty();
                    $.each(data, function (index, state) {
                        var isSelected = (state.id == selectedStateId) ? 'selected' : '';
                        $('#state-dropdown').append('<option value="' + state.id + '" ' + isSelected + '>' + state.name + '</option>');
                    });
                    $('#state-dropdown').prop('disabled', false);
                    if (selectedStateId) {
                        loadCities(selectedStateId);
                    }
                }
            });
        } else {
            $('#state-dropdown').empty().append('<option value="">Select State</option>').prop('disabled', true);
        }
    });

    $('#state-dropdown').change(function () {
        var stateId = $(this).val();
        if (stateId) {
            loadCities(stateId);
        }
    });

    function loadCities(stateId) {
        if (!stateId) {
            return;
        }

        $.ajax({
            url: "/get-location-data/city/" + stateId,
            method: "GET",
            success: function (data) {
                $('#city-dropdown').empty();
                $.each(data, function (index, city) {
                    var isSelected = (city.id == selectedCityId) ? 'selected' : '';
                    $('#city-dropdown').append('<option value="' + city.id + '" ' + isSelected + '>' + city.name + '</option>');
                });
                $('#city-dropdown').prop('disabled', false);
            }
        });
    }


    if (selectedCountryId) {
        $('#country-dropdown').val(selectedCountryId).change();
    }


    if (selectedStateId) {
        $('#state-dropdown').val(selectedStateId).change();
    }
});


</script>












<script>
    $(document).ready(function () {
    $("#basic_detail_form").validate({
        rules: {
            first_name: {
                required: true,
                minlength: 2,
            },
            middle_name: {
                required: true,
            },
            last_name: {
                required: true,
                minlength: 2,
            },
            mobile: {
                required: true,
                digits: true,
                minlength: 10,
                maxlength: 10,
            },
        },
        messages: {
            first_name: {
                required: "Please enter your first name",
                minlength: "First name must be at least 2 characters long",
            },
            middle_name: {
                required: "Please enter your middle name",
            },
            last_name: {
                required: "Please enter your last name",
                minlength: "Last name must be at least 2 characters long",
            },
            mobile: {
                required: "Please provide your mobile number",
                digits: "Only digits are allowed",
                minlength: "Mobile number must be exactly 10 digits",
                maxlength: "Mobile number must be exactly 10 digits",
            },
        },
        errorPlacement: function (error, element) {
            error.addClass("text-danger");
            element.closest(".form-group").append(error);
        },
        highlight: function (element) {
            $(element).addClass("is-invalid");
        },
        unhighlight: function (element) {
            $(element).removeClass("is-invalid");
        },
        submitHandler: function (form) {
            var formData = $(form).serialize();
            // Perform AJAX call or any action on valid form submission
            $.ajax({
                url: "{{ route('user.updatebasic', $user->id) }}", // Pass the user ID directly
                    type: "POST",
                    data: formData,
                    success: function(response) {
                        if(response.status === 'success') {
                            Swal.fire({
                                icon: 'success',
                                title: 'Details Updated',
                                confirmButtonText: 'OK'
                            })
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error!',
                                text: response.message,
                                confirmButtonText: 'OK'
                            });
                        }
                    },
                    error: function(xhr) {
                        var errors = xhr.responseJSON.errors;
                        $(".text-danger").empty();
                        $.each(errors, function(key, value) {
                            $("#" + key + "-error").text(value);
                        });
                        Swal.fire({
                            icon: 'error',
                            title: 'Form Validation Failed',
                            text: 'Please fix the errors below.',
                            confirmButtonText: 'OK'
                        });
                    }
                });

        },
    });

    // Custom trigger for Save button
    $('#basic_details').click(function () {
        $("#basic_detail_form").submit();
    });
});




</script>












<script>
  $(document).ready(function () {
        $.validator.addMethod(
        "fileExtension",
        function (value, element, param) {
            if (element.files.length > 0) {
                const extension = value.split('.').pop().toLowerCase();
                return param.split('|').indexOf(extension) !== -1;
            }
            return true; // No file selected, let "required" handle it
        },
        "Allowed file types: jpg, jpeg, png, pdf."
    );
    $('#necessary_details_form').validate({
        rules: {
            country: {
                required: true,
            },
            state: {
                required: true,
            },
            city: {
                required: true,
            },
            pincode: {
                required: true,
                digits: true,
                minlength: 6,
                maxlength: 6,
            },
            dob: {
                required: true,
                date: true,
            },
            adhar_no: {
                required: true,
                digits: true,
                minlength: 12,
                maxlength: 12,
            },
            adhar_img: {
                required: true,
                // extension: "jpg|jpeg|png|pdf",
                fileExtension: "jpg|jpeg|png|pdf",
            },
            pan_no: {
                required: true,
                minlength: 10,
                maxlength: 10,
            },
            passport_no: {
                required: true,
                minlength: 10,
                maxlength: 10,
            },
            Pancard_img: {
                required: true,
                // extension: "jpg|jpeg|png|pdf",
                fileExtension: "jpg|jpeg|png|pdf",
            },
            passport_img: {
                required: true,
                // extension: "jpg|jpeg|png|pdf",
                fileExtension: "jpg|jpeg|png|pdf",
            },
        },
        messages: {
            country: {
                required: "Please select a country.",
            },
            state: {
                required: "Please select a state.",
            },
            city: {
                required: "Please select a city.",
            },
            pincode: {
                required: "Please enter the pincode.",
                digits: "Pincode must contain only numbers.",
                minlength: "Pincode must be 6 digits.",
                maxlength: "Pincode must be 6 digits.",
            },
            dob: {
                required: "Please select your date of birth.",
                date: "Please enter a valid date.",
            },
            adhar_no: {
                required: "Please enter your Aadhar number.",
                digits: "Aadhar number must contain only digits.",
                minlength: "Aadhar number must be 12 digits.",
                maxlength: "Aadhar number must be 12 digits.",
            },
            adhar_img: {
                required: "Please upload an Aadhar image.",
                fileExtension: "Allowed file types: jpg, jpeg, png, pdf.",
            },
            pan_no: {
                required: "Please enter your PAN number.",
                minlength: "PAN number must be 10 characters.",
                maxlength: "PAN number must be 10 characters.",
            },
            passport_no: {
                required: "Please enter your Passport number.",
                minlength: "Passport number number must be 10 characters.",
                maxlength: "Passport number number must be 10 characters.",
            },
            Passport_img: {
                required: "Please upload a Passport  image.",
                fileExtension: "Allowed file types: jpg, jpeg, png, pdf.",
            },
        },
        errorElement: 'div',
        errorPlacement: function (error, element) {
            error.addClass('invalid-feedback');
            element.closest('.form-group').append(error);
        },
        highlight: function (element) {
            $(element).addClass('is-invalid');
        },
        unhighlight: function (element) {
            $(element).removeClass('is-invalid');
        },
        submitHandler: function (form) {
            // AJAX Submission
            let formData = new FormData(form);
            console.log(formData); // Before sending AJAX request

            $.ajax({
                url: "{{ route('user.details') }}",
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function (res) {

                    if (res.status === 'success') {
                        iziToast.success({
                                title: 'Success',
                                message: res.message,
                                position: 'topRight'
                            });
                        // $(form)[0].reset(); // Reset the form
                    } else {
                        // Error notification
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: res.message,
                        });
                    }
                },
                error: function () {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Something went wrong. Please try again.',
                    });
                },
            });
        },
    });
});
</script>
<script>
    document.getElementById('profile-picture-input').addEventListener('change', function(event) {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('profile-picture-preview').src = e.target.result;
            };
            reader.readAsDataURL(file);

            // Auto-submit the form when a new image is selected
            document.getElementById('profile-picture-form').submit();
        }
    });
</script>
@if(session('success'))
    <script>
        iziToast.success({
            title: 'Success',
            message: '{{ session("success") }}',
            position: 'topRight'
        });
    </script>
@endif

@endpush
