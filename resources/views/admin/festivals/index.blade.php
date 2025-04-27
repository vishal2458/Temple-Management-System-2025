@extends('layouts.main')

@section('title', 'Festivals')

@section('main-content')
<!-- Festival Modal -->
<div class="modal fade" id="festivalModal" tabindex="-1" role="dialog" aria-labelledby="festivalModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="festivalForm" enctype="multipart/form-data">
                <input type="hidden" id="festivalId" name="id"> <!-- Hidden ID field -->
                <div class="modal-header">
                    <h5 class="modal-title" id="festivalModalLabel">Add Festival</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="festivalName">Festival Name</label>
                        <input type="text" class="form-control" id="festivalName" name="festivalName" placeholder="Festival Name">
                        <span class="text-danger error-festivalName"></span>
                    </div>
                    <div class="form-group">
                        <label for="startDate">Start Date</label>
                        <input type="date" class="form-control" id="startDate" name="startDate">
                        <span class="text-danger error-startDate"></span>
                    </div>
                    <div class="form-group">
                        <label for="endDate">End Date</label>
                        <input type="date" class="form-control" id="endDate" name="endDate">
                        <span class="text-danger error-endDate"></span>
                    </div>
                    <div class="form-group">
                        <label for="festival_image">festival Image</label>
                        <input type="file" class="form-control" id="festival_image" name="festival_image">
                        <!-- Hidden field to check if an image exists -->
                        <input type="hidden" id="hasImage" name="hasImage" value="0">
                        <span class="text-danger error-festival_image"></span>
                    </div>
                    <div class="form-group">
                        <label for="festival_desc">Festival Description</label>
                        <textarea name="festival_desc" id="festival_desc" class="form-control" cols="30" rows="20" placeholder="Festival Description"></textarea>
                        <span class="text-danger error-festival_desc"></span>
                    </div>
                    <div class="form-group">
                        <label for="temple">Temple</label>
                        <select class="form-control" id="temple" name="temple">
                            <option value="">Select Temple</option>
                            @foreach ($temples as $temple)
                                <option value="{{ $temple->id }}">{{ $temple->name . '-' . $temple->state }}</option>
                            @endforeach
                        </select>
                        <span class="text-danger error-temple"></span>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

<section class="section">
    <div class="section-header">
        <h1>Festivals</h1>
    </div>
    <a href="#" class="btn btn-primary mb-4" data-toggle="modal" data-target="#festivalModal" id="addFestival">Add Festival</a>

    <!-- Table to Display Festivals -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover" id="festival-table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Festival Name</th>
                                    <th>Image</th>
                                    <th>Date</th>
                                    <th>Festival At</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('script')
{{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>

<script>
    $(document).ready(function () {
        // Handle Add Festival Button
        $('#addFestival').click(function () {
            $('#festivalForm')[0].reset(); // Reset form
            $('.text-danger').text(''); // Clear error messages
            $('#festivalId').val(''); // Clear ID
            $('#festivalModalLabel').text('Add Festival'); // Set modal title
        });

        // Handle Edit Button Click
        $(document).on('click', '.btn-edit', function () {
            const festivalId = $(this).data('id');

            // Fetch festival data via AJAX
            $.ajax({
                url: `/festivals/${festivalId}/edit`,
                type: 'GET',
                success: function (response) {
                    $('#festivalId').val(response.id);
                    $('#festivalName').val(response.name);
                    $('#startDate').val(response.start_date);
                    $('#endDate').val(response.end_date);
                    $('#temple').val(response.temple_id);
                    $('#festival_desc').val(response.festival_desc);
                    $('#festivalModalLabel').text('Edit Festival');
                    if (response.image) {
                    $('#hasImage').val('1'); // Image exists
                    $('#imagePreview').attr('src', `/storage/festivals/${response.image}`).show();
                } else {
                    $('#hasImage').val('0'); // No image
                    $('#imagePreview').hide();
                }
                    console.log($('#hasImage').val()); // Should be '1' if image exists, '0' otherwise

                    $('#festivalModal').modal('show'); // Show modal
                },
                error: function () {
                    alert('Failed to fetch festival details.');
                }
            });
        });
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
        // Form Validation
        $("#festivalForm").validate({
            rules: {
                festivalName: "required",
                startDate: "required",
                endDate: {
                    required: true,
                    greaterThan: "#startDate"
                },
                temple: "required",
                festival_desc: "required",
                festival_image: {
                    required: function () {
                        return $('#festivalId').val() === '' || $('#hasImage').val() === '0';
                    },
                    fileExtension: "jpg|jpeg|png|pdf",
                }
            },
            messages: {
                festivalName: "Festival Name is required.",
                startDate: "Start Date is required.",
                endDate: {
                    required: "End Date is required.",
                    greaterThan: "End Date cannot be earlier than Start Date."
                },
                temple: "Please select a temple.",
                festival_desc: "Please write some details about the festival.",
                festival_image: {
                    required: "Festival image is required.",
                    extension: "Only JPG, JPEG, PNG, and GIF files are allowed."
                }
            },
            errorClass: "text-danger",
            errorElement: "span",
            submitHandler: function (form) {
                const formData = new FormData(form);
                formData.append('_token', $('meta[name="csrf-token"]').attr('content'));

                $.ajax({
                    url: '{{ route("admin.festivals.store") }}', // Always use the same route
                    type: 'POST', // Laravel requires POST for file uploads
                    data: formData,
                    processData: false, // Prevent jQuery from processing data
                    contentType: false, // Let browser set content type
                    success: function (response) {
                        $('#festivalModal').modal('hide');
                        Swal.fire({
                            icon: 'success',
                            title: $('#festivalId').val() ? 'Festival Updated' : 'Festival Added',
                            confirmButtonText: 'OK'
                        });
                        setTimeout(function () {
                            location.reload();
                        }, 3000);
                    },
                    error: function () {
                        alert('An error occurred while saving the festival.');
                    }
                });
            }
        });

        // Custom validation method to check if End Date is greater than Start Date
        $.validator.addMethod("greaterThan", function (value, element, param) {
            return value >= $(param).val();
        }, "End Date must be after Start Date.");

        // Initialize DataTable
        $('#festival-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{{ route('admin.festivals.index') }}',
            columns: [
                { data: 'id', name: 'id', className: 'text-center' },
                { data: 'name', name: 'name' },
                {
                    data: 'festival_image', 
                    name: 'festival_image',
                    render: function(data, type, row) {
                        return `<img src="${data ? data : 'default-image.jpg'}" 
                                alt="${row.name} image" 
                                style="width: 65px; height: 70px; object-fit: cover; margin-top:5px;">`;
                    }
                },
                { data: 'start_date', name: 'start_date' },
                {
                    data: 'temple',
                    name: 'temple',
                    render: function (data) {
                        return `<b>${data.name}</b><br>
                                <small>Located at: ${data.state} - ${data.country}</small><br>
                                <small>Phone: ${data.phone}</small>`;
                    }
                },
                {
                    data: 'id',
                    name: 'id',
                    orderable: false,
                    searchable: false,
                    render: function (data) {
                        return `<button class="btn btn-warning btn-edit" data-id="${data}">Edit</button>
                        <a href="/view-festival/${data}" class="btn btn-warning">View</a>`;
                    }
                }
            ],
            pageLength: 10,
            searchDelay: 500
        });
    });
</script>

@endpush
