<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

<style>
    :root {
        --primary-gradient: linear-gradient(to bottom, #64B5D6 0%, #3E6D9C 100%);
        --card-bg: rgba(255, 255, 255, 0.95);
        --accent-blue: #3E6D9C;
    }

    body {
        background: var(--primary-gradient) !important;
        background-attachment: fixed !important;
        min-height: 100vh;
        font-family: 'Outfit', sans-serif;
    }

    .glass-container {
        padding: 40px 0;
    }

    .profile-card {
        background: var(--card-bg);
        border-radius: 30px;
        border: 1px solid rgba(255, 255, 255, 0.4);
        box-shadow: 0 15px 45px rgba(0, 0, 0, 0.1);
        padding: 3rem;
        margin-bottom: 2rem;
    }
</style>

<x-app-layout>
    <div class="glass-container">
        <div class="container" style="max-width: 900px;">
            <div class="text-center mb-5">
                <h1 class="font-black text-5xl text-white tracking-tighter uppercase mb-2">My Profile</h1>
                <p class="text-white opacity-75 font-bold uppercase tracking-widest small">Manage your account settings and security</p>
            </div>

            @if (\App\Helpers\AccessRightsHelper::checkPermission('profile.save_information') == 'inline')
                <div class="profile-card">
                    @include('profile.partials.update-profile-information-form')
                </div>
            @endif

            @if (\App\Helpers\AccessRightsHelper::checkPermission('profile.update_password') == 'inline')
                <div class="profile-card">
                    @include('profile.partials.update-password-form')
                </div>
            @endif

            @if (\App\Helpers\AccessRightsHelper::checkPermission('profile.delete_account') == 'inline')
                <div class="profile-card border-danger-subtle">
                    @include('profile.partials.delete-user-form')
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
