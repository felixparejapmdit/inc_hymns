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
        <link rel="stylesheet" href="{{ asset('css/vendor/all.min.css') }}">
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
        </style>
    </head>

    <body class="font-sans antialiased">

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
            <main class="{{ isset($header) ? 'mt-44' : 'mt-2' }}">
                {{ $slot }}
            </main>
        </div>


    </body>
</html>
