@extends('layouts.app')

@section('title')
Rider - Create
@endsection

@section('content')
<section class="content-main">
    <div class="content-header">

        <div>
            <h2 class="content-title">Rider - Create</h2>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                   <form action="{{ route('rider.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="name">Rider Name</label>
                        <input type="text" class="form-control" name="name" id="name" value="{{ old('name') }}">
                        @error('name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    
                    <div class="mb-3">
                        <label for="city">Rider City</label>
                        <input type="text" class="form-control" name="city" id="city" value="{{ old('city') }}">
                        @error('city')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="phone">Rider Phone</label>
                        <input type="text" class="form-control" name="phone" id="phone" value="{{ old('phone') }}">
                        @error('phone')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>


                    <div class="mb-3">
                        <label for="cnic">Rider Cnic</label>
                        <input type="text" class="form-control" name="cnic" id="cnic" value="{{ old('cnic') }}">
                        @error('cnic')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="bike_no">Rider Bike_No</label>
                        <input type="text" class="form-control" name="bike_no" id="bike_no" value="{{ old('bike_no') }}">
                        @error('bike_no')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="address">Rider Address</label>
                        <input type="text" class="form-control" name="address" id="address" value="{{ old('address') }}">
                        @error('address')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <button class="btn btn-light my-3" type="submit"><i
                        class="icon material-icons md-create mx-1"></i> Create Rider</button>
                   </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection