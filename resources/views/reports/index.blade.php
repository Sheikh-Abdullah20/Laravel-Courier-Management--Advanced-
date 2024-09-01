@extends('layouts.app')

@section('title')
Reports
@endsection

@section('content')
<section class="content-main">
    <div class="content-header">
        <div>
            <h2 class="content-title">Reports</h2>
        </div>
    </div>
    <hr>
   <div class="row">
    <div class="col-md-12 ">
        <form action="{{ route('report.index') }}" method="GET" class="d-flex justify-content-end mb-4">
        <input type="date" class="form-control w-25 mx-2" name="date">
            <select class="form-select w-25" name="city">
                <option value="" hidden>Select City</option>
                @foreach($agents as $agent)
                <option value="{{ $agent->city }}">{{ $agent->city }}</option>
                @endforeach
            </select>
        <button type="submit" class="btn btn-dark mx-2">Search</button>
    </form>

    </div>
   </div>

   @if(empty($date) && empty($city))
   <div class="row">
    <div class="col-md-12">
        <div class="alert alert-primary"> Search Shipments Report</div>
    </div>
   </div>
   @elseif($shipments->isEmpty())
   <div class="row">
    <div class="col-md-12">
        <div class="alert alert-primary">No Shipment Found {{ $date ? ' Date: ' .  $date : '' }} <br> {{ $city ? ' City : ' . $city : '' }} </div>
    </div>
   </div>
   
   @else
   <div class="row">
    <div class="col-md-12 d-flex justify-content-end ">
        <p>Total Shipments Found: <b>{{ $total_shipments }}</b> </p>
    </div>
   </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                    <table class="table table-stripped text-center">
                        <thead>
                            <tr>
                            <th>Tracking Number</th>
                            <th>Agent Name</th>
                            <th>Agent Branch</th>
                            <th>Agent City</th>
                            <th>Shipping Date</th>
                            <th>Sender Name</th>
                            <th>Receiver Name</th>
                            <th>Approval Status</th>
                            <th>Shipment Status</th>
                            <th>Payment Method</th>
                            <th>Amount</th>
                        </tr>
                        </thead>
                        @foreach($shipments as $shipment)
                        <tbody>
                            <tr>
                                <td>{{ $shipment->tracking_number }}</td>
                                <td>{{ $shipment->agent_name}}</td>
                                <td>{{ $shipment->agent->branch }}</td>
                                <td>{{ $shipment->agent->city}}</td>
                                <td>{{ $shipment->shipping_date}}</td>
                                <td>{{ $shipment->sender_name}}</td>
                                <td>{{ $shipment->receiver_name}}</td>
                                <td>
                                @if($shipment->status === 'Approved')
                                <p class="bg-success p-1 text-light">{{ $shipment->status }}</p>
                                @elseif($shipment->status === 'Pending')
                                <p class="bg-danger p-1 text-light">{{ $shipment->status }}</p>
                                @endif
                            </td>
                            <td>
                                @if($shipment->status_shipment === 'Pending')
                                <p class="bg-danger p-1 text-light">{{ $shipment->status }}</p>
                                @elseif($shipment->status_shipment === 'Approved')
                                <p class="bg-success p-1 text-light">{{ $shipment->status }}</p>
                                @elseif($shipment->status_shipment === 'On the way')
                                <p class="bg-primary p-1 text-light">{{ $shipment->status }}</p>
                                @elseif($shipment->status_shipment === 'Delivered')
                                <p class="bg-warning p-1 text-light">{{ $shipment->status }}</p>
                                @endif
                            </td>
                            <td>{{ $shipment->payment_method }}</td>
                            <td>{{ $shipment->amount }}</td>
                            </tr>    
                        </tbody>
                        @endforeach
                    </table>
                </div>
                </div>
            </div>
            {{ $shipments->links() }}
        </div>
    </div>
    @endif
</section>
@endsection