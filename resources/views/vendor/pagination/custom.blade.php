@if ($paginator->hasPages())
  <nav aria-label="Pagination" class="pagination-container">
    <ul class="pagination">
      {{-- First Page Link --}}
      @if ($paginator->onFirstPage())
        <li class="page-item disabled">
          <span class="page-link">&laquo;&laquo; First</span>
        </li>
      @else
        <li class="page-item">
          <a class="page-link" href="{{ $paginator->url(1) }}" rel="first">&laquo;&laquo; First</a>
        </li>
      @endif

      {{-- Previous Page Link --}}
      @if ($paginator->onFirstPage())
        <li class="page-item disabled">
          <span class="page-link">&laquo;&laquo; Previous</span>
        </li>
      @else
        <li class="page-item">
          <a class="page-link" href="{{ $paginator->previousPageUrl() }}" rel="prev">&laquo;&laquo; Previous</a>
        </li>
      @endif

      {{-- Pagination Elements --}}
      @php
        $start = max(1, $paginator->currentPage() - 4);
        $end = min($paginator->lastPage(), $start + 9);
        if ($end - $start < 9 && $start > 1) {
            $start = max(1, $end - 9);
        }
      @endphp

      @for ($i = $start; $i <= $end; $i++)
        @if ($i == $paginator->currentPage())
          <li class="page-item active" aria-current="page">
            <span class="page-link"><b>{{ $i }}</b></span>
          </li>
        @else
          <li class="page-item">
            <a class="page-link" href="{{ $paginator->url($i) }}">{{ $i }}</a>
          </li>
        @endif
      @endfor

      {{-- Next Page Link --}}
      @if ($paginator->hasMorePages())
        <li class="page-item">
          <a class="page-link" href="{{ $paginator->nextPageUrl() }}" rel="next">Next &raquo;&raquo;</a>
        </li>
      @else
        <li class="page-item disabled">
          <span class="page-link">Next &raquo;&raquo;</span>
        </li>
      @endif

      {{-- Last Page Link --}}
      @if ($paginator->currentPage() == $paginator->lastPage())
        <li class="page-item disabled">
          <span class="page-link">Last &raquo;&raquo;</span>
        </li>
      @else
        <li class="page-item">
          <a class="page-link" href="{{ $paginator->url($paginator->lastPage()) }}" rel="last">Last
            &raquo;&raquo;</a>
        </li>
      @endif
    </ul>
  </nav>
@endif
