<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }} | {{ $title ?? '' }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased bg-gray-50">
    @include('partials.header')

    @include('partials.sidebar')

    <div class="p-2 sm:ml-64">
        <div class="p-2 mt-14 py-5">
            <main>
                @if (session('success'))
                    <x-alert-success>
                        {{ session('success') }}
                    </x-alert-success>
                @endif

                @if (session('error'))
                    <x-alert-danger>
                        {{ session('error') }}
                    </x-alert-danger>
                @endif

                {{ $slot }}
            </main>
        </div>
    </div>

    <!-- Global Loader Overlay -->
    <div id="global-loader"
        class="fixed inset-0 z-[100] hidden flex items-center justify-center bg-gray-900/50 backdrop-blur-sm transition-opacity duration-300">
        <div class="flex flex-col items-center p-6 bg-white rounded-2xl shadow-2xl">
            <svg class="animate-spin h-10 w-10 text-blue-600 mb-3" xmlns="http://www.w3.org/2000/svg" fill="none"
                viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4">
                </circle>
                <path class="opacity-75" fill="currentColor"
                    d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                </path>
            </svg>
            <span class="text-sm font-semibold text-gray-700">Traitement en cours...</span>
        </div>
    </div>
</body>

</html>
