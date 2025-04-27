<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Donation Receipt</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            color: #333;
        }
        .header, .footer {
            text-align: center;
            background-color: #f8f8f8;
            padding: 15px;
            border-radius: 10px;
        }
        .header img {
            width: 80px;
            height: auto;
            margin-bottom: 10px;
        }
        .receipt-box {
            border: 2px solid #ddd;
            padding: 20px;
            border-radius: 10px;
            margin-top: 20px;
        }
        .details {
            width: 100%;
            margin-top: 10px;
        }
        .details td {
            padding: 8px;
            border-bottom: 1px solid #ddd;
        }
        .footer {
            font-size: 14px;
            margin-top: 20px;
        }
        .temple-image {
            text-align: center;
            margin-bottom: 20px;
        }
        .temple-image img {
            width: 100%;
            max-height: 250px;
            object-fit: cover;
            border-radius: 10px;
        }
        .thank-you {
            text-align: center;
            font-size: 18px;
            margin-top: 20px;
            color: #28a745;
            font-weight: bold;
        }
    </style>
</head>
<body>

    <!-- Header -->
    <div class="header">

        <h2>{{ $temple->name }}</h2>
        <p>Donation Reciept</p>
    </div>
    <!-- Receipt Box -->
    <div class="receipt-box">
        <h3>Donation Details</h3>
        <table class="details">
            <tr>
                <td><strong>User :</strong></td>
                @if(!empty($user))
                    <td>{{ $user->first_name.' ' .$user->middle_name.' '.$user->last_name }}</td>
                    @else
                    <td>Anonymous Donation</td>
                @endif

            </tr>
            <tr>
                <td><strong>Amount:</strong></td>
                <td>Rs {{ $donation->amount }}</td>
            </tr>
            <tr>
                <td><strong>Invoice No:</strong></td>
                <td>{{ $donation->receipt_number }}</td>
            </tr>
            <tr>
                <td><strong>Transation Id:</strong></td>
                <td>{{ $donation->transaction_id }}</td>
            </tr>
            <tr>
                <td><strong>Payment Mode:</strong></td>
                <td>{{ $donation->payment_method }}</td>
            </tr>
            <tr>
                <td><strong>Temple:</strong></td>
                <td>{{ $temple['name'] }}</td>
            </tr>
            <tr>
                <td><strong>Date:</strong></td>
                <td>{{ date('d M Y, h:i A', strtotime($donation->donation_date)) }}</td>
            </tr>
        </table>
    </div>

    <!-- Thank You Message -->
    <div class="thank-you">
         Thank You!
    </div>

    <!-- Footer -->
    <div class="footer">
        <p> Thank You for Your Generous Contribution! Your donation helps in temple maintenance, religious services, and community welfare activities. May Lord Ram bless you with peace, prosperity, and happiness.</p>
    </div>

</body>
</html>
