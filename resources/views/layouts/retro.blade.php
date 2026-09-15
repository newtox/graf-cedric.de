<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? __('menu.dashboard') }} &mdash; Graf Cedric</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-retro-bg text-retro-text min-h-screen">
    <div class="max-w-6xl mx-2 sm:mx-auto my-3 sm:my-6 pixel-border overflow-hidden bg-retro-panel">

        <div class="relative h-28 sm:h-40 bg-cover bg-repeat-x flex items-center justify-between px-4 sm:px-8">
            <div>
                <h1 class="font-pixel text-lg sm:text-2xl md:text-3xl text-white" style="text-shadow: 3px 3px 0 rgb(var(--c-border));">
                    Graf Cedric von Leuchtenberg
                </h1>
                <p class="font-pixel text-xs text-retro-accent2 mt-2" style="text-shadow: 2px 2px 0 rgb(var(--c-border));">
                    {{ __('about.tagline') }}
                </p>
            </div>

            <div class="flex items-center gap-2">
                <a href="{{ route('language.switch', app()->getLocale() === 'de' ? 'en' : 'de') }}"
                    title="{{ __('menu.switch') }}"
                    class="w-9 h-9 flex items-center justify-center rounded bg-retro-panel/90 text-retro-text hover:opacity-80 transition shrink-0">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="2" y1="12" x2="22" y2="12"/><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"/></svg>
                </a>

                @auth
                    <form action="{{ route('logout') }}" method="POST" class="shrink-0">
                        @csrf
                        <button title="{{ __('menu.logout') }}" class="w-9 h-9 flex items-center justify-center rounded bg-red-900/90 text-white hover:bg-red-800 transition">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/><polyline points="16 17 21 12 16 7"/><line x1="21" y1="12" x2="9" y2="12"/></svg>
                        </button>
                    </form>
                @else
                    <a href="{{ route('login') }}" title="{{ __('menu.guest') }}" class="px-3 py-2 rounded bg-retro-accent text-white hover:opacity-90 transition font-pixel text-xs shrink-0">
                        {{ __('menu.guest') }}
                    </a>
                @endauth
            </div>
        </div>

        @include('partials.alerts')

        <div class="flex flex-col sm:flex-row">
            <aside class="bg-retro-border sm:w-24 shrink-0 flex sm:flex-col items-center gap-3 p-3 flex-wrap justify-center sm:justify-start">
                <a href="{{ route('home') }}" title="{{ __('menu.dashboard') }}"
                   class="flex flex-col items-center gap-1 w-16 group">
                    <span class="w-12 h-12 pixel-border !border-2 flex items-center justify-center bg-retro-panelLight text-retro-text group-hover:bg-retro-accent group-hover:text-white transition">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
                    </span>
                    <span class="font-pixel text-[8px] text-retro-text text-center leading-tight hidden sm:block break-words w-full">{{ __('menu.dashboard') }}</span>
                </a>

                <a href="{{ route('about') }}" title="{{ __('menu.about') }}"
                   class="flex flex-col items-center gap-1 w-16 group">
                    <span class="w-12 h-12 pixel-border !border-2 flex items-center justify-center bg-retro-panelLight text-retro-text group-hover:bg-retro-accent group-hover:text-white transition">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                    </span>
                    <span class="font-pixel text-[8px] text-retro-text text-center leading-tight hidden sm:block break-words w-full">{{ __('menu.about') }}</span>
                </a>

                <a href="{{ route('games.index') }}" title="{{ __('menu.public_games') }}"
                   class="flex flex-col items-center gap-1 w-16 group">
                    <span class="w-12 h-12 pixel-border !border-2 flex items-center justify-center bg-retro-panelLight text-retro-text group-hover:bg-retro-accent group-hover:text-white transition">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="6" y1="12" x2="10" y2="12"/><line x1="8" y1="10" x2="8" y2="14"/><line x1="15" y1="13" x2="15.01" y2="13"/><line x1="18" y1="11" x2="18.01" y2="11"/><rect x="2" y="6" width="20" height="12" rx="2"/></svg>
                    </span>
                    <span class="font-pixel text-[8px] text-retro-text text-center leading-tight hidden sm:block break-words w-full">{{ __('menu.public_games') }}</span>
                </a>

                @auth
                    <a href="{{ route('admin.games.index') }}" title="{{ __('menu.games_management') }}"
                       class="flex flex-col items-center gap-1 w-16 group">
                        <span class="w-12 h-12 pixel-border !border-2 flex items-center justify-center bg-retro-panelLight text-retro-text group-hover:bg-retro-accent group-hover:text-white transition">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-7.94 7.94l-6.91 6.91a2.12 2.12 0 0 1-3-3l6.91-6.91a6 6 0 0 1 7.94-7.94l-3.76 3.76z"/></svg>
                        </span>
                        <span class="font-pixel text-[8px] text-retro-text text-center leading-tight hidden sm:block break-words w-full">{{ __('menu.games_management') }}</span>
                    </a>

                    @can('view tags')
                        <a href="{{ route('admin.tags.index') }}" title="{{ __('menu.tags_management') }}"
                           class="flex flex-col items-center gap-1 w-16 group">
                            <span class="w-12 h-12 pixel-border !border-2 flex items-center justify-center bg-retro-panelLight text-retro-text group-hover:bg-retro-accent group-hover:text-white transition">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20.59 13.41l-7.17 7.17a2 2 0 0 1-2.83 0L2 12V2h10l8.59 8.59a2 2 0 0 1 0 2.82z"/><line x1="7" y1="7" x2="7.01" y2="7"/></svg>
                            </span>
                            <span class="font-pixel text-[8px] text-retro-text text-center leading-tight hidden sm:block break-words w-full">{{ __('menu.tags_management') }}</span>
                        </a>
                    @endcan

                    @can('view users')
                        <a href="{{ route('admin.users.index') }}" title="{{ __('menu.users_management') }}"
                           class="flex flex-col items-center gap-1 w-16 group">
                            <span class="w-12 h-12 pixel-border !border-2 flex items-center justify-center bg-retro-panelLight text-retro-text group-hover:bg-retro-accent group-hover:text-white transition">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                            </span>
                            <span class="font-pixel text-[8px] text-retro-text text-center leading-tight hidden sm:block break-words w-full">{{ __('menu.users_management') }}</span>
                        </a>
                    @endcan
                @endauth
            </aside>

            <main class="flex-1 min-w-0 bg-retro-panelLight/20 p-3 sm:p-6">
                @yield('content')
            </main>
        </div>

        <footer class="bg-retro-border px-4 sm:px-6 py-4">
            <div class="flex flex-col sm:flex-row items-center justify-center gap-2 sm:gap-4 text-center font-mono text-sm sm:text-base text-retro-muted">
                <span>
                    Copyright &copy; {{ now()->year }}
                    <a href="https://newtox.de" class="text-retro-accent2 hover:underline">Newtox</a>.
                    All rights reserved.
                </span>
                <span class="hidden sm:inline">&middot;</span>
                <a href="https://github.com/newtox/graf-cedric.de" class="text-retro-accent2 hover:underline">
                    v1.0 beta
                </a>
            </div>
        </footer>
    </div>
</body>
</html>