@extends('tablar::page')

@section('title', __('tags.title'))

@section('content')
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <h2 class="page-title">{{ __('tags.title') }}</h2>
                </div>
                @can('create tags')
                    <div class="col-auto ms-auto">
                        <a href="{{ route('admin.tags.create') }}" class="btn btn-primary me-2">
                            <i class="ti ti-plus me-2"></i>
                            {{ __('tags.create') }}
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
                            <th>{{ __('tags.fields.name') }}</th>
                            <th>{{ __('tags.fields.color') }}</th>
                            <th class="w-1"></th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($tags as $tag)
                            <tr>
                                <td>{{ $tag->name }}</td>
                                <td>
                                    <span class="badge bg-{{ $tag->color }} text-bg-dark me-2">{{ $tag->color }}</span>
                                </td>
                                <td>
                                    <div class="btn-list flex-nowrap">
                                        @can('edit tags')
                                            <a href="{{ route('admin.tags.edit', $tag) }}"
                                               class="btn btn-icon btn-primary me-2">
                                                <i class="ti ti-edit"></i>
                                            </a>
                                        @endcan
                                        @can('delete tags')
                                            <form action="{{ route('admin.tags.destroy', $tag) }}"
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
                                <td colspan="4" class="text-center py-4">
                                    ...
                                </td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
                @if($tags->hasPages())
                    <div class="card-footer pb-0">
                        {{ $tags->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
