@props(['tag'])

<span {{ $attributes->merge(['class' => 'inline-block px-2 py-0.5 text-xs text-white font-pixel']) }} style="background-color: {{ $tag->color_hex }}">
    {{ $tag->name }}
</span>