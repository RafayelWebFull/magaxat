<style>
/* pagination starts here */

.pagination-container {
    display: flex;
    flex-direction: row;
    align-items: center;
    justify-content: flex-end;
    list-style: none;
    position: absolute;
    bottom: 10px;
    margin: auto;
    left: 45%;
}

.pagination-item {
    margin: 10px;
}

.pagination-arrow {
    margin: 10px;
    font-size: 30px;
    font-weight:600;
    color: wheat;
}

.pagination-number {
    border: 1px solid rgb(182, 182, 182);
    padding: 5px;
    border-radius: 5px;
}

@media screen and (max-width:480px) {
    
}
}

/* end pagination */
</style>

@if ($paginator->hasPages())
    <div>
        <ul class="pagination pagination-container">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <li class="disabled pagination-arrow" aria-disabled="true" aria-label="@lang('pagination.previous')">
                    <span class="pagination-arrow" aria-hidden="true">&lsaquo;</span>
                </li>
            @else
                <li>
                    <a class="pagination-arrow" href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="@lang('pagination.previous')">&lsaquo;</a>
                </li>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <li class="disabled"  aria-disabled="true pagination-arrow"><span>{{ $element }}</span></li>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="pagination-item pagination-number" aria-current="page"><span>{{ $page }}</span></li>
                        @else
                            <li class="pagination-item pagination-number" ><a href="{{ $url }}">{{ $page }}</a></li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li >
                    <a class="pagination-arrow" href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')">&rsaquo;</a>
                </li>
            @else
                <li class="disabled pagination-arrow" aria-disabled="true" aria-label="@lang('pagination.next')">
                    <span class="pagination-arrow" aria-hidden="true">&rsaquo;</span>
                </li>
            @endif
        </ul>
    </div>
@endif
