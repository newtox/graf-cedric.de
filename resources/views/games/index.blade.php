@extends('layouts.retro')

@section('content')
    <div class="flex flex-wrap items-center justify-between gap-3 mb-6">
        <h2 class="font-pixel text-sm text-retro-accent2">{{ __('games.title') }}</h2>

        <form action="{{ route('games.index') }}" method="GET" class="flex items-center gap-2">
            <input type="text" name="search" value="{{ request('search') }}"
                   placeholder="{{ __('games.fields.search') }}"
                   title="{{ __('games.fields.search') }}"
                   class="bg-retro-bg border-2 border-retro-border text-retro-text font-mono text-lg p-2 w-56">

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
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4" id="games-grid">
        @include('games.partials.game-cards')
    </div>

    <div class="mt-6">
        {{ $games->links() }}
    </div>
@endsection