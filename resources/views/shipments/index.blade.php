@extends('layouts.app')

@section('title')
Shipments - View
@endsection

@section('content')
<x-alert />
<section class="content-main">
    <div class="content-header justify-content-end">

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
                    {{-- @can('view riders')
                    <div class="row my-2">
                        <div class="col-md-12">
                            <h2>Riders</h2>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="table-responsive">
                                @php $count = 0; @endphp
                                <table class="table table-striped text-center">
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
                                                    <input type="radio" value="{{ $rider->id }}" name="rider"
                                                        id="rider">
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
                    @endcan --}}

                    <div>
                        <h2 class="content-title mb-2">Shipments - View</h2>
                    </div>
                    <div class="row mb-4">
                        <div class="col-md-12 mb-4">
                            <form action="{{ route('shipment.index') }}" method="GET" class="d-flex w-75 m-auto">
                                @csrf

                                <input type="search" class="form-control " placeholder="Tracking Number"
                                    name="search_tracking_number">

                                @if(auth()->user()->hasRole('admin') || auth()->user()->hasRole('agent'))
                                <select name="agents" id="agents" class="form-select mx-3">
                                    <option value="" hidden>Choose Agent</option>
                                    <option value="">All</option>
                                    @foreach ($agents as $agent )
                                    <option value="{{ $agent->name }}">{{ $agent->name }}</option>
                                    @endforeach
                                </select>
                                @endif

                                <select name="status" id="status" class="form-select mx-2">
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
                        <div class="row mb-2">
                            @if(auth()->user()->hasRole('admin'))
                            <div class="col-md-4 d-flex align-items-center">
                                <select name="rider" class="form-select w-50" id="select_rider">
                                    <option value="" hidden>Select Rider</option>
                                    @foreach($riders as $rider)
                                    <option value="{{ $rider->id }}">{{ $rider->name }} - ({{ $rider->rider_city }})</option>
                                    @endforeach
                                </select>
                                <label for="select_rider" class="mx-1">Select Rider to Assign Shipments</label>
                            </div>
                            @endif
                            <div class="col d-flex justify-content-end">
                                <input type="hidden" name="action" id="form-action" value="">
                                @can('print')
                                <button type="button" onclick="submit_form('print')" class="btn btn-success mx-1"><i
                                        class="icon material-icons md-print mx-1"></i>Print</button>
                                @endcan
                                @can('delete shipments')
                                <button type="button" onclick="submit_form('delete') " class="btn btn-danger mx-2"><i
                                        class="icon material-icons md-delete mx-1"></i>Delete</button>
                                @endcan
                                @can('download reports')
                                <a href="{{ route('download_shipment') }}" class="btn btn-dark"><i
                                        class="icon material-icons md-get_app mx-1"></i>Download Shipments Report</a>
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

                                        <th>Order Tracking</th>
                                        <th>Agent</th>
                                        <th>City</th>
                                        <th>Sender Name</th>
                                        <th>Receiver Name</th>
                                        <th>Order Number</th>
                                        <th>Shipping Date</th>
                                        @if(auth()->user()->hasRole('admin') || auth()->user()->hasRole('agent'))
                                        <th>Status</th>
                                        @endif
                                        <th>Shipment_Status</th>
                                        @if(auth()->user()->hasRole('user'))
                                        <th>Amount</th>
                                        @endif
                                        @if(auth()->user()->hasPermissionTo('edit shipments') ||
                                        auth()->user()->hasPermissionTo('show shipments'))
                                        <th>Actions</th>
                                        @elseif(auth()->user()->hasPermissionTo('delete shipments') ||
                                        auth()->user()->hasRole('admin'))
                                        <th>Actions</th>
                                        @endif
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($shipments as $shipment)
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
                            <td>{{ $shipment->tracking_number }}</td>
                            <td>{{ $shipment->agent_name }}</td>
                            <td>{{ $shipment->agent->city }}</td>
                            <td>{{ $shipment->sender_name }}</td>
                            <td>{{ $shipment->receiver_name }}</td>
                            <td>{{ $shipment->order_number }}</td>
                            <td>{{ $shipment->shipping_date }}</td>
                            
                            @if(auth()->user()->hasRole('admin') || auth()->user()->hasRole('agent'))
                            @if($shipment->status === 'Approved')
                            <td><p class="bg-success p-1 rounded text-light ">{{ $shipment->status }}</p>
                                @elseif($shipment->status === 'Pending')
                            <td><p class="bg-danger p-1 rounded text-light ">{{ $shipment->status }}</p>
                                @endif
                                @endif

                            
                            @if($shipment->status_shipment === 'Order Initiated')
                            <td><p class="bg-success p-1 rounded text-light">{{ $shipment->status_shipment }}</p>
                            </td>

                            @elseif($shipment->status_shipment === 'On the way')
                            <td><p class="bg-primary p-1 rounded text-light">{{ $shipment->status_shipment }}</p>
                            </td>

                            @elseif($shipment->status_shipment === 'Delivered')
                            <td><p class="bg-warning p-1 rounded text-dark">{{ $shipment->status_shipment }}</p>
                            </td>
                            @else
                            <td><p class="bg-secondary p-1 rounded text-light">{{ $shipment->status_shipment }}</p>
                            </td>
                            @endif
                            @if(auth()->user()->hasRole('user'))
                            <td>Rs:{{ $shipment->amount }}</td>
                            @endif
                            <td>
                                <div class="row justify-content-center">
                                    @can('show shipments')
                                    <div class="col-md-2  mx-2 my-2">
                                        <a href="{{ route('shipment.show', $shipment) }}" class="btn btn-sm btn-info"><i
                                                class="icon material-icons md-visibility"></i></a>
                                    </div>
                                    @endcan

                                    @if($shipment->status === 'Approved' || auth()->user()->hasRole('admin'))
                                    @can('edit shipments')
                                    <div class="col-md-2  my-2">
                                        <a href="{{ route('shipment.edit',$shipment) }}" class="btn btn-sm btn-dark"><i
                                                class="icon material-icons md-edit"></i></a>
                                    </div>
                                    @endcan
                                    @endif

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
                      document.getElementById('form-action').value = action;
                      document.getElementById('form').submit();  
                      
                  }
                }
                console.log(action);
            }
              
            
            
</script>
@endsection