@extends('layouts.retro')

@section('content')
    <div class="flex flex-wrap items-center justify-between gap-3 mb-6">
        <h2 class="font-pixel text-sm text-retro-accent2">{{ __('tags.title') }}</h2>
        @can('create tags')
            <a href="{{ route('admin.tags.create') }}" class="pixel-border !border-2 px-4 py-2 font-pixel text-xs bg-retro-accent text-white">
                + {{ __('tags.create') }}
            </a>
        @endcan
    </div>

    <div class="sm:hidden space-y-3">
        @forelse($tags as $tag)
            <div class="pixel-border bg-retro-panel p-3" x-data="{ confirmingDelete: false }">
                <div class="flex items-center justify-between mb-3">
                    <span class="inline-flex items-center gap-2 font-mono text-lg">
                        <span class="inline-block w-4 h-4 rounded-full shrink-0" style="background-color: {{ $tag->color_hex }}"></span>
                        {{ $tag->name }}
                    </span>
                </div>
                <div class="flex gap-2">
                    @can('edit tags')
                        <x-icon-action-button :href="route('admin.tags.edit', $tag)" :label="__('tags.edit')" class="flex-1">
                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                            {{ __('tags.edit') }}
                        </x-icon-action-button>
                    @endcan
                    @can('delete tags')
                        <form id="delete-tag-form-m-{{ $tag->id }}" action="{{ route('admin.tags.destroy', $tag) }}" method="POST" class="hidden">
                            @csrf
                            @method('DELETE')
                        </form>
                        <x-icon-action-button variant="danger" :label="__('common.delete')" class="flex-1" @click="confirmingDelete = true">
                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6"/><path d="M10 11v6"/><path d="M14 11v6"/><path d="M9 6V4a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v2"/></svg>
                            {{ __('common.delete') }}
                        </x-icon-action-button>
                    @endcan
                </div>

                <x-confirm-modal show="confirmingDelete" onConfirm="document.getElementById('delete-tag-form-m-{{ $tag->id }}').submit()" />
            </div>
        @empty
            <p class="text-center text-retro-muted font-mono text-lg py-6">{{ __('common.no_results') }}</p>
        @endforelse
    </div>

    <div class="hidden sm:block pixel-border bg-retro-panel"><div class="overflow-x-auto">
        <table class="w-full font-mono text-lg">
            <thead>
                <tr class="text-left text-retro-accent2 bg-retro-border font-pixel text-xs">
                    <th class="p-3">{{ __('tags.fields.name') }}</th>
                    <th class="p-3">{{ __('tags.fields.color') }}</th>
                    <th class="p-3"></th>
                </tr>
            </thead>
            <tbody>
                @forelse($tags as $tag)
                    <tr class="border-b border-retro-border/50" x-data="{ confirmingDelete: false }">
                        <td class="p-3">{{ $tag->name }}</td>
                        <td class="p-3">
                            <span class="inline-flex items-center gap-2">
                                <span class="inline-block w-4 h-4 rounded-full" style="background-color: {{ $tag->color_hex }}"></span>
                                {{ $tag->color }}
                            </span>
                        </td>
                        <td class="p-3">
                            <div class="flex gap-2">
                                @can('edit tags')
                                    <x-icon-action-button :href="route('admin.tags.edit', $tag)" :label="__('tags.edit')">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                                    </x-icon-action-button>
                                @endcan
                                @can('delete tags')
                                    <form id="delete-tag-form-{{ $tag->id }}" action="{{ route('admin.tags.destroy', $tag) }}" method="POST" class="hidden">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                    <x-icon-action-button variant="danger" :label="__('common.delete')" @click="confirmingDelete = true">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6"/><path d="M10 11v6"/><path d="M14 11v6"/><path d="M9 6V4a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v2"/></svg>
                                    </x-icon-action-button>
                                @endcan
                            </div>

                            <x-confirm-modal show="confirmingDelete" onConfirm="document.getElementById('delete-tag-form-{{ $tag->id }}').submit()" />
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="p-6 text-center text-retro-muted font-mono text-lg">{{ __('common.no_results') }}</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        </div>
    </div>

    <div class="mt-4">
        {{ $tags->links() }}
    </div>
@endsection