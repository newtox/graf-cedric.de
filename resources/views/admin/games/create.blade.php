@extends('tablar::page')

@section('title', __('games.create'))

@section('content')
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <h2 class="page-title">{{ __('games.create') }}</h2>
                </div>
            </div>
        </div>
    </div>
    <div class="page-body">
        <div class="container-xl">
            <form action="{{ route('admin.games.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card">
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label required">{{ __('games.fields.title') }}</label>
                            <input type="text" name="title" class="form-control" value="{{ old('title') }}" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">{{ __('games.fields.thumbnail') }}</label>
                            <input type="file" name="thumbnail" class="form-control" accept="image/*">
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label required">{{ __('games.fields.developer_name') }}</label>
                                    <input type="text" name="developer_name" class="form-control"
                                           value="{{ old('developer_name') }}" required>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">{{ __('games.fields.developer_image') }}</label>
                                    <input type="file" name="developer_image" class="form-control" accept="image/*">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label required">{{ __('games.fields.publisher_name') }}</label>
                                    <input type="text" name="publisher_name" class="form-control"
                                           value="{{ old('publisher_name') }}" required>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">{{ __('games.fields.publisher_image') }}</label>
                                    <input type="file" name="publisher_image" class="form-control" accept="image/*">
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">{{ __('games.fields.tags') }}</label>
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
                                                {{ in_array($tag->id, old('tags', [])) ? 'checked' : '' }}>
                                            <span class="tag-label">{{ $tag->name }}</span>
                                        </label>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-start">
                        <a href="{{ url()->previous() ?: route('admin.games.index') }}" class="btn btn-secondary me-2">
                            <i class="ti ti-arrow-back me-2"></i>
                        </a>
                        <button type="submit" class="btn btn-primary me-2">
                            <i class="ti ti-send me-2"></i>
                            {{ __('games.create') }}
                        </button>
                    </div>
                </div>
            </form>
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
