<section class="mb-4">
    <header>
        <h2 class="h4 text-dark">
            {{ __('Profile Information') }}
        </h2>

        <p class="mt-2 text-muted">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-4">
        @csrf
        @method('patch')

        <div class="mb-3">
            <label for="name" class="form-label">
                {{ __('Name') }}
            </label>
            <input 
                type="text" 
                id="name" 
                name="name" 
                class="form-control" 
                value="{{ old('name', $user->name) }}" 
                required 
                autofocus 
                autocomplete="name">
            <div class="invalid-feedback d-block">
                @error('name')
                    {{ $message }}
                @enderror
            </div>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">
                {{ __('Email') }}
            </label>
            <input 
                type="email" 
                id="email" 
                name="email" 
                class="form-control" 
                value="{{ old('email', $user->email) }}" 
                required 
                autocomplete="username">
            <div class="invalid-feedback d-block">
                @error('email')
                    {{ $message }}
                @enderror
            </div>

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div class="mt-2">
                    <p class="small text-muted">
                        {{ __('Your email address is unverified.') }}

                        <button 
                            form="send-verification" 
                            class="btn btn-link p-0 text-decoration-none">
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 text-success small">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div class="d-flex align-items-center gap-2">
            <button type="submit" class="button">
                {{ __('Save') }}
            </button>
        </div>
    </form>
</section>
