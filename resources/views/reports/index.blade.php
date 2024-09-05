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
      
        <div class="col-md-4 d-flex justify-content-between">
        <form action="{{ route('report.index') }}" method="GET">
            <input type="hidden" value="{{ $from }}" name="from">
            <input type="hidden" value="{{ $to }}" name="to">
            <input type="hidden" value="{{ $city }}" name="city">
            <button type="submit" class="btn btn-light font-sm" name="download"><i
                class="icon material-icons md-get_app mx-1"></i>Download Report</button>
        </form>
        </div>


    <div class="col-md-8 ">
        <form action="{{ route('report.index') }}" method="GET" class="d-flex justify-content-end mb-4">
        <label for="from" class="form-label my-2">From</label>
        <input type="date" class="form-control mx-2" name="from" id="from">

    
        <label for="to" class="form-label my-2">To</label>
        <input type="date" class="form-control mx-2" name="to" id="to">

       
            <select class="form-select w-75" name="city">
                <option value="" hidden>Select City</option>
                @foreach($agents as $agent)
                <option value="{{ $agent->city }}">{{ $agent->city }}</option>
                @endforeach
            </select>
        <button type="submit" class="btn btn-light font-sm mx-2"><i
            class="icon material-icons md-search mx-1"></i>Search</button>
    </form>

    </div>
   </div>

  
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
                    <table class="table table-striped text-center">
                        <thead class="table-light">
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
                        <tbody>
                            @foreach($shipments as $shipment)
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
                                <p class="bg-success p-1 text-light rounded font-sm">{{ $shipment->status }}</p>
                                @elseif($shipment->status === 'Pending')
                                <p class="bg-danger p-1 text-light rounded font-sm">{{ $shipment->status }}</p>
                                @endif
                            </td>
                            <td>
                                
                                
                                @if($shipment->status_shipment === 'Order Initiated')
                                <p class="bg-success p-1 text-light rounded font-sm">{{ $shipment->status_shipment }}</p>
                                @elseif($shipment->status_shipment === 'On the way')
                                <p class="bg-primary p-1 text-light rounded font-sm">{{ $shipment->status_shipment }}</p>
                                @elseif($shipment->status_shipment === 'Delivered')
                                <p class="bg-warning p-1 text-light rounded font-sm">{{ $shipment->status_shipment }}</p>
                                @else
                                <p class="bg-secondary p-1 text-light rounded font-sm">{{ $shipment->status_shipment }}</p>
                                @endif
                            </td>
                            <td>{{ $shipment->payment_method }}</td>
                            <td>{{ $shipment->amount }}</td>
                            </tr>    
                            @endforeach
                        </tbody>
                    </table>
                </div>
                </div>
            </div>
            {{ $shipments->links() }}
        </div>
    </div>
  
</section>
@endsection