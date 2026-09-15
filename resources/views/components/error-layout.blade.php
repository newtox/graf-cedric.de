@props(['code', 'title', 'text'])

<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $code }} &mdash; Graf Cedric</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-retro-bg text-retro-text min-h-screen">
    <div class="min-h-screen flex flex-col items-center justify-center px-4 text-center">
        <p class="font-pixel text-4xl sm:text-6xl text-retro-accent mb-4">{{ $code }}</p>
        <h1 class="font-pixel text-sm sm:text-base mb-4">{{ $title }}</h1>
        <p class="font-mono text-lg text-retro-muted max-w-sm mb-8">{{ $text }}</p>

        <a href="{{ route('home') }}" class="pixel-border !border-2 px-6 py-3 font-pixel text-xs bg-retro-accent text-white">
            {{ __('menu.dashboard') }}
        </a>
    </div>
</body>
</html>