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
                <h4> <b> Branch Name : </b> {{ $agent->branch_name }} </h4> 
                <hr>
                <h4> <b> Branch Email : </b> {{ $agent->branch_email }} </h4>
                <hr>
                <h4> <b> Branch Address : {{ $agent->branch_address }} </b> </h4>
                <hr>
                <h4> <b> Owner Name : </b> {{ $agent->owner_name }} </h4>
                <hr>
                <h4> <b> Owner Phone : </b> {{ $agent->owner_phone }} </h4>
            </div>

            <div class="row my-4 px-2 ">
                <div class="col-md-6">
                    <a href="{{ route('agent.index') }}" class="btn btn-dark p-2 w-25  ">Back</a>
                </div>
            </div>
        </div>
    </div>
</div>


</section>

@endsection