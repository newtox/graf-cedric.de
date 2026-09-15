@extends('layouts.retro')

@section('content')
    <div class="flex flex-wrap items-center justify-between gap-3 mb-6">
        <h2 class="font-pixel text-sm text-retro-accent2">{{ __('games.title') }}</h2>

        <div class="flex items-center gap-2">
            <form action="{{ route('admin.games.index') }}" method="GET" class="flex items-center gap-2">
                <input type="text" name="search" value="{{ request('search') }}"
                       placeholder="{{ __('games.fields.search') }}"
                       title="{{ __('games.fields.search') }}"
                       class="bg-retro-bg border-2 border-retro-border text-retro-text font-mono text-lg p-2 w-40 sm:w-48">

                <div x-data="{ open: false }" class="relative">
                    <button type="button" @click="open = !open"
                        class="pixel-border !border-2 px-3 py-2 font-pixel text-xs bg-retro-panel text-retro-text">
                        {{ __('games.fields.tags') }}
                    </button>
                    <div x-show="open" x-cloak @click.outside="open = false"
                        class="absolute right-0 mt-2 w-56 pixel-border bg-retro-panel p-3 z-10 max-h-72 overflow-y-auto">
                        @foreach($tags as $tag)
                            <label class="flex items-center gap-2 mb-2 font-mono text-lg cursor-pointer">
                                <input type="checkbox" name="tags[]" value="{{ $tag->id }}"
                                    {{ in_array($tag->id, (array) request('tags')) ? 'checked' : '' }}>
                                <span class="inline-block w-3 h-3 rounded-full" style="background-color: {{ $tag->color_hex }}"></span>
                                {{ $tag->name }}
                            </label>
                        @endforeach
                        <button type="submit" class="w-full mt-2 pixel-border !border-2 px-3 py-1.5 font-pixel text-xs bg-retro-accent text-white">
                            {{ __('games.fields.filter') }}
                        </button>
                    </div>
                </div>
            </form>

            @can('create games')
                <a href="{{ route('admin.games.create') }}" class="pixel-border !border-2 px-4 py-2 font-pixel text-xs bg-retro-accent text-white whitespace-nowrap">
                    + {{ __('games.create') }}
                </a>
            @endcan
        </div>
    </div>

    <div class="sm:hidden space-y-3">
        @forelse($games as $game)
            <div class="pixel-border bg-retro-panel p-3" x-data="{ confirmingDelete: false }">
                <div class="flex items-center gap-3 mb-3">
                    @if($game->thumbnail)
                        <img src="{{ $game->thumbnail }}" class="w-12 h-12 object-contain bg-retro-panelLight pixel-border !border-2 shrink-0">
                    @endif
                    <div class="min-w-0">
                        <p class="font-mono text-lg truncate">{{ $game->title }}</p>
                        <p class="font-mono text-sm text-retro-muted truncate">{{ $game->developer?->name }}</p>
                    </div>
                </div>

                @if($game->tags->isNotEmpty())
                    <div class="flex flex-wrap gap-1 mb-3">
                        @foreach($game->tags as $tag)
                            <span class="inline-block px-2 py-0.5 text-xs text-white font-pixel" style="background-color: {{ $tag->color_hex }}">{{ $tag->name }}</span>
                        @endforeach
                    </div>
                @endif

                <div class="flex gap-2">
                    @can('edit games')
                        <a href="{{ route('admin.games.edit', $game) }}"
                           class="flex-1 flex items-center justify-center gap-2 pixel-border !border-2 px-3 py-2 font-pixel text-xs bg-retro-panelLight text-retro-text">
                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                            {{ __('games.edit') }}
                        </a>
                    @endcan
                    @can('delete games')
                        <form id="delete-game-form-m-{{ $game->id }}" action="{{ route('admin.games.destroy', $game) }}" method="POST" class="hidden">
                            @csrf
                            @method('DELETE')
                        </form>
                        <button type="button" @click="confirmingDelete = true"
                                class="flex-1 flex items-center justify-center gap-2 pixel-border !border-2 px-3 py-2 font-pixel text-xs bg-red-900 text-red-100">
                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6"/><path d="M10 11v6"/><path d="M14 11v6"/><path d="M9 6V4a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v2"/></svg>
                            {{ __('common.delete') }}
                        </button>
                    @endcan
                </div>

                <div x-show="confirmingDelete" x-cloak
                     class="fixed inset-0 bg-black/60 flex items-center justify-center z-50 px-4"
                     @click.self="confirmingDelete = false">
                    <div class="pixel-border bg-retro-panel p-6 max-w-sm w-full text-center">
                        <p class="font-pixel text-xs text-retro-accent2 mb-2">{{ __('common.confirm_delete_title') }}</p>
                        <p class="font-mono text-lg text-retro-muted mb-4">{{ __('common.confirm_delete_text') }}</p>
                        <div class="flex gap-3 justify-center">
                            <button type="button" @click="confirmingDelete = false" class="pixel-border !border-2 px-4 py-2 font-pixel text-xs bg-retro-panelLight text-retro-text">
                                {{ __('common.cancel') }}
                            </button>
                            <button type="button" @click="document.getElementById('delete-game-form-m-{{ $game->id }}').submit()" class="pixel-border !border-2 px-4 py-2 font-pixel text-xs bg-red-700 text-white">
                                {{ __('common.delete') }}
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <p class="text-center text-retro-muted font-mono text-lg py-6">{{ __('common.no_results') }}</p>
        @endforelse
    </div>

    <div class="hidden sm:block pixel-border bg-retro-panel"><div class="overflow-x-auto">
        <table class="w-full font-mono text-lg">
            <thead>
                <tr class="text-left text-retro-accent2 bg-retro-border font-pixel text-xs">
                    <th class="p-3">{{ __('games.fields.thumbnail') }}</th>
                    <th class="p-3">{{ __('games.fields.title') }}</th>
                    <th class="p-3">{{ __('games.fields.developer_name') }}</th>
                    <th class="p-3">{{ __('games.fields.publisher_name') }}</th>
                    <th class="p-3">{{ __('games.fields.tags') }}</th>
                    <th class="p-3"></th>
                </tr>
            </thead>
            <tbody>
                @forelse($games as $game)
                    <tr class="border-b border-retro-border/50" x-data="{ confirmingDelete: false }">
                        <td class="p-3">
                            @if($game->thumbnail)
                                <img src="{{ $game->thumbnail }}" class="w-10 h-10 object-contain bg-retro-panelLight pixel-border !border-2">
                            @endif
                        </td>
                        <td class="p-3">{{ $game->title }}</td>
                        <td class="p-3">
                            <div class="flex items-center gap-2">
                                @if($game->developer?->image)
                                    <img src="{{ $game->developer->image }}" class="w-6 h-6 object-contain bg-retro-panelLight pixel-border !border-2">
                                @endif
                                {{ $game->developer?->name }}
                            </div>
                        </td>
                        <td class="p-3">
                            <div class="flex items-center gap-2">
                                @if($game->publisher?->image)
                                    <img src="{{ $game->publisher->image }}" class="w-6 h-6 object-contain bg-retro-panelLight pixel-border !border-2">
                                @endif
                                {{ $game->publisher?->name }}
                            </div>
                        </td>
                        <td class="p-3">
                            @foreach($game->tags as $tag)
                                <span class="inline-block px-2 py-0.5 text-xs text-white font-pixel mr-1 mb-1" style="background-color: {{ $tag->color_hex }}">
                                    {{ $tag->name }}
                                </span>
                            @endforeach
                        </td>
                        <td class="p-3">
                            <div class="flex gap-2">
                                @can('edit games')
                                    <a href="{{ route('admin.games.edit', $game) }}" title="{{ __('games.edit') }}"
                                       class="w-10 h-10 flex items-center justify-center pixel-border !border-2 bg-retro-panelLight text-retro-text hover:opacity-80 transition">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                                    </a>
                                @endcan
                                @can('delete games')
                                    <form id="delete-game-form-{{ $game->id }}" action="{{ route('admin.games.destroy', $game) }}" method="POST" class="hidden">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                    <button type="button" @click="confirmingDelete = true" title="{{ __('common.delete') }}"
                                            class="w-10 h-10 flex items-center justify-center pixel-border !border-2 bg-red-900 text-red-100 hover:opacity-80 transition">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6"/><path d="M10 11v6"/><path d="M14 11v6"/><path d="M9 6V4a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v2"/></svg>
                                    </button>
                                @endcan
                            </div>

                            <div x-show="confirmingDelete" x-cloak
                                 class="fixed inset-0 bg-black/60 flex items-center justify-center z-50 px-4"
                                 @click.self="confirmingDelete = false">
                                <div class="pixel-border bg-retro-panel p-6 max-w-sm w-full text-center">
                                    <p class="font-pixel text-xs text-retro-accent2 mb-2">{{ __('common.confirm_delete_title') }}</p>
                                    <p class="font-mono text-lg text-retro-muted mb-4">{{ __('common.confirm_delete_text') }}</p>
                                    <div class="flex gap-3 justify-center">
                                        <button type="button" @click="confirmingDelete = false" class="pixel-border !border-2 px-4 py-2 font-pixel text-xs bg-retro-panelLight text-retro-text">
                                            {{ __('common.cancel') }}
                                        </button>
                                        <button type="button" @click="document.getElementById('delete-game-form-{{ $game->id }}').submit()" class="pixel-border !border-2 px-4 py-2 font-pixel text-xs bg-red-700 text-white">
                                            {{ __('common.delete') }}
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="p-6 text-center text-retro-muted font-mono text-lg">
                            {{ __('common.no_results') }}
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        </div>
    </div>

    <div class="mt-4">
        {{ $games->links() }}
    </div>
@endsection