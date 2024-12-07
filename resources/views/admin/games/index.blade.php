@extends('tablar::page')

@section('title', __('games.title'))

@section('content')
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <h2 class="page-title">{{ __('games.title') }}</h2>
                </div>
                @can('create games')
                    <div class="col-auto ms-auto">
                        <a href="{{ route('admin.games.create') }}" class="btn btn-primary me-2">
                            <i class="ti ti-plus me-2"></i>
                            {{ __('games.create') }}
                        </a>
                    </div>
                @endcan
            </div>
        </div>
    </div>
    <div class="page-body">
        <div class="container-xl">
            <div class="card">
                <div class="table-responsive">
                    <table class="table table-vcenter card-table">
                        <thead>
                        <tr>
                            <th>{{ __('games.fields.thumbnail') }}</th>
                            <th>{{ __('games.fields.title') }}</th>
                            <th>{{ __('games.fields.developer_name') }}</th>
                            <th>{{ __('games.fields.publisher_name') }}</th>
                            <th>{{ __('games.fields.tags') }}</th>
                            <th class="w-1"></th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($games as $game)
                            <tr>
                                <td>
                                    @if($game->thumbnail)
                                        <span class="avatar avatar-lg rounded"
                                              style="background-image: url('{{ $game->thumbnail }}');
                                              background-size: contain;
                                              background-repeat: no-repeat;
                                              background-position: center;">
                                        </span>
                                    @endif
                                </td>
                                <td>
                                    <div class="font-weight-medium">{{ $game->title }}</div>
                                    <div class="text-muted">{{ $game->slug }}</div>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        @if($game->developer_image)
                                            <span class="avatar avatar-sm me-2"
                                                  style="background-image: url('{{ $game->developer_image }}');
                                                  background-size: contain;
                                                  background-repeat: no-repeat;
                                                  background-position: center;">
                                            </span>
                                        @endif
                                        {{ $game->developer_name }}
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        @if($game->publisher_image)
                                            <span class="avatar avatar-sm me-2"
                                                  style="background-image: url('{{ $game->publisher_image }}');
                                                  background-size: contain;
                                                  background-repeat: no-repeat;
                                                  background-position: center;">
                                            </span>
                                        @endif
                                        {{ $game->publisher_name }}
                                    </div>
                                </td>
                                <td>
                                    @foreach($game->tags as $tag)
                                        <span class="badge bg-{{ $tag->color }} text-bg-dark me-2">
                                            {{ $tag->name }}
                                        </span>
                                    @endforeach
                                </td>
                                <td>
                                    <div class="btn-list flex-nowrap">
                                        @can('edit games')
                                            <a href="{{ route('admin.games.edit', $game) }}"
                                               class="btn btn-icon btn-primary me-2">
                                                <i class="ti ti-edit"></i>
                                            </a>
                                        @endcan
                                        @can('delete games')
                                            <form action="{{ route('admin.games.destroy', $game) }}"
                                                  method="POST"
                                                  onsubmit="return confirm('Sure?');"
                                                  class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-icon btn-danger me-2">
                                                    <i class="ti ti-trash"></i>
                                                </button>
                                            </form>
                                        @endcan
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-4">
                                    ...
                                </td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
                @if($games->hasPages())
                    <div class="card-footer pb-0">
                        {{ $games->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
