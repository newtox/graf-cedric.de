@extends('layouts.retro')

@section('content')
    <h2 class="font-pixel text-sm text-retro-accent2 mb-6">{{ __('tags.edit') }}</h2>

    <form action="{{ route('admin.tags.update', $tag) }}" method="POST" class="pixel-border bg-retro-panel p-6 max-w-md" novalidate>
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label class="font-pixel text-xs text-retro-accent2 block mb-2">{{ __('tags.fields.name') }}</label>
            <input type="text" name="name" value="{{ old('name', $tag->name) }}"
                   class="w-full bg-retro-bg border-2 border-retro-border text-retro-text font-mono text-lg p-2">
            @error('name')
                <p class="text-red-400 font-mono text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-6">
            <label class="font-pixel text-xs text-retro-accent2 block mb-2">{{ __('tags.fields.color') }}</label>
            <div class="flex items-center gap-3">
                <input type="color" name="color" value="{{ old('color', $tag->color_hex) }}"
                       class="w-14 h-10 bg-retro-bg border-2 border-retro-border cursor-pointer">
                <span class="font-mono text-lg text-retro-muted">{{ __('tags.fields.color_hint') }}</span>
            </div>
            @error('color')
                <p class="text-red-400 font-mono text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex gap-3">
            <a href="{{ route('admin.tags.index') }}" class="pixel-border !border-2 px-4 py-2 font-pixel text-xs bg-retro-panelLight text-retro-text">&larr;</a>
            <button type="submit" class="pixel-border !border-2 px-4 py-2 font-pixel text-xs bg-retro-accent text-white">
                {{ __('tags.edit') }}
            </button>
        </div>
    </form>
@endsection