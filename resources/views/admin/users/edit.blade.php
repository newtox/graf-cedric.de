@extends('tablar::page')

@section('title', __('users.edit'))

@section('content')
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <h2 class="page-title">{{ __('users.edit') }}</h2>
                </div>
            </div>
        </div>
    </div>
    <div class="page-body">
        <div class="container-xl">
            <form action="{{ route('admin.users.update', $user) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="card">
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label required">{{ __('users.fields.name') }}</label>
                            <input type="text" name="name" class="form-control" value="{{ $user->name }}" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label required">{{ __('users.fields.email') }}</label>
                            <input type="email" name="email" class="form-control" value="{{ $user->email }}" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">{{ __('users.fields.password') }}</label>
                            <input type="password" name="password" class="form-control">
                            <small class="form-hint">{{ __('users.hints.leave_blank') }}</small>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">{{ __('users.fields.password_confirmation') }}</label>
                            <input type="password" name="password_confirmation" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">{{ __('users.fields.roles') }}</label>
                            @foreach($roles as $role)
                                <label class="form-check">
                                    <input type="checkbox"
                                           name="roles[]"
                                           value="{{ $role->id }}"
                                           class="form-check-input"
                                        {{ $user->hasRole($role->name) ? 'checked' : '' }}>
                                    <span class="form-check-label">{{ $role->name }}</span>
                                </label>
                            @endforeach
                        </div>
                    </div>
                    <div class="card-footer text-start">
                        <a href="{{ url()->previous() ?: route('admin.users.index') }}" class="btn btn-secondary me-2">
                            <i class="ti ti-arrow-back me-2"></i>
                        </a>
                        <button type="submit" class="btn btn-primary me-2">
                            <i class="ti ti-database-edit me-2"></i>
                            {{ __('users.edit') }}
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
