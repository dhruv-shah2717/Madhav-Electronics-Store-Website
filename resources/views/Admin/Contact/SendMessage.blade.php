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
    </style>
</head>
<body>

    <p>Hello Mr/Ms. {{ $data1['username'] }},</p>

    <p>We have received a contact form submission from this email: {{ $data1['email'] }}.</p>
    
    <p>Here is your solution:</p>
        
    <p>{{ $data1['message'] }}</p>

    <p>If you have any further questions or need additional assistance, feel free to reach out!</p>

    <p>Best regards,</p>
    <p>The Madhav Team</p>

</body>
</html>