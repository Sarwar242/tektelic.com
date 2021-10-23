@if ($paginator->lastPage() > 1)
    <ul class="pagination-list" data-aos="fade-in" data-aos-duration="1000" data-aos-delay="150">
        @if($paginator->currentPage() != 1)
        <li class="prev-page {{ ($paginator->currentPage() == 1) ? ' disabled' : '' }}">
            <a href="{{ $paginator->url(1) }}">
                <svg width="6" height="11" viewBox="0 0 6 11" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M5 0.499998L1 5.25L5 10" stroke="#C4C4C4" stroke-linecap="round"/>
                </svg>
            </a>
        </li>
        @endif
        @for ($i = 1; $i <= $paginator->lastPage(); $i++)
            <li class="pagination-item">
                <a class="pagination-link {{ ($paginator->currentPage() == $i) ? ' current-page' : '' }}"
                   href="{{ $paginator->url($i) }}"
                   data-page="{{$i}}">
                    {{ $i }}
                </a>
            </li>
        @endfor
        @if($paginator->currentPage() != $paginator->lastPage())
        <li class="next-page {{ ($paginator->currentPage() == $paginator->lastPage()) ? ' disabled' : '' }}">
            <a class="next-page-link" href="{{ $paginator->url($paginator->currentPage()+1) }}">
                <svg width="6" height="11" viewBox="0 0 6 11" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M1 0.499998L5 5.25L1 10" stroke="#2CABE1" stroke-linecap="round"/>
                </svg>
            </a>
        </li>
        @endif
    </ul>
@endif
