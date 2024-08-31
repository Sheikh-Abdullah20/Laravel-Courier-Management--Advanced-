<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Contact Us</title>
    <link rel="stylesheet" href="{{ asset('assets/css/vendors/bootstrap.css') }}">
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2 class="text-center">Hello Admin </h2>
                <p>{{ $request['name'] }} is Send You Something from Our Website</p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <h3>Contact Information</h3>
                <ul class="list-unstyled">
                    <li>Name: {{ $request['name'] }}</li>
                    <li>Email: {{ $request['email'] }}</li>
                </ul>
                <h3>Message</h3>
                <p>{{ $request['message'] }}</p>
            </div>
        </div>
    </div>
</body>
</html>
   
