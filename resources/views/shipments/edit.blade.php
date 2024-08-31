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
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="agent_name">Agent Name*</label>
                                  <select  id="agent_name" name="agent_name" class="form-select" style="cursor: pointer"> 
                                    <option value="" hidden>Select Agent</option>
                                    @foreach ($agents as $agent )
                                        <option {{ $hasAgent === $agent->owner_name ? 'selected' : '' }} value="{{ $agent->owner_name }}">{{ $agent->owner_name }}</option>
                                    @endforeach
                                  </select>
                                    @error('agent_name')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

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
                            @if(auth()->user()->hasRole('admin'))
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="status">Status*</label>
                                    <select name="status" id="status" class="form-select">
                                        @foreach ($statuss as $status )
                                            <option {{ $hasStatus === $status->status_name ? 'selected' : '' }} value="{{ $status->status_name }}">{{ $status->status_name }}</option>
                                        @endforeach
                                    </select>
                                    @error('status')
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
                                    <label for="from_country">From Country*</label>
                                    <input type="text" class="form-control" id="from_country" name="from_country" value="{{ $shipment->from_country }}">
                                    @error('from_country')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="to_country">To Country*</label>
                                    <input type="text" class="form-control" id="to_country" name="to_country" value="{{ $shipment->to_country }}">
                                    @error('to_country')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="from_city">From City*</label>
                                    <input type="text" class="form-control" id="from_city" name="from_city" value="{{ $shipment->from_city }}">
                                    @error('from_city')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="to_city">To City*</label>
                                    <input type="text" class="form-control" id="to_city" name="to_city" value="{{ $shipment->to_city }}">
                                    @error('to_city')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="from_area">From Area*</label>
                                    <input type="text" class="form-control" id="from_area" name="from_area" value="{{ $shipment->from_area }}">
                                    @error('from_area')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="to_area">To Area*</label>
                                    <input type="text" class="form-control" id="to_area" name="to_area" value="{{ $shipment->to_area }}">
                                    @error('to_area')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>


                        <div class="row">
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

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="order_number">Order Refference</label>
                                    <input type="text" class="form-control" id="order_number" name="order_number" value="{{ $shipment->order_number }}">
                                    @error('order_number')
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
                                    <label for="package_type">Package Type*</label>
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


                        <button type="submit" class="btn btn-dark my-4">Update Shipment</button>
                </div>
            </div>
        </div>
    </div>
    </form>





</section>
@endsection