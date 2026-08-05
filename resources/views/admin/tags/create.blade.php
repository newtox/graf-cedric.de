@extends('tablar::page')

@section('title', __('tags.create'))

@section('content')
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <h2 class="page-title">{{ __('tags.create') }}</h2>
                </div>
            </div>
        </div>
    </div>
    <div class="page-body">
        <div class="container-xl">
            <form action="{{ route('admin.tags.store') }}" method="POST" novalidate>
                @csrf
                <div class="card">
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label required">{{ __('tags.fields.name') }}</label>
                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label required">{{ __('tags.fields.color') }}</label>
                            <select name="color" class="form-select @error('color') is-invalid @enderror" required>
                                <option value="orange" {{ old('color') === 'orange' ? 'selected' : '' }}>Orange</option>
                                <option value="yellow" {{ old('color') === 'yellow' ? 'selected' : '' }}>Yellow</option>
                                <option value="green" {{ old('color') === 'green' ? 'selected' : '' }}>Green</option>
                                <option value="purple" {{ old('color') === 'purple' ? 'selected' : '' }}>Purple</option>
                                <option value="blue" {{ old('color') === 'blue' ? 'selected' : '' }}>Blue</option>
                                <option value="indigo" {{ old('color') === 'indigo' ? 'selected' : '' }}>Indigo</option>
                                <option value="red" {{ old('color') === 'red' ? 'selected' : '' }}>Red</option>
                                <option value="azure" {{ old('color') === 'azure' ? 'selected' : '' }}>Azure</option>
                                <option value="lime" {{ old('color') === 'lime' ? 'selected' : '' }}>Lime</option>
                                <option value="cyan" {{ old('color') === 'cyan' ? 'selected' : '' }}>Cyan</option>
                            </select>

                            @error('color')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="card-footer text-start">
                        <a href="{{ url()->previous() ?: route('admin.tags.index') }}" class="btn btn-secondary me-2">
                            <i class="ti ti-arrow-back me-2"></i>
                        </a>
                        <button type="submit" class="btn btn-primary me-2">
                            <i class="ti ti-send me-2"></i>
                            {{ __('tags.create') }}
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
