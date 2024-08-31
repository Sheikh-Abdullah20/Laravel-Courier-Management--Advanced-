@extends('layouts.app')

@section('title')
Permission - Edit
@endsection

@section('content')
@extends('layouts.app')

@section('title')
Permission - Create
@endsection

@section('content')
<section class="content-main">
    <div class="content-header">

        <div>
            <h2 class="content-title">Permissions - Edit</h2>
        </div>

    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('permission.update',$permission) }}" method="POST">
                        @csrf
                        @method("PUT")
                        <div class="mb-3">
                            <label for="Permission">Permission Name</label>
                            <input type="text" class="form-control" id="Permission" name="permission"
                                value="{{ $permission->name }}">
                        </div>
                        <button type="submit" class="btn btn-dark">Update Permission</button>
                    </form>
                </div>
            </div>
        </div>
    </div>





</section>
@endsection
@endsection