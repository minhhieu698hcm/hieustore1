<div class="page-pagination text-center" data-aos="fade-up" data-aos-delay="0"  data-aos-duration="300">
    <ul>
        <!-- Previous Button -->
        @if ($currentPage > 1)
            <li><a href="javascript:void(0);" class="pagination-link" data-page="{{ $currentPage - 1 }}">Previous</a></li>
        @endif

        <!-- Page Links -->
        @foreach ($pagination as $page)
            @if (is_numeric($page))
                <li><a href="javascript:void(0);" class="pagination-link {{ $page == $currentPage ? 'active' : '' }}" data-page="{{ $page }}">{{ $page }}</a></li>
            @else
                <li><span>{{ $page }}</span></li>
            @endif
        @endforeach

        <!-- Next Button -->
        @if ($currentPage < $totalPages)
            <li><a href="javascript:void(0);" class="pagination-link" data-page="{{ $currentPage + 1 }}">Next</a></li>
        @endif
    </ul>
</div>
