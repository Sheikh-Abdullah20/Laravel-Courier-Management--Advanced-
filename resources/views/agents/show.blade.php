@extends('layouts.app')

@section('title')
Agent - Show
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
                <h1 class="text-center mb-4">Agent Details</h1>
                <h4> <b>  Name : </b> {{ $agent->name }} </h4> 
                <hr>
                <h4> <b> Email : </b> {{ $agent->email }} </h4>
                <hr>
                <h4> <b>  Address : {{ $agent->address }} </b> </h4>
                <hr>
                <h4> <b>  City : {{ $agent->city }} </b> </h4>
                <hr>
                <h4> <b> Branch : </b> {{ $agent->branch }} </h4>
                <hr>
                <h4> <b>Phone : </b> {{ $agent->phone }} </h4>
            </div>

            <div class="row my-4 px-2 ">
                <div class="col-md-6 ">
                    <a href="{{ route('agent.index') }}" class="btn btn-light w-50 font-sm  d-flex align-items-center justify-content-center"><i
                        class="icon material-icons md-arrow_back mx-1"></i>Back</a>
                </div>
            </div>
        </div>
    </div>
</div>


</section>

@endsection