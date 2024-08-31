<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Welcome Mail</title>
</head>
<body>
    <h1>Welcome to Our Website!</h1>
    <p>Hi {{ $request['name'] }},</p>
    <p>Thank you for signing up . We hope you find this email interesting and informative.</p>
 
    <p> <b>Your Credentials</b></p>
    <p>Login: {{ $request['email'] }}</p>
    <p>Password: {{ $request['password'] }}</p>
    <br>
    <p style="color: red">Dont Share These Credentials With Anyone..!:</p>
    
    <a href="{{ route('guest') }}">Login Here....</a>
    <br>
    <p>This email is automatically generated. Please do not reply to
    
</body>
</html>