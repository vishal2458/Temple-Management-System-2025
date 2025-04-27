@extends('user.userlayouts.main')

@section('title', 'Temples')

@section('main-content')

    <section class="section">
        <div class="section-header">
            <h1>Temples</h1>
        </div>
        {{-- <a href="{{ route('admin.addtemple') }}" class="btn btn-primary mb-4">Add New Temple</a> --}}

        <!-- Table to Display Temples -->
        <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table table-hover" id="table-1">
                      <thead>
                        <tr>
                          <th class="text-center">
                            #
                          </th>
                          <th>Temple Name</th>
                          <th>Temple Image</th>
                          <th>Temple Email</th>
                          <th>Temple Contact</th>
                          <th>Temple State</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        @php
                            $i = 1;
                        @endphp
                        @foreach ($temples as $temple)
                        <tr class="mt-5">
                            <td class="align-middle">{{ $i }}</td>
                            <td>
                                    <strong style="margin-left: 16px !important">{{ $temple->name }}</strong>
                            </td>
                            <td> <img src="{{ asset($temple->main_image) }}" alt="{{ $temple->name }} image" style="width: 65px; height: 70px; object-fit: cover;margin-top:5px"></td>
                            <td>{{ $temple->email }}</td>
                            <td>{{ $temple->phone }}</td>
                            <td>{{ $temple->state  }}</td>
                            <td><a href="{{ route('user.temples.show',$temple->id) }}" class="btn btn-warning">View</a></td>
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
