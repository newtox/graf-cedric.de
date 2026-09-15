@if ($paginator->hasPages())
    <nav role="navigation" aria-label="Pagination Navigation" class="flex flex-wrap items-center justify-center gap-2 font-pixel text-xs">
        @if ($paginator->onFirstPage())
            <span title="{{ __('pagination.previous') }}" class="w-9 h-9 flex items-center justify-center pixel-border !border-2 bg-retro-panelLight text-retro-muted opacity-50">&laquo;</span>
        @else
            <a href="{{ $paginator->previousPageUrl() }}" title="{{ __('pagination.previous') }}" class="w-9 h-9 flex items-center justify-center pixel-border !border-2 bg-retro-panelLight text-retro-text hover:opacity-80 transition">&laquo;</a>
        @endif

        @foreach ($elements as $element)
            @if (is_string($element))
                <span class="w-9 h-9 flex items-center justify-center text-retro-muted">...</span>
            @endif

            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <span class="w-9 h-9 flex items-center justify-center pixel-border !border-2 bg-retro-accent text-white">{{ $page }}</span>
                    @else
                        <a href="{{ $url }}" class="w-9 h-9 flex items-center justify-center pixel-border !border-2 bg-retro-panelLight text-retro-text hover:opacity-80 transition">{{ $page }}</a>
                    @endif
                @endforeach
            @endif
        @endforeach

        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" title="{{ __('pagination.next') }}" class="w-9 h-9 flex items-center justify-center pixel-border !border-2 bg-retro-panelLight text-retro-text hover:opacity-80 transition">&raquo;</a>
        @else
            <span title="{{ __('pagination.next') }}" class="w-9 h-9 flex items-center justify-center pixel-border !border-2 bg-retro-panelLight text-retro-muted opacity-50">&raquo;</span>
        @endif
    </nav>
@endif