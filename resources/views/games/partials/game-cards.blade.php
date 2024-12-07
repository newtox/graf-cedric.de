@foreach($games as $game)
    <div class="col-sm-6 col-lg-4">
        <a href="{{ route('games.show', $game) }}" class="card card-sm">
            <div class="card-img-top img-responsive img-responsive-16x9"
                 style="background-image: url('{{ $game->thumbnail }}');
                 background-size: contain;
                 background-repeat: no-repeat;
                 background-position: center;">
            </div>
            <div class="card-body">
                <h3 class="card-title">{{ $game->title }}</h3>
                <div class="mt-3">
                    @foreach($game->tags as $tag)
                        <span class="badge bg-{{ $tag->color }} text-bg-dark me-2">
                            {{ $tag->name }}
                        </span>
                    @endforeach
                </div>
            </div>
        </a>
    </div>
@endforeach
