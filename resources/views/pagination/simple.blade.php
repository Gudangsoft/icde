@if ($paginator->hasPages())
<nav style="display:flex;align-items:center;gap:6px;">
    @if ($paginator->onFirstPage())
    <span style="display:inline-flex;align-items:center;justify-content:center;width:34px;height:34px;border-radius:8px;background:#f1f5f9;color:#cbd5e1;font-size:0.85rem;cursor:not-allowed;">
        <i class="bi bi-chevron-left"></i>
    </span>
    @else
    <a href="{{ $paginator->previousPageUrl() }}" style="display:inline-flex;align-items:center;justify-content:center;width:34px;height:34px;border-radius:8px;background:#f1f5f9;color:#475569;font-size:0.85rem;text-decoration:none;" onmouseover="this.style.background='#e2e8f0'" onmouseout="this.style.background='#f1f5f9'">
        <i class="bi bi-chevron-left"></i>
    </a>
    @endif

    @if ($paginator->hasMorePages())
    <a href="{{ $paginator->nextPageUrl() }}" style="display:inline-flex;align-items:center;justify-content:center;width:34px;height:34px;border-radius:8px;background:#f1f5f9;color:#475569;font-size:0.85rem;text-decoration:none;" onmouseover="this.style.background='#e2e8f0'" onmouseout="this.style.background='#f1f5f9'">
        <i class="bi bi-chevron-right"></i>
    </a>
    @else
    <span style="display:inline-flex;align-items:center;justify-content:center;width:34px;height:34px;border-radius:8px;background:#f1f5f9;color:#cbd5e1;font-size:0.85rem;cursor:not-allowed;">
        <i class="bi bi-chevron-right"></i>
    </span>
    @endif
</nav>
@endif
