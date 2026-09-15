@extends('layouts.retro')

@section('content')
    <a href="{{ url()->previous() ?: route('games.index') }}" class="text-sm text-retro-muted hover:text-retro-accent2 transition font-mono">&larr; {{ __('games.title') }}</a>

    <div class="pixel-border bg-retro-panel mt-4 max-w-xl mx-auto overflow-hidden">
        <div class="h-56 bg-retro-panelLight flex items-center justify-center"
             style="background-image: url('{{ $game->thumbnail }}'); background-size: contain; background-repeat: no-repeat; background-position: center;">
        </div>

        <div class="p-6">
            <h2 class="font-pixel text-sm text-retro-accent2 mb-4">{{ $game->title }}</h2>

            <div class="flex flex-wrap gap-1 mb-6">
                @foreach($game->tags as $tag)
                    <span class="inline-block px-2 py-0.5 text-xs text-white font-pixel" style="background-color: {{ $tag->color_hex }}">
                        {{ $tag->name }}
                    </span>
                @endforeach
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 font-mono text-lg">
                @if($game->developer)
                    <div>
                        <p class="text-retro-muted text-sm font-pixel mb-2">{{ __('games.fields.developer_name') }}</p>
                        <div class="flex items-center gap-3">
                            @if($game->developer->image)
                                <div class="w-16 h-16 bg-retro-panelLight pixel-border !border-2 flex items-center justify-center"
                                     style="background-image: url('{{ $game->developer->image }}'); background-size: contain; background-repeat: no-repeat; background-position: center;">
                                </div>
                            @endif
                            <span>{{ $game->developer->name }}</span>
                        </div>
                    </div>
                @endif

                @if($game->publisher)
                    <div>
                        <p class="text-retro-muted text-sm font-pixel mb-2">{{ __('games.fields.publisher_name') }}</p>
                        <div class="flex items-center gap-3">
                            @if($game->publisher->image)
                                <div class="w-16 h-16 bg-retro-panelLight pixel-border !border-2 flex items-center justify-center"
                                     style="background-image: url('{{ $game->publisher->image }}'); background-size: contain; background-repeat: no-repeat; background-position: center;">
                                </div>
                            @endif
                            <span>{{ $game->publisher->name }}</span>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
