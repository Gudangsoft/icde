@if ($paginator->hasPages())
<nav style="display:flex;align-items:center;gap:6px;flex-wrap:wrap;">
    {{-- Previous --}}
    @if ($paginator->onFirstPage())
    <span style="display:inline-flex;align-items:center;justify-content:center;width:34px;height:34px;border-radius:8px;background:#f1f5f9;color:#cbd5e1;font-size:0.85rem;cursor:not-allowed;">
        <i class="bi bi-chevron-left"></i>
    </span>
    @else
    <a href="{{ $paginator->previousPageUrl() }}" style="display:inline-flex;align-items:center;justify-content:center;width:34px;height:34px;border-radius:8px;background:#f1f5f9;color:#475569;font-size:0.85rem;text-decoration:none;transition:background 0.15s;" onmouseover="this.style.background='#e2e8f0'" onmouseout="this.style.background='#f1f5f9'">
        <i class="bi bi-chevron-left"></i>
    </a>
    @endif

    {{-- Pages --}}
    @foreach ($elements as $element)
        @if (is_string($element))
        <span style="display:inline-flex;align-items:center;justify-content:center;width:34px;height:34px;color:#94a3b8;font-size:0.85rem;">…</span>
        @endif
        @if (is_array($element))
            @foreach ($element as $page => $url)
                @if ($page == $paginator->currentPage())
                <span style="display:inline-flex;align-items:center;justify-content:center;width:34px;height:34px;border-radius:8px;background:#1B6CA8;color:#fff;font-size:0.83rem;font-weight:700;">{{ $page }}</span>
                @else
                <a href="{{ $url }}" style="display:inline-flex;align-items:center;justify-content:center;width:34px;height:34px;border-radius:8px;background:#f1f5f9;color:#475569;font-size:0.83rem;font-weight:500;text-decoration:none;transition:background 0.15s;" onmouseover="this.style.background='#e2e8f0'" onmouseout="this.style.background='#f1f5f9'">{{ $page }}</a>
                @endif
            @endforeach
        @endif
    @endforeach

    {{-- Next --}}
    @if ($paginator->hasMorePages())
    <a href="{{ $paginator->nextPageUrl() }}" style="display:inline-flex;align-items:center;justify-content:center;width:34px;height:34px;border-radius:8px;background:#f1f5f9;color:#475569;font-size:0.85rem;text-decoration:none;transition:background 0.15s;" onmouseover="this.style.background='#e2e8f0'" onmouseout="this.style.background='#f1f5f9'">
        <i class="bi bi-chevron-right"></i>
    </a>
    @else
    <span style="display:inline-flex;align-items:center;justify-content:center;width:34px;height:34px;border-radius:8px;background:#f1f5f9;color:#cbd5e1;font-size:0.85rem;cursor:not-allowed;">
        <i class="bi bi-chevron-right"></i>
    </span>
    @endif

    <span style="font-size:0.78rem;color:#94a3b8;margin-left:4px;">
        {{ $paginator->firstItem() }}–{{ $paginator->lastItem() }} dari {{ $paginator->total() }}
    </span>
</nav>
@endif
