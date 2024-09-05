@extends('layouts.app')

@section('title')
Role - Edit
@endsection

@section('content')
<section class="content-main">
    <div class="content-header">

        <div>
            <h2 class="content-title">Role - Edit</h2>
        </div>

    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('role.update',$role) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="Permission">Role Name</label>
                            <input type="text" class="form-control" id="Permission" name="role" value="{{ $role->name }}">
                        </div>
                        @error('role')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                        <button type="submit" class="btn btn-light font-sm mb-3"><i class="icon material-icons md-edit mx-1"></i>Update Role</button>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        @if(!empty($permissions))
        @foreach($permissions as $permission)
        <div class="col-md-3 p-2">
            <input {{ $hasPermissions->contains($permission->name) ? 'checked' : '' }} type="checkbox" class="form-check-input" value="{{ $permission->name }}" name="permission[]" style="cursor: pointer;">
            <label for="input">{{ $permission->name }}</label>
        </div>
        @endforeach
    </div>
    @else 
        <div class="row text-center">
            <div class="col-md-12">
                <span class="text-danger">No Permission Found</span>
            </div>
        </div>
    @endif
</form>





</section>
@endsection