@push('styles')
    @vite(['resources/css/pagination_style.css'])
@endpush

<div class="pagination">
    <!-- Previous page link -->
    @if ($paginator->onFirstPage())
        <span class="disabled" aria-disabled="true">&laquo; Previous</span>
    @else
        <a href="{{ $paginator->previousPageUrl() . '&' . http_build_query(request()->except('page')) }}" rel="prev">&laquo; Previous</a>
    @endif

    <!-- Pagination elements -->
    @foreach ($elements as $element)
        @if (is_string($element))
            <span class="disabled">{{ $element }}</span>
        @endif

        @if (is_array($element))
            @foreach ($element as $page => $url)
                @php
                    $urlWithQuery = $url . '&' . http_build_query(request()->except('page'));
                @endphp

                @if ($page == $paginator->currentPage())
                    <span class="active">{{ $page }}</span>
                @else
                    <a href="{{ $urlWithQuery }}" class="inactive">{{ $page }}</a>
                @endif
            @endforeach
        @endif
    @endforeach

    <!-- Next page link -->
    @if ($paginator->hasMorePages())
        <a href="{{ $paginator->nextPageUrl() . '&' . http_build_query(request()->except('page')) }}" rel="next">Next &raquo;</a>
    @else
        <span class="disabled" aria-disabled="true">Next &raquo;</span>
    @endif
</div>
