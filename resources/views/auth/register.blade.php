


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>Register Page</title>
  <link rel="shortcut icon" href="{{ asset('assets/favicon.png') }}" type="image/x-icon">
  @include('layouts.css')
<body>
  <div id="app">
    <section class="section">

      <div class="container mt-5">
        <div class="row">
          <div class="col-12 col-sm-10 offset-sm-1 col-md-8 offset-md-2 col-lg-8 offset-lg-2 col-xl-8 offset-xl-2">
            <div class="login-brand">
              <img src="assets/img/ram3.png" alt="logo" width="100" height="100" class="shadow-warning rounded-circle">
            </div>

            <div class="card card-warning">
              <div class="card-header"><h4>Register</h4></div>

              <div class="card-body">
                <form method="POST" id="signup_form">
                    @csrf
                  <div class="row">
                    <div class="form-group col-4">
                        <label for="first_name">First Name</label>
                        <input id="first_name" type="text" class="form-control" name="first_name" autofocus>
                        <div id="first_name-error" class="text-danger"></div>
                            @error('first_name')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                    </div>
                    <div class="form-group col-4">
                        <label for="middle_name">Middle Name</label>
                        <input id="middle_name" type="text" class="form-control" name="middle_name" autofocus>
                        <div id="middle_name-error" class="text-danger"></div>
                            @error('middle_name')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                    </div>
                    <div class="form-group col-4">
                        <label for="last_name">Last Name</label>
                        <input id="last_name" type="text" class="form-control" name="last_name" autofocus>
                        <div id="last_name-error" class="text-danger"></div>
                            @error('last_name')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                    </div>
                  </div>
                  <div class="row">
                    <div class="form-group col-4">
                        <label for="email">Email</label>
                        <input id="email" type="email" class="form-control" name="email">
                        <div id="email-error" class="text-danger"></div>
                            @error('email')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    <div class="form-group col-4">
                        <label for="mobile">Mobile Number</label>
                        <input id="mobile" type="number" class="form-control" name="mobile">
                        <div id="mobile-error" class="text-danger"></div>
                            @error('mobile')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                    </div>
                    <div class="form-group col-4">
                        <label for="gender">Gender</label>
                        <select class="form-control" name="gender" id="gender">
                            <option value="" selected disabled>Select Gender</option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                            <option value="Other">Other</option>
                        </select>
                        <div id="gender-error" class="text-danger"></div>
                            @error('gender')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                    </div>
                  </div>
                  <div class="row">
                    <div class="form-group col-6">
                      <label for="password" class="d-block">Password</label>
                      <input id="password" type="password" class="form-control pwstrength" data-indicator="pwindicator" name="password">
                      <div id="password-error" class="text-danger"></div>
                      @error('password')
                          <div class="text-danger">{{ $message }}</div>
                      @enderror
                    </div>
                    <div class="form-group col-6">
                      <label for="password2" class="d-block">Password Confirmation</label>
                      <input id="password2" type="password" class="form-control" name="password_confirmation">
                      <div id="password_confirmation-error" class="text-danger"></div>
                      @error('password_confirmation')
                      <div class="text-danger">{{ $message }}</div>
                      @enderror
                    </div>
                  </div>
                  <div class="form-group">
                    <button type="submit" class="btn btn-warning btn-lg btn-block">
                      Register
                    </button>
                  </div>
                </form>
              </div>
            </div>
            <div class="mt-5 text-muted text-center">
                Already have an account? <a href="{{ route('login') }}">Jump in</a>
              </div>
            <div class="simple-footer">
                Copyright &copy; {{date('Y')}}
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
  @include('layouts.js')
  <script>
    $(document).ready(function() {
        $.validator.addMethod("strongPassword", function(value, element) {
            return this.optional(element) || /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{6,}$/.test(value);
        }, "Password must contain at least one uppercase, one lowercase, one number, and one special character.");

        $("#signup_form").validate({
            rules: {
                first_name: {
                    required: true,
                    minlength: 2
                },
                middle_name: {
                    required: true,
                    minlength: 1
                },
                last_name: {
                    required: true,
                    minlength: 3
                },
                gender: {
                    required: true
                },
                email: {
                    required: true,
                    email: true,
                    remote: {
                        url: "{{ route('check.email') }}",
                        type: "GET",
                        data: {
                            email: function() {
                                return $("#email").val();
                            }
                        },
                        dataFilter: function(response) {
                            var jsonResponse = JSON.parse(response);
                            return jsonResponse.valid ? 'true' : 'false';
                        }
                    }
                },
                mobile: {
                    required: true,
                    minlength: 10,
                    maxlength: 10,
                },
                password: {
                    required: true,
                    minlength: 6,
                    strongPassword: true
                },
                password_confirmation: {
                    required: true,
                    equalTo: "#password"
                },
            },
            messages: {
                first_name: {
                    required: "Please enter your First name",
                    minlength: "Your full name must be at least 2 characters long"
                },
                middle_name: {
                    required: "Please enter your First name",
                    minlength: "Your middle name must be at least 1 characters long"
                },
                last_name: {
                    required: "Please enter your First name",
                    minlength: "Your full name must be at least 3 characters long"
                },
                gender: {
                    required: "Please select Gender",
                },
                email: {
                    required: "Please enter your email",
                    email: "Please enter a valid email address",
                    remote: "This email is already Registerd"
                },
                mobile: {
                    required: "Please enter your mobile number.",
                    minlength: "Mobile number is too short.",
                    maxlength: "Mobile number is too long."
                },
                password: {
                    required: "Please provide a password",
                    minlength: "Your password must be at least 6 characters long",
                    strongPassword: "Password must contain at least one uppercase, one lowercase, one number, and one special character."
                },
                password_confirmation: {
                    required: "Please confirm your password",
                    equalTo: "Passwords do not match"
                },
            },
            submitHandler: function(form) {
                Swal.fire({
                    title: "Wait...",
                    text: "We are Sending You a verification Mail.",
                    allowOutsideClick: false,
                    didOpen: () => {
                        Swal.showLoading();
                    }
                });
                var formData = $(form).serialize();

                $.ajax({
                    url: "{{ route('register.action') }}",
                    type: "POST",
                    data: formData,
                    success: function(response) {
                        if(response.status === 'success') {
                            Swal.fire({
                                icon: 'success',
                                title: 'Registration Successful!',
                                text: 'You have successfully registered.',
                                confirmButtonText: 'OK'
                            }).then(function() {
                                window.location.href = response.redirectUrl;
                            });
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
            }
        });
    });

  </script>

</body>
</html>
