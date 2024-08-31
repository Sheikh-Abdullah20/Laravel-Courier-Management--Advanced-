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
                                <label for="country">Country</label>
                                <input type="text" class="form-control" id="country" name="country" value="{{ $user->country }}">
                                @error('country')
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
                       
                        <div class="mb-3">
                            <label for="current_Role">Current Role</label>
                            <input type="text" class="form-control" id="current_Role"  value="{{ $user->roles->pluck('name')->implode('') }}" readonly>
                        </div>


                        <div class="mb-3">
                            <div class="row">
                                <div class="col-md-12">
                                    <label for="role">Roles</label>
                                    <select name="role" id="role" class="form-select" style="cursor: pointer">
                                        <option value="" hidden>Select Role</option>
                                        @foreach($roles as $role)
                                        <option {{ $hasRole->contains($role->name) ? 'selected' : '' }} value="{{ $role->name }}">{{ $role->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            @error('role')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        
                        <button type="submit" class="btn btn-dark">Update User</button>
                </div>
            </div>
        </div>
    </div>
</form>

</section>
@endsection
