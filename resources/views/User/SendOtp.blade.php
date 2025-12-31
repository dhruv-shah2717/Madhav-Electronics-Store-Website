<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            margin: 0;
            padding: 0;
        }
        p {
            color: black;
        }
        .otp {
            font-weight: bold;
            color: #e53637;
        }
    </style>
</head>
<body>

    <p>Hello Mr./Ms. User,</p>

    <p>Your account has been created successfully!</p>

    <p>Your One-Time Password (OTP) is: <span class="otp">{{ $data1['otp'] }}</span></p>

    <p>Please use this OTP to complete your verification process. For security reasons, do not share this code with anyone.</p>

    <p>Thank you for choosing us!</p>

    <p>Best Regards,</p>
    <p>The Madhav Team</p>

</body>
</html>