@extends('layouts.main')

@section('title', 'Contacts')

@section('main-content')

    <section class="section">
        <div class="section-header">
            <h1>Inquiries </h1>
        </div>
        {{-- <a href="{{ route('admin.adduser') }}" class="btn btn-primary mb-4">Add New user</a> --}}

        <!-- Table to Display users -->
        <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table table-hover" id="inquiries-table">
                      <thead>
                        <tr>
                          <th class="text-center">
                            #
                          </th>
                          <th>User Name</th>
                          <th>Email</th>
                          <th>Subject</th>
                          <th>Date</th>
                          <th>Action</th>
                          {{-- <th>Action</th> --}}
                        </tr>
                      </thead>
                      <tbody>
                        @php
                            $i = 1;
                        @endphp
                        @foreach ($contacts as $contact)
                        <tr class="mt-5">
                            <td class="align-middle">{{ $i }}</td>
                            <td>
                                    <strong style="margin-left: 16px !important">{{ $contact->name}}</strong>
                            </td>
                            <td>{{ $contact->email }}</td>
                            <td>{{ $contact->subject }}</td>
                           <td>
                            {{ $contact->created_at->format('d-m-Y') }}

                            </td>
                            <td>
                                <a class="btn btn-primary" href="{{ route('admin.view.inquiries',$contact->id) }}">View Details</a>
                            </td>
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
    $('#inquiries-table').DataTable();
});
    </script>
@endpush
