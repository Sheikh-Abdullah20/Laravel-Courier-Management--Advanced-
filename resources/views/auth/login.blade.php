@extends('auth.authLayout')

@section('title')
Sign-in
@endsection

@section('content')

<section class="content-main mt-80 mb-80">
    <div class="card mx-auto card-login">
        <div class="card-body">
            <div class="row text-center">
                <div class="col-md-12 ">
                    <a href="{{ route('guest') }}">
                        <x-application-logo/>
                    </a>
                </div>
            </div>
            
            <h2 class="card-title mb-4 text-center">Sign-in</h2>
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input class="form-control" placeholder="Email" type="email" name="email" value="{{ old('email') }}" />
                    @error('email')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Password</label>
                    <input class="form-control" placeholder="Password" type="password" name="password" value="{{ old('password') }}" />
                    @error('password')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>



                <div class="mb-4">
                    <div class="row justify-content-center">
                        <button type="submit" class="btn btn-dark">Login</button>
                    </div>
                </div>
            </form>
            
            <p class="text-center my-3">Forgot your password? <a class="text-danger" href="{{ route('password.request') }}">Reset Password</a></p>
            <p class="text-center mb-2">Dont have an account? <a class="text-danger" href="{{ route('register') }}"> Signup now..!!</a></p>
        </div>
    </div>
</section>

@endsection