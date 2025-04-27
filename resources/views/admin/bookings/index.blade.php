@extends('layouts.main')

@section('title', 'Bookings')

@section('main-content')

    <section class="section">
        <div class="section-header">
            <h1>Darshan Bookings</h1>
        </div>
        {{-- <a href="{{ route('admin.addtemple') }}" class="btn btn-primary mb-4">Add New Temple</a> --}}

        <!-- Table to Display Temples -->
        <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover" id="bookings-table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Devote</th>
                                    <th>Arrival</th>
                                    <th>Booking Id</th>
                                    <th>From</th>
                                    <th>Temple</th>
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

    </div>
    </section>
@endsection

@push('script')
<script>
$('#bookings-table').DataTable({
    processing: true,
    serverSide: true,
    ajax: '{{ route('admin.bookings.index') }}',
    columns: [
        { data: 'id', name: 'id', className: 'text-center' },
        {
            data: 'user',
            name: 'user',
            render: function (data) {
                return `<b>${data.first_name} ${data.last_name}</b><br>
                        <small>Email: ${data.email}</small><br>
                        <small>Phone: ${data.mobile_no}</small>`;
            }
        },
        { data: 'booking_date', name: 'booking_date' },
        { data: 'booking_id', name: 'booking_id' },
        {
            data: 'user.user_details.country',
            name: 'user.user_details.country',
            render: function (data) {
                return data.name;
            }
        },
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
                return `<a href="/view-booking/${data}" class="btn btn-warning">View</a>`;
            }
        }
    ],
    pageLength: 10,
    searchDelay: 500 // Adds a delay before searching
});


</script>

@endpush