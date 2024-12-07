@extends('tablar::page')

@section('title', $game->title)

@section('content')
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <h2 class="page-title">{{ $game->title }}</h2>
                </div>
            </div>
        </div>
    </div>
    <div class="page-body">
        <div class="container-xl">
            <div class="card" style="max-width: 600px; margin: 0 auto;">
                <div class="card-img-top img-responsive"
                     style="background-image: url('{{ $game->thumbnail }}');
                     background-size: contain;
                     background-repeat: no-repeat;
                     background-position: center;
                     height: 200px;
                     width: 100%;
                     max-width: 400px;
                     margin: 0 auto;">
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        @foreach($game->tags as $tag)
                            <span class="badge bg-{{ $tag->color }} text-bg-dark me-2">
                                {{ $tag->name }}
                            </span>
                        @endforeach
                    </div>
                    <div class="row mb-3">
                        @if($game->developer_name)
                            <div class="col-md-6 mb-3">
                                <div class="text-muted">{{ __('games.fields.developer_name') }}</div>
                                <div class="d-flex align-items-center">
                                    @if($game->developer_image)
                                        <span class="avatar me-2"
                                              style="background-image: url('{{ $game->developer_image }}');
                                              background-size: contain;
                                              background-repeat: no-repeat;
                                              background-position: center;
                                              height: 128px;
                                              width: 128px;">
                                        </span>
                                    @endif
                                    {{ $game->developer_name }}
                                </div>
                            </div>
                        @endif
                        @if($game->publisher_name)
                            <div class="col-md-6 mb-3">
                                <div class="text-muted">{{ __('games.fields.publisher_name') }}</div>
                                <div class="d-flex align-items-center">
                                    @if($game->publisher_image)
                                        <span class="avatar me-2"
                                              style="background-image: url('{{ $game->publisher_image }}');
                                              background-size: contain;
                                              background-repeat: no-repeat;
                                              background-position: center;
                                              height: 128px;
                                              width: 128px;">
                                        </span>
                                    @endif
                                    {{ $game->publisher_name }}
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="card-footer">
                    <a href="{{ url()->previous() ?: route('games.index') }}" class="btn btn-secondary me-2">
                        <i class="ti ti-arrow-back me-2"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
