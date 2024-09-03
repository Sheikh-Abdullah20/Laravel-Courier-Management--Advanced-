@extends('layouts.app')

@section('title')
view Shipments
@endsection

@section('content')
<section class="content-main">
    <div class="content-header">
        <div>
            <h2 class="content-title">Assigned Shipments Of Rider - ({{ $rider->name }})</h2>
        </div>
    </div>
    <hr>

    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <table class="table table-striped d text-center">
                        <thead>
                            <tr>
                                <th>Order Tracking</th>
                                <th>Agent Name</th>
                                <th>City</th>
                                <th>Sender Name</th>
                                <th>Receiver Name</th>
                                <th>Sender Email</th>
                                <th>Receiver Email</th>
                                <th>Order Number</th>
                                <th>Shipping Date</th>
                                <th>Assigning Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($shipments as $shipment)
                            <tr>
                                <td>{{ $shipment->tracking_number }}</td>
                                <td>{{ $shipment->agent_name }}</td>
                                <td>{{ $shipment->agent->city }}</td>
                                <td>{{ $shipment->sender_name }}</td>
                                <td>{{ $shipment->receiver_name }}</td>
                                <td>{{ $shipment->sender_email }}</td>
                                <td>{{ $shipment->receiver_email }}</td>
                                <td>{{ $shipment->order_number }}</td>
                                <td>{{ $shipment->shipping_date }}</td>
                                <td>{{ $shipment->created_at }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection