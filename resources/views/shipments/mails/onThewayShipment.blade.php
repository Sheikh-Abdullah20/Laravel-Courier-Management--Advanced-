<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Shipment On-The-Way Mail</title>
    <link rel="stylesheet" href="{{ asset('assets/css/vendors/bootstrap.css') }}">
  </head>
  <body>
    <p>Sender Name: <b>{{ $request['sender_name'] }}</b></p>
    <br>
    <p>Receiver Name: <b>{{ $request['receiver_name'] }}</b></p>
    <hr>
    <p>Your Shipment is On The Way Please Be Patient</p>
    <br>
    <p>This Package Will Be Deliver To {{ $request['receiver_name'] }}</p>
    <br>
    <p>Pickup Address: <b> {{ $request['pickup_address'] }} </b></p>
    <br>
    <p>Delivery Address: <b> {{ $request['delivery_address'] }} </b></p>
    <br>
    <p>Tracking Number: {{ $shipment['tracking_number'] }}</p>
    <br>
    <h2>Track Your Shipments</h2>
    <a href="{{ route('guest.track-shipment') }}">Shipment Tracking</a>

</body>
<script src="{{ asset('assets/js/vendors/bootstrap.bundle.min.js') }}"></script>
</html>