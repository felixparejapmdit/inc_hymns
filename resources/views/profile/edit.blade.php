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
        padding: 20px 0;
    }

    .profile-card {
        background: var(--card-bg);
        border-radius: 30px;
        border: 1px solid rgba(255, 255, 255, 0.4);
        box-shadow: 0 15px 45px rgba(0, 0, 0, 0.1);
        padding: 2rem;
        margin-bottom: 1.5rem;
    }

    .profile-hero {
        position: relative;
        display: inline-flex;
        flex-direction: column;
        align-items: center;
        gap: 0.35rem;
        margin-bottom: 1.5rem;
        padding-bottom: 0.8rem;
    }

    .profile-hero::after {
        content: '';
        position: absolute;
        left: 50%;
        bottom: 0;
        transform: translateX(-50%);
        width: 120px;
        height: 2px;
        border-radius: 999px;
        background: linear-gradient(90deg, rgba(255,255,255,0), rgba(255,255,255,0.85), rgba(255,255,255,0));
    }

    .profile-hero-title {
        font-size: clamp(2rem, 4.5vw, 3.4rem);
        line-height: 0.95;
        font-weight: 950;
        letter-spacing: -0.05em;
        text-transform: uppercase;
        color: #fff;
        margin: 0;
        text-shadow: 0 6px 24px rgba(15, 23, 42, 0.18);
    }

    .profile-hero-subtitle {
        max-width: 42rem;
        margin: 0;
        font-size: 0.92rem;
        font-weight: 800;
        letter-spacing: 0.16em;
        text-transform: uppercase;
        color: rgba(255, 255, 255, 0.78);
    }

</style>

<x-app-layout>
    <div class="glass-container">
        <div class="container-fluid px-5 px-xl-5 page-shell">
            <div class="text-center mb-4">
                <div class="profile-hero">
                    <h1 class="profile-hero-title">My Profile</h1>
                    <p class="profile-hero-subtitle">Manage your account settings and security</p>
                </div>
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
