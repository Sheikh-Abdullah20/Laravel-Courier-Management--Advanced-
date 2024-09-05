@extends('layouts.app')

@section('title')
Shipment - Edit
@endsection

@section('content')
<section class="content-main">
    <div class="content-header">

        <div>
            <h2 class="content-title">Shipment - Edit</h2>
        </div>

    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('shipment.update',$shipment) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="row">
                           {{-- <input type="hidden" name="agent_name" value="{{ $shipment->agent_name }}"> --}}
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="shipping_date">Shipping Date*</label>
                                    <input type="date" class="form-control" id="shipping_date" name="shipping_date"
                                        style="cursor: pointer;" value="{{$shipment->shipping_date}}">
                                    @error('shipping_date')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="sender_name">Sender Name*</label>
                                    <input type="text" class="form-control" id="sender_name" name="sender_name" value="{{ $shipment->sender_name }}">
                                    @error('sender_name')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="receiver_name">Receiver Name*</label>
                                    <input type="text" class="form-control" id="receiver_name" name="receiver_name" value="{{$shipment->receiver_name}}">
                                    @error('receiver_name')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="sender_email">Sender Email*</label>
                                    <input type="email" class="form-control" id="sender_email" name="sender_email" value="{{ $shipment->sender_email }}">
                                    @error('sender_email')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="receiver_email">Receiver Email*</label>
                                    <input type="email" class="form-control" id="receiver_email" name="receiver_email" value="{{ $shipment->receiver_email }}">
                                    @error('receiver_email')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">        
                            @if($shipment->status === 'Approved' || auth()->user()->hasRole('admin'))
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="status">Status Shipment</label>
                                    <select name="status_shipment" id="status" class="form-select">
                                        @foreach ($statuss as $status )
                                            <option {{ $hasStatus === $status->status_name ? 'selected' : '' }} value="{{ $status->status_name }}">{{ $status->status_name }}</option>
                                        @endforeach
                                    </select>
                                    @error('status_shipment')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            @endif

                            @if(auth()->user()->hasRole('admin'))
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="approval">Approval Status</label>
                                    <select name="approval" id="approval" class="form-select">
                                    <option {{ $shipment->status === 'Approved' ? 'selected' : '' }} value="Approved">Approved</option>
                                    <option {{ $shipment->status === 'Pending' ? 'selected' : '' }} value="Pending">Pending</option>
                                    </select>
                                    @error('approval')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            @endif
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="sender_phone">Sender Phone*</label>
                                    <input type="text" class="form-control" id="sender_phone" name="sender_phone" value="{{ $shipment->sender_phone }}">
                                    @error('sender_phone')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="receiver_phone">Receiver Phone*</label>
                                    <input type="text" class="form-control" id="receiver_phone" name="receiver_phone" value="{{ $shipment->receiver_phone }}">
                                    @error('receiver_phone')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="pickup_address">Pickup Address*</label>
                                    <input type="text" class="form-control" id="pickup_address" name="pickup_address" value="{{$shipment->pickup_address}}">
                                    @error('pickup_address')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="delivery_address">Deliver Address*</label>
                                    <input type="text" class="form-control" id="delivery_address"
                                        name="delivery_address" value="{{$shipment->delivery_address}}">
                                    @error('delivery_address')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="return_address">Return Address*</label>
                                    <input type="text" class="form-control" id="return_address" name="return_address" value="{{ $shipment->return_address }}">
                                    @error('return_address')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="return_city">Return City*</label>
                                    <input type="text" class="form-control" id="return_city" name="return_city" value="{{ $shipment->return_city }}">
                                    @error('return_city')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                       
                        <div class="row">

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="city">City*</label>
                                    <input type="text" class="form-control" id="city" name="city" value="{{ $shipment->city }}">
                                    @error('city')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>


                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="from_area">From Area*</label>
                                    <input type="text" class="form-control" id="from_area" name="from_area" value="{{ $shipment->from_area }}">
                                    @error('from_area')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                      
                           

                          
                        


                        <div class="row">

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="to_area">To Area*</label>
                                    <input type="text" class="form-control" id="to_area" name="to_area" value="{{ $shipment->to_area }}">
                                    @error('to_area')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="payment_method">payment Method*</label>
                                    <select name="payment_method" id="payment_method" class="form-select"
                                        style="cursor: pointer;">
                                        <option value="" hidden >Select Payment Method</option>
                                        <option value="{{$shipment->payment_method}}" selected>{{ $shipment->payment_method }}</option>
                                        <option value="COD">COD</option>
                                        <option value="bank Transfer">bank Transfer</option>
                                    </select>
                                    @error('payment_method')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                        </div>
                        <div class="row my-4">
                            <div class="col-md-12">
                                <h2>Packaging Details</h2>
                                <hr>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="package_type">Order Type*</label>
                                    <input type="text" class="form-control" id="package_type" name="package_type" value="{{ $shipment->package_type }}">
                                    @error('package_type')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="description">Description</label>
                                    <input type="text" class="form-control" id="description" name="description" value="{{ $shipment->description }}">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="quantity">Quantity*</label>
                                    <input type="number" class="form-control" id="quantity" name="quantity" value="{{ $shipment->quantity }}">
                                    @error('quantity')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="weight">Weight*</label>
                                    <input type="text" class="form-control" id="weight" name="weight" value="{{ $shipment->weight }}">
                                    @error('weight')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="amount">Amount</label>
                                    <input type="number" class="form-control" name="amount" id="amount" value="{{$shipment->amount}}">
                                    @error('amount')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>


                        <button type="submit" class="btn btn-light font-sm my-4"><i
                            class="icon material-icons md-edit mx-1"></i>Update Shipment</button>
                </div>
            </div>
        </div>
    </div>
    </form>





</section>
@endsection