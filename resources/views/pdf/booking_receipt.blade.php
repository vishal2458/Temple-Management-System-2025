<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>booking Receipt</title>
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
       
        <h2>{{ $temple['name'] }}</h2>
        <p>Booking Reciept</p>
    </div>
    <!-- Receipt Box -->
    <div class="receipt-box">
        <h3>booking Details</h3>
        <table class="details">
            <tr>
                <td><strong>Reference No:</strong></td>
                <td>{{ $booking['receipt_number'] }}</td>
            </tr>
            <tr>
                <td><strong>Booking Id:</strong></td>
                <td>{{ $booking['booking_id'] }}</td>
            </tr>
            <tr>
                <td><strong>Temple:</strong></td>
                <td>{{ $temple['name'] }}</td>
            </tr>
            <tr>
                <td><strong>Date:</strong></td>
                <td>{{ date('d M Y, h:i A', strtotime($booking['booking_date'])) }}</td>
            </tr>
        </table>
    </div>

    <!-- Thank You Message -->
    <div class="thank-you">
         Thank You!
    </div>

    <!-- Footer -->
    <div class="footer">
        <p>For any queries, contact us at <strong>{{ $temple['email'] }}</strong></p>
        {{-- <p>Visit: <strong>www.rammandirayodhya.org</strong></p> --}}
    </div>

</body>
</html>
