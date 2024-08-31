@extends('layouts.app')

@section('title')
Rider - Show
@endsection

@section('css')
<style>
    .btn{
        display: block !important;
    }
</style>
@endsection
@section('content')
<section class="content-main">
    
<div class="row">
    
    <div class="col-md-12">
        <div class="card p-5">
            <div class="card-body">
                <h1 class="text-center mb-4">Rider Details</h1>
                <h4> <b> Rider Name : </b> {{ $rider->name }} </h4> 
                <hr>
                <h4> <b> Rider Phone : {{ $rider->phone }} </b> </h4>
                <hr>
                <h4> <b> Rider Address : {{ $rider->address }} </b> </h4>
                <hr>
                <h4> <b> Rider Bike_No : {{ $rider->bike_no }} </b> </h4>
                <hr>
                <h4> <b> Rider Cnic : {{ $rider->rider_cnic}} </b> </h4>

            </div>

            <div class="row my-4 px-2 ">
                <div class="col-md-6">
                    <a href="{{ route('rider.index') }}" class="btn btn-dark p-2 w-25  ">Back</a>
                </div>
            </div>
        </div>
    </div>
</div>


</section>

@endsection