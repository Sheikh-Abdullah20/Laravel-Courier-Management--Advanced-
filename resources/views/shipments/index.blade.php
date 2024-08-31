@extends('layouts.app')

@section('title')
Shipments - View
@endsection

@section('content')
<x-alert />
<section class="content-main">
    <div class="content-header">

        <div>
            <h2 class="content-title">Shipments - View</h2>
        </div>

        @can('create shipments')    
        <div>
            <a href="{{ route('shipment.create') }}" class="btn btn-dark">Create Shipment</a>
        </div>
        @endcan
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    @can('view riders')
                    <div class="row my-2">
                        <div class="col-md-12">
                            <h2>Riders</h2>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="table-responsive">
                                @php $count = 0; @endphp
                                <table class="table table-bordered  table-striped text-center p-5">
                                    <thead>
                                        <tr>
                                            @if(auth()->user()->hasPermissionTo('print'))
                                            <th>Select Rider</th>
                                            @elseif(auth()->user()->hasRole('admin'))
                                            <th>Select Rider</th>
                                            @endif
                                            <th>Rider ID</th>
                                            <th>Rider Name</th>
                                            <th>Rider Phone</th>
                                            <th>Rider Cnic</th>
                                            <th>Rider Bike_No</th>
                                            <th>Rider Address</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <form id="rider-form" action="{{ route('shipment.index') }}" method="GET">
                                            @csrf
                                            @foreach($riders as $rider)
                                            <tr>
                                                @php $count++; @endphp
                                                @if(auth()->user()->hasPermissionTo('print') ||
                                                auth()->user()->hasRole('admin'))
                                                <td>
                                                 <input type="radio" value="{{ $rider->id }}" name="rider" id="rider">
                                                </td>
                                                @endif
                                                <td>{{ $count }}</td>
                                                <td>{{ $rider->name }}</td>
                                                <td>{{ $rider->phone }}</td>
                                                <td>{{ $rider->rider_cnic }}</td>
                                                <td>{{ $rider->bike_no }}</td>
                                                <td>{{ $rider->address }}</td>
                                            </tr>
                                            @endforeach
                                        </form>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    @endcan
                    <div class="row my-5">
                        <div class="col-md-12">
                            <form action="{{ route('shipment.index') }}" method="GET" class="d-flex w-50 m-auto">
                                @csrf
                                <select name="agents" id="agents" class="form-select mx-3">
                                    <option value="" hidden>Choose Agent</option>
                                    <option value="">All</option>
                                    @foreach ($agents as $agent )
                                    <option value="{{ $agent->owner_name }}">{{ $agent->owner_name }}</option>
                                    @endforeach
                                </select>
                                <select name="status" id="status" class="form-select mx-3">
                                    <option value="" hidden>Choose Status</option>
                                    @foreach ($statuss as $status )
                                    <option value="{{ $status->status_name }}">{{ $status->status_name }}</option>
                                    @endforeach
                                </select>

                                <button type="submit" class="btn btn-dark">Filter</button>
                            </form>
                        </div>
                    </div>
                    @if($shipments->isEmpty())
                    <div class="row">
                        <div class="col-md-12">
                            <div class="alert alert-warning">
                                No shipments found
                            </div>
                        </div>
                    </div>

                    @else
                    <form id="form" action="{{ route('shipment.index') }}" method="GET">
                        @csrf
                        <div class="row">
                            <div class="col-md-12 d-flex justify-content-end">
                                <input type="hidden" name="action" id="form-action" value="">
                                @can('print')
                                <button type="button" onclick="submit_form('print')" class="btn btn-success mx-1"><i
                                        class="icon material-icons md-print"></i></button>
                                @endcan
                                @can('delete shipments')
                                <button type="button" onclick="submit_form('delete') " class="btn btn-danger mx-2"><i
                                        class="icon material-icons md-delete"></i></button>
                                @endcan
                                @can('download reports')
                                <a href="{{ route('download_shipment') }}" class="btn btn-secondary"><i
                                        class="icon material-icons md-cloud_download"></i></a>
                                @endcan
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table id="shipmentTable" class="table table-bordered  table-striped text-center">
                                <thead>
                                    <tr>
                                        @if(auth()->user()->hasPermissionTo('delete agents') ||
                                        auth()->user()->hasPermissionTo('print'))
                                        <th>Select</th>
                                        @elseif(auth()->user()->hasRole('admin'))
                                        <th>Select</th>
                                        @endif
                                        <th>Shipment ID</th>
                                        <th>Order Tracking</th>
                                        <th>Agent</th>
                                        <th>Sender Name</th>
                                        <th>Receiver Name</th>
                                        <th>Order Number</th>
                                        <th>Shipping Date</th>
                                        <th>Status</th>
                                        @if(auth()->user()->hasPermissionTo('edit shipments') ||
                                        auth()->user()->hasPermissionTo('show shipments'))
                                        <th>Actions</th>
                                        @elseif(auth()->user()->hasPermissionTo('delete shipments'))
                                        <th>Actions</th>
                                        @elseif(auth()->user()->hasRole('admin'))
                                        <th>Actions</th>
                                        @endif
                                    </tr>
                                </thead>
                                {{-- Opening Php for Making Counter --}}

                                @php $count = 0; @endphp
                                <tbody>
                                    @foreach($shipments as $shipment)
                                    @php $count++; @endphp
                                    <tr>
                                        @if(auth()->user()->hasPermissionTo('delete agents') ||
                                        auth()->user()->hasPermissionTo('print'))
                                        <td>
                                            <input type="checkbox" name="selected[]" value="{{ $shipment->id }}">
                                        </td>
                                        @elseif(auth()->user()->hasRole('admin'))
                                        <td>
                                            <input type="checkbox" name="selected[]" value="{{ $shipment->id }}">
                                        </td>
                    </form>
                    @endif
                    <td>{{$count}}</td>
                    <td>{{ $shipment->tracking_number }}</td>
                    <td>{{ $shipment->agent_name }}</td>
                    <td>{{ $shipment->sender_name }}</td>
                    <td>{{ $shipment->receiver_name }}</td>
                    <td>{{ $shipment->order_number }}</td>
                    <td>{{ $shipment->shipping_date }}</td>
                    @if($shipment->status === 'Pending')
                    <td><span class="bg-danger p-2 text-light ">{{ $shipment->status }}</span>
                    <td>
                        @elseif($shipment->status === 'Approved')
                    <td><span class="bg-success p-2 rounded text-light">{{ $shipment->status }}</span>
                    <td>

                        @elseif($shipment->status === 'On the way')
                    <td class="w-25"><span class="bg-primary p-2 rounded text-light">{{ $shipment->status }}</span>
                    <td>

                        @elseif($shipment->status === 'Delivered')
                    <td><span class="bg-warning p-2 rounded text-dark">{{ $shipment->status }}</span>
                    <td>
                        @else
                    <td><span class="bg-secondary p-2 rounded text-light">{{ $shipment->status }}</span>
                    <td>
                        @endif

                        <div class="row justify-content-center">
                            @can('show shipments')
                            <div class="col-md-2  mx-2 my-2">
                                <a href="{{ route('shipment.show', $shipment) }}" class="btn btn-sm btn-info"><i
                                        class="icon material-icons md-visibility"></i></a>
                            </div>
                            @endcan
                            @can('edit shipments')
                            <div class="col-md-2  my-2">
                                <a href="{{ route('shipment.edit',$shipment) }}" class="btn btn-sm btn-dark"><i
                                        class="icon material-icons md-edit"></i></a>
                            </div>
                            @endcan

                            @can('delete shipments')
                            <div class="col-md-2  mx-2 my-2">
                                <form action="{{ route('shipment.destroy',$shipment) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger"
                                        onclick="return confirm('Are You Sure You Want to Delete This Shipment?')"><i
                                            class="icon material-icons md-delete"></i></button>
                                </form>
                            </div>
                            @endcan
                        </div>

                    </td>
                    </tr>
                    @endforeach
                    </tbody>
                    </table>
                </div>
                @endif
            </div>
        </div>
    </div>
    </div>
    <div class="row">
        {{ $shipments->links() }}
    </div>





</section>
@endsection


@section('scripts')
<script>
    function submit_form(action) {
               

                if(action === 'delete'){
                const checkbox =  document.querySelectorAll('input[name="selected[]"]:checked');
                if(checkbox.length < 1){
                    alert('Please Select Shipment First');
                }else{
                  confirmed = confirm('Are You Sure');
                  if(confirmed){
                    document.getElementById('form-action').value = action;
                    document.getElementById('form').submit();
                  }
                }
                 }else if(action === 'print'){                    
                    const checkbox = document.querySelectorAll('input[name="selected[]"]:checked');
                  if(checkbox.length < 1){
                    alert('Please Select Shipment First');
                  }else{
                    let rider = document.querySelector('input[name="rider"]:checked');
                    let selectedRider = null;
                    
                    if(rider){
                    selectedRider = rider.value;
                    console.log(selectedRider);
               
                        const riderInput = document.createElement('input');
                        riderInput.type = 'hidden';
                        riderInput.name = 'rider_id';
                        riderInput.value = selectedRider;
                        document.getElementById('form').appendChild(riderInput);
                        document.getElementById('form-action').value = action;
                        document.getElementById('form').submit();  
                    }
                    document.getElementById('form-action').value = action;
                    document.getElementById('form').submit();  
                    
                }
            }
              
                console.log(action);
            }   
            
</script>
@endsection