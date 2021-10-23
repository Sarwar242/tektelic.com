
@if (count($breadcrumbs))
    <div class="page-breadcrumbs">
        <ul class="breadcrumbs-navigation">
            @foreach ($breadcrumbs as $breadcrumb)
                @if ($breadcrumb->url && !$loop->last)
                    <li class="breadcrumbs-item">
                        <a class="breadcrumbs-link" href="{{ $breadcrumb->url }}">{{ $breadcrumb->title }}</a>
                    </li>
                @else
                    <li class="breadcrumbs-item">
                        <span class="breadcrumbs-text">{{ $breadcrumb->title }}</span>
                    </li>
                @endif
            @endforeach
        </ul>
    </div>
@endif
