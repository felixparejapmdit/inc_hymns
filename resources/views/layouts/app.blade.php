<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'INC Hymns') }}</title>

        <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">
        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Other head elements -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
            /* Adjust the body padding to account for fixed headers */
            body {
                padding-top: 100px; /* Adjust as necessary to match the combined height of Navigation and Page Heading */
            }
            .fixed-header {
                position: fixed;
                top: 0;
                width: 100%;
                z-index: 50;
                background: rgba(255, 255, 255, 0.75);
                backdrop-filter: blur(10px);
                -webkit-backdrop-filter: blur(10px);
                border-bottom: 1px solid rgba(255, 255, 255, 0.3);
                box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
            }
            .fixed-header nav {
                background: transparent !important;
                border: none !important;
            }
            .fixed-page-heading {
                position: fixed;
                top: 60px; /* Adjust based on the height of the navigation */
                width: 100%;
                z-index: 40;
                box-shadow: 0 1px 4px rgba(0, 0, 0, 0.1);
            }
            .page-shell {
                width: 100%;
                max-width: 90%;
                margin: 0 auto;
            }

            .page-header-shell {
                display: flex;
                justify-content: space-between;
                align-items: flex-start;
                gap: 1.5rem;
                margin: 0.5rem 0 1.5rem;
                flex-wrap: wrap;
            }

            .page-kicker {
                display: inline-flex;
                align-items: center;
                gap: 0.5rem;
                padding: 0.4rem 0.8rem;
                border-radius: 999px;
                background: rgba(255, 255, 255, 0.18);
                color: rgba(255, 255, 255, 0.85);
                font-size: 0.72rem;
                font-weight: 900;
                letter-spacing: 0.14em;
                text-transform: uppercase;
                margin-bottom: 0.9rem;
            }

            .page-title {
                font-size: clamp(2.2rem, 4vw, 3.5rem);
                line-height: 0.95;
                color: #fff;
                font-weight: 950;
                letter-spacing: -0.04em;
                margin-bottom: 0.6rem;
            }

            .page-subtitle {
                color: rgba(255, 255, 255, 0.8);
                font-size: 0.95rem;
                font-weight: 700;
                letter-spacing: 0.04em;
                margin-bottom: 0;
                max-width: 42rem;
            }

            .toolbar-stack {
                display: flex;
                align-items: center;
                gap: 0.8rem;
                flex-wrap: wrap;
                justify-content: flex-end;
            }

            .page-action-btn {
                min-height: 48px;
                min-width: 140px;
                padding: 0 1.25rem;
                border-radius: 999px;
                display: inline-flex;
                align-items: center;
                justify-content: center;
                gap: 0.6rem;
                font-weight: 900;
                letter-spacing: 0.04em;
                text-decoration: none !important;
                transition: transform 0.2s ease, box-shadow 0.2s ease, background 0.2s ease, color 0.2s ease;
            }

            .page-action-btn i,
            .page-action-btn span {
                line-height: 1;
            }

            .page-action-btn:hover {
                transform: translateY(-1px);
            }

            .page-action-btn-secondary {
                background: rgba(255, 255, 255, 0.16);
                color: #fff;
                border: 1px solid rgba(255, 255, 255, 0.28);
                box-shadow: 0 10px 25px rgba(0, 0, 0, 0.08);
            }

            .page-action-btn-secondary:hover {
                color: #fff;
                background: rgba(255, 255, 255, 0.24);
            }

            .page-action-btn-primary {
                background: #fff;
                color: #3e6d9c;
                border: 1px solid rgba(255, 255, 255, 0.7);
                box-shadow: 0 14px 30px rgba(0, 0, 0, 0.1);
            }

            .page-action-btn-primary:hover {
                color: #22486c;
                background: #f8fbff;
            }

            .pagination-centered nav,
            .pagination-centered .pagination {
                display: flex;
                flex-direction: column;
                align-items: center;
                width: 100%;
            }

            .pagination-centered nav div:last-child,
            .pagination-centered .pagination {
                display: flex;
                justify-content: center;
                align-items: center;
                flex-wrap: wrap;
                gap: 6px;
                width: 100%;
                margin-top: 1rem;
            }

            .pagination-centered nav div:last-child a,
            .pagination-centered nav div:last-child span,
            .pagination-centered .page-link {
                display: inline-flex;
                align-items: center;
                justify-content: center;
                min-width: 38px;
                height: 38px;
                border-radius: 12px;
                font-weight: 700;
                font-size: 0.85rem;
                transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
                text-decoration: none !important;
                background: #f8fafc;
                color: #64748b;
                border: 1px solid #e2e8f0;
            }

            .pagination-centered nav div:last-child a:hover,
            .pagination-centered .page-link:hover {
                background: #fff;
                color: #22c55e;
                border-color: #22c55e;
                transform: translateY(-3px);
                box-shadow: 0 5px 15px rgba(34, 197, 94, 0.1);
            }

            .pagination-centered nav div:last-child span[aria-current="page"] > span,
            .pagination-centered .page-item.active .page-link,
            .pagination-centered .active-page {
                background: #22c55e !important;
                color: #fff !important;
                border: none !important;
                box-shadow: 0 4px 12px rgba(34, 197, 94, 0.3);
            }

            .pagination-centered nav div:last-child span[aria-disabled="true"] > span,
            .pagination-centered .page-item.disabled .page-link {
                background: transparent !important;
                border: none !important;
                color: #cbd5e1 !important;
                box-shadow: none !important;
                cursor: default;
            }

            .pagination-centered nav svg {
                width: 18px;
                height: 18px;
            }

            .pagination-centered nav div:first-child {
                display: none !important;
            }

            .pagination-centered .pagination {
                margin-bottom: 0;
            }

            @media (max-width: 768px) {
                .page-shell {
                    max-width: 98%;
                }
                .page-header-shell {
                    gap: 1rem;
                }
                .page-title {
                    font-size: clamp(1.85rem, 8vw, 2.5rem);
                }
                .page-action-btn {
                    min-width: 128px;
                    min-height: 44px;
                }
                .pagination-centered nav div:last-child a,
                .pagination-centered nav div:last-child span,
                .pagination-centered .page-link {
                    min-width: 32px;
                    height: 32px;
                    font-size: 0.75rem;
                }
            }
        </style>
    </head>

    <body class="font-sans antialiased">
        @auth
            <script>
                (function () {
                    const idleTimeoutMs = 60 * 60 * 1000;
                    const loginUrl = @json(url('/login'));
                    let idleTimer = null;
                    let hasLoggedOut = false;

                    function performLogout() {
                        if (hasLoggedOut) return;
                        hasLoggedOut = true;
                        window.location.replace(loginUrl);
                    }

                    function resetTimer() {
                        if (hasLoggedOut) return;
                        window.clearTimeout(idleTimer);
                        idleTimer = window.setTimeout(performLogout, idleTimeoutMs);
                    }

                    ['mousemove', 'mousedown', 'keydown', 'scroll', 'touchstart', 'click'].forEach(eventName => {
                        window.addEventListener(eventName, resetTimer, { passive: true });
                    });

                    window.addEventListener('focus', resetTimer);
                    document.addEventListener('visibilitychange', () => {
                        if (!document.hidden) {
                            resetTimer();
                        }
                    });

                    resetTimer();
                })();
            </script>
        @endauth

        <div class="min-h-screen bg-white-100 dark:bg-gray-900">
            <!-- Navigation -->
            <div class="fixed-header">
                @include('layouts.navigation')
            </div>

            <!-- Page Heading -->
            @if (isset($header))
                <header class="fixed-page-heading bg-white dark:bg-gray-800 shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main class="{{ isset($header) ? 'mt-44' : '' }}" style="{{ isset($header) ? '' : 'margin-top: 2px;' }}">
                {{ $slot }}
            </main>
        </div>


    </body>
</html>
