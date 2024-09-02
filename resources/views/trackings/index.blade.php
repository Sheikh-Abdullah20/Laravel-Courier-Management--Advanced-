@extends('layouts.app')

@section('title')
Shipment - Tracking
@endsection
@section('css')
<link rel="stylesheet" href="{{ asset('assets/css/trackingPrint.css') }}">
@endsection
@section('content')
<section class="content-main">
    <div class="content-header">
        <div>
            <h2 class="content-title">Shipment - Tracking</h2>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('tracking.index') }}" method="GET">
                @csrf
                <label for="track">Shipment Tracking</label>
                <input type="number" class="form-control w-50" placeholder="Tracking Number" id="track" name="track"
                    value="{{ old('track') }}">

                <button class="btn btn-dark my-3 d-block" type="submit">Track Your Shipment</button>

            </form>
            @if(request()->has('track'))
            @if(!empty($shipment))
            <hr>
            <div class="row">
                <div class="col-md-12 d-flex justify-content-end">
                    <button onclick="window.print()" class="btn btn-success"><i
                            class="icon material-icons md-print"></i></button>
                </div>
            </div>
            <div class="row">

                <div class="col-md-1 ">
                    <x-application-logo />
                </div>

                <div class="col-md-4 p-4">
                    <h3>Sender Details</h3>
                    <br>
                    <p>Sender Name: <b>{{ $shipment->sender_name }}</b></p>
                    <p>Sender Email: <b>{{ $shipment->sender_email }}</b></p>
                    <p>Sender Address: <b>{{ $shipment->from_area }}</b></p>
                    <p>Pickup Address: <b>{{ $shipment->pickup_address }}</b></p>
                    <p>Origin: <b>{{ $shipment->city }}</b></p>
                    <p>Booking Date: <b>{{ $shipment->shipping_date }}</b></p>
                </div>

                <div class="col-md-4 p-4">
                    <h3>Receiver Details </h3>
                    <br>
                    <p>Receiver Name: <b>{{ $shipment->receiver_name }}</b></p>
                    <p>Receiver Email: <b>{{ $shipment->receiver_email }}</b></p>
                    <p>Receiver Address: <b>{{ $shipment->delivery_address }}</b></p>
                    <p>Receiver City: <b>{{ $shipment->city }}</b></p>
                </div>
                <div class="col-md-3 p-4">
                    <h3>Shipment Tracking</h3>
                    <br>
                    <p>Tracking Number: <b>{{ $shipment->tracking_number }}</b></p>

                    @if($shipment->status_shipment === 'Delivered')
                    <p>Current Status: <span class="bg-warning p-2 rounded text-dark"><b>{{ $shipment->status_shipment
                                }}</b></span></p>
                    @elseif($shipment->status_shipment === 'On the way')
                    <p>Current Status: <span class="bg-primary p-2 rounded text-light"><b>{{ $shipment->status_shipment
                                }}</b></span></p>
                    @elseif($shipment->status_shipment === 'Pending')
                    <p>Current Status: <span class="bg-danger p-2 rounded text-light"><b>{{ $shipment->status_shipment
                                }}</b></span></p>
                    @elseif($shipment->status_shipment === 'Approved')
                    <p>Current Status: <span class="bg-success p-2 rounded text-light"><b>{{ $shipment->status_shipment
                                }}</b></span></p>
                    @else
                    <p>Current Status: <span class="bg-secondary p-2 rounded text-light"><b>{{
                                $shipment->status_shipment }}</b></span></p>
                    @endif
                    <p>Amount: <b>Rs:{{ $shipment->amount }}</b></p>
                </div>
            </div>

            <div class="row no-print">
                <h3>Order Progress:</h3>
            </div>

            <div class="row">
                <div class="col-md-12">
                    @if($shipment->status_shipment === 'Pending')
                    <div class="progress no-print" role="progressbar" aria-label="Basic example" aria-valuenow="0"
                        aria-valuemin="0" aria-valuemax="100">
                        <div class="progress-bar bg-danger" style="width: 10%"></div>
                    </div>
                    @elseif($shipment->status_shipment === 'Approved')
                    <div class="progress no-print" role="progressbar" aria-label="Basic example" aria-valuenow="0"
                        aria-valuemin="0" aria-valuemax="100">
                        <div class="progress-bar" style="width: 30%"></div>
                    </div>

                    @elseif($shipment->status_shipment === 'On the way')
                    <div class="progress no-print" role="progressbar" aria-label="Basic example" aria-valuenow="0"
                        aria-valuemin="0" aria-valuemax="100">
                        <div class="progress-bar bg-primary" style="width: 70%"></div>
                    </div>

                    @elseif($shipment->status_shipment === 'Delivered')
                    <div class="progress no-print" role="progressbar" aria-label="Basic example" aria-valuenow="0"
                        aria-valuemin="0" aria-valuemax="100">
                        <div class="progress-bar bg-warning" style="width: 100%"></div>
                    </div>

                    @endif

                </div>
            </div>

            @else
            <div class="row text-center my-5">
                <div class="col-md-12">
                    <div class="alert alert-danger">
                        No Shipment Found
                    </div>
                </div>
            </div>
            @endif
            @endif
        </div>
    </div>






</section>
@endsection