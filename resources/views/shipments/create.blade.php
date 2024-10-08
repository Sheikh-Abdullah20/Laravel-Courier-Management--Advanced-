@extends('layouts.app')

@section('title')
Shipment - Create
@endsection

@section('content')
<x-alert/>
<section class="content-main">
    <div class="content-header">

        <div>
            <h2 class="content-title">Shipment - Create</h2>
        </div>

    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('shipment.store') }}" method="POST">
                        @csrf
                        <div class="row">
                            @if(auth()->user()->hasRole('admin'))
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="agent_name">Agent Name*</label>
                                  <select id="agent_name" name="agent_name" class="form-select" style="cursor: pointer" > 
                                    <option value="" hidden>Select Agent</option>
                                    @foreach ($agents as $agent )
                                        <option value="{{ $agent->id }}">{{ $agent->name }}</option>
                                    @endforeach
                                  </select>
                                    @error('agent_name')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            @endif

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="shipping_date">Shipping Date*</label>
                                    <input type="date" class="form-control" id="shipping_date" name="shipping_date"
                                        style="cursor: pointer;" value="{{ old('shipping_date') }}">
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
                                    <input type="text" class="form-control" id="sender_name" name="sender_name" value="{{ old('sender_name') }}">
                                    @error('sender_name')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="receiver_name">Receiver Name*</label>
                                    <input type="text" class="form-control" id="receiver_name" name="receiver_name" value="{{ old('receiver_name') }}">
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
                                    <input type="email" class="form-control" id="sender_email" name="sender_email" value="{{ old('sender_email') }}">
                                    @error('sender_email')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="receiver_email">Receiver Email*</label>
                                    <input type="email" class="form-control" id="receiver_email" name="receiver_email" value="{{ old('receiver_email') }}">
                                    @error('receiver_email')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="sender_phone">Sender Phone*</label>
                                    <input type="text" class="form-control" id="sender_phone" name="sender_phone" value="{{ old('sender_phone') }}">
                                    @error('sender_phone')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="receiver_phone">Receiver Phone*</label>
                                    <input type="text" class="form-control" id="receiver_phone" name="receiver_phone" value="{{ old('receiver_phone') }}">
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
                                    <input type="text" class="form-control" id="pickup_address" name="pickup_address" value="{{ old('pickup_address') }}">
                                    @error('pickup_address')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="delivery_address">Deliver Address*</label>
                                    <input type="text" class="form-control" id="delivery_address"
                                        name="delivery_address" value="{{ old('delivery_address') }}">
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
                                    <input type="text" class="form-control" id="return_address" name="return_address" value="{{ old('return_address') }}">
                                    @error('return_address')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="return_city">Return City*</label>
                                    <input type="text" class="form-control" id="return_city" name="return_city" value="{{ old('return_city') }}">
                                    @error('return_city')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            @if(auth()->user()->hasRole('agent'))
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="city">City*</label>
                                   <select  id="city" name="city" class="form-select">
                                    <option value="" hidden >Select City</option>
                                    <option value="{{ $city }}" >{{ $city }}</option>
                                   </select>
                                    @error('city')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        
                            @elseif(auth()->user()->hasRole('admin'))
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="city">City*</label>
                                    <input type="text" class="form-control" id="city" name="city" value="{{ old('city') }}">
                                    @error('city')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            @endif

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="from_area">From Area*</label>
                                    <input type="text" class="form-control" id="from_area" name="from_area" value="{{ old('from_area') }}">
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
                                    <input type="text" class="form-control" id="to_area" name="to_area" value="{{ old('to_area') }}">
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
                                        <option value="">Select Payment Method</option>
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
                                    <input type="text" class="form-control" id="package_type" name="package_type" value="{{ old('package_type') }}">
                                    @error('package_type')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="description">Description</label>
                                    <input type="text" class="form-control" id="description" name="description" value="{{ old('description') }}">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="quantity">Quantity*</label>
                                    <input type="number" class="form-control" id="quantity" name="quantity" value="{{ old('quantity') }}">
                                    @error('quantity')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="weight">Weight*</label>
                                    <input type="text" class="form-control" id="weight" name="weight" value="{{ old('weight') }}">
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
                                    <input type="number" class="form-control" name="amount" id="amount" value="{{ old('amount') }}">
                                    @error('amount')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>


                        <button type="submit" class="btn btn-light font-sm my-4"><i
                            class="icon material-icons md-create mx-1"></i>Create Shipment</button>
                </div>
            </div>
        </div>
    </div>
    </form>





</section>
@endsection