<section>
    <header class="profile-section-header">
        <h2 class="profile-title text-2xl">
            {{ __('Update Password') }}
        </h2>

        <p class="profile-subtitle">
            {{ __('Ensure your account is using a long, random password to stay secure.') }}
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="mt-4">
        @csrf
        @method('put')

        <div class="form-group-modern">
            <label for="update_password_current_password" class="form-label-modern">{{ __('Current Password') }}</label>
            <input id="update_password_current_password" name="current_password" type="password" class="form-input-modern" autocomplete="current-password" placeholder="••••••••">
            @if($errors->updatePassword->has('current_password'))
                <p class="text-danger small font-bold mt-2">{{ $errors->updatePassword->first('current_password') }}</p>
            @endif
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group-modern">
                    <label for="update_password_password" class="form-label-modern">{{ __('New Password') }}</label>
                    <input id="update_password_password" name="password" type="password" class="form-input-modern" autocomplete="new-password" placeholder="••••••••">
                    @if($errors->updatePassword->has('password'))
                        <p class="text-danger small font-bold mt-2">{{ $errors->updatePassword->first('password') }}</p>
                    @endif
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group-modern">
                    <label for="update_password_password_confirmation" class="form-label-modern">{{ __('Confirm Password') }}</label>
                    <input id="update_password_password_confirmation" name="password_confirmation" type="password" class="form-input-modern" autocomplete="new-password" placeholder="••••••••">
                    @if($errors->updatePassword->has('password_confirmation'))
                        <p class="text-danger small font-bold mt-2">{{ $errors->updatePassword->first('password_confirmation') }}</p>
                    @endif
                </div>
            </div>
        </div>

        <div class="d-flex align-items-center gap-4 mt-4">
            <button type="submit" class="btn-save-modern">
                <i class="fas fa-lock mr-2"></i> {{ __('Update Password') }}
            </button>

            @if (session('status') === 'password-updated')
                <div 
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 3000)"
                    class="success-pill shadow-sm"
                >
                    <i class="fas fa-check"></i>
                    {{ __('Password Changed Successfully') }}
                </div>
            @endif
        </div>
    </form>
</section>
