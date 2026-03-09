<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<style>
    :root {
        --primary-gradient: linear-gradient(to bottom, #64B5D6 0%, #3E6D9C 100%);
        --card-bg: rgba(255, 255, 255, 0.9);
        --accent-blue: #3E6D9C;
        --accent-gold: #FFD700;
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

    .section-title {
        color: white;
        text-transform: uppercase;
        letter-spacing: 2px;
        font-weight: 900;
        font-size: 1.2rem;
        margin-bottom: 1.5rem;
        display: flex;
        align-items: center;
        gap: 15px;
        opacity: 0.9;
    }

    .section-title::after {
        content: "";
        flex: 1;
        height: 1px;
        background: rgba(255,255,255,0.2);
    }

    .settings-card {
        background: var(--card-bg);
        border-radius: 24px;
        border: 1px solid rgba(255, 255, 255, 0.4);
        padding: 2rem;
        text-align: center;
        transition: all 0.4s cubic-bezier(0.34, 1.56, 0.64, 1);
        text-decoration: none !important;
        height: 100%;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        position: relative;
        overflow: hidden;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
    }

    .settings-card:hover {
        transform: translateY(-10px);
        background: white;
        box-shadow: 0 20px 50px rgba(0, 0, 0, 0.15);
        border-color: var(--accent-blue);
    }

    .settings-card i {
        font-size: 3.5rem;
        color: var(--accent-blue);
        margin-bottom: 1.5rem;
        transition: all 0.3s;
    }

    .settings-card:hover i {
        transform: scale(1.1);
        color: #64B5D6;
    }

    .settings-card .name {
        font-size: 1.1rem;
        font-weight: 800;
        color: #1e293b;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .settings-card .desc {
        color: #64748b;
        font-size: 0.85rem;
        margin-top: 8px;
        font-weight: 500;
        opacity: 0;
        transform: translateY(10px);
        transition: all 0.3s;
    }

    .settings-card:hover .desc {
        opacity: 1;
        transform: translateY(0);
    }

    /* Search Bar */
    .search-wrapper {
        position: relative;
        max-width: 600px;
        margin: 0 auto 3rem;
    }

    .search-input {
        width: 100%;
        height: 60px;
        background: rgba(255,255,255,0.2) !important;
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255,255,255,0.3);
        border-radius: 100px;
        padding: 0 30px 0 65px;
        font-size: 1.1rem;
        color: white !important;
        font-weight: 600;
        transition: all 0.3s;
    }

    .search-input::placeholder {
        color: rgba(255,255,255,0.6);
    }

    .search-input:focus {
        background: rgba(255,255,255,0.3) !important;
        box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        outline: none;
    }

    .search-wrapper i {
        position: absolute;
        left: 25px;
        top: 50%;
        transform: translateY(-50%);
        color: white;
        font-size: 1.4rem;
        opacity: 0.8;
    }

    .grid-section {
        margin-bottom: 3rem;
    }

</style>

<x-app-layout>
    <div class="glass-container">
        <div class="container" style="max-width: 1400px;">
            <div class="text-center mb-5">
                <h1 class="font-black text-5xl text-white tracking-tighter uppercase mb-2">Admin Settings</h1>
                <p class="text-white opacity-70 font-bold uppercase tracking-widest small">Manage your hymns system configuration</p>
            </div>

            <div class="search-wrapper">
                <i class="fas fa-search"></i>
                <input type="text" id="settingsSearch" class="search-input" placeholder="Search for settings (e.g. 'users', 'music', 'logs')...">
            </div>

            <!-- Music Management Section -->
            <div class="grid-section" id="section-music">
                <h2 class="section-title"><i class="fas fa-music"></i> Music Resources</h2>
                <div class="row">
                    @php
                        $musicItems = [
                            ['route' => 'categories.index', 'icon' => 'fas fa-tags', 'name' => 'Categories', 'desc' => 'Manage hymn categories and tags', 'perm' => 'categories.view'],
                            ['route' => 'instrumentations.index', 'icon' => 'fas fa-sliders-h', 'name' => 'Instrumentations', 'desc' => 'Define instrumentation types', 'perm' => 'instrumentations.view'],
                            ['route' => 'ensemble_types.index', 'icon' => 'fas fa-microphone-alt', 'name' => 'Ensemble Types', 'desc' => 'Manage ensemble configurations', 'perm' => 'ensemble_types.view'],
                            ['route' => 'credits.index', 'icon' => 'fas fa-user-edit', 'name' => 'Credits', 'desc' => 'Manage music creator profiles', 'perm' => 'credits.view'],
                            ['route' => 'church_hymns.index', 'icon' => 'fas fa-church', 'name' => 'Church Hymns', 'desc' => 'Manage worship service types', 'perm' => 'church_hymns.view'],
                            ['route' => 'playlists_management.index', 'icon' => 'fab fa-spotify', 'name' => 'Playlist', 'desc' => 'Curate special occasion playlists', 'perm' => null],
                            ['route' => 'languages.index', 'icon' => 'fas fa-language', 'name' => 'Languages', 'desc' => 'Manage available languages', 'perm' => null],
                        ];
                    @endphp

                    @foreach($musicItems as $item)
                        @if(!$item['perm'] || \App\Helpers\AccessRightsHelper::checkPermission($item['perm']) == 'inline')
                            <div class="col-12 col-sm-6 col-lg-3 mb-4 setting-item">
                                <a href="{{ route($item['route']) }}" class="settings-card shadow-sm">
                                    <i class="{{ $item['icon'] }}"></i>
                                    <span class="name">{{ $item['name'] }}</span>
                                    <span class="desc">{{ $item['desc'] }}</span>
                                    <span class="keywords d-none">{{ $item['name'] }} {{ $item['desc'] }}</span>
                                </a>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>

            <!-- Security & Users Section -->
            <div class="grid-section" id="section-security">
                <h2 class="section-title"><i class="fas fa-shield-alt"></i> Security & Access</h2>
                <div class="row">
                    @php
                        $securityItems = [
                            ['route' => 'users.index', 'icon' => 'fas fa-users-cog', 'name' => 'Users', 'desc' => 'Control user accounts and access', 'perm' => 'users.view'],
                            ['route' => 'groups.index', 'icon' => 'fas fa-user-shield', 'name' => 'Groups', 'desc' => 'Manage user roles and permissions', 'perm' => 'groups.view'],
                            ['route' => 'permissions.index', 'icon' => 'fas fa-key', 'name' => 'Permissions', 'desc' => 'Define system access levels', 'perm' => 'permissions.view'],
                            ['route' => 'permission_categories.index', 'icon' => 'fas fa-layer-group', 'name' => 'Permission Categories', 'desc' => 'Organize permissions into sets', 'perm' => 'permission_categories.view'],
                        ];
                    @endphp

                    @foreach($securityItems as $item)
                        @if(!$item['perm'] || \App\Helpers\AccessRightsHelper::checkPermission($item['perm']) == 'inline')
                            <div class="col-12 col-sm-6 col-lg-3 mb-4 setting-item">
                                <a href="{{ route($item['route']) }}" class="settings-card shadow-sm">
                                    <i class="{{ $item['icon'] }}"></i>
                                    <span class="name">{{ $item['name'] }}</span>
                                    <span class="desc">{{ $item['desc'] }}</span>
                                    <span class="keywords d-none">{{ $item['name'] }} {{ $item['desc'] }}</span>
                                </a>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>

            <!-- Maintenance Section -->
            <div class="grid-section" id="section-system">
                <h2 class="section-title"><i class="fas fa-server"></i> System Maintenance</h2>
                <div class="row">
                    @php
                        $systemItems = [
                            ['route' => 'activity_logs.index', 'icon' => 'fas fa-clipboard-list', 'name' => 'Activity Logs', 'desc' => 'Monitor system and user actions', 'perm' => 'activity_logs.view'],
                            ['route' => 'api_documentations.index', 'icon' => 'fas fa-book-code', 'name' => 'API Docs', 'desc' => 'Explore developer endpoints', 'perm' => 'api_documentation.view'],
                        ];
                    @endphp

                    @foreach($systemItems as $item)
                        @if(!$item['perm'] || \App\Helpers\AccessRightsHelper::checkPermission($item['perm']) == 'inline')
                            <div class="col-12 col-sm-6 col-lg-3 mb-4 setting-item">
                                <a href="{{ route($item['route']) }}" class="settings-card shadow-sm">
                                    <i class="{{ $item['icon'] }}"></i>
                                    <span class="name">{{ $item['name'] }}</span>
                                    <span class="desc">{{ $item['desc'] }}</span>
                                    <span class="keywords d-none">{{ $item['name'] }} {{ $item['desc'] }}</span>
                                </a>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>

        </div>
    </div>
</x-app-layout>

<script>
    $('#settingsSearch').on('keyup', function() {
        var value = $(this).val().toLowerCase();
        
        $('.setting-item').each(function() {
            var toggle = $(this).text().toLowerCase().indexOf(value) > -1;
            $(this).toggle(toggle);
        });

        // Hide section titles if no items match
        $('.grid-section').each(function() {
            var hasVisible = $(this).find('.setting-item:visible').length > 0;
            $(this).toggle(hasVisible);
        });
    });
</script>
