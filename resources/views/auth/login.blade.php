<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>Log-In</title>
    <link rel="shortcut icon" href="{{ asset('assets/favicon.png') }}" type="image/x-icon">
    @include('layouts.css')
</head>

<body>
  <div id="app">
    <section class="section ">
      <div class="container mt-5">
        <div class="row">
          <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
            <div class="login-brand">
              <img src="assets/img/ram3.png" alt="logo" width="100" height="95" class="shadow-warning rounded-circle">
            </div>
            <div class="card card-warning">
              <div class="card-header text-warning"><h4>Login</h4></div>

              <div class="card-body">
                <form  id="login-form" novalidate="">
                    @csrf
                  <div class="form-group">
                    <label for="email">Email</label>
                    <input id="email" type="email" class="form-control" name="email" tabindex="1" placeholder="Email" required autofocus>
                    <div class="error-message text-danger" ></div>
                    <div class="invalid-feedback">
                      Please fill in your email
                    </div>
                  </div>

                  <div class="form-group">
                    <div class="d-block">
                    	<label for="password" class="control-label">Password</label>
                      <div class="float-right">
                        <a href="{{ route('password.form') }}" class="text-small">
                          Forgot Password?
                        </a>
                      </div>
                    </div>
                    <input id="password" type="password" class="form-control" name="password" tabindex="2" placeholder="Password" required>
                    <div class="error-message text-danger" ></div>
                    <div class="invalid-feedback">
                      please fill in your password
                    </div>
                  </div>

                  {{-- <div class="form-group">
                    <div class="custom-control custom-checkbox">
                      <input type="checkbox" name="remember" class="custom-control-input" tabindex="3" id="remember-me">
                      <label class="custom-control-label" for="remember-me">Remember Me</label>
                    </div>
                  </div> --}}

                  <div class="form-group">
                    <button type="submit" class="btn btn-warning btn-lg btn-block" tabindex="4">
                      Login
                    </button>
                  </div>
                </form>
              </div>
            </div>
            <div class="mt-5 text-muted text-center">
              Don't have an account? <a href="{{ route('register') }}">Create One</a>
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
        $("#login-form").validate({
            rules: {
                email: {
                    required: true,
                    email: true
                },
                password: {
                    required: true,
                    minlength: 3
                }
            },
            messages: {
                email: {
                    required: "Please enter your email",
                    email: "Please enter a valid email address"
                },
                password: {
                    required: "Please provide your password",
                    minlength: "Password must be at least 3 characters long"
                }
            },
            errorPlacement: function(error, element) {
                error.appendTo(element.parent().find('.error-message'));
            },
            submitHandler: function(form) {
                var formData = $(form).serialize();

                $.ajax({
                    url: "{{ route('login.action') }}",
                    type: 'POST',
                    data: formData,
                    success: function(response) {
                        if(response.status === 'success') {
                            iziToast.success({
                                title: 'Success',
                                message: response.message,
                                position: 'topRight'
                            });
                            window.location.href = response.redirectUrl;
                        } else {
                            iziToast.error({
                                title: 'Opps!!!',
                                message: response.message,
                                position: 'topRight'
                            });
                        }
                    },
                    error: function(xhr) {
                        var errors = xhr.responseJSON.errors;
                        var errorMessage = '';
                        $.each(errors, function(key, value) {
                            errorMessage += value + '<br>';
                        });
                        iziToast.error({
                            title: 'Error',
                            message: errorMessage,
                            position: 'topRight'
                        });
                    }
                });
            }
        });
    });
</script>
@if(session('status'))
<script>
    iziToast.success({
        title: 'success',
        message: @json(session('status')),
        position: 'topRight'
    });
</script>
@endif

</body>
</html>
