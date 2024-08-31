@extends('layouts.app')


@section('title')
Status - Edit
@endsection

@section('content')
<section class="content-main">
    <div class="content-header">

        <div>
            <h2 class="content-title">Status - Edit</h2>
        </div>

    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('status.update',$status) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="status">Status Name</label>
                            <input type="text" class="form-control" id="status" name="status_name" value="{{ $status->status_name }}">
                            @error('status_name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-dark">Update Status</button>
                </div>
            </div>
        </div>
    </div>
</form>





</section>
@endsection