<tbody>
    @php $i = 1; @endphp
    @foreach ($donations as $donation)
        <tr>
            <td class="align-middle">{{ $i }}</td>
            <td>{{ $donation->temple->name }}</td>
            <td>{{ $donation->donation_date }}</td>
            <td>{{ $donation->receipt_number }}</td>
            <td><i class="fas fa-rupee-sign"></i> <strong style="margin-left: 16px !important">{{ $donation->amount }}</strong></td>
            <td>
                <a href="{{ asset($donation->invoice) }}" download class="btn btn-warning">
                    Donation Receipt
                </a>
            </td>  
        </tr>
        @php $i++ @endphp
    @endforeach
</tbody>
