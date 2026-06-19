<style>
    /* Safe Flexbox Layout with WebKit Prefixes to prevent vertical stacking in strict browsers */
    .primary-header-wrapper {
        display: -webkit-box !important;
        display: -webkit-flex !important;
        display: -ms-flexbox !important;
        display: flex !important;
        -webkit-box-pack: justify !important;
        -webkit-justify-content: space-between !important;
        -ms-flex-pack: justify !important;
        justify-content: space-between !important;
        height: 4rem;
    }
    .header-left-group, .header-right-group {
        display: -webkit-box !important;
        display: -webkit-flex !important;
        display: -ms-flexbox !important;
        display: flex !important;
        -webkit-box-align: center !important;
        -webkit-align-items: center !important;
        -ms-flex-align: center !important;
        align-items: center !important;
    }
    
    .header-right-group {
        gap: 1.5rem;
    }

    @media (max-width: 639px) {
        .header-right-group {
            display: none !important;
        }
    }

    .main-dashboard-nav {
        position: sticky;
        top: 0;
        z-index: 1000;
    }

    .nav-brand-text,
    .nav-user-text {
        color: #334155 !important;
        -webkit-text-fill-color: #334155 !important;
        background: none !important;
        font-weight: 800 !important;
    }

    .settings-dropdown-trigger {
        width: 2.6rem;
        height: 2.6rem;
        border-radius: 999px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        color: #64748b;
        background: rgba(255, 255, 255, 0.85);
        border: 1px solid rgba(100, 116, 139, 0.15);
        box-shadow: 0 8px 20px rgba(15, 23, 42, 0.06);
        transition: all 0.2s ease;
    }

    .settings-dropdown-trigger:hover {
        color: #3e6d9c;
        background: #fff;
        transform: translateY(-1px);
    }

    .settings-dropdown-panel {
        padding: 0.85rem;
        background: rgba(255, 255, 255, 0.98) !important;
        backdrop-filter: blur(18px);
        -webkit-backdrop-filter: blur(18px);
        border: 1px solid rgba(148, 163, 184, 0.18);
        border-radius: 18px;
        box-shadow: 0 24px 55px rgba(15, 23, 42, 0.14);
    }

    .settings-dropdown-section + .settings-dropdown-section {
        margin-top: 0.9rem;
        padding-top: 0.9rem;
        border-top: 1px solid rgba(226, 232, 240, 0.95);
    }

    .settings-dropdown-kicker {
        margin: 0 0 0.55rem;
        font-size: 0.68rem;
        letter-spacing: 0.16em;
        text-transform: uppercase;
        font-weight: 900;
        color: #64748b;
        padding: 0 0.15rem;
    }

    .settings-dropdown-link {
        display: flex;
        align-items: center;
        gap: 0.8rem;
        padding: 0.8rem 0.9rem;
        border-radius: 14px;
        text-decoration: none !important;
        color: #334155 !important;
        transition: background 0.2s ease, color 0.2s ease, transform 0.2s ease;
    }

    .settings-dropdown-link:hover {
        background: #f8fbff;
        color: #1d4f7a !important;
        transform: translateX(2px);
    }

    .settings-dropdown-link i {
        width: 1.75rem;
        height: 1.75rem;
        border-radius: 999px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        background: rgba(62, 109, 156, 0.12);
        color: #3e6d9c;
        flex-shrink: 0;
    }

    .settings-dropdown-link .menu-title {
        font-weight: 800;
        line-height: 1.15;
    }

    .settings-dropdown-link .menu-desc {
        font-size: 0.74rem;
        color: #64748b;
        line-height: 1.2;
        margin-top: 0.1rem;
    }
</style>

<nav x-data="{ open: false }" class="main-dashboard-nav bg-white dark:bg-gray-800 border-b border-gray-100 dark:border-gray-700">
    @php
        $canCreateHymn = \App\Helpers\AccessRightsHelper::checkPermission('musics.create') == 'inline';
        $canCreateUser = \App\Helpers\AccessRightsHelper::checkPermission('users.create') == 'inline';
        $settingsSections = [
            [
                'title' => 'Music Resources',
                'items' => [
                    ['route' => 'categories.index', 'icon' => 'fa-tags', 'title' => 'Categories', 'desc' => 'Hymn groupings', 'perm' => 'categories.view'],
                    ['route' => 'instrumentations.index', 'icon' => 'fa-sliders-h', 'title' => 'Instrumentations', 'desc' => 'Instruments & arrangements', 'perm' => 'instrumentations.view'],
                    ['route' => 'ensemble_types.index', 'icon' => 'fa-microphone-alt', 'title' => 'Ensemble Types', 'desc' => 'Group & choir classification', 'perm' => 'ensemble_types.view'],
                    ['route' => 'credits.index', 'icon' => 'fa-user-edit', 'title' => 'Credits', 'desc' => 'Creator profiles', 'perm' => 'credits.view'],
                    ['route' => 'church_hymns.index', 'icon' => 'fa-church', 'title' => 'Church Hymns', 'desc' => 'Worship service types', 'perm' => 'church_hymns.view'],
                    ['route' => 'playlists_management.index', 'icon' => 'fa-list-ul', 'title' => 'Playlists', 'desc' => 'Special occasion collections', 'perm' => null],
                    ['route' => 'languages.index', 'icon' => 'fa-language', 'title' => 'Languages', 'desc' => 'Available hymn languages', 'perm' => null],
                ],
            ],
            [
                'title' => 'Security & Access',
                'items' => [
                    ['route' => 'users.index', 'icon' => 'fa-users-cog', 'title' => 'Users', 'desc' => 'Accounts and access', 'perm' => 'users.view'],
                    ['route' => 'groups.index', 'icon' => 'fa-user-shield', 'title' => 'Groups', 'desc' => 'Roles and organization', 'perm' => 'groups.view'],
                    ['route' => 'permissions.index', 'icon' => 'fa-key', 'title' => 'Permissions', 'desc' => 'Access levels', 'perm' => 'permissions.view'],
                    ['route' => 'permission_categories.index', 'icon' => 'fa-layer-group', 'title' => 'Permission Categories', 'desc' => 'Permission sets', 'perm' => 'permission_categories.view'],
                ],
            ],
            [
                'title' => 'System Maintenance',
                'items' => [
                    ['route' => 'activity_logs.index', 'icon' => 'fa-clipboard-list', 'title' => 'Activity Logs', 'desc' => 'Audit trail', 'perm' => 'activity_logs.view'],
                    ['route' => 'api_documentations.index', 'icon' => 'fa-book-code', 'title' => 'API Docs', 'desc' => 'Endpoints guide', 'perm' => 'api_documentation.view'],
                ],
            ],
        ];
    @endphp
    <!-- Primary Navigation Menu -->
    <div class="px-5 px-xl-5 mx-auto" style="max-width: 90%;">
        <div class="primary-header-wrapper">
            <div class="header-left-group">

                <!-- Logo -->
                <div class="flex-shrink-0">
                    <a href="{{ route('dashboard') }}">
                        <x-application-logo class="block h-9 w-auto fill-current text-gray-800 dark:text-gray-200" />
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="flex items-center space-x-8 sm:-my-px ml-4">
                    <a href="{{ route('dashboard') }}" class="flex items-center no-underline hover:opacity-80 transition-opacity">
                        <span class="nav-brand-text" style="font-size: 1.1rem;">INC Hymns</span>
                    </a>
                </div>

            </div>

            <div class="header-right-group">
                <!-- Branding (Only on Show Page) -->
                @if(Route::currentRouteName() == 'musics.show' || Request::is('musics/*'))
                <div class="header-left-group">
                    <h2 class="text-lg md:text-xl font-black text-slate-800 uppercase tracking-tighter mb-0 flex items-center gap-2 whitespace-nowrap">
                        <span class="text-blue-600">Hymn</span> Masterpiece
                    </h2>
                </div>
                @endif
                @if ($canCreateHymn || $canCreateUser)
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="flex items-center text-sm font-medium text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition duration-150 ease-in-out">
                            <div>Create New</div>
                            <div class="ml-1">
                                <svg class="h-4 w-4 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414l-4 4a1 1 0 0 1-1.414 0l-4-4a1 1 0 0 1 0-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>
                    <x-slot name="content">
                        <!-- Hymn Create Link -->
                        @if ($canCreateHymn)
                            <x-responsive-nav-link :href="route('musics.create')" class="text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white">
                                {{ __('Hymn') }}
                            </x-responsive-nav-link>
                        @endif
                        <!-- User Create Link -->
                        @if ($canCreateUser)
                            <x-responsive-nav-link :href="route('users.create')" class="text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white">
                                {{ __('User') }}
                            </x-responsive-nav-link>
                        @endif
                    </x-slot>
                </x-dropdown>
                @endif
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="flex items-center text-sm font-medium text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition duration-150 ease-in-out">
                            <div>
                                <span class="nav-user-text">{{ Auth::user()?->name ?? 'Guest' }}</span>
                            </div>

                            <div class="ml-1">
                                <svg class="h-4 w-4 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414l-4 4a1 1 0 0 1-1.414 0l-4-4a1 1 0 0 1 0-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>
                    <x-slot name="content">
                        <!-- User Profile -->
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Profile') }}
                        </x-dropdown-link>
                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>

                          <!-- List of Settings -->
                            @if (\App\Helpers\AccessRightsHelper::checkPermission('settings.view_admin') == 'inline')
                            <x-nav-link :href="route('admin.settings')" :active="request()->routeIs('admin.settings')">
                                <i class="fa fa-cogs fa-fw" aria-hidden="true"></i> Admin Settings
                            </x-nav-link>
                            @endif

                    </x-slot>
                </x-dropdown>

                <!-- List of Settings -->
                @if (\App\Helpers\AccessRightsHelper::checkPermission('settings.view') == 'inline')
                <x-dropdown align="right" width="80" contentClasses="settings-dropdown-panel">
                    <x-slot name="trigger">
                        <button type="button" class="settings-dropdown-trigger" aria-label="Open settings menu">
                            <i class="fas fa-cog"></i>
                        </button>
                    </x-slot>
                    <x-slot name="content">
                        @foreach ($settingsSections as $section)
                            <div class="settings-dropdown-section">
                                <p class="settings-dropdown-kicker">{{ $section['title'] }}</p>
                                <div class="space-y-1">
                                    @foreach ($section['items'] as $item)
                                        @if (!$item['perm'] || \App\Helpers\AccessRightsHelper::checkPermission($item['perm']) == 'inline')
                                            <a href="{{ route($item['route']) }}" class="settings-dropdown-link">
                                                <i class="fas {{ $item['icon'] }}"></i>
                                                <div>
                                                    <div class="menu-title">{{ $item['title'] }}</div>
                                                    <div class="menu-desc">{{ $item['desc'] }}</div>
                                                </div>
                                            </a>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                    </x-slot>
                </x-dropdown>
                @endif
            </div>

            <!-- Hamburger Menu for Mobile -->
            <div class="-mr-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 text-gray-400 dark:text-gray-500 hover:text-gray-500 dark:hover:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-900 focus:outline-none focus:text-gray-500 dark:focus:text-gray-400 focus:bg-gray-100 dark:focus:bg-gray-900 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu for Mobile -->
    <div :class="{'block': open, 'd-none': ! open}" class="d-none d-sm-none sm:hidden">
        @if(Route::currentRouteName() == 'musics.show' || Request::is('musics/*'))
        <div class="pt-4 pb-4 px-5 border-b border-gray-100 dark:border-gray-700 bg-slate-50/50 d-md-none">
            <h2 class="text-xl font-black text-slate-800 uppercase tracking-tighter mb-0 flex items-center gap-2 whitespace-nowrap">
                <span class="text-blue-600">Hymn</span> Masterpiece
            </h2>
        </div>
        @endif
        <div class="pt-2 pb-3 space-y-1">
            <!-- Dashboard Link -->
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>

            <!-- List of Musics Link -->
            <x-responsive-nav-link :href="route('musics.index')" :active="request()->routeIs('musics.index')">
                {{ __('Musics') }}
            </x-responsive-nav-link>
        </div>


         <!-- Create New Hymn and User -->
        @if ($canCreateHymn || $canCreateUser)
            <div class="pt-4 pb-1 border-t border-gray-200 dark:border-gray-600">
                <div class="px-4">
                    <div class="font-medium text-base text-gray-800 dark:text-gray-200">Create New</div>
                </div>
                <div class="mt-3 space-y-1">
                    @if ($canCreateHymn)
                        <a href="{{ route('musics.create') }}" class="flex items-center text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white">
                            {{ __('Hymn') }}
                            <div class="ml-1">
                                <svg class="h-4 w-4 fill-current text-gray-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414l-4 4a1 1 0 0 1-1.414 0l-4-4a1 1 0 0 1 0-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </a>
                    @endif
                    @if ($canCreateUser)
                        <a href="{{ route('users.create') }}" class="flex items-center text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white">
                            {{ __('User') }}
                            <div class="ml-1">
                                <svg class="h-4 w-4 fill-current text-gray-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414l-4 4a1 1 0 0 1-1.414 0l-4-4a1 1 0 0 1 0-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </a>
                    @endif
                </div>
            </div>
        @endif

        <!-- User Profile and Logout -->
        <div class="pt-4 pb-1 border-t border-gray-200 dark:border-gray-600">
            <div class="px-4">
                <div class="font-medium text-base text-gray-800 dark:text-gray-200">{{ Auth::user()?->name ?? 'Guest' }}</div>
                <div class="font-medium text-sm text-gray-500">{{ Auth::user()?->email ?? '' }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <!-- User Profile Link -->
                <x-responsive-nav-link :href="route('profile.edit')">
                    {{ __('Profile') }}
                </x-responsive-nav-link>

                <!-- Logout Link -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-responsive-nav-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>

           
        </div>

        <div class="pt-4 pb-1 border-t border-gray-200 dark:border-gray-600">
            <!-- List of Settings -->
                @if (\App\Helpers\AccessRightsHelper::checkPermission('settings.view') == 'inline')
                <x-dropdown align="right" width="80" contentClasses="settings-dropdown-panel">
                    <x-slot name="trigger">
                        <button type="button" class="settings-dropdown-trigger" aria-label="Open settings menu">
                            <i class="fas fa-cog"></i>
                        </button>
                    </x-slot>
                    <x-slot name="content">
                        @foreach ($settingsSections as $section)
                            <div class="settings-dropdown-section">
                                <p class="settings-dropdown-kicker">{{ $section['title'] }}</p>
                                <div class="space-y-1">
                                    @foreach ($section['items'] as $item)
                                        @if (!$item['perm'] || \App\Helpers\AccessRightsHelper::checkPermission($item['perm']) == 'inline')
                                            <a href="{{ route($item['route']) }}" class="settings-dropdown-link">
                                                <i class="fas {{ $item['icon'] }}"></i>
                                                <div>
                                                    <div class="menu-title">{{ $item['title'] }}</div>
                                                    <div class="menu-desc">{{ $item['desc'] }}</div>
                                                </div>
                                            </a>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                    </x-slot>
                </x-dropdown>
                @endif
        </div>
    </div>
</nav>
