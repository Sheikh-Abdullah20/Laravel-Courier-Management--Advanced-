@extends('layouts.guest')

@section('title')
    Shipment-Track
@endsection

@section('css')
<link rel="stylesheet" href="{{ asset('assets/css/trackingPrintguest.css') }}">
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2 class="no-print">  Track - Shipment </h2>
                <p class="no-print">Enter Tracking Number Here Of Your Shipment to find Status Of Your Shipment</p>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
               
                <div class="card ">
                    <div class="card-body">
                        <form action="{{ route('guest.track-shipment') }}" method="GET">
                            @csrf
                            <label for="track">Shipment Tracking</label>
                            <input type="number" class="form-control w-50" placeholder="Tracking Number" id="track" name="track" value="{{ old('track') }}">
            
                            <button class="btn btn-dark my-3 d-block" type="submit">Track Your Shipment</button>
            
                        </form>
                        @if(request()->has('track'))
                        @if(!empty($shipment))
                        <hr>
                        <div class="row">
                            <div class="col-md-12 d-flex justify-content-end">
                                <button onclick="window.print()" class="btn btn-success"><i class="icon material-icons md-print"></i></button>
                            </div>
                        </div>
                     
                        <div class="row">
            
                                <div class="col-md-2 ">
                                    <x-application-logo/>
                                </div>
                        
                            <div class="col-md-6 p-4">
                                <h2>Shipment Booking Details</h2>
                                <br>
                                <p>Tracking Number: <b>{{ $shipment->tracking_number }}</b></p>
                                <p>Sender Name: <b>{{ $shipment->sender_name }}</b></p>
                                <p>Origin: <b>{{ $shipment->city }}</b></p>
                                <p>Booking Date:  <b>{{ $shipment->shipping_date }}</b></p>
                            </div>
            
                            <div class="col-md-4 p-4">
                                <h2>Shipment Track Status</h2>
                                <br>
                               @if($shipment->status === 'Delivered')
                               <p>Current Status: <span class="bg-warning p-2 rounded text-dark"><b>{{ $shipment->status }}</b></span></p>
                               @elseif($shipment->status === 'On the way')
                               <p>Current Status: <span class="bg-primary p-2 rounded text-light"><b>{{ $shipment->status }}</b></span></p>
                               @elseif($shipment->status === 'Pending')
                               <p>Current Status: <span class="bg-danger p-2 rounded text-light"><b>{{ $shipment->status }}</b></span></p>
                               @elseif($shipment->status === 'Approved')
                               <p>Current Status:  <span class="bg-success p-2 rounded text-light"><b>{{ $shipment->status }}</b></span></p>
                               @else
                               <p>Current Status:  <span class="bg-secondary p-2 rounded text-light"><b>{{ $shipment->status }}</b></span></p>
                               @endif
                            </div>
                        </div>
                        <div class="row no-print">
                            <h2>Order Progress:</h2>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                              @if($shipment->status_shipment === 'Pending')
                              <div class="progress" role="progressbar" aria-label="Basic example" aria-valuenow="0"       aria-valuemin="0" aria-valuemax="100">
                                <div class="progress-bar" style="width: 10%"></div>
                              </div>
                              @elseif($shipment->status_shipment === 'Approved')
                              <div class="progress" role="progressbar" aria-label="Basic example" aria-valuenow="0"       aria-valuemin="0" aria-valuemax="100">
                                <div class="progress-bar" style="width: 30%"></div>
                              </div>
            
                              @elseif($shipment->status_shipment === 'On the way')
                              <div class="progress" role="progressbar" aria-label="Basic example" aria-valuenow="0"       aria-valuemin="0" aria-valuemax="100">
                                <div class="progress-bar" style="width: 70%"></div>
                              </div>
            
                              @elseif($shipment->status_shipment === 'Delivered')
                              <div class="progress" role="progressbar" aria-label="Basic example" aria-valuenow="0"       aria-valuemin="0" aria-valuemax="100">
                                <div class="progress-bar" style="width: 100%"></div>
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
            </div>
        </div>
    </div>
@endsection