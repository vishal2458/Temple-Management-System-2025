@extends('user.userlayouts.main')

@section('title', 'Bookings')

@section('main-content')

    <section class="section">
        <div class="section-header">
            <h1>Darshan Bookings</h1>
        </div>
        {{-- <a href="{{ route('admin.addtemple') }}" class="btn btn-primary mb-4">Add New Temple</a> --}}

        <!-- Table to Display Temples -->
        {{-- {{ dd($bookings) }} --}}
        <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover" id="table-1">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th><i class="fas fa-synagogue"></i> Temple Name</th>
                                    <th><i class="fas fa-globe-asia"></i> Location</th>
                                    <th><i class="fas fa-calendar-alt"></i> Darshan Date</th>
                                    <th><i class="fas fa-id-badge"></i> Booking ID</th>
                                    <th><i class="fas fa-lock"></i> Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $i = 1;
                                @endphp
                                @foreach ($bookings as $booking)
                                <tr class="mt-5">
                                    <td class="align-middle">{{ $i }}</td>
                                    <td>{{ $booking->temple->name }}</td>
                                    <td> <b>{{ $booking->temple->state.','.$booking->temple->country }} </b></td>
                                    <td>{{ $booking->booking_date }}</td>                        
                                    <td>{{ $booking->booking_id }}</td>                                    
                                    <td>
                                        <a href="{{ asset($booking->invoice) }}" download class="btn btn-warning">
                                            Booking Receipt
                                        </a>
                                    </td>                             
                                  </tr>
                                  @php
                                      $i++
                                  @endphp
                                @endforeach
                              </tbody>
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
    $(document).ready(function () {
    $('#table-1').DataTable();
});
</script>

@endpush
