<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Your Password</title>
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
        .reset-button {
            display: inline-block;
            margin: 20px 0;
            padding: 12px 25px;
            background: #d9534f;
            color: white;
            font-size: 18px;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
        }
        .reset-button:hover {
            background: #c9302c;
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
            🔑 Password Reset Request
        </div>
        <div class="content">
            <p>Dear {{ $data['name'] }},</p>
            <p>We received a request to reset your password. Click the button below to set a new password.</p>
            <a href="{{ $data['verification_link'] }}" class="reset-button">Reset Password</a>
            <p>If you did not request a password reset, please ignore this email.</p>
            <h4>༒राधे राधे༒</h4>
        </div>
        <div class="footer">
            © 2025 Temple Trust | All Rights Reserved
        </div>
    </div>
</body>
</html>
