<section class="mb-4">
    <header>
        <h2 class="content-title">
            {{ __('Update Password') }}
        </h2>

        <p class="mt-2 text-muted">
            {{ __('Ensure your account is using a long, random password to stay secure.') }}
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="mt-4">
        @csrf
        @method('put')

        <div class="mb-3">
            <label for="update_password_current_password" class="form-label">
                {{ __('Current Password') }}
            </label>
            <input type="password" id="update_password_current_password" name="current_password" class="form-control"
                autocomplete="current-password">
            <div class="invalid-feedback d-block">
                @error('current_password')
                {{ $message }}
                @enderror
            </div>
        </div>

        <div class="mb-3">
            <label for="update_password_password" class="form-label">
                {{ __('New Password') }}
            </label>
            <input type="password" id="update_password_password" name="password" class="form-control"
                autocomplete="new-password">
            <div class="invalid-feedback d-block">
                @error('password')
                {{ $message }}
                @enderror
            </div>
        </div>

        <div class="mb-3">
            <label for="update_password_password_confirmation" class="form-label">
                {{ __('Confirm Password') }}
            </label>
            <input type="password" id="update_password_password_confirmation" name="password_confirmation"
                class="form-control" autocomplete="new-password">
            <div class="invalid-feedback d-block">
                @error('password_confirmation')
                {{ $message }}
                @enderror
            </div>
        </div>

        <div class=" row d-flex align-items-center gap-2">
            <div class="col-md-4">
                <button type="submit" class="btn btn-light">
                    <i class="icon material-icons md-save mx-1"></i>
                    {{ __('Save') }}
                </button>
            </div>
           

            @if (session('status') === 'password-updated')
            <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                class="text-muted small">{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>