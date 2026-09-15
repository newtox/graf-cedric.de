@props(['href' => null, 'variant' => 'default', 'label'])

@php
    $variantClasses = $variant === 'danger'
        ? 'bg-red-900 text-red-100'
        : 'bg-retro-panelLight text-retro-text';
    $tag = $href ? 'a' : 'button';
@endphp

<{{ $tag }} @if($href) href="{{ $href }}" @else type="button" @endif title="{{ $label }}"
    {{ $attributes->merge(['class' => "w-10 h-10 flex items-center justify-center pixel-border !border-2 $variantClasses hover:opacity-80 transition"]) }}>
    {{ $slot }}
</{{ $tag }}>