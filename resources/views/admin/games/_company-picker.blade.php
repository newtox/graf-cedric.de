@php
    $currentMode = old($prefix.'_mode');
    $currentExistingId = old($prefix.'_existing_id', $selected ?? '');
    if (! $currentMode) {
        $currentMode = ($companies->isEmpty() || ! $currentExistingId) ? 'new' : 'existing';
    }
    $imageMap = $companies->mapWithKeys(fn ($c) => [$c->id => $c->image])->toJson();
@endphp
<div x-data="{ mode: '{{ $currentMode }}', selectedId: '{{ $currentExistingId }}', images: {{ $imageMap }} }" class="mb-4">
    <label class="font-pixel text-xs text-retro-accent2 block mb-2">{{ $label }}</label>

    <input type="hidden" name="{{ $prefix }}_mode" x-model="mode">

    <div class="flex gap-2 mb-2 font-pixel text-xs">
        <button type="button" @click="mode = 'existing'"
                :class="mode==='existing' ? 'bg-retro-accent text-white' : 'bg-retro-bg text-retro-text'"
                class="px-3 py-2">
            {{ __('games.fields.use_existing') }}
        </button>
        <button type="button" @click="mode = 'new'"
                :class="mode==='new' ? 'bg-retro-accent text-white' : 'bg-retro-bg text-retro-text'"
                class="px-3 py-2">
            {{ __('games.fields.add_new') }}
        </button>
    </div>

    <div x-show="mode === 'existing'" x-cloak class="flex items-center gap-3">
        <select name="{{ $prefix }}_existing_id" x-model="selectedId"
                class="flex-1 bg-retro-bg border-2 border-retro-border text-retro-text font-mono text-lg p-2">
            <option value="">{{ __('games.fields.select_placeholder') }}</option>
            @foreach($companies as $company)
                <option value="{{ $company->id }}">{{ $company->name }}</option>
            @endforeach
        </select>
        <template x-if="images[selectedId]">
            <img :src="images[selectedId]" class="w-10 h-10 object-contain pixel-border !border-2 bg-white">
        </template>
    </div>

    <div x-show="mode === 'new'" x-cloak class="space-y-2">
        <input type="text" name="{{ $prefix }}_name" placeholder="{{ __('games.fields.'.$prefix.'_name') }}"
               value="{{ old($prefix.'_name') }}"
               class="w-full bg-retro-bg border-2 border-retro-border text-retro-text font-mono text-lg p-2">
        <input type="file" name="{{ $prefix }}_image" accept="image/*"
               class="w-full text-sm font-mono text-retro-text">
    </div>

    <div x-show="mode === 'existing'">
        @error($prefix.'_existing_id')
            <p class="text-red-400 font-mono text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>
    <div x-show="mode === 'new'">
        @error($prefix.'_name')
            <p class="text-red-400 font-mono text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>
</div>