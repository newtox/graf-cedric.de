@extends('layouts.retro')

@section('content')
    <h2 class="font-pixel text-sm text-retro-accent2 mb-6">{{ __('companies.create') }}</h2>

    <form action="{{ route('admin.companies.store') }}" method="POST" enctype="multipart/form-data" class="pixel-border bg-retro-panel p-6 max-w-md" novalidate>
        @csrf

        <div class="mb-4">
            <label class="font-pixel text-xs text-retro-accent2 block mb-2">{{ __('companies.fields.name') }}</label>
            <input type="text" name="name" value="{{ old('name') }}"
                   class="w-full bg-retro-bg border-2 border-retro-border text-retro-text font-mono text-lg p-2">
            @error('name')
                <p class="text-red-400 font-mono text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-6">
            <label class="font-pixel text-xs text-retro-accent2 block mb-2">{{ __('companies.fields.image') }}</label>
            <input type="file" name="image" accept="image/*"
                   class="w-full font-mono text-sm text-retro-muted file:mr-3 file:py-2 file:px-3 file:border-0 file:pixel-border file:!border-2 file:bg-retro-panelLight file:text-retro-text file:font-pixel file:text-xs">
            @error('image')
                <p class="text-red-400 font-mono text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex gap-3">
            <a href="{{ route('admin.companies.index') }}" class="pixel-border !border-2 px-4 py-2 font-pixel text-xs bg-retro-panelLight text-retro-text">&larr;</a>
            <button type="submit" class="pixel-border !border-2 px-4 py-2 font-pixel text-xs bg-retro-accent text-white">
                {{ __('companies.create') }}
            </button>
        </div>
    </form>
@endsection