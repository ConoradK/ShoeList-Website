<!-- resources/views/pagination/custom.blade.php -->
<div class="pagination">
    <!-- Previous page link with check for being on the first page -->
    @if ($paginator->onFirstPage())
        <!-- Disabled Previous button when on the first page -->
        <span class="disabled" aria-disabled="true">&laquo; Previous</span>
    @else
        <!-- Link to the previous page when not on the first page -->
        <a href="{{ $paginator->previousPageUrl() }}" rel="prev">&laquo; Previous</a>
    @endif

    <!-- Loop through the pagination elements to generate page links -->
    @foreach ($elements as $element)
        <!-- If the element is a string (e.g., "Previous", "Next" or page range), render as disabled -->
        @if (is_string($element))
            <span class="disabled">{{ $element }}</span>
        @endif

        <!-- If the element is an array (containing pages and URLs), loop through each page -->
        @if (is_array($element))
            @foreach ($element as $page => $url)
                <!-- If the page is the current page, display it with active styles -->
                @if ($page == $paginator->currentPage())
                    <span class="active">{{ $page }}</span>
                @else
                    <!-- For non-current pages, display the page as an inactive link -->
                    <a href="{{ $url }}" class="inactive">{{ $page }}</a>
                @endif
            @endforeach
        @endif
    @endforeach

    <!-- Next page link with check for having more pages -->
    @if ($paginator->hasMorePages())
        <!-- Link to the next page when more pages are available -->
        <a href="{{ $paginator->nextPageUrl() }}" rel="next">Next &raquo;</a>
    @else
        <!-- Disabled Next button when on the last page -->
        <span class="disabled" aria-disabled="true">Next &raquo;</span>
    @endif
</div>
