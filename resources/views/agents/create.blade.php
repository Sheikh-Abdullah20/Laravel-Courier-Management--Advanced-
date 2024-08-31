-- Active: 1720255218737@@127.0.0.1@3306@my_courier
@extends('layouts.app')

@section('title')
Agent - Create
@endsection

@section('content')
<section class="content-main">
    <div class="content-header">

        <div>
            <h2 class="content-title">Agent - Create</h2>
        </div>

    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('agent.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="name">Branch Name</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}">
                            @error('name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}">
                            @error('email')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                        </div>

                        <div class="mb-3">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" id="password" name="password" value="{{ old('password') }}">
                            @error('password')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-12">
                                <label for="country">Country</label>
                                <input type="text" class="form-control" id="country" name="country" value="{{ old('country') }}">
                                @error('country')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="address">Address</label>
                            <input type="text" class="form-control" id="address" name="address" value="{{ old('address') }}">
                            @error('address')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-12">
                                <label for="owner_name">Onwer Name</label>
                                <input type="text" class="form-control" id="owner_name" name="owner_name" value="{{ old('owner_name') }}">
                                @error('owner_name')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                       

                        <div class="row mb-3">
                            <div class="col-md-12">
                                <label for="owner_phone">Onwer Phone</label>
                                <input type="text" class="form-control" id="phone" name="owner_phone" value="{{ old('owner_phone') }}">
                                @error('owner_phone')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                    
                        
                        <button type="submit" class="btn btn-dark my-3" >Create Agent</button>
                </div>
            </div>
        </div>
    </div>

    
</form>





</section>
@endsection