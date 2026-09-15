@props(['show', 'onConfirm'])

<div x-show="{{ $show }}" x-cloak
    class="fixed inset-0 bg-black/60 flex items-center justify-center z-50 px-4"
    @click.self="{{ $show }} = false" @keydown.escape.window="{{ $show }} = false">
    <div x-show="{{ $show }}" x-transition class="pixel-border bg-retro-panel p-6 max-w-sm w-full text-center">
        <p class="font-pixel text-xs text-retro-accent2 mb-2">{{ __('common.confirm_delete_title') }}</p>
        <p class="font-mono text-lg text-retro-muted mb-4">{{ __('common.confirm_delete_text') }}</p>
        <div class="flex gap-3 justify-center">
            <button type="button" @click="{{ $show }} = false" class="pixel-border !border-2 px-4 py-2 font-pixel text-xs bg-retro-panelLight text-retro-text">
                {{ __('common.cancel') }}
            </button>
            <button type="button" @click="{{ $onConfirm }}" class="pixel-border !border-2 px-4 py-2 font-pixel text-xs bg-red-700 text-white">
                {{ __('common.delete') }}
            </button>
        </div>
    </div>
</div>