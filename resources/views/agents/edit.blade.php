@extends('layouts.app')

@section('title')
Agent - Edit
@endsection

@section('content')

<section class="content-main">
    <div class="content-header">

        <div>
            <h2 class="content-title">Agent - Edit</h2>
        </div>

    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('agent.update',$agent) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="name">Branch Name</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ $agent->branch_name }}">
                            @error('name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" name="email" value="{{ $agent->email }}">
                            @error('email')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                        </div>


                        <div class="mb-3">
                            <label for="address">Address</label>
                            <input type="text" class="form-control" id="address" name="address" value="{{ $agent->branch_address }}">
                            @error('address')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-12">
                                <label for="owner_name">Onwer Name</label>
                                <input type="text" class="form-control" id="owner_name" name="owner_name" value="{{ $agent->owner_name }}">
                                @error('owner_name')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-12">
                                <label for="owner_phone">Onwer Phone</label>
                                <input type="text" class="form-control" id="owner_phone" name="owner_phone" value="{{ $agent->owner_phone }}">
                                @error('owner_phone')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-12">
                                <label for="branch_status">branch_status </label>
                                <select class="form-select" id="branch_status" name="branch_status">                                 
                                    <option {{ $hasStatus === 'Active' ? 'selected' : '' }}   value="Active">Active</option>
                                    <option {{ $hasStatus === 'In-Active' ? 'selected' : '' }}   value="In-Active">In-Active</option>
                                </select>    
                                @error('branch_status')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                    
                        
                        <button type="submit" class="btn btn-dark my-3" >Update Agent</button>
                </div>
            </div>
        </div>
    </div>

    
</form>





</section>

@endsection