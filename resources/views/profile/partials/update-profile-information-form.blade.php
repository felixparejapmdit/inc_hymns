<style>
    .profile-section-header {
        margin-bottom: 1rem;
    }

    .profile-title {
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: -0.5px;
        color: #1e293b;
        margin-bottom: 0.5rem;
    }

    .profile-subtitle {
        color: #64748b;
        font-weight: 500;
        font-size: 0.95rem;
    }

    .form-group-modern {
        margin-bottom: 1rem;
    }

    .form-label-modern {
        display: block;
        font-weight: 700;
        text-transform: uppercase;
        font-size: 0.75rem;
        color: #64748b;
        letter-spacing: 1px;
        margin-bottom: 0.6rem;
    }

    .form-input-modern {
        width: 100%;
        padding: 0.8rem 1.2rem;
        border-radius: 12px;
        border: 2px solid #e2e8f0;
        background: #f8fafc;
        font-weight: 600;
        color: #1e293b;
        transition: all 0.3s;
    }

    .form-input-modern:focus {
        background: white;
        border-color: #3E6D9C;
        box-shadow: 0 0 0 4px rgba(62, 109, 156, 0.1);
        outline: none;
    }

    .btn-save-modern {
        background: #3E6D9C;
        color: white;
        padding: 0.8rem 2rem;
        border-radius: 50px;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: 1px;
        border: none;
        transition: all 0.3s;
        box-shadow: 0 4px 15px rgba(62, 109, 156, 0.2);
        cursor: pointer;
    }

    .btn-save-modern:hover {
        background: #2d547a;
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(62, 109, 156, 0.3);
    }

    .verification-notice {
        background: #fffbeb;
        border-left: 4px solid #f59e0b;
        padding: 1rem;
        border-radius: 8px;
        margin-top: 1rem;
    }

    .success-pill {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        background: #dcfce7;
        color: #166534;
        padding: 6px 16px;
        border-radius: 50px;
        font-weight: 700;
        font-size: 0.85rem;
    }
</style>

<section>
    <header class="profile-section-header">
        <h2 class="profile-title text-2xl">
            {{ __('Profile Information') }}
        </h2>

        <p class="profile-subtitle">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-4">
        @csrf
        @method('patch')

        <div class="row">
            <div class="col-md-6">
                <div class="form-group-modern">
                    <label for="name" class="form-label-modern">{{ __('Full Name') }}</label>
                    <input id="name" name="name" type="text" class="form-input-modern" value="{{ old('name', $user->name) }}" required autofocus autocomplete="name" placeholder="Enter your full name">
                    @if($errors->has('name'))
                        <p class="text-danger small font-bold mt-2">{{ $errors->first('name') }}</p>
                    @endif
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group-modern">
                    <label for="username" class="form-label-modern">{{ __('Username') }}</label>
                    <input id="username" name="username" type="text" class="form-input-modern" value="{{ old('username', $user->username) }}" required autocomplete="username" placeholder="Choose a unique username">
                    @if($errors->has('username'))
                        <p class="text-danger small font-bold mt-2">{{ $errors->first('username') }}</p>
                    @endif
                </div>
            </div>
        </div>

        <div class="form-group-modern">
            <label for="email" class="form-label-modern">{{ __('Email Address') }}</label>
            <input id="email" name="email" type="email" class="form-input-modern" value="{{ old('email', $user->email) }}" required autocomplete="username" placeholder="yourname@example.com">
            @if($errors->has('email'))
                <p class="text-danger small font-bold mt-2">{{ $errors->first('email') }}</p>
            @endif

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div class="verification-notice shadow-sm mt-3">
                    <div class="d-flex align-items-center gap-2 mb-2">
                        <i class="fas fa-exclamation-triangle text-amber-500"></i>
                        <span class="font-bold text-amber-900 small uppercase">{{ __('Action Required') }}</span>
                    </div>
                    <p class="text-sm text-gray-800 mb-2">
                        {{ __('Your email address is unverified.') }}
                    </p>

                    <button form="send-verification" class="btn btn-sm btn-link text-amber-700 font-bold p-0 underline h-auto">
                        {{ __('Click here to re-send the verification email.') }}
                    </button>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-bold text-sm text-green-600">
                            <i class="fas fa-check-circle mr-1"></i>
                            {{ __('A new verification link has been sent to your email address.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div class="d-flex align-items-center gap-4 mt-4">
            <button type="submit" class="btn-save-modern">
                <i class="fas fa-save mr-2"></i> {{ __('Save Changes') }}
            </button>

            @if (session('status') === 'profile-updated')
                <div 
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 3000)"
                    class="success-pill shadow-sm"
                >
                    <i class="fas fa-check"></i>
                    {{ __('Profile Updated Successfully') }}
                </div>
            @endif
        </div>
    </form>
</section>
