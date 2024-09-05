@extends('layouts.app')

@section('title')
view Shipments
@endsection

@section('content')
<x-alert/>
<section class="content-main">
    <div class="content-header">
        <div>
            <h2 class="content-title">Assigned Shipments Of Rider - ({{ $rider->name }})</h2>
        </div>

        @if($shipments->isNotEmpty())
        <div>
            <form action="{{ route('assignedShipment_riders',$rider->id) }}" method="GET">
                @csrf
                <button type="submit" class="btn btn-light font-sm" name="download"><i
                    class="icon material-icons md-get_app mx-1"></i>Download Assigned Shipment Report</button>
                </form>
        </div>
        @endif
    </div>
    <hr>
 <div class="row">
    <div class="col-md-12 d-flex justify-content-end mb-3">
        <form id="form" action="{{ route('assignedShipment_riders',$rider->id) }}" method="GET">
            @csrf
            <input type="hidden" value="{{ $rider->id }}" name="rider_id">
            <a id="button" class="btn btn-danger font-sm"><i
                class="icon material-icons md-delete mx-1"></i>Delete</a>
        
    </div>
 </div>
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="table-responsive">
                    <table class="table table-striped  text-center">
                        <thead class="table-light">
                            <tr>
                                <th>Select</th>
                                <th>Rider Name</th>
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
                                <td>
                                   
                                    <input type="checkbox" value="{{ $shipment->id }}" name="selected[]" class="form-check-input">
                               
                                </td>
                                <td>{{ $rider->name }}</td>
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
                        </form>
                        </tbody>
                    </table>
                </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('scripts')

<script>
    document.getElementById('button').addEventListener('click', function(){
        let checkbox = document.querySelectorAll('input[name="selected[]"]:checked');
        if( checkbox.length < 1){
            alert('Please Select Any Shipment First');
        }else{
            confirmed = confirm('Are You sure you want to Delete Assigned Shipments? ')
            if(confirmed){
                document.getElementById('form').submit();
            }
        }
    });
</script>

@endsection