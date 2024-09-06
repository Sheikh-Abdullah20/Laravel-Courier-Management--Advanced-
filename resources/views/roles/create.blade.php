@extends('layouts.app')

@section('title')
Role - Create
@endsection

@section('content')
<section class="content-main">
    <div class="content-header">

        <div>
            <h2 class="content-title">Role - Create</h2>
        </div>

    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('role.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="Permission">Role Name</label>
                            <input type="text" class="form-control" id="Permission" name="role">
                            @error('role')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-light font-sm mb-3"><i class="icon material-icons md-create mx-1"></i>Create Role</button>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <p>Select All</p>
            <input type="checkbox" class="form-check-input" id="selectAll" onclick="AllSelected(this)">
            <hr>
        </div>
    </div>
    <div class="row">
        @if(!empty($permissions))
        @foreach($permissions as $permission)
        <div class="col-md-3 p-2">
            <input type="checkbox" class="form-check-input" value="{{ $permission->name }}" name="permission[]" style="cursor: pointer;">
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

@section('scripts')

<script>
   function AllSelected(){
    let checkboxes = document.querySelectorAll('input[name="permission[]"]');
    checkboxes.forEach(checkbox =>{
        checkbox.checked = document.getElementById('selectAll').checked;
    })
   }
</script>

@endsection