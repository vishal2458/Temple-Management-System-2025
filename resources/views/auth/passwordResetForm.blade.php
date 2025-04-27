<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>Reset Password</title>
    <link rel="shortcut icon" href="{{ asset('assets/favicon.png') }}" type="image/x-icon">
    @include('layouts.css')
</head>

<body>
  <div id="app">
    <section class="section">
      <div class="container mt-5">
        <div class="row">
          <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
            <div class="login-brand">
              <img src="{{ asset('assets/img/ram3.png') }}" alt="logo" width="100" height="95" class="shadow-warning rounded-circle">
            </div>
            <div class="card card-warning">
              <div class="card-header text-warning"><h4>Reset Password</h4></div>

              <div class="card-body">
                <form id="resetPassword-form" novalidate="">
                    @csrf
                    <input type="hidden" name="userId" value="{{ $userId }}">
                    <input type="hidden" name="verificationCode" value="{{ $verificationCode }}">

                  <div class="form-group">
                    <input id="password" type="password" class="form-control" name="password" tabindex="1" placeholder="New Password" required>
                    <div class="error-message text-danger"></div>
                    <div class="invalid-feedback">
                      Please enter your new password.
                    </div>
                  </div>

                  <div class="form-group">
                    <input id="confirmPassword" type="password" class="form-control" name="confirm_password" tabindex="2" placeholder="Confirm Password" required>
                    <div class="error-message text-danger"></div>
                    <div class="invalid-feedback">
                      Please confirm your new password.
                    </div>
                  </div>

                  <div class="form-group">
                    <button type="submit" class="btn btn-warning btn-lg btn-block" tabindex="3">
                      Reset Now
                    </button>
                  </div>
                </form>
              </div>
            </div>

            <div class="simple-footer">
              Copyright &copy; {{ date('Y') }}
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

        $("#resetPassword-form").validate({
            rules: {
                password: {
                    required: true,
                    minlength: 6,
                    strongPassword: true
                },
                confirm_password: {
                    required: true,
                    equalTo: "#password"
                }
            },
            messages: {
                password: {
                    required: "Please enter your new password",
                    minlength: "Password must be at least 6 characters long",
                    strongPassword: "Password must contain at least one uppercase, one lowercase, one number, and one special character."
                },
                confirm_password: {
                    required: "Please confirm your new password",
                    equalTo: "Passwords do not match"
                }
            },
            errorPlacement: function(error, element) {
                error.appendTo(element.parent().find('.error-message'));
            },
            submitHandler: function(form) {
                var formData = $(form).serialize();
                Swal.fire({
                    title: "Wait...",
                    text: "While We Update Your Password.",
                    allowOutsideClick: false,
                    didOpen: () => {
                        Swal.showLoading();
                    }
                });
                $.ajax({
                    url: "{{ route('reset.password.action') }}",
                    type: 'POST',
                    data: formData,
                    success: function(response) {
                        if(response.status === 'success') {
                            iziToast.success({
                                title: 'Success',
                                message: response.message,
                                position: 'topRight'
                            });
                            setTimeout(() => {
                                window.location.href = "{{ route('login') }}";
                            }, 2000);
                        } else {
                            iziToast.error({
                                title: 'Error',
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
        title: 'Success',
        message: @json(session('status')),
        position: 'topRight'
    });
</script>
@endif

</body>
</html>
