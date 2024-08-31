@extends('layouts.app')

@section('title')
User - Create
@endsection


@section('content')

<section class="content-main">
    <div class="content-header">

        <div>
            <h2 class="content-title">User - Create</h2>
        </div>

    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('user.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="name">User Name</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}">
                            @error('name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="email">User Email</label>
                            <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}">
                            @error('email')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                        </div>

                        <div class="mb-3">
                            <label for="Password">User Password</label>
                            <input type="password" class="form-control" id="Password" name="password">
                            @error('password')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="password_confirmation">Confirm Password</label>
                            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
                            @error('password_confirmation')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="address">Address</label>
                            <input type="text" class="form-control" id="address" name="address" value="{{ old('address') }}">
                            @error('address')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="dob">Date Of Birth</label>
                            <input type="date" class="form-control" id="dob" name="dob" style="cursor: pointer" value="{{ old('dob') }}">
                            @error('dob')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-3 row">
                            <div class="col-md-2">
                                <label for="country">Country</label>
                                <input type="text" class="form-control" id="country_code" name="country" value="{{ old('country') }}">
                                @error('country')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-10">
                                <label for="phone">Phone Number</label>
                                <input type="text" class="form-control" id="phone" name="phone" value="{{ old('phone') }}">
                                @error('phone')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="agent-inputs" id="agent-input" style="display: none">
                            <div class="mb-3">
                                <label for="branch_name">Branch_Name</label>    
                                <input type="text" class="form-control" name="branch_name" id="branch_name">
                                @error('branch_name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>   
                        </div>

                        <div class="mb-3">
                            <div class="row">
                                <div class="col-md-12">
                                    <label for="role">Roles</label>
                                    <select name="role" id="role" class="form-select" style="cursor: pointer">
                                        <option value="">Select Role</option>
                                        @foreach($roles as $role)
                                        <option value="{{ $role->name }}">{{ $role->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            @error('role')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        
                        <button type="submit" class="btn btn-dark">Create User</button>
                </div>
            </div>
        </div>
    </div>
</form>





</section>

@endsection

@section('scripts')

<script>
    document.addEventListener('DOMContentLoaded', function(){
    const role = document.getElementById('role');
    const agentInput = document.getElementById('agent-input');

    role.addEventListener('change', function() {
        if(this.value === 'agent') {
            agentInput.style.display = 'block'
        }else {
            agentInput.style.display = 'none'
        }
    });
    });
   
</script>

</script>
    
@endsection