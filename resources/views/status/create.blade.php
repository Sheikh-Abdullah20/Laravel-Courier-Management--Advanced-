@extends('layouts.app')


@section('title')
Status - Create
@endsection

@section('content')

<section class="content-main">
    <div class="content-header">

        <div>
            <h2 class="content-title">Status - Create</h2>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                   <form action="{{ route('status.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="status">Status Name</label>
                        <input type="text" class="form-control" name="status_name" id="status">
                        @error('status_name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <button class="btn btn-dark" type="submit">Create Status</button>
                   </form>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection