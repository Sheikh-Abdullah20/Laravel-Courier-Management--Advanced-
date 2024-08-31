@extends('layouts.app')

@section('title')
User - Show
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
                <h1 class="text-center mb-4">User Details</h1>
                <h4> <b> User Name : </b> {{ $user->name }} </h4> 
                <hr>
                <h4> <b> User Email : </b> {{ $user->email }} </h4>
                <hr>
                <h4> <b> User Address : {{ $user->address }} </b> </h4>
                <hr>
                <h4> <b> User Phone : {{ $user->phone }} </b> </h4>
                <hr>
                <h4> <b> User Country : {{ $user->country }} </b> </h4>
                <hr>
                <h4> <b> User Date Of Birth : {{ $user->dob}} </b> </h4>

            </div>

            <div class="row my-4 px-2 ">
                <div class="col-md-6">
                    <a href="{{ route('user.index') }}" class="btn btn-dark p-2 w-25  ">Back</a>
                </div>
            </div>
        </div>
    </div>
</div>


</section>

@endsection