@extends('layouts.main')

@section('title', 'Add Temple')

@section('main-content')

<section class="section">
    <div class="section-header">
        <h1>Add Temple</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="#">Temples</a></div>
            <div class="breadcrumb-item">Add Temple</div>
        </div>
    </div>
    <div class="section-body">
        <div class="row mt-sm-4">
            <div class="col-12">
                <form enctype="multipart/form-data" id="basic_detail_form">
                    @csrf
                    <!-- Temple Basic Details -->
                    <div class="card">
                        <div class="card-header">
                            <h4>Temple Basic Details</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="form-group col-md-4">
                                    <label>Temple Name</label>
                                    <input type="text" id="temple_name" class="form-control" name="temple_name" placeholder="Temple Name" required>
                                    <div class="error-message"> @error('temple_name'){{ $message }}@enderror</div>
                                </div>
                                <div class="form-group col-md-4">
                                    <label>Email</label>
                                    <input type="email" class="form-control" name="email" placeholder="Temple Email" required>
                                    <div class="error-message"> @error('email'){{ $message }}@enderror</div>
                                </div>
                                <div class="form-group col-md-4">
                                    <label>Phone</label>
                                    <input type="tel" id="mobile" class="form-control" name="mobile" placeholder="Temple Mobile Number" required>
                                   <div class="error-message"> @error('mobile'){{ $message }}@enderror</div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-3">
                                    <label>Temple City</label>
                                    <input type="text" id="temple_city" class="form-control" name="temple_city" placeholder="Temple City" required>
                                   <div class="error-message"> @error('temple_city'){{ $message }}@enderror</div>
                                </div>
                                <div class="form-group col-md-3">
                                    <label>Temple State</label>
                                    <input type="text" id="temple_state" class="form-control" name="temple_state" placeholder="Temple State" required>
                                   <div class="error-message"> @error('temple_state'){{ $message }}@enderror</div>
                                </div>
                                <div class="form-group col-md-3">
                                    <label>Temple Country</label>
                                    <input type="text" id="temple_country" class="form-control" name="temple_country" value="India" placeholder="Temple Country" readonly>
                                   <div class="error-message"> @error('temple_country'){{ $message }}@enderror</div>
                                </div>
                                <div class="form-group col-md-3">
                                    <label>Best Month To visit</label>
                                    <select name="temple_season" id="temple_season" class="form-control">
                                        <option value="" selected disabled>Best Season to Visit</option>
                                        <option value="winter">Winter</option>
                                        <option value="summer">Summer</option>
                                        <option value="monsoon">Monsoon</option>
                                        <option value="autumn">Autumn</option>
                                        <option value="all">All Season</option>
                                    </select>
                                   <div class="error-message"> @error('temple_season'){{ $message }}@enderror</div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-6">
                                    <label>Temple Address</label>
                                    <textarea class="form-control" name="temple_address" id="temple_address" placeholder="Temple Address" required></textarea>
                                   <div class="error-message"> @error('temple_address'){{ $message }}@enderror</div>
                                </div>
                                <div class="form-group col-6">
                                    <label>Temple Description</label>
                                    <textarea class="form-control" name="temple_desc" id="temple_desc" placeholder="Temple Description" required></textarea>
                                   <div class="error-message"> @error('temple_desc'){{ $message }}@enderror</div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Temple Live Darshan Youtube IFrame Link</label>
                                <textarea class="form-control" name="live_darshan" id="live_darshan" placeholder="Youtube Temple Live Darshan Link" required></textarea>
                               <div class="error-message"> @error('live_darshan'){{ $message }}@enderror</div>
                            </div>
                        </div>
                    </div>
                    <!-- Temple Images -->
                    <div class="card">
                        <div class="card-header">
                            <h4>Temple Images</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label>Main Image</label>
                                    <input type="file" class="form-control" name="temple_mainimg" id="temple_mainimg" required>
                                   <div class="error-message"> @error('temple_mainimg'){{ $message }}@enderror</div>
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Featured Images (multiple images supported)</label>
                                    <input type="file" class="form-control" name="temple_featuredimgs[]" id="temple_featuredimgs" multiple required>
                                   <div class="error-message"> @error('temple_featuredimgs'){{ $message }}@enderror</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Temple Arti Timings -->
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h4>Temple Arti Timings (Special Arti)</h4>
                            <!-- Switch Button -->
                            <label class="custom-switch">
                                <input type="checkbox" class="custom-switch-input" name="arti_switch" id="arti_switch">
                                <span class="custom-switch-indicator"></span>
                                <span class="custom-switch-description">Enable</span>
                            </label>
                        </div>
                        <div class="card-body" id="arti_section">
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label>Special Arti for festival</label>
                                    <input type="text" name="special_arti_date" class="form-control datepicker" disabled>
                                   <div class="error-message"> @error('special_arti_date'){{ $message }}@enderror</div>
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Timing of Arti</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text"><i class="fas fa-clock"></i></div>
                                        </div>
                                        <input type="text" name="special_arti_time" class="form-control timepicker" disabled>
                                    </div>
                                   <div class="error-message"> @error('special_arti_time'){{ $message }}@enderror</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Temple Darshan Timings -->
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h4>Temple Darshan Timings (Special Darshan)</h4>
                            <!-- Switch Button -->
                            <label class="custom-switch">
                                <input type="checkbox" class="custom-switch-input" name="darshan_switch" id="darshan_switch">
                                <span class="custom-switch-indicator"></span>
                                <span class="custom-switch-description">Enable</span>
                            </label>
                        </div>
                        <div class="card-body" id="darshan_section">
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label>Special Darshan for festival</label>
                                    <input type="text" name="special_darshan_date" class="form-control datepicker" disabled>
                                   <div class="error-message"> @error('special_darshan_date'){{ $message }}@enderror</div>
                                </div>
                                <div class="form-group col-md-3">
                                    <label>Timing of Darshan From:</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text"><i class="fas fa-clock"></i></div>
                                        </div>
                                        <input type="text" class="form-control timepicker" name="darshan_from" disabled>
                                    </div>
                                   <div class="error-message"> @error('darshan_from'){{ $message }}@enderror</div>
                                </div>
                                <div class="form-group col-md-3">
                                    <label>Timing of Darshan To:</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text"><i class="fas fa-clock"></i></div>
                                        </div>
                                        <input type="text" class="form-control timepicker" name="darshan_to" disabled>
                                    </div>
                                   <div class="error-message"> @error('darshan_to'){{ $message }}@enderror</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Submit Button -->
                    <div class="text-right">
                        <button class="btn btn-primary">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

@endsection

@push('script')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        function toggleSection(switchId, sectionId) {
            const toggleSwitch = document.getElementById(switchId);
            const section = document.getElementById(sectionId);

            toggleSwitch.addEventListener('change', function () {
                const inputs = section.querySelectorAll('input, textarea');
                if (toggleSwitch.checked) {
                    inputs.forEach(input => input.removeAttribute('disabled'));
                } else {
                    inputs.forEach(input => input.setAttribute('disabled', true));
                }
            });
        }

        toggleSection('arti_switch', 'arti_section');
        toggleSection('darshan_switch', 'darshan_section');

        $.validator.addMethod('youtubeEmbedValid', function(value, element) {
            const youtubePattern = /^(https?:\/\/)?(www\.)?(youtube\.com\/(watch\?v=|embed\/)|youtu\.be\/)([a-zA-Z0-9_-]{11})/;
            return youtubePattern.test(value);
        }, 'Please enter a valid YouTube link');
        // Initialize jQuery Validation
        $('#basic_detail_form').validate({
            errorElement: 'div',
            errorClass: 'invalid-feedback',
            highlight: function(element) {
                $(element).addClass('is-invalid').removeClass('is-valid');
                $(element).next('.error-message').text($(element).data('error'));
            },
            unhighlight: function(element) {
                $(element).removeClass('is-invalid').addClass('is-valid');
                $(element).next('.error-message').text('');
            },
            rules: {
                temple_name: {
                    required: true,
                    minlength: 2
                },
                email: {
                    required: true,
                    email: true
                },
                mobile: {
                    required: true,
                    digits: true,
                    minlength: 10,
                    maxlength: 10
                },
                temple_city: {
                    required: true,
                    minlength: 3
                },
                temple_state: {
                    required: true,
                    minlength: 4
                },
                temple_season: {
                    required: true
                },
                temple_country: {
                    required: true
                },
                temple_address: {
                    required: true,
                    minlength: 20,
                    maxlength:350
                },
                temple_desc: {
                    required: true,
                    minlength: 100
                },
                temple_mainimg: {
                    required: true
                },
                "temple_featuredimgs[]": {
                    required: true
                },
                special_arti: {
                    required: function() {
                        return $('#arti_switch').is(':checked');
                    }
                },
                special_arti_time: {
                    required: function() {
                        return $('#arti_switch').is(':checked');
                    }
                },
                special_darshan: {
                    required: function() {
                        return $('#darshan_switch').is(':checked');
                    }
                },
                darshan_from: {
                    required: function() {
                        return $('#darshan_switch').is(':checked');
                    }
                },
                darshan_to: {
                    required: function() {
                        return $('#darshan_switch').is(':checked');
                    }
                },
                live_darshan: {
                    required: true,
                    youtubeEmbedValid: true
                }
            },
            messages: {
                temple_name: {
                    required: "Please fill in Temple Name",
                    minlength: "At least 2 characters required"
                },
                email: {
                    required: "Please fill in Email",
                    email: "Please enter a valid Email"
                },
                mobile: {
                    required: "Please fill in Mobile number",
                    digits: "Please enter a valid Mobile number",
                    minlength: "Mobile number must be 10 digits",
                    maxlength: "Mobile number must be 10 digits"
                },
                temple_city: "Please fill in City",
                temple_state: "Please fill in State",
                temple_country: "Please fill in Country",
                temple_season: "Please Select the Suitable Season",
                temple_address: {
                    required:"Please fill in Temple Address",
                    minlength: "The address cannot be less then 50 characters",
                    maxlength: "The address cannot be more then 250 characters"
                },
                temple_desc: {
                    required:"Please fill in Temple Description",
                    minlength: "The Temple Description cannot be less then 150 characters "
                },
                live_darshan: {
                    required: "Please provide a YouTube embed code",
                    youtubeEmbedValid: "Please enter a valid YouTube embed code"
                },
                temple_mainimg: "Please upload the Main Image",
                "temple_featuredimgs[]": "Please upload at least one Featured Image",
                special_arti: "Please provide the Special Arti date",
                special_arti_time: "Please provide the Special Arti timing",
                special_darshan: "Please provide the Special Darshan date",
                darshan_from: "Please provide the Darshan start time",
                darshan_to: "Please provide the Darshan end time"
            },
            errorPlacement: function(error, element) {
                if (element.parent('.input-group').length) {
                    error.insertAfter(element.parent());
                } else {
                    error.insertAfter(element);
                }
            },
            submitHandler: function(form, event) {
                event.preventDefault();
                // form.submit();
                var formData = new FormData(form);

                if ($('#arti_switch').is(':checked')) {
                    formData.delete('special_arti_date');
                    formData.delete('special_arti_time');

                    formData.append('special_arti_date', $('input[name="special_arti_date"]').val());
                    formData.append('special_arti_time', $('input[name="special_arti_time"]').val());
                }else {
                    formData.delete('special_arti_date');
                    formData.delete('special_arti_time');
                }

                if ($('#darshan_switch').is(':checked')) {

                    formData.delete('special_darshan_date');
                    formData.delete('darshan_from');
                    formData.delete('darshan_to');

                    formData.append('special_darshan_date', $('input[name="special_darshan_date"]').val());
                    formData.append('darshan_from', $('input[name="darshan_from"]').val());
                    formData.append('darshan_to', $('input[name="darshan_to"]').val());
                }else {
                    formData.delete('special_darshan_date');
                    formData.delete('darshan_from');
                    formData.delete('darshan_to');

                }
                // Submit the form via AJAX
                $.ajax({
                    url: "{{ route('admin.storeTemple') }}",
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function (res) {
                        if (res.status === 'success') {
                        let timerInterval;
                            Swal.fire({
                                title: res.message,
                                html: "Redirecting in <b></b> seconds.",
                                timer: 3000,
                                timerProgressBar: true,
                                allowOutsideClick: false, // Prevent closing by clicking outside
                                allowEscapeKey: false, // Prevent closing by pressing the escape key
                                didOpen: () => {
                                    Swal.showLoading();
                                    const timer = Swal.getPopup().querySelector("b");
                                    timerInterval = setInterval(() => {
                                        timer.textContent = `${Math.ceil(Swal.getTimerLeft() / 1000)}`;  // Shows seconds remaining
                                    }, 1000);  // Update every second
                                },
                                willClose: () => {
                                    clearInterval(timerInterval);
                                }
                            }).then((result) => {
                                if (result.dismiss === Swal.DismissReason.timer) {
                                    console.log("I was closed by the timer");
                                    window.location.href = "{{ route('admin.temples') }}";
                                }
                            });

                        }
                    },
                    error: function () {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'An error occurred while submitting the form.',
                        });
                    }
                });
            }
        });
    });
</script>
@endpush
