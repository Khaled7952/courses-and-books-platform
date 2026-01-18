@if ($paginator->hasPages())
    <div class="mt-4 num-page d-flex justify-content-center">
        <ul class="gap-2 m-0 fw-bold d-flex list-unstyled">

            {{-- Previous --}}
            @if ($paginator->onFirstPage())
                <li class="opacity-50 nav-item">

                </li>
            @else
                <li class="nav-item">
                </li>
            @endif

            {{-- Pages --}}
            @foreach ($elements as $element)

                {{-- "..." --}}
                @if (is_string($element))
                    <li class="nav-item">
                        <span class="nav-link fs-4">{{ $element }}</span>
                    </li>
                @endif

                {{-- Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="nav-item">
                                <span class="nav-link active fs-4" aria-current="page">{{ $page }}</span>
                            </li>
                        @else
                            <li class="nav-item">
                                <a class="nav-link fs-4" href="{{ $url }}">{{ $page }}</a>
                            </li>
                        @endif
                    @endforeach
                @endif

            @endforeach

            {{-- Next --}}
            @if ($paginator->hasMorePages())
                <li class="nav-item">
                </li>
            @else
                <li class="opacity-50 nav-item">

                </li>
            @endif

        </ul>
    </div>
@endif
