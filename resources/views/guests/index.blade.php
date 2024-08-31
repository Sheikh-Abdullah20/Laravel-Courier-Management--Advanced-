@extends('layouts.guest')

@section('title')
Home
@endsection

@section('css')
<link rel="stylesheet" href="{{ asset('assets/guest/css/guest.css') }}">
@endsection

@section('content')
<x-alert/>
<div class="container">
    <div class="row">
        <div class="section1">
        <div class="col-md-6">
            <h2>My <span class="text-success">Courier</span></h2>
            <p>On-Time Delivery, <span class="text-success">Every Time</span></p>
            <a href="{{ route('guest.track-shipment') }}" class="btn btn-success mt-3">Track Your Shipment</a>
        </div>
        <div class="col-md-6">
            <img src="{{ asset('assets/imgs/guest-imgs/courier-service.png') }}" class="img-fluid" alt="Courier Image">
        </div>
    </div>
</div>

<div class="card">
    <div class="card-body">
        
<div class="row my-5">
    <div class="section1">
        <div class="col-md-6">
            <img src="{{asset('assets/imgs/guest-imgs/contact-us-form-img.png')}}" alt="" class="img-fluid">
        </div>

        <div class="col-md-6 my-5">
            <form action="{{ route('guest.contact-us') }}" method="POST" class="my-5">
                @csrf
                <h3 class="text-center">Contact Us</h3>
                <div class="mb-3">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" name="name" value="{{ old('name') }}" id="name">
                    @error('name')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="email">Email</label>
                    <input type="text" class="form-control" name="email" value="{{ old('email') }}" id="email">
                    @error('email')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="Message">Message</label>
                    <textarea name="message" id="Message" cols="30" rows="10" class="form-control">{{ old('message') }}</textarea>
                    @error('message')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

               <button class="btn btn-success d-flex"> <i class="icon material-icons md-send mx-2"></i> Send</button>


            </form>
        </div>
    </div>
</div>
    </div>
</div>
</div>
@endsection