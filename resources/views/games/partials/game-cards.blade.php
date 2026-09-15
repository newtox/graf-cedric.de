@forelse($games as $game)
    <a href="{{ route('games.show', $game) }}" class="pixel-border bg-retro-panel block hover:brightness-110 transition">
        <div class="h-40 bg-retro-panelLight flex items-center justify-center"
             style="background-image: url('{{ $game->thumbnail }}'); background-size: contain; background-repeat: no-repeat; background-position: center;">
        </div>
        <div class="p-4">
            <h3 class="font-pixel text-xs text-retro-text mb-3">{{ $game->title }}</h3>
            <div class="flex flex-wrap gap-1">
                @foreach($game->tags as $tag)
                    <span class="inline-block px-2 py-0.5 text-xs text-white font-pixel" style="background-color: {{ $tag->color_hex }}">
                        {{ $tag->name }}
                    </span>
                @endforeach
            </div>
        </div>
    </a>
@empty
    <p class="col-span-full text-center text-retro-muted font-mono text-lg py-8">
        {{ __('common.no_results') }}
    </p>
@endforelse