@extends('layouts.main')

@section('title', 'Users')

@section('main-content')

    <section class="section">
        <div class="section-header">
            <h1>Users</h1>
        </div>
        {{-- <a href="{{ route('admin.adduser') }}" class="btn btn-primary mb-4">Add New user</a> --}}

        <!-- Table to Display users -->
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
                          <th>User Name</th>
                          <th>Profile</th>
                          <th>User Contact Info</th>
                          <th>User Details</th>
                          {{-- <th>User State</th> --}}
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        @php
                            $i = 1;
                        @endphp
                        @foreach ($users as $user)
                        <tr class="mt-5">
                            <td class="align-middle">{{ $i }}</td>
                            <td>
                                    <strong style="margin-left: 16px !important">{{ $user->first_name.' '.$user->middle_name.' '.$user->last_name }}</strong>
                            </td>
                            <td>
                                <img alt="image" src="{{ asset($user->profile_picture ?? 'assets/img/avatar/avatar-1.png') }}" class="rounded-circle" width="35" data-toggle="tooltip" title="" data-original-title="{{ $user->first_name }}" style="width: 63px;height:58px">
                              </td>
                           <td>
                            <small>Email: {{ $user->email }}</small><br>
                            <small>Phone: {{ $user->mobile_no }}</small><br>
                            </td>
                           <td>
                            <small>Location: {{ $user->userDetails->state['name'] ?? '' }}-{{ $user->userDetails->country['name'] ?? '' }}</small><br>
                            <small>Gender: {{ $user->gender}}</small><br>
                            </td>
                            <td><a href="{{ route('admin.viewUserDetails',$user->id) }}" class="btn btn-warning">View</a></td>
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
