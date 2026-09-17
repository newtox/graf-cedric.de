@extends('layouts.retro')

@section('content')
    <div class="flex flex-wrap items-center justify-between gap-3 mb-6">
        <h2 class="font-pixel text-sm text-retro-accent2">{{ __('companies.title') }}</h2>

        <div class="flex flex-wrap items-center gap-2">
            <form action="{{ route('admin.companies.index') }}" method="GET">
                <input type="text" name="search" value="{{ request('search') }}"
                       placeholder="{{ __('companies.fields.search') }}" title="{{ __('companies.fields.search') }}"
                       class="bg-retro-bg border-2 border-retro-border text-retro-text font-mono text-lg p-2 w-40 sm:w-48">
            </form>

            @can('create companies')
                <a href="{{ route('admin.companies.create') }}" class="pixel-border !border-2 px-4 py-2 font-pixel text-xs bg-retro-accent text-white whitespace-nowrap">
                    + {{ __('companies.create') }}
                </a>
            @endcan
        </div>
    </div>

    <div class="sm:hidden space-y-3">
        @forelse($companies as $company)
            <div class="pixel-border bg-retro-panel p-3" x-data="{ confirmingDelete: false }">
                <div class="flex items-center gap-3 mb-3">
                    @if($company->image)
                        <img src="{{ $company->image }}" class="w-12 h-12 object-contain bg-retro-panelLight pixel-border !border-2 shrink-0">
                    @endif
                    <div class="min-w-0">
                        <p class="font-mono text-lg truncate">{{ $company->name }}</p>
                        <p class="font-mono text-sm text-retro-muted">
                            {{ __('companies.fields.games_as_developer') }}: {{ $company->games_as_developer_count }} ·
                            {{ __('companies.fields.games_as_publisher') }}: {{ $company->games_as_publisher_count }}
                        </p>
                    </div>
                </div>
                <div class="flex gap-2">
                    @can('edit companies')
                        <x-icon-action-button :href="route('admin.companies.edit', $company)" :label="__('companies.edit')" class="flex-1">
                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                            {{ __('companies.edit') }}
                        </x-icon-action-button>
                    @endcan
                    @can('delete companies')
                        <form id="delete-company-form-m-{{ $company->id }}" action="{{ route('admin.companies.destroy', $company) }}" method="POST" class="hidden">
                            @csrf
                            @method('DELETE')
                        </form>
                        <x-icon-action-button variant="danger" :label="__('common.delete')" class="flex-1" @click="confirmingDelete = true">
                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6"/><path d="M10 11v6"/><path d="M14 11v6"/><path d="M9 6V4a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v2"/></svg>
                            {{ __('common.delete') }}
                        </x-icon-action-button>
                    @endcan
                </div>

                <x-confirm-modal show="confirmingDelete" onConfirm="document.getElementById('delete-company-form-m-{{ $company->id }}').submit()" />
            </div>
        @empty
            <p class="text-center text-retro-muted font-mono text-lg py-6">{{ __('common.no_results') }}</p>
        @endforelse
    </div>

    <div class="hidden sm:block pixel-border bg-retro-panel"><div class="overflow-x-auto">
        <table class="w-full font-mono text-lg">
            <thead>
                <tr class="text-left text-retro-accent2 bg-retro-border font-pixel text-xs">
                    <th class="p-3">{{ __('companies.fields.image') }}</th>
                    <th class="p-3">{{ __('companies.fields.name') }}</th>
                    <th class="p-3">{{ __('companies.fields.games_as_developer') }}</th>
                    <th class="p-3">{{ __('companies.fields.games_as_publisher') }}</th>
                    <th class="p-3"></th>
                </tr>
            </thead>
            <tbody>
                @forelse($companies as $company)
                    <tr class="border-b border-retro-border/50" x-data="{ confirmingDelete: false }">
                        <td class="p-3">
                            @if($company->image)
                                <img src="{{ $company->image }}" class="w-10 h-10 object-contain bg-retro-panelLight pixel-border !border-2">
                            @endif
                        </td>
                        <td class="p-3">{{ $company->name }}</td>
                        <td class="p-3">{{ $company->games_as_developer_count }}</td>
                        <td class="p-3">{{ $company->games_as_publisher_count }}</td>
                        <td class="p-3">
                            <div class="flex gap-2">
                                @can('edit companies')
                                    <x-icon-action-button :href="route('admin.companies.edit', $company)" :label="__('companies.edit')">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                                    </x-icon-action-button>
                                @endcan
                                @can('delete companies')
                                    <form id="delete-company-form-{{ $company->id }}" action="{{ route('admin.companies.destroy', $company) }}" method="POST" class="hidden">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                    <x-icon-action-button variant="danger" :label="__('common.delete')" @click="confirmingDelete = true">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6"/><path d="M10 11v6"/><path d="M14 11v6"/><path d="M9 6V4a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v2"/></svg>
                                    </x-icon-action-button>
                                @endcan
                            </div>

                            <x-confirm-modal show="confirmingDelete" onConfirm="document.getElementById('delete-company-form-{{ $company->id }}').submit()" />
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="p-6 text-center text-retro-muted font-mono text-lg">{{ __('common.no_results') }}</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        </div>
    </div>

    <div class="mt-4">
        {{ $companies->links() }}
    </div>
@endsection