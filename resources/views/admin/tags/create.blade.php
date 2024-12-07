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
            <form action="{{ route('admin.tags.store') }}" method="POST">
                @csrf
                <div class="card">
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label required">{{ __('tags.fields.name') }}</label>
                            <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label required">{{ __('tags.fields.color') }}</label>
                            <select name="color" class="form-select" required>
                                <option value="orange">Orange</option>
                                <option value="yellow">Yellow</option>
                                <option value="green">Green</option>
                                <option value="purple">Purple</option>
                                <option value="blue">Blue</option>
                                <option value="indigo">Indigo</option>
                                <option value="red">Red</option>
                                <option value="azure">Azure</option>
                                <option value="lime">Lime</option>
                                <option value="cyan">Cyan</option>
                            </select>
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
