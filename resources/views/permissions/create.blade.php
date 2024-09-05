@extends('layouts.app')

@section('title')
Permission - Create
@endsection

@section('content')
<section class="content-main">
    <div class="content-header">

        <div>
            <h2 class="content-title">Permissions - Create</h2>
        </div>

    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('permission.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="Permission">Permission Name</label>
                            <input type="text" class="form-control" id="Permission" name="permission">
                            @error('permission')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-light font-sm"><i class="icon material-icons md-create mx-1"></i>Create Permission</button>
                    </form>
                </div>
            </div>
        </div>
    </div>




</section>
@endsection