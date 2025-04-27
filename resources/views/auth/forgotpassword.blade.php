<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>Forgot Password</title>
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
              <div class="card-header text-warning"><h4>Forgot Password</h4></div>

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
                    <button type="submit" class="btn btn-warning btn-lg btn-block" tabindex="4">
                      Reset Password
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
                    email: true,
                    remote: {
                        url: "{{ route('check.emailforpassword') }}",
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
            },
            messages: {
                email: {
                    required: "Please enter your email",
                    email: "Please enter a valid email address",
                    remote: "This email is Not  Registerd with us!!!"
                },
            },
            errorPlacement: function(error, element) {
                error.appendTo(element.parent().find('.error-message'));
            },
            submitHandler: function(form) {
                Swal.fire({
                    title: "Please Wait...",
                    allowOutsideClick: false,
                    didOpen: () => {
                        Swal.showLoading();
                    }
                });
                var formData = $(form).serialize();

                $.ajax({
                    url: "{{ route('send.passwordmail') }}",
                    type: 'POST',
                    data: formData,
                    success: function(response) {
                        if(response.status === 'success') {
                            iziToast.success({
                                title: 'Success',
                                message: "An Email Has been sent to you with a password Reset Link.",
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

</body>
</html>
