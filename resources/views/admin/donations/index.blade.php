@extends('layouts.main')

@section('title', 'Donations')

@section('main-content')

    <section class="section">
        <div class="section-header">
            <h1>Donations</h1>
        </div>

        <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover" id="donation-table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Devotee</th>
                                    <th>Amount</th>
                                    <th>Donated on</th>
                                    <th>Receipt No</th>
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

    </section>

@endsection

@push('script')
<script>
$(document).ready(function () {
    $('#donation-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{{ route('admin.donations.index') }}',
        columns: [
            { data: 'id', name: 'id', className: 'text-center' },
            {
                data: 'user',
                name: 'user',
                render: function (data) {
                    if (data && data.first_name && data.last_name) {
                        return `<b>${data.first_name} ${data.last_name}</b>`;
                    } else {
                        return `<b>Anonymous</b>`;
                    }
                }
            },
            { data: 'amount', name: 'amount' },
            { data: 'donation_date', name: 'donation_date' },
            { data: 'receipt_number', name: 'receipt_number' },
            {
                data: 'temple',
                name: 'temple',
                render: function (data) {
                    return data ? `<b>${data.name}</b>` : '<b>Unknown</b>';
                }
            },
            {
                data: 'id',
                name: 'id',
                orderable: false,
                searchable: false,
                render: function (data) {
                    return `<a href="/view-donation/${data}" class="btn btn-warning">View</a>`;
                }
            }
        ],
        pageLength: 10,
        searchDelay: 500
    });
});
</script>
@endpush
