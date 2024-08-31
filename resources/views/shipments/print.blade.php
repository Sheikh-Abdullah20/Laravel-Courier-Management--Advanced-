<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Print shipments</title>
    <link rel="stylesheet" href="{{ asset('assets/css/print.css') }}">
    <style>

    </style>
</head>

<body>
    <div class="no-print">
        <div class="row">
            <div class="btn">
                <a href="{{ route('shipment.index') }}" class="btn">Back</a>
            </div>
            <div class="btn">
                <button onclick="window.print()" class="btn ">Print</button>
            </div>
        </div>
    </div>
    @foreach ($shipments as $shipment )
    <div class="print-container">
        <div class="row">
            <div class="col-6">
                <x-application-logo/>
            </div>
            @if(!empty($findRider))
            <div class="col-6" style="display: flex; padding: 2rem">
                <p>Rider Name: <strong>{{ $findRider->name }}</strong></p>
                <p>Rider Phone: <strong>{{ $findRider->phone }}</strong></p>
                <p>Rider Bike No: <strong>{{ $findRider->bike_no }}</strong></p>
            </div>
            @endif
           
        </div>
        <div class="info-section">
            <div class="section-1">
                <h3>Receiver Information</h3> 
                <p><strong>Name: </strong> {{ $shipment->receiver_name }} </p>
                <p><strong>Contact: </strong> {{ $shipment->receiver_phone }} </p>
                <p><strong>Delivery Address:</strong> {{ $shipment->delivery_address }} </p>

                <div class="section-2">
                    <br>
                    <h3>Shipper Information</h3>
                    <p><strong>Name: </strong> {{ $shipment->sender_name }} </p>
                    <p><strong>Contact: </strong> {{ $shipment->sender_phone }} </p>
                    <p><strong>Pickup Address: </strong> {{ $shipment->pickup_address }} </p>
                    <p><strong>Return Address: </strong> {{ $shipment->return_address }} </p>
                </div>
            </div>

            <div class="section-3">
                <h3>shipment Information</h3>
                <p><strong>Quantity: </strong> {{ $shipment->quantity }} </p>
                <p><strong>Order Number: </strong> {{ $shipment->order_number }} </p>
                <p><strong>Tracking No:</strong> {{ $shipment->tracking_number }} </p>
                <p><strong>Origin:</strong> {{ $shipment->from_city }} </p>
                <p><strong>Destination:</strong> {{ $shipment->to_city }} </p>
                <p><strong>Return City:</strong>{{ $shipment->return_city }}  </p>
                <p><strong>Remarks:</strong> {{ $shipment->description }} </p>
            </div>
            <div class="section-4">
                <h3>Order Information</h3>
                {{ QrCode::generate(route('shipment.show',$shipment->id)) }}
                <p><strong>Date: {{ $shipment->created_at->format('d M Y')  }} </strong> </p>
                <p><strong>Amount:</strong> Rs: {{ $shipment->amount }} </p>
                <p><strong>Order Type:</strong> {{ $shipment->package_type }} </p>
            </div>
        </div>
       
    </div>
    @endforeach
</body>
<script>
    window.print();
</script>
</html>