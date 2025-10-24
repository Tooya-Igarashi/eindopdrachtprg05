<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }} - Games</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-gray-50">
<!-- Header -->
<header class="bg-white shadow-sm">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16 items-center">
{{--            <div class="flex items-center">--}}
{{--                <a href="{{ url('/') }}" class="text-xl font-bold text-indigo-600">--}}
{{--                    {{ config('app.name', 'GameHub') }}--}}
{{--                </a>--}}
{{--            </div>--}}

            <!-- Navigation -->
            <nav class="hidden md:flex space-x-8">
                <x-nav-link href="{{ route('games.index') }}">Games</x-nav-link>
                @if(\Illuminate\Support\Facades\Auth::guest())
                <x-nav-button href="{{ route('login') }}">Log in</x-nav-button>
                <x-nav-button href="{{ route('register') }}"> Register</x-nav-button>
                @else                <x-nav-button href="{{ route('games.create') }}" >Add Game</x-nav-button>

                @endif
            </nav>
            @auth
                @include('layouts.navigation')
            @endauth

            <!-- Mobile menu button -->
            <div class="md:hidden">
                <button type="button" class="text-gray-500 hover:text-gray-600 focus:outline-none focus:text-gray-600">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
            </div>
        </div>
    </div>
</header>

<!-- Hero Section -->
<div class="bg-gradient-to-r from-indigo-500 to-purple-600 text-white py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h1 class="text-4xl font-bold mb-4">{{$header}}</h1>
        <p class="text-xl max-w-2xl mx-auto">{{$header_text}}</p>
    </div>
</div>

<!-- Main Content -->
<main class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
    {{ $slot }}
</main>

<!-- Footer -->
<footer class="bg-white border-t border-gray-200 mt-12">
    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
        <div class="md:flex md:items-center md:justify-between">
            <div class="text-center md:text-left">
                <p class="text-sm text-gray-500">
                    &copy; {{ date('Y') }} {{ config('app.name', 'GameHub') }}. All rights reserved.
                </p>
            </div>
        </div>
    </div>
</footer>
</body>
</html>
