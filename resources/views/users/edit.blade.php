@extends('layouts.app')

@section('title')
User - Edit
@endsection


@section('content')
<section class="content-main">
    <div class="content-header">

        <div>
            <h2 class="content-title">User - Edit</h2>
        </div>

    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('user.update' , $user) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="name">User Name</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}">
                            @error('name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="email">User Email</label>
                            <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}">
                            @error('email')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                        </div>


                        <div class="mb-3">
                            <label for="address">Address</label>
                            <input type="text" class="form-control" id="address" name="address" value="{{ $user->address }}">
                            @error('address')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="dob">Date Of Birth</label>
                            <input type="date" class="form-control" id="dob" name="dob" style="cursor: pointer" value="{{ $user->dob }}">
                            @error('dob')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-3 row">
                            <div class="col-md-2">
                                <label for="country">City</label>
                                <input type="text" class="form-control" id="city" name="city" value="{{ $user->city }}">
                                @error('city')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-8">
                                <label for="phone">Phone Number</label>
                                <input type="text" class="form-control" id="phone" name="phone" value="{{ $user->phone }}">
                                @error('phone')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                                        
                        <button type="submit" class="btn btn-light font-sm my-3"><i class="icon material-icons md-edit mx-1"></i>Update User</button>
                </div>
            </div>
        </div>
    </div>
</form>

</section>
@endsection
