@extends('layouts.retro')

@section('content')
    <div class="max-w-sm mx-auto">
        <h2 class="font-pixel text-sm text-retro-accent2 mb-6 text-center">{{ __('auth_pages.login_title') }}</h2>

        <form method="POST" action="{{ route('login') }}" class="pixel-border bg-retro-panel p-6" autocomplete="off">
            @csrf

            <div class="mb-4">
                <label class="font-pixel text-xs text-retro-accent2 block mb-2">{{ __('auth_pages.email') }}</label>
                <input type="email" name="email" value="{{ old('email') }}"
                       class="w-full bg-retro-bg border-2 border-retro-border text-retro-text font-mono text-lg p-2">
                @error('email')
                    <p class="text-red-400 font-mono text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label class="font-pixel text-xs text-retro-accent2 block mb-2">{{ __('auth_pages.password') }}</label>
                <input type="password" name="password"
                       class="w-full bg-retro-bg border-2 border-retro-border text-retro-text font-mono text-lg p-2">
                @error('password')
                    <p class="text-red-400 font-mono text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <label class="flex items-center gap-2 font-mono text-lg mb-6 cursor-pointer">
                <input type="checkbox" name="remember">
                {{ __('auth_pages.remember_me') }}
            </label>

            <button type="submit" class="w-full pixel-border !border-2 px-4 py-2 font-pixel text-xs bg-retro-accent text-white">
                {{ __('auth_pages.sign_in') }}
            </button>
        </form>
    </div>
@endsection
