@extends('auth.authLayout')


@section('title')
Forgot - Password
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
            <div class="forgot-password">
                <div class="card">
                    <x-alert/>
                    <div class="card-body p-5 mt-3">
                        <p class="text-sm text-dark text-center"> <span class="text-danger">Forgot your password? </span><br>  No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one. </p>
    
                        <form action="{{ route('password.email') }}" method="POST" class="w-75 m-auto">
                            @csrf
                            <div class="mb-3">
                                <input type="email" class="form-control" name="email" placeholder="Enter Your Email">
                                @error('email')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="row justify-content-center">
                                <button class="btn btn-light my-3 w-50 d-flex justify-content-center " type="submit"><i class="icon material-icons md-send mx-1"></i>Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
          
        </div>
    </div>
</div>
@endsection

    {{-- <div class="mb-4 text-sm text-gray-600">
        {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button>
                {{ __('Email Password Reset Link') }}
            </x-primary-button>
        </div>
    </form> --}}

