@extends('tablar::page')

@section('title', __('games.title'))

@section('content')
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <h2 class="page-title">{{ __('games.title') }}</h2>
                </div>
                <div class="col-auto ms-auto">
                    <form action="{{ route('games.index') }}" method="GET" class="d-flex gap-2">
                        <div class="input-icon">
                            <span class="input-icon-addon">
                                <i class="ti ti-search text-azure"></i>
                            </span>
                            <input type="text"
                                   class="form-control"
                                   name="search"
                                   value="{{ request('search') }}">
                        </div>
                        <div class="dropdown">
                            <button class="btn dropdown-toggle"
                                    type="button"
                                    data-bs-auto-close="outside"
                                    data-bs-toggle="dropdown">
                                {{ __('games.fields.tags') }}
                            </button>
                            <div class="dropdown-menu dropdown-menu-end p-3">
                                @foreach($tags as $tag)
                                    <label class="dropdown-item rounded-2 d-flex align-items-center mb-1">
                                        <input type="checkbox"
                                               name="tags[]"
                                               value="{{ $tag->id }}"
                                               class="form-check-input me-2 d-none"
                                               data-color="{{ $tag->color }}"
                                            {{ in_array($tag->id, (array)request('tags')) ? 'checked' : '' }}>
                                        <span class="tag-label">{{ $tag->name }}</span>
                                    </label>
                                @endforeach
                                <div class="dropdown-divider"></div>
                                <button type="submit" class="dropdown-item rounded-2">
                                    Filter
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="page-body">
        <div class="container-xl">
            <div class="row row-cards">
                @include('games.partials.game-cards')
            </div>
            <div class="mt-4">
                {{ $games->links() }}
            </div>
        </div>
    </div>

    <script>
        document.querySelectorAll('input[type="checkbox"][data-color]').forEach(checkbox => {
            const label = checkbox.closest('.dropdown-item');

            if (checkbox.checked) {
                label.classList.add(`bg-${checkbox.dataset.color}`);
            }

            checkbox.addEventListener('change', () => {
                if (checkbox.checked) {
                    label.classList.add(`bg-${checkbox.dataset.color}`);
                } else {
                    label.classList.remove(`bg-${checkbox.dataset.color}`);
                }
            });
        });
    </script>
@endsection
