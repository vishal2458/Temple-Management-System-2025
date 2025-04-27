@extends('layouts.main')

@section('title', 'Edit Temple')
@push('css')
<style>
    textarea#temple_desc
    {
        height: 130px !important;
    }
    textarea#temple_address
    {
        height: 130px !important;
    }
    textarea#live_darshan
    {
        height: 130px !important;
    }

</style>
@endpush

@section('main-content')

<section class="section">
    <div class="section-header">
        <h1>Edit Temple</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="#">Temples</a></div>
            <div class="breadcrumb-item">Edit Temple</div>
        </div>
    </div>
    <div class="section-body">
        <div class="row mt-sm-4">
            <div class="col-12">
                <form enctype="multipart/form-data" id="basic_detail_form_update">
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
                                    <input type="text" id="temple_name" class="form-control" name="temple_name" value="{{ old('temple_name', $temple->name) }}" required>
                                    <div class="error-message"> @error('temple_name'){{ $message }}@enderror</div>
                                </div>
                                <div class="form-group col-md-4">
                                    <label>Email</label>
                                    <input type="email" class="form-control" name="email" value="{{ old('email', $temple->email) }}" required>
                                    <div class="error-message"> @error('email'){{ $message }}@enderror</div>
                                </div>
                                <div class="form-group col-md-4">
                                    <label>Phone</label>
                                    <input type="tel" id="mobile" class="form-control" name="mobile" value="{{ old('mobile', $temple->phone) }}" required>
                                   <div class="error-message"> @error('mobile'){{ $message }}@enderror</div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-3">
                                    <label>Temple City</label>
                                    <input type="text" id="temple_city" class="form-control" name="temple_city" value="{{ old('city', $temple->city) }}" required>
                                   <div class="error-message"> @error('temple_city'){{ $message }}@enderror</div>
                                </div>
                                <div class="form-group col-md-3">
                                    <label>Temple State</label>
                                    <input type="text" id="temple_state" class="form-control" name="temple_state" value="{{ old('state', $temple->state) }}" required>
                                   <div class="error-message"> @error('temple_state'){{ $message }}@enderror</div>
                                </div>
                                <div class="form-group col-md-3">
                                    <label>Temple Country</label>
                                    <input type="text" id="temple_country" class="form-control" name="temple_country" value="India" readonly>
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
                                   <div class="error-message"> @error('temple_country'){{ $message }}@enderror</div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-6">
                                    <label>Temple Address</label>
                                    <textarea class="form-control" name="temple_address" id="temple_address" required>{{ $temple->address }}</textarea>
                                   <div class="error-message"> @error('temple_address'){{ $message }}@enderror</div>
                                </div>
                                <div class="form-group col-6">
                                    <label>Temple Description</label>
                                    <textarea class="form-control" name="temple_desc" id="temple_desc" required>{{ $temple->description }}</textarea>
                                   <div class="error-message"> @error('temple_desc'){{ $message }}@enderror</div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Temple Live Darshan Youtube IFrame Link</label>
                                <textarea class="form-control" name="live_darshan" id="live_darshan" placeholder="Temple Live Darshan" required>{{ $temple->live_darshan }}</textarea>
                               <div class="error-message"> @error('live_darshan'){{ $message }}@enderror</div>
                            </div>
                            <!-- Additional fields like city, state, etc. -->
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
                                    {{-- @if($temple->images && $temple->main_image)
                                        <img src="{{ asset($temple->main_image) }}" alt="Main Image" class="img-fluid">
                                    @endif --}}
                                    <input type="file" class="form-control" name="temple_mainimg" id="temple_mainimg">
                                    <input type="hidden" id="existing_mainimg" value="{{ $temple->main_image ?? '' }}">
                                   <div class="error-message"> @error('temple_mainimg'){{ $message }}@enderror</div>
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Featured Images (multiple images supported)</label>
                                    @if($temple->images && $temple->images->isNotEmpty())
                                        <div class="row">
                                            @foreach($temple->images as $image)
                                                <div class="col-4">
                                                    {{-- <img src="{{ asset('storage/'.$image->path) }}" alt="Featured Image" class="img-thumbnail"> --}}
                                                </div>
                                            @endforeach
                                        </div>
                                    @endif
                                    {{-- {{ dd($temple->images) }} --}}
                                    <input type="file" class="form-control" name="temple_featuredimgs[]" id="temple_featuredimgs" multiple>
                                    <input type="hidden" id="existing_featuredimgs"  value="{{ implode(',', $temple->images->pluck('image_url')->toArray()) }}">
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
                                <input type="checkbox" class="custom-switch-input" name="arti_switch" id="arti_switch"
                                {{ isset($temple->artiTimes) ? 'checked' : '' }}>

                                <span class="custom-switch-indicator"></span>
                                <span class="custom-switch-description">Enable</span>
                            </label>
                        </div>
                        <div class="card-body" id="arti_section">
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label>Special Arti for festival</label>
                                    <input type="text" name="special_arti_date" class="form-control datepicker" @isset($temple->artiTimes->date) value="{{ $temple->artiTimes->date }}" @endisset   {{ isset($temple->artiTimes->date) ? '' : 'disabled' }}>
                                <div class="error-message"> @error('special_arti_date'){{ $message }}@enderror</div>
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Timing of Arti</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text"><i class="fas fa-clock"></i></div>
                                        </div>
                                        <input type="text" name="special_arti_time" class="form-control timepicker" @isset($temple->artiTimes->time) value="{{ $temple->artiTimes->time }}" @endisset   {{ isset($temple->artiTimes->time) ? '' : 'disabled' }}>
                                        <input type="hidden" name="arti_id" value="{{ isset($temple->artiTimes->id) ? $temple->artiTimes->id : '' }}">
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
                            <label class="custom-switch">
                                <input type="checkbox" class="custom-switch-input" name="darshan_switch" id="darshan_switch"
                                {{ isset($temple->darshanTimes) ? 'checked' : '' }}>

                                <span class="custom-switch-indicator"></span>
                                <span class="custom-switch-description">Enable</span>
                            </label>
                        </div>
                        <div class="card-body" id="darshan_section">
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label>Special Darshan for festival</label>
                                    <input type="text" name="special_darshan_date" class="form-control datepicker" @isset($temple->darshanTimes->date) value="{{ $temple->darshanTimes->date }}" @endisset
                                    {{ isset($temple->darshanTimes->date) ? '' : 'disabled' }}>
                                <div class="error-message"> @error('special_darshan_date'){{ $message }}@enderror</div>
                                </div>
                                <div class="form-group col-md-3">
                                    <label>Timing of Darshan From:</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text"><i class="fas fa-clock"></i></div>
                                        </div>
                                        <input type="text" class="form-control timepicker" name="darshan_from" @isset($temple->darshanTimes->from) value="{{ $temple->darshanTimes->from }}" @endisset  {{ isset($temple->darshanTimes->from) ? '' : 'disabled' }}>
                                    </div>
                                <div class="error-message"> @error('darshan_from'){{ $message }}@enderror</div>
                                </div>
                                <div class="form-group col-md-3">
                                    <label>Timing of Darshan To:</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text"><i class="fas fa-clock"></i></div>
                                        </div>
                                        <input type="text" class="form-control timepicker" name="darshan_to" @isset($temple->darshanTimes->to) value="{{ $temple->darshanTimes->to }}" @endisset {{ isset($temple->darshanTimes->to) ? '' : 'disabled' }}>
                                        <input type="hidden" name="darshan_id" value="{{ $temple->darshanTimes->id ?? '' }}">
                                    </div>
                                <div class="error-message"> @error('darshan_to'){{ $message }}@enderror</div>
                                </div>
                            </div>
                        </div>
                    </div>


                    @if($temple->images && $temple->images->isNotEmpty())
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h4>Temple Featured Images</h4>
                        </div>
                        <div class="card-body" id="darshan_section">

                                @php
                                    $i = 1;
                                @endphp
                                <div class="row">
                                    @foreach ($temple->images as $image)
                                        <div class="col-md-3 col-4 mb-3">
                                            <div class="card">
                                                <img src="{{ asset($image->image_url) }}" class="card-img-top" alt="{{ $image->image_name }}" style="width: 100%; height: 200px; object-fit: cover;">
                                                <div class="card-body text-center">
                                                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteImageModal" data-image-id="{{ $image->id }}">Delete</button>
                                                </div>
                                            </div>
                                        </div>

                                        @if ($loop->index % 5 == 5) <!-- Every 5 images create a new row -->
                                            </div>
                                            <div class="row">
                                        @endif
                                    @php
                                        $i++;
                                    @endphp
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endif
                    <div class="text-right">
                        <button class="btn btn-primary">Update Changes</button>
                        <button class="btn btn-danger">Delete  Temple</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
<!-- Delete Modal -->
<div class="modal fade" id="deleteImageModal" tabindex="-1" role="dialog" aria-labelledby="deleteImageModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteImageModalLabel">Confirm Deletion</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Are you sure you want to delete this image?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-danger" id="confirmDeleteButton">Delete</button>
            </div>
        </div>
    </div>
</div>
@endsection

@push('script')

<script>
    let imageIdToDelete = null;

// When delete button is clicked, store the image ID
$('#deleteImageModal').on('show.bs.modal', function (event) {
    const button = $(event.relatedTarget); // Button that triggered the modal
    imageIdToDelete = button.data('image-id'); // Extract image ID from data attribute
});

// Handle the delete confirmation
$('#confirmDeleteButton').click(function () {
    if (!imageIdToDelete) return;

    $.ajax({
        url: `/temple-images/${imageIdToDelete}`,
        type: 'DELETE',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // Ensure CSRF token is included
        },
        success: function (response) {
            if (response.status === 'success') {
                iziToast.success({
                    title: 'Success',
                    message: 'Temple Fetured Image deleted',
                    position: 'topRight'
                });
                // Remove the image card from the DOM
                $(`button[data-image-id="${imageIdToDelete}"]`).closest('.col-md-3').remove();
                $('#deleteImageModal').modal('hide');
            } else {
                alert(response.message);
            }
        },
        error: function (xhr) {
            alert('An error occurred while deleting the image.');
        }
    });
});

</script>





<script>
    let templeId = "{{ $temple->id }}";
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
            // Regular expression to match YouTube watch URLs and embed URLs
            const youtubePattern = /^(https?:\/\/)?(www\.)?(youtube\.com\/(watch\?v=|embed\/)|youtu\.be\/)([a-zA-Z0-9_-]{11})/;
            return youtubePattern.test(value);
        }, 'Please enter a valid YouTube link.');
        // Initialize jQuery Validation
        $('#basic_detail_form_update').validate({
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
                temple_season: {
                    required: true
                },
                temple_mainimg: {
                    required: function() {
                        return !$('#temple_mainimg').val() && !$('#existing_mainimg').val(); // Check if the input is empty and no image exists
                    }
                },
                "temple_featuredimgs[]": {
                    required: function() {
                        return !$('#temple_featuredimgs').val() && !$('#existing_featuredimgs').val(); // Check if the input is empty and no images exist
                    }
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
                temple_season: "Please Select the Suitable Season",
                mobile: {
                    required: "Please fill in Mobile number",
                    digits: "Please enter a valid Mobile number",
                    minlength: "Mobile number must be 10 digits",
                    maxlength: "Mobile number must be 10 digits"
                },
                temple_city: "Please fill in City",
                temple_state: "Please fill in State",
                temple_country: "Please fill in Country",
                temple_address: {
                    required:"Please fill in Temple Address",
                    minlength: "The address cannot be less then 50 characters",
                    maxlength: "The address cannot be more then 250 characters"
                },
                temple_desc: {
                    required:"Please fill in Temple Description",
                    minlength: "The Temple Description cannot be less then 150 characters "
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
                    formData.delete('arti_id');

                    formData.append('special_arti_date', $('input[name="special_arti_date"]').val());
                    formData.append('special_arti_time', $('input[name="special_arti_time"]').val());
                    var artiId = $('input[name="arti_id"]').val();
                    if (artiId !== null && artiId !== '') {
                        formData.append('arti_id', artiId);
                    }
                    // formData.append('arti_id', $('input[name="arti_id"]').val());
                } else {
                    formData.delete('special_arti_date');
                    formData.delete('special_arti_time');
                    formData.delete('arti_id');
                }

                if ($('#darshan_switch').is(':checked')) {
                    var darshan_id = $('input[name="darshan_id"]').val();
                    if (darshan_id !== null && darshan_id !== '') {
                        formData.append('darshan_id', darshan_id);
                    }
                    // formData.append('darshan_id', $('input[name="darshan_id"]').val());
                    formData.append('special_darshan_date', $('input[name="special_darshan_date"]').val());
                    formData.append('darshan_from', $('input[name="darshan_from"]').val());
                    formData.append('darshan_to', $('input[name="darshan_to"]').val());
                }
                // Submit the form via AJAX
                $.ajax({
                    url: `/temples/${templeId}`,
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    headers: {
                        'X-CSRF-TOKEN': "{{ csrf_token() }}"
                    },
                    success: function (res) {
                        if (res.status === 'success') {
                            let timerInterval;
                            Swal.fire({
                                title: res.message,
                                html: "Page will refresh in <b></b> seconds.",
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
                                    // console.log("I was closed by the timer");
                                    // Refresh the page after alert closes
                                    window.location.reload();
                                }
                            });
                        }
                    },
                    error: function () {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'An error occurred while submitting the form.Pls try again later',
                        });
                    }
                });
            }
        });
    });
</script>
@endpush
