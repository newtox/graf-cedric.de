@extends('tablar::page')

@section('title', __('home.dashboard'))

@section('content')
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <h2 class="page-title">{{ __('home.dashboard') }}</h2>
                </div>
            </div>
        </div>
    </div>
    <div class="page-body">
        <div class="container-xl">
            <div class="row row-deck row-cards">
                <div class="col-sm-6 col-lg-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <i class="ti ti-device-gamepad-3 text-red me-2"></i>
                                <div class="subheader">{{ __('home.total_games') }}</div>
                            </div>
                            <div class="h1 mb-3">{{ $stats['total_games'] }}</div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <i class="ti ti-tag text-yellow me-2"></i>
                                <div class="subheader">{{ __('home.total_tags') }}</div>
                            </div>
                            <div class="h1 mb-3">{{ $stats['total_tags'] }}</div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <i class="ti ti-user text-green me-2"></i>
                                <div class="subheader">{{ __('home.total_users') }}</div>
                            </div>
                            <div class="h1 mb-3">{{ $stats['total_users'] }}</div>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">{{ __('home.games_by_tag') }}</h3>
                        </div>
                        <div class="card-body">
                            @foreach($stats['games_by_tag'] as $tag)
                                <div class="mb-3">
                                    <div class="d-flex justify-content-between mb-1">
                                        <span>{{ $tag->name }}</span>
                                        <span>{{ $tag->games_count }} {{ __('home.entries') }}</span>
                                    </div>
                                    <div class="progress">
                                        <div class="progress-bar bg-{{ $tag->color }}"
                                             style="width: {{ ($tag->games_count / $stats['total_games']) * 100 }}%"
                                             role="progressbar"
                                             aria-valuenow="{{ $tag->games_count }}"
                                             aria-valuemin="0"
                                             aria-valuemax="{{ $stats['total_games'] }}">
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">{{ __('home.latest_games') }}</h3>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-vcenter card-table">
                                <thead>
                                <tr>
                                    <th>{{ __('home.title') }}</th>
                                    <th>{{ __('home.developer_name') }}</th>
                                    <th>{{ __('home.tags') }}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($stats['latest_games'] as $game)
                                    <tr>
                                        <td>{{ $game->title }}</td>
                                        <td>{{ $game->developer_name }}</td>
                                        <td>
                                            @foreach($game->tags as $tag)
                                                <span class="badge bg-{{ $tag->color }} text-bg-dark me-2">
                                                        {{ $tag->name }}
                                                    </span>
                                            @endforeach
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
