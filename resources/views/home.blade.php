@extends('layouts.retro')

@section('content')
    <h2 class="font-pixel text-sm text-retro-accent2 mb-6">{{ __('home.dashboard') }}</h2>

    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-6">
        <div class="pixel-border bg-retro-panel p-4 text-center">
            <svg class="mx-auto mb-2 text-retro-accent2" xmlns="http://www.w3.org/2000/svg" width="36" height="36" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="6" y1="12" x2="10" y2="12"/><line x1="8" y1="10" x2="8" y2="14"/><line x1="15" y1="13" x2="15.01" y2="13"/><line x1="18" y1="11" x2="18.01" y2="11"/><rect x="2" y="6" width="20" height="12" rx="2"/></svg>
            <div class="font-pixel text-xs text-retro-accent2 mb-2">{{ __('home.total_games') }}</div>
            <div class="font-pixel text-xl text-retro-text">{{ $stats['total_games'] }}</div>
        </div>
        <div class="pixel-border bg-retro-panel p-4 text-center">
            <svg class="mx-auto mb-2 text-retro-accent2" xmlns="http://www.w3.org/2000/svg" width="36" height="36" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20.59 13.41l-7.17 7.17a2 2 0 0 1-2.83 0L2 12V2h10l8.59 8.59a2 2 0 0 1 0 2.82z"/><line x1="7" y1="7" x2="7.01" y2="7"/></svg>
            <div class="font-pixel text-xs text-retro-accent2 mb-2">{{ __('home.total_tags') }}</div>
            <div class="font-pixel text-xl text-retro-text">{{ $stats['total_tags'] }}</div>
        </div>
        <div class="pixel-border bg-retro-panel p-4 text-center">
            <svg class="mx-auto mb-2 text-retro-accent2" xmlns="http://www.w3.org/2000/svg" width="36" height="36" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="4"/><line x1="1.05" y1="12" x2="7" y2="12"/><line x1="17.01" y1="12" x2="22.96" y2="12"/></svg>
            <div class="font-pixel text-xs text-retro-accent2 mb-2">{{ __('home.total_commits') }}</div>
            <div class="font-pixel text-xl text-retro-text">{{ $stats['total_commits'] }}</div>
        </div>
    </div>

    <div class="pixel-border bg-retro-panel p-4 mb-6">
        <h3 class="font-pixel text-xs text-retro-accent2 mb-4">{{ __('home.games_by_tag') }}</h3>
        @foreach($stats['games_by_tag'] as $tag)
            <div class="mb-3 font-mono text-lg">
                <div class="flex justify-between mb-1">
                    <span>{{ $tag->name }}</span>
                    <span>{{ $tag->games_count }} {{ __('home.entries') }}</span>
                </div>
                <div class="w-full h-4 bg-retro-bg pixel-border !border-2">
                    <div class="h-full"
                         style="width: {{ $stats['total_games'] > 0 ? ($tag->games_count / $stats['total_games']) * 100 : 0 }}%; background-color: {{ $tag->color_hex }}">
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <div class="pixel-border bg-retro-panel p-4">
        <h3 class="font-pixel text-xs text-retro-accent2 mb-4">{{ __('home.latest_games') }}</h3>
        <table class="w-full font-mono text-lg">
            <thead>
                <tr class="text-left text-retro-accent2 border-b-2 border-retro-bg">
                    <th class="py-2">{{ __('home.title') }}</th>
                    <th class="py-2">{{ __('home.developer_name') }}</th>
                    <th class="py-2">{{ __('home.tags') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach($stats['latest_games'] as $game)
                    <tr class="border-b border-retro-bg/50">
                        <td class="py-2">{{ $game->title }}</td>
                        <td class="py-2">{{ $game->developer?->name }}</td>
                        <td class="py-2">
                            @foreach($game->tags as $tag)
                                <span class="inline-block px-2 py-0.5 text-xs text-white font-pixel mr-1 mb-1" style="background-color: {{ $tag->color_hex }}">
                                    {{ $tag->name }}
                                </span>
                            @endforeach
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection