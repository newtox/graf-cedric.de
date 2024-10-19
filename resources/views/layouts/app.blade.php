<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Load Tailwind CSS via Vite -->
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-900 text-white">
<div id="app">
    @include('layouts.navigation') <!-- Include the navigation bar -->

    <!-- Page Content -->
    <main class="py-4">
        <div class="container mx-auto">
            @if (isset($slot))
                {{ $slot }} <!-- Render slot content if it's set -->
            @else
                @yield('content') <!-- Fallback to yield content if slot is not set -->
            @endif
        </div>
    </main>
</div>

<!-- Load JS -->
@vite('resources/js/app.js')
</body>
</html>
