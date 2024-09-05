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
                            <label for="name">Name</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ $agent->name }}">
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
                            <input type="text" class="form-control" id="address" name="address" value="{{ $agent->address }}">
                            @error('address')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                     

                        <div class="row mb-3">
                            <div class="col-md-12">
                                <label for="owner_phone">Phone</label>
                                <input type="text" class="form-control" id="phone" name="phone" value="{{ $agent->phone }}">
                                @error('phone')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="branch">Branch Name</label>
                            <input type="text" class="form-control" id="branch" name="branch" value="{{ $agent->branch }}">
                            @error('branch')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-light font-sm my-3" ><i
                            class="icon material-icons md-edit mx-1"></i>Update Agent</button>
                </div>
            </div>
        </div>
    </div>

    
</form>





</section>

@endsection