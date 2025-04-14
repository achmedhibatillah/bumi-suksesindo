<div class="d-flex flex-column align-items-center">
    <nav aria-label="Page navigation">
        <ul class="pagination pagination-sm m-0 mb-1 border-clr2 rounded overflow-hidden">
            @if ($xxx->onFirstPage())
                <li class="page-item disabled">
                    <a class="page-link bg-clr2 ">&laquo;</a>
                </li>
            @else
                <li class="page-item">
                    <a class="page-link bg-danger text-white " href="{{ $xxx->previousPageUrl() }}" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                    </a>
                </li>
            @endif

            @foreach ($xxx->links()->elements[0] as $page => $url)
                <li class="page-item {{ $page == $xxx->currentPage() ? 'bg-clrsec' : '' }}">
                    <a class="page-link bg-transparent  text-clr2" href="{{ $url }}">{{ $page }}</a>
                </li>
            @endforeach

            @if ($xxx->hasMorePages())
                <li class="page-item">
                    <a class="page-link bg-danger text-white " href="{{ $xxx->nextPageUrl() }}" aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                    </a>
                </li>
            @else
                <li class="page-item disabled">
                    <a class="page-link bg-clr2 ">&raquo;</a>
                </li>
            @endif
        </ul>
    </nav>

    <div class="mt-1 text-muted text-center fsz-10">
        <!-- Menampilkan {{ $xxx->firstItem() }} - {{ $xxx->lastItem() }} dari {{ $xxx->total() }} data. -->
    </div>
</div>
