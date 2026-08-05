@extends('tablar::page')

@section('title', __('users.create'))

@section('content')
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <h2 class="page-title">{{ __('users.create') }}</h2>
                </div>
            </div>
        </div>
    </div>
    <div class="page-body">
        <div class="container-xl">
            <form action="{{ route('admin.users.store') }}" method="POST" novalidate>
                @csrf
                <div class="card">
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label required">{{ __('users.fields.name') }}</label>
                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" required>

                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label required">{{ __('users.fields.email') }}</label>
                            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" required>

                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label required">{{ __('users.fields.password') }}</label>
                            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" required>

                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label required">{{ __('users.fields.password_confirmation') }}</label>
                            <input type="password" name="password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror" required>

                            @error('password_confirmation' || 'password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label required">{{ __('users.fields.roles') }}</label>
    
                            @foreach($roles as $role)
                                <label class="form-check">
                                <input type="checkbox" name="roles[]" value="{{ $role->id }}"
                                    class="form-check-input" {{ is_array(old('roles')) && in_array($role->id, old('roles')) ? 'checked' : '' }}>

                                    <span class="form-check-label">{{ $role->name }}</span>
                                </label>
                            @endforeach

                            @error('roles')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="card-footer text-start">
                        <a href="{{ url()->previous() ?: route('admin.users.index') }}" class="btn btn-secondary me-2">
                            <i class="ti ti-arrow-back me-2"></i>
                        </a>
                        <button type="submit" class="btn btn-primary me-2">
                            <i class="ti ti-send me-2"></i>
                            {{ __('users.create') }}
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
