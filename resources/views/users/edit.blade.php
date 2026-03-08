@include('musics.form_styles')

<x-app-layout>
    <div class="glass-container py-4" style="margin-top: 5px;">
        <div class="container-fluid px-5 px-xl-5" style="max-width: 90%; margin: 0 auto;">
            <div class="form-glass">
                <!-- Header (Premium Single-Row) -->
                <div class="d-flex align-items-center justify-content-between mb-10 pb-6 border-bottom flex-wrap gap-4">
                    <div class="d-flex align-items-center">
                        <h1 class="text-4xl font-black text-slate-800 tracking-tighter mb-0 uppercase">Edit User</h1>
                        <div class="mx-4 d-none d-md-block" style="width: 2px; height: 35px; background: rgba(0,0,0,0.1); border-radius: 2px;"></div>
                        <div class="d-none d-md-block">
                            <p class="text-muted font-bold small uppercase tracking-widest mb-0 opacity-60">Modifying Profile: {{ $user->name }}</p>
                        </div>
                    </div>
                    
                    <div class="d-flex gap-3">
                        @php
                            $cancelRoute = route('users.index');
                            if (strpos(url()->full(), 'group=') !== false && isset($groupId)) {
                                $cancelRoute = route('groups.users', ['group' => $groupId]);
                            }
                        @endphp
                        <button type="button" class="btn btn-premium btn-cancel px-5 shadow-sm" onclick="window.location.href='{{ $cancelRoute }}'">
                            <i class="fas fa-times mr-2 opacity-50"></i> {{ __('Cancel') }}
                        </button>
                    </div>
                </div>

                <form method="POST" action="{{ route('users.update', $user->id) }}">
                    @csrf
                    @method('PUT')

                    <div class="row g-4 mb-4">
                        <div class="col-md-6">
                            <label class="custom-label">{{ __('Full Name') }}</label>
                            <input type="text" name="name" class="modern-input" value="{{ old('name', $user->name) }}" required autofocus placeholder="John Doe">
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>

                        <div class="col-md-6">
                            <label class="custom-label">{{ __('Username') }}</label>
                            <input type="text" name="username" class="modern-input" value="{{ old('username', $user->username) }}" required placeholder="johndoe123">
                            <x-input-error :messages="$errors->get('username')" class="mt-2" />
                        </div>

                        <div class="col-md-12">
                            <label class="custom-label">{{ __('Email Address') }}</label>
                            <input type="email" name="email" class="modern-input" value="{{ old('email', $user->email) }}" required placeholder="email@example.com">
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>

                        <div class="col-md-12">
                            <div class="section-title mt-4">Security Update</div>
                            <p class="text-xs text-muted mb-4 opacity-70 italic">Leave password blank if you don't wish to change it.</p>
                            <div class="row g-4">
                                <div class="col-md-6">
                                    <label class="custom-label">{{ __('New Password') }}</label>
                                    <input type="password" name="password" class="modern-input" placeholder="••••••••">
                                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                                </div>
                                <div class="col-md-6">
                                    <label class="custom-label">{{ __('Confirm New Password') }}</label>
                                    <input type="password" name="password_confirmation" class="modern-input" placeholder="••••••••">
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="section-title mt-4">Access & Roles</div>
                            <label class="custom-label">{{ __('Assigned Groups') }}</label>
                            <select id="groups" name="groups[]" multiple class="modern-input" style="height: auto; min-height: 120px;" required>
                                @foreach ($groups as $group)
                                    <option value="{{ $group->id }}" {{ $user->groups->contains($group) ? 'selected' : '' }}>{{ $group->name }}</option>
                                @endforeach
                            </select>
                            <p class="text-xs text-muted mt-2 opacity-60">Hold Ctrl (Cmd) to select multiple groups.</p>
                        </div>

                        @if (\App\Helpers\AccessRightsHelper::checkPermission('users.activate_account') == 'inline')
                        <div class="col-md-12 mt-2">
                            <div class="d-flex align-items-center bg-slate-50 p-3 rounded-xl border">
                                <input id="login_enabled" type="checkbox" name="login_enabled" style="width: 20px; height: 20px;" {{ old('login_enabled', $user->activated) ? 'checked' : '' }}>
                                <label for="login_enabled" class="mb-0 ml-3 font-bold text-slate-700">User Login Enabled</label>
                            </div>
                        </div>
                        @endif
                    </div>

                    <div class="d-flex justify-content-end gap-3 mt-10 pt-6 border-top">
                        <button type="button" class="btn btn-premium btn-cancel px-8" onclick="window.location.href='{{ $cancelRoute }}'">
                            <i class="fas fa-arrow-left mr-2 opacity-50"></i> Back to Users
                        </button>
                        <button type="submit" class="btn btn-premium btn-save px-10 shadow-lg">
                            <i class="fas fa-save mr-2"></i> Update Account
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
