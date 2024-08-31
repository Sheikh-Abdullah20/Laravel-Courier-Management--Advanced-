@extends('auth.authLayout')


@section('title')
Deactivate - Confirmation
@endsection

@section('css')
<style>
    body{
        align-content: center !important; 
    }
</style>
@endsection

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card w-50 m-auto p-5">
                <x-alert/>
                <div class="card-body p-5 mt-3">
                    <h4 class="text-center text-danger"> Are You Sure You Want To Delete Your Account? <br> Once You Have Deleted Your Account You Will Lose All Your Data..! </h4>

                    <form action="{{ route('profile.destroy') }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <div class="mb-3 mt-3">
                            <input type="password" class="form-control" name="password" placeholder="Confirm Your Pasword Before You Delete Your Account">
                            @error('password')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="row justify-content-center">
                            <button class="btn btn-danger my-3" type="submit">Delete Account</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

