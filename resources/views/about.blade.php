@extends('layouts.retro')

@section('content')
    <h2 class="font-pixel text-sm text-retro-accent2 mb-6">{{ __('about.title') }}</h2>

    <div class="pixel-border bg-retro-panel p-6 flex flex-col md:flex-row gap-6">
        <div class="shrink-0 mx-auto md:mx-0">
            <div class="pixel-border !border-2 inline-block">
                <img src="{{ asset('storage/images/Profile.png') }}" alt="Profile" class="w-48 h-48 object-cover">
            </div>
        </div>
        <div class="font-mono text-lg leading-relaxed">
            {!! nl2br(e(__('about.content'))) !!}
        </div>
    </div>
@endsection
