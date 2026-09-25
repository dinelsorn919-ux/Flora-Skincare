@if ($paginator->hasPages())
    <nav class="flex items-center justify-between border-t border-line pt-4 px-2">
        <!-- Text Info -->
        <div class="text-xs text-ink/60">
            Showing {{ $paginator->firstItem() }} to {{ $paginator->lastItem() }} of {{ $paginator->total() }} results
        </div>

        <!-- Pagination Elements -->
        <div class="flex items-center gap-1">
            {{-- Previous Button --}}
            @if ($paginator->onFirstPage())
                <span class="px-3 py-1.5 text-xs bg-white border border-line text-ink/30 rounded-sm cursor-not-allowed">Previous</span>
            @else
                <a href="{{ $paginator->previousPageUrl() }}" class="px-3 py-1.5 text-xs bg-white border border-line text-ink/70 rounded-sm hover:border-forest hover:text-forest transition-colors">Previous</a>
            @endif

            {{-- Number Pages --}}
            @foreach ($elements as $element)
                @if (is_string($element))
                    <span class="px-2 py-1.5 text-xs text-ink/40">{{ $element }}</span>
                @endif

                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <span class="px-3 py-1.5 text-xs bg-forest text-bone border border-forest rounded-sm font-medium">{{ $page }}</span>
                        @else
                            <a href="{{ $url }}" class="px-3 py-1.5 text-xs bg-white border border-line text-ink/70 rounded-sm hover:border-forest hover:text-forest transition-colors">{{ $page }}</a>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Button --}}
            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}" class="px-3 py-1.5 text-xs bg-white border border-line text-ink/70 rounded-sm hover:border-forest hover:text-forest transition-colors">Next</a>
            @else
                <span class="px-3 py-1.5 text-xs bg-white border border-line text-ink/30 rounded-sm cursor-not-allowed">Next</span>
            @endif
        </div>
    </nav>
@endif