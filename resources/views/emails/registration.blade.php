<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email Verification</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f6f2;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: 20px auto;
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            border: 5px solid #e6b800;
        }
        .header {
            background: #e6b800;
            padding: 20px;
            text-align: center;
            color: white;
            font-size: 24px;
            font-weight: bold;
        }
        .content {
            padding: 30px;
            text-align: center;
        }
        .content p {
            font-size: 18px;
            color: #333;
        }
        .verify-button {
            display: inline-block;
            margin: 20px 0;
            padding: 12px 25px;
            background: #d4a017;
            color: white;
            font-size: 18px;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
        }
        .verify-button:hover {
            background: #b88a00;
        }
        .footer {
            background: #f2e1c0;
            text-align: center;
            padding: 15px;
            font-size: 14px;
            color: #555;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            🛕 Temple Email Verification
        </div>
        <div class="content">
            <p>Dear Devotee, {{ $data['name'] }}</p>
            <p>Thank you for registering with us. Please verify your email to proceed further.</p>
            <a href="{{ $data['verification_link'] }}" class="verify-button">Verify Email</a>
            <p>May the divine blessings always be with you. 🕉️</p>
            <h4>༒राधे राधे༒</h4>
        </div>
        <div class="footer">
            © 2025 Temple Trust | All Rights Reserved
        </div>
    </div>
</body>
</html>
