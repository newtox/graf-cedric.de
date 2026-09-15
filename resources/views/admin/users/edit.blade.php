@extends('layouts.retro')

@section('content')
    <h2 class="font-pixel text-sm text-retro-accent2 mb-6">{{ __('users.edit') }}</h2>

    <form action="{{ route('admin.users.update', $user) }}" method="POST" class="pixel-border bg-retro-panel p-6 max-w-md" novalidate>
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label class="font-pixel text-xs text-retro-accent2 block mb-2">{{ __('users.fields.name') }}</label>
            <input type="text" name="name" value="{{ old('name', $user->name) }}"
                   class="w-full bg-retro-bg border-2 border-retro-border text-retro-text font-mono text-lg p-2">
            @error('name')<p class="text-red-400 font-mono text-sm mt-1">{{ $message }}</p>@enderror
        </div>

        <div class="mb-4">
            <label class="font-pixel text-xs text-retro-accent2 block mb-2">{{ __('users.fields.email') }}</label>
            <input type="email" name="email" value="{{ old('email', $user->email) }}"
                   class="w-full bg-retro-bg border-2 border-retro-border text-retro-text font-mono text-lg p-2">
            @error('email')<p class="text-red-400 font-mono text-sm mt-1">{{ $message }}</p>@enderror
        </div>

        <div class="mb-4">
            <label class="font-pixel text-xs text-retro-accent2 block mb-2">{{ __('users.fields.password') }}</label>
            <input type="password" name="password"
                   class="w-full bg-retro-bg border-2 border-retro-border text-retro-text font-mono text-lg p-2">
            <p class="text-retro-muted font-mono text-sm mt-1">{{ __('users.hints.leave_blank') }}</p>
            @error('password')<p class="text-red-400 font-mono text-sm mt-1">{{ $message }}</p>@enderror
        </div>

        <div class="mb-6">
            <label class="font-pixel text-xs text-retro-accent2 block mb-2">{{ __('users.fields.password_confirmation') }}</label>
            <input type="password" name="password_confirmation"
                   class="w-full bg-retro-bg border-2 border-retro-border text-retro-text font-mono text-lg p-2">
        </div>

        <div class="mb-6">
            <label class="font-pixel text-xs text-retro-accent2 block mb-2">{{ __('users.fields.roles') }}</label>
            <div class="flex flex-wrap gap-2">
                @foreach($roles as $role)
                    <label class="cursor-pointer">
                        <input type="checkbox" name="roles[]" value="{{ $role->id }}" class="peer hidden"
                            {{ (is_array(old('roles')) && in_array($role->id, old('roles'))) || (! old('roles') && $user->hasRole($role->name)) ? 'checked' : '' }}>
                        <span class="inline-block px-3 py-1 font-pixel text-xs bg-retro-bg text-retro-muted peer-checked:bg-retro-accent peer-checked:text-white transition">
                            {{ $role->name }}
                        </span>
                    </label>
                @endforeach
            </div>
            @error('roles')<p class="text-red-400 font-mono text-sm mt-1">{{ $message }}</p>@enderror
        </div>

        <div class="flex gap-3">
            <a href="{{ route('admin.users.index') }}" class="pixel-border !border-2 px-4 py-2 font-pixel text-xs bg-retro-panelLight text-retro-text">&larr;</a>
            <button type="submit" class="pixel-border !border-2 px-4 py-2 font-pixel text-xs bg-retro-accent text-white">
                {{ __('users.edit') }}
            </button>
        </div>
    </form>
@endsection
