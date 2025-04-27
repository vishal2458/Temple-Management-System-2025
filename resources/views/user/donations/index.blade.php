@extends('user.userlayouts.main')

@section('title', 'My Donations')

@section('main-content')

<section class="section">
    <div class="section-header">
        <h1>My Donations</h1>
    </div>

    <!-- Table to Display Donations -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover" id="donationsTable">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Temple Name</th>
                                    <th>Donation Date</th>
                                    <th>Receipt No</th>
                                    <th>Amount</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody></tbody> <!-- Data will be filled by DataTables AJAX -->
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection

@push('script')
<!-- Include jQuery and DataTables -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>

<script>
    $(document).ready(function () {
        $('#donationsTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('user.donations') }}",
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                { data: 'temple.name', name: 'temple.name' },
                { data: 'donation_date', name: 'donation_date' },
                { data: 'receipt_number', name: 'receipt_number' },
                { data: 'amount', name: 'amount' },
                { data: 'action', name: 'action', orderable: false, searchable: false },
            ]
        });
    });
</script>
@endpush
