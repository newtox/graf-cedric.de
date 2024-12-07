@extends('tablar::page')

@section('title', __('tags.edit'))

@section('content')
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <h2 class="page-title">{{ __('tags.edit') }}</h2>
                </div>
            </div>
        </div>
    </div>
    <div class="page-body">
        <div class="container-xl">
            <form action="{{ route('admin.tags.update', $tag) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="card">
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label required">{{ __('tags.fields.name') }}</label>
                            <input type="text" name="name" class="form-control" value="{{ $tag->name }}" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label required">{{ __('tags.fields.color') }}</label>
                            <select name="color" class="form-select" required>
                                <option value="orange" {{ $tag->color === 'orange' ? 'selected' : '' }}>Orange</option>
                                <option value="yellow" {{ $tag->color === 'yellow' ? 'selected' : '' }}>Yellow</option>
                                <option value="green" {{ $tag->color === 'green' ? 'selected' : '' }}>Green</option>
                                <option value="purple" {{ $tag->color === 'purple' ? 'selected' : '' }}>Purple</option>
                                <option value="blue" {{ $tag->color === 'blue' ? 'selected' : '' }}>Blue</option>
                                <option value="indigo" {{ $tag->color === 'indigo' ? 'selected' : '' }}>Indigo</option>
                                <option value="red" {{ $tag->color === 'red' ? 'selected' : '' }}>Red</option>
                                <option value="azure" {{ $tag->color === 'azure' ? 'selected' : '' }}>Azure</option>
                                <option value="lime" {{ $tag->color === 'lime' ? 'selected' : '' }}>Lime</option>
                                <option value="cyan" {{ $tag->color === 'cyan' ? 'selected' : '' }}>Cyan</option>
                            </select>
                        </div>
                    </div>
                    <div class="card-footer text-start">
                        <a href="{{ url()->previous() ?: route('admin.tags.index') }}" class="btn btn-secondary me-2">
                            <i class="ti ti-arrow-back me-2"></i>
                        </a>
                        <button type="submit" class="btn btn-primary me-2">
                            <i class="ti ti-database-edit me-2"></i>
                            {{ __('tags.edit') }}
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
