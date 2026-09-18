@extends('layouts.retro')

@section('content')
    <h2 class="font-pixel text-sm text-retro-accent2 mb-6">{{ __('games.create') }}</h2>

    <form action="{{ route('admin.games.store') }}" method="POST" enctype="multipart/form-data" class="pixel-border bg-retro-panel p-6" novalidate>
        @csrf

        <div class="mb-4">
            <label class="font-pixel text-xs text-retro-accent2 block mb-2">{{ __('games.fields.title') }}</label>
            <input type="text" name="title" value="{{ old('title') }}"
                   class="w-full bg-retro-bg border-2 border-retro-border text-retro-text font-mono text-lg p-2">
            @error('title') <p class="text-red-400 font-mono text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        <div class="mb-4">
            <label class="font-pixel text-xs text-retro-accent2 block mb-2">{{ __('games.fields.thumbnail') }}</label>
            <input type="file" name="thumbnail" accept="image/*" class="w-full font-mono text-sm text-retro-muted file:mr-3 file:py-2 file:px-3 file:border-0 file:pixel-border file:!border-2 file:bg-retro-panelLight file:text-retro-text file:font-pixel file:text-xs">
            @error('thumbnail') <p class="text-red-400 font-mono text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            @include('admin.games._company-picker', [
                'prefix' => 'developer',
                'label' => __('games.fields.developer_name'),
                'companies' => $companies,
                'selected' => '',
            ])
            @include('admin.games._company-picker', [
                'prefix' => 'publisher',
                'label' => __('games.fields.publisher_name'),
                'companies' => $companies,
                'selected' => '',
            ])
        </div>

        <div class="mb-4">
            <label class="font-pixel text-xs text-retro-accent2 block mb-2">{{ __('games.fields.tags') }}</label>
            <div class="flex flex-wrap gap-2">
                @foreach($tags as $tag)
                    <label class="cursor-pointer">
                        <input type="checkbox" name="tags[]" value="{{ $tag->id }}" class="peer hidden"
                               {{ in_array($tag->id, old('tags', [])) ? 'checked' : '' }}>
                        <span class="inline-block px-3 py-1 font-pixel text-xs bg-retro-bg text-retro-text peer-checked:bg-[var(--tag-color)] peer-checked:text-white transition" style="--tag-color: {{ $tag->color_hex }}">
                            {{ $tag->name }}
                        </span>
                    </label>
                @endforeach
            </div>
            @error('tags') <p class="text-red-400 font-mono text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        <div class="flex gap-3 mt-6">
            <a href="{{ route('admin.games.index') }}" class="pixel-border !border-2 px-4 py-2 font-pixel text-xs bg-retro-bg text-retro-text">
                &larr;
            </a>
            <button type="submit" class="pixel-border !border-2 px-4 py-2 font-pixel text-xs bg-retro-accent text-white">
                {{ __('games.create') }}
            </button>
        </div>
    </form>
@endsection