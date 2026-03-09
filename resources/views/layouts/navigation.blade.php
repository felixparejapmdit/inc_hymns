
<nav x-data="{ open: false }" class="bg-white dark:bg-gray-800 border-b border-gray-100 dark:border-gray-700">
    <!-- Primary Navigation Menu -->
    <div class="px-5 px-xl-5 mx-auto" style="max-width: 90%;">
        <div class="flex justify-between h-16">
            <div class="flex items-center">

                <!-- Logo -->
                <div class="flex-shrink-0">
                    <a href="{{ route('dashboard') }}">
                        <x-application-logo class="block h-9 w-auto fill-current text-gray-800 dark:text-gray-200" />
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="flex items-center space-x-8 sm:-my-px ml-4">
                    <a href="{{ route('dashboard') }}" class="flex items-center no-underline hover:opacity-80 transition-opacity">
                        <span style="background: linear-gradient(to right, #475b9a, #6aa8c4); -webkit-background-clip: text; -webkit-text-fill-color: transparent; font-weight: bold; font-size: 1.1rem;">INC Hymns</span>
                    </a>
                </div>

            </div>

            <div class="d-none d-sm-flex sm:items-center sm:gap-6">
                <!-- Branding (Only on Show Page) -->
                @if(Route::currentRouteName() == 'musics.show' || Request::is('musics/*'))
                <div class="flex items-center">
                    <h2 class="text-lg md:text-xl font-black text-slate-800 uppercase tracking-tighter mb-0 flex items-center gap-2 whitespace-nowrap">
                        <span class="text-blue-600">Hymn</span> Masterpiece
                    </h2>
                </div>
                @endif
                <x-dropdown align="right" width="48">
                
                    <x-slot name="trigger">
                    @if ((\App\Helpers\AccessRightsHelper::checkPermission('musics.create') == 'inline') || (\App\Helpers\AccessRightsHelper::checkPermission('users.create') == 'inline'))
                        <button class="flex items-center text-sm font-medium text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition duration-150 ease-in-out">
                            <div>Create New</div>
                            <div class="ml-1">
                                <svg class="h-4 w-4 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            <div class="ml-1">
                                <svg class="h-4 w-4 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 011.414 0L10 10.586l3.293-3.293a1 1 111.414 1.414l-4 4a1 1 01-1.414 0l-4-4a1 1 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                        @endif
                    </x-slot>
                    <x-slot name="content">
                        <!-- Hymn Create Link -->
                        @if (\App\Helpers\AccessRightsHelper::checkPermission('musics.create') == 'inline')
                            <x-responsive-nav-link :href="route('musics.create')" class="text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white">
                                {{ __('Hymn') }}
                            </x-responsive-nav-link>
                        @endif
                        <!-- User Create Link -->
                        @if (\App\Helpers\AccessRightsHelper::checkPermission('users.create') == 'inline')
                        <x-responsive-nav-link :href="route('users.create')" class="text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white">
                            {{ __('User') }}
                        </x-responsive-nav-link>
                        @endif
                    </x-slot>
                </x-dropdown>
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="flex items-center text-sm font-medium text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition duration-150 ease-in-out">
                            
                            @if (Auth::check())
                                <div>
                                    <span style="background: linear-gradient(to right, #475b9a, #6aa8c4); -webkit-background-clip: text; -webkit-text-fill-color: transparent; font-weight: bold;">{{ Auth::user()->name }}</span>
                                </div>
                            @else
                                <script type="text/javascript">
                                    window.location.href = "{{ route('login') }}"; // Redirect to the login page
                                </script>
                            @endif

                            <div class="ml-1">
                                <svg class="h-4 w-4 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            <div class="ml-1">
                                <svg class="h-4 w-4 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 011.414 0L10 10.586l3.293-3.293a1 1 111.414 1.414l-4 4a1 1 01-1.414 0l-4-4a1 1 010-1.414z" clip-rule="evenodd" />
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
                <x-nav-link :href="route('admin.settings')" :active="request()->routeIs('admin.settings')">
                    <i class="fa fa-cogs fa-fw" aria-hidden="true"></i>
                </x-nav-link>
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
        <div class="pt-4 pb-1 border-t border-gray-200 dark:border-gray-600">
            <div class="px-4">
                <div class="font-medium text-base text-gray-800 dark:text-gray-200">Create New</div>
            </div>
            <div class="mt-3 space-y-1">
                <!-- Hymn Create Link -->
                <a href="{{ route('musics.create') }}" class="flex items-center text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white">
                    {{ __('Hymn') }}
                    <div class="ml-1">
                        <svg class="h-4 w-4 fill-current text-gray-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                    </div>
                </a>
                <!-- User Create Link -->
                <a href="{{ route('users.create') }}" class="flex items-center text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white">
                    {{ __('User') }}
                    <div class="ml-1">
                        <svg class="h-4 w-4 fill-current text-gray-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                    </div>
                </a>
            </div>
        </div>

        <!-- User Profile and Logout -->
        <div class="pt-4 pb-1 border-t border-gray-200 dark:border-gray-600">
            <div class="px-4">
                @if (Auth::check())
                    <div class="font-medium text-base text-gray-800 dark:text-gray-200">{{ Auth::user()->name }}</div>
                    <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                @else
                    <script type="text/javascript">
                        window.location.href = "{{ route('login') }}"; // Redirect to the login page
                    </script>
                @endif
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
                <x-nav-link :href="route('admin.settings')" :active="request()->routeIs('admin.settings')">
                    <i class="fa fa-cogs fa-fw" aria-hidden="true"></i>
                </x-nav-link>
                @endif
        </div>
    </div>
</nav>
