<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Shipment Creation Mail</title>
    <link rel="stylesheet" href="{{ asset('assets/css/vendors/bootstrap.css') }}">
  </head>
  <body>

    <h2>Shipment Has Been Created</h2>
    <br>
    <h4>Shipment Created By: {{ $shipment->agent_name }}</h4>
    <hr>
    <p>Sender Name: <b>{{ $request['sender_name'] }}</b></p>
    <p>Receiver Name: <b>{{ $request['receiver_name'] }}</b></p>
    <hr>
    <p>Please View The Shipment</p>
    <br>
    <p>This Package Will Be Deliver To {{ $request['receiver_name'] }}</p>
    <br>
    <p>Pickup Address: <b> {{ $request['pickup_address'] }} </b></p>
    <br>
    <p>Delivery Address: <b> {{ $request['delivery_address'] }} </b></p>
    <br>
    <p>Delivery City: <b> {{ $request['city'] }} </b></p>
    <br>
    <p>Tracking Number: {{ $shipment['tracking_number'] }}</p>
    <br>
    <h2> Approve Shipment Here... </h2>
    <a href="{{ route('shipment.index') }}">Admin Shipments</a>

</body>
<script src="{{ asset('assets/js/vendors/bootstrap.bundle.min.js') }}"></script>
</html>