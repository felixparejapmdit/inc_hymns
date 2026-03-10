<section>
    <header class="profile-section-header">
        <h2 class="profile-title text-2xl text-danger">
            {{ __('Delete Account') }}
        </h2>

        <p class="profile-subtitle">
            {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.') }}
        </p>
    </header>

    <button
        class="btn btn-danger rounded-pill px-4 font-black uppercase shadow-sm mt-3"
        x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
    >
        <i class="fas fa-trash-alt mr-2"></i> {{ __('Permanently Delete Account') }}
    </button>

    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}" class="p-6">
            @csrf
            @method('delete')

            <h2 class="profile-title text-xl text-danger">
                {{ __('Are you sure you want to delete your account?') }}
            </h2>

            <p class="profile-subtitle mt-2">
                {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.') }}
            </p>

            <div class="mt-4">
                <label for="password" class="form-label-modern sr-only">{{ __('Password') }}</label>

                <input
                    id="password"
                    name="password"
                    type="password"
                    class="form-input-modern block w-3/4"
                    placeholder="{{ __('Confirm your password to delete') }}"
                />

                @if($errors->userDeletion->has('password'))
                    <p class="text-danger small font-bold mt-2">{{ $errors->userDeletion->first('password') }}</p>
                @endif
            </div>

            <div class="mt-4 d-flex justify-content-end gap-3">
                <button type="button" class="btn btn-light rounded-pill px-4 font-bold border" x-on:click="$dispatch('close')">
                    {{ __('Cancel') }}
                </button>

                <button type="submit" class="btn btn-danger rounded-pill px-4 font-bold shadow-sm">
                    {{ __('Delete Account') }}
                </button>
            </div>
        </form>
    </x-modal>
</section>
