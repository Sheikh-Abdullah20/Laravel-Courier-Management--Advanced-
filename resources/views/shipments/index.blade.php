@extends('layouts.app')

@section('title')
Shipments - View
@endsection

@section('content')
<x-alert />
<section class="content-main">
    <div class="content-header">

        <div>
            <h2 class="content-title mb-2">Shipments - View</h2>
        </div>
        @can('create shipments')
        <div>
            <a href="{{ route('shipment.create') }}" class="btn btn-light font-sm "><i
                class="icon material-icons md-create mx-1"></i>Create Shipment</a>
        </div>
        @endcan
    </div>

    
        <div class="row mb-2">
            <form id="form" action="{{ route('shipment.index') }}" method="GET">
                @csrf
            <div class="col d-flex justify-content-end">
                <input type="hidden" name="action" id="form-action" value="">
                <input type="hidden" name="selectedId" value="" id="selected_ids">
                <input type="hidden" name="riderId" value="" id="selected_rider_id">
                @can('print')
                <button type="button" onclick="submit_form('print')" class="btn btn-success mx-1 font-sm"><i
                        class="icon material-icons md-print mx-1"></i>Print</button>
                @endcan
                @can('delete shipments')
                <button type="button" onclick="submit_form('delete') " class="btn btn-danger mx-2 font-sm"><i
                        class="icon material-icons md-delete mx-1"></i>Delete</button>
                @endcan
                @can('download reports')
                <a href="{{ route('download_shipment') }}" class="btn btn-light font-sm"><i
                        class="icon material-icons md-get_app mx-1"></i>Download Shipments Report</a>
                @endcan
            </div>
          </form>
        </div>
    <div class="row my-3">
        <div class="col-md-12">
            <div class="card ">
                <header class="card-header">
                    <form action="{{ route('shipment.index') }}" method="GET">
                        @csrf
                        <div class="row align-items-center">
                            @if(auth()->user()->hasRole('admin') || auth()->user()->hasRole('agent'))
                            <div class="col-md-3 col-12 me-auto mb-md-0 mb-3">
                                <div class="custom_select">
                                    <select class="form-select " name="agents">
                                        <option value="" hidden>Choose Agent</option>
                                        @foreach ($agents as $agent )
                                        <option value="{{ $agent->name }}">{{ $agent->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            @endif
                            <div class="col-md-2 col-6">
                                
                                <input type="search" class="form-control  mx-2" placeholder="Tracking Number"
                                    name="search_tracking_number">
                            </div>

                            <div class="col-md-2 col-6">
                                <div class="custom_select">
                                    <select class="form-select  mx-2" name="status">
                                        <option value="" hidden>Choose Status</option>
                                        @foreach ($statuss as $status )
                                        <option value="{{ $status->status_name }}">{{ $status->status_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-2 col-6">
                                <button type="submit" class="btn btn-light font-sm mx-3 rounded "> <i
                                    class="icon material-icons md-search mx-1"></i>Search</button>
                            </div>
                        </div>
                </header>
            </form>
                <div class="card-body">
                    <div class="row align-items-center my-3">
                        @if(auth()->user()->hasRole('admin'))
                        <form action="{{ route('shipment.index') }}" method="GET">
                        <h5 class="card-title">Riders</h5>
                        <div class="col-md-3 col-12 me-auto mb-md-0 mb-3">
                            <div class="custom_select">
                                <select class="form-select" id="rider-select">
                                    <option value="" hidden>Select Rider</option>
                                    @foreach($riders as $rider)
                                    <option value="{{ $rider->id }}">{{ $rider->name }} - ({{ $rider->rider_city }})
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </form>
                        @endif
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

                    <div class="table-responsive">
                        <table class="table table-striped text-center">
                            <thead class="table-light">
                                <tr>
                                    @if(auth()->user()->hasPermissionTo('delete agents') ||
                                    auth()->user()->hasPermissionTo('print'))
                                    <th><input type="checkbox" class="form-check-input" id="selectAll" onclick="AllSelected(this)"></th>
                                    @elseif(auth()->user()->hasRole('admin'))
                                    <th><input type="checkbox" class="form-check-input" id="selectAll" onclick="AllSelected(this)"></th>
                                    @endif

                                    <th>Order Tracking</th>
                                    <th>Agent</th>
                                    <th>City</th>
                                    <th>Sender Name</th>
                                    <th>Receiver Name</th>
                                    <th>Order Number</th>
                                    <th>Shipping Date</th>
                                    @if(auth()->user()->hasRole('admin') || auth()->user()->hasRole('agent'))
                                    <th scope="col">Status</th>
                                    @endif
                                    <th scope="col">Shipment_Status</th>
                                    @if(auth()->user()->hasRole('user'))
                                    <th scope="col">Amount</th>
                                    @endif
                                    @if(auth()->user()->hasPermissionTo('edit shipments') ||
                                    auth()->user()->hasPermissionTo('show shipments'))
                                    <th scope="col">Actions</th>
                                    @elseif(auth()->user()->hasPermissionTo('delete shipments') ||
                                    auth()->user()->hasRole('admin'))
                                    <th scope="col">Actions</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($shipments as $shipment)
                                <tr>
                                    @if(auth()->user()->hasPermissionTo('delete agents') ||
                                    auth()->user()->hasPermissionTo('print'))
                                    <td>
                                        <input type="checkbox" name="selected[]" value="{{ $shipment->id }}"
                                            class="form-check-input">
                                    </td>
                                    @elseif(auth()->user()->hasRole('admin'))
                                    <td>
                                        <input type="checkbox" name="selected[]" value="{{ $shipment->id }}"
                                            class="form-check-input">
                                    </td>

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
                                    <td>
                                        <p class="bg-success p-1 rounded text-light font-sm ">{{ $shipment->status }}</p>
                                        @elseif($shipment->status === 'Pending')
                                    <td>
                                        <p class="bg-danger p-1 rounded text-light font-sm ">{{ $shipment->status }}</p>
                                        @endif
                                        @endif


                                        @if($shipment->status_shipment === 'Order Initiated')
                                    <td>
                                        <p class="bg-success p-1 rounded text-light  font-sm">{{ $shipment->status_shipment }}
                                        </p>
                                    </td>

                                    @elseif($shipment->status_shipment === 'On the way')
                                    <td>
                                        <p class="bg-primary p-1 rounded text-light font-sm">{{ $shipment->status_shipment }}
                                        </p>
                                    </td>

                                    @elseif($shipment->status_shipment === 'Delivered')
                                    <td>
                                        <p class="bg-warning p-1 rounded text-dark font-sm">{{ $shipment->status_shipment }}</p>
                                    </td>
                                    @else
                                    <td>
                                        <p class="bg-secondary p-1 rounded text-light font-sm">{{ $shipment->status_shipment }}
                                        </p>
                                    </td>
                                    @endif
                                    @if(auth()->user()->hasRole('user'))
                                    <td>Rs:{{ $shipment->amount }}</td>
                                    @endif
                                    <td>
                                        <div class="row justify-content-center">
                                            @can('show shipments')
                                            <div class="col-md-2  mx-2 my-2">
                                                <a href="{{ route('shipment.show', $shipment) }}"
                                                    class="btn btn-sm btn-warning"><i
                                                        class="icon material-icons md-visibility"></i></a>
                                            </div>
                                            @endcan

                                            @if($shipment->status === 'Approved' || auth()->user()->hasRole('admin'))
                                            @can('edit shipments')
                                            <div class="col-md-2  my-2">
                                                <a href="{{ route('shipment.edit',$shipment) }}"
                                                    class="btn btn-sm btn-dark"><i
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
    <div class="pagination-area mt-30 mb-50">
        <nav aria-label="Page navigation example">
            {{ $shipments->links() }}
        </nav>
    </div>





</section>
@endsection


@section('scripts')
<script>
            function submit_form(action) {    
                     const checkbox =  document.querySelectorAll('input[name="selected[]"]:checked');
                     let selectedIds = [];
                        checkbox.forEach(checkbox => {
                        selectedIds.push(checkbox.value);
                    });

                    if(checkbox.length < 1){
                        alert('Please Select Shipment First');
                        return false;
                    }

                    if(action === 'delete'){
                      confirmed = confirm('Are You Sure');
                    if(confirmed){
                        document.getElementById('selected_ids').value = selectedIds
                        document.getElementById('form-action').value = action;
                        document.getElementById('form').submit();
                    }      
                    }else if(action === 'print'){                    
                        let selectRider = document.getElementById('rider-select');        
                        let selectedRider = selectRider ? selectRider.value : '';
                    
                        if(selectedRider !== ''){
                            document.getElementById('selected_ids').value = selectedIds
                            document.getElementById('selected_rider_id').value = selectedRider
                            document.getElementById('form-action').value = action;
                            document.getElementById('form').submit();   
                            console.log('rider Selected');
                        }else{
                            document.getElementById('selected_ids').value = selectedIds
                            console.log(selectedIds);
                            document.getElementById('form-action').value = action;
                            document.getElementById('form').submit();  
                    
                            console.log('rider Not Selected');
                        }
                       
                    

                }
                console.log(action);
            }
              

            function AllSelected(){
                let checkboxes = document.querySelectorAll('input[name="selected[]"]');
                checkboxes.forEach(checkbox => {
                    checkbox.checked = document.getElementById('selectAll').checked;
                }); 
            }
            
            
</script>
@endsection