@extends('auth.authLayout')

@section('title')
Sign-up
@endsection

@section('content')

<section class="content-main mt-80 mb-80">
    <div class="card mx-auto ">
        <div class="card-body">
            <div class="row text-center">
                <div class="col-md-12 ">
                    <a href="{{ route('guest') }}">
                        <x-application-logo/>
                    </a>
                </div>
            </div>
            <h2 class="card-title my-4 text-center ">Create an Account</h2>
            <form method="POST" action="{{ route('register') }}">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Name</label>
                            <input class="form-control" placeholder="Name" type="text" name="name" value="{{ old('name') }}" />
                            @error('name')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input class="form-control" placeholder="Email" type="email" name="email"
                                value="{{ old('email') }}" />
                            @error('email')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
              

                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Password</label>
                            <input class="form-control" placeholder="Password" type="password" name="password" />
                            @error('password')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Confirm Password</label>
                            <input class="form-control" placeholder="Confirm Password" type="password" name="password_confirmation" />
                            @error('password_confirmation')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>

              
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Address</label>
                            <input class="form-control" placeholder="Address" type="text" name="address"
                                value="{{ old('address') }}" />
                            @error('address')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Date Of Birth</label>
                            <input class="form-control" type="date" name="dob" value="{{ old('dob') }}" />
                            @error('dob')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
            
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Phone</label>
                                <input class="form-control" placeholder="Phone" type="text" name="phone"
                                    value="{{ old('phone') }}" />
                                @error('phone')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">City</label>
                                <input class="form-control" placeholder="city" type="text" name="city"
                                    value="{{ old('city') }}" />
                                @error('city')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <p class="small text-center text-muted">By signing up, you confirm that you’ve read and accepted our
                        User Notice and Privacy Policy.</p>
                </div>

                <div class="mb-4">
                    <div class="row justify-content-center">
                        <button type="submit" class="btn btn-light w-25 d-flex justify-content-center"><i class="icon material-icons md-person_add mx-1"></i>Sign-up</button>
                    </div>
                </div>
            </form>
            <p class="text-center mb-2">Already have an account? <a class="text-danger" href="{{ route('login') }}">Sign
                    in now</a></p>
        </div>
    </div>
</section>

@endsection