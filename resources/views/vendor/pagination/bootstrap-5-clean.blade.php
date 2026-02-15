@if ($paginator->hasPages())
    <style>
        .pagination-container {
            display: flex;
            justify-content: center;
            margin: 30px 0;
        }

        .pagination {
            display: flex !important;
            flex-wrap: nowrap !important;
            list-style: none !important;
            margin: 0 !important;
            padding: 0 !important;
            gap: 5px;
        }

        .page-item {
            display: inline-block !important;
            margin: 0 !important;
        }

        .page-link {
            display: inline-flex !important;
            align-items: center;
            justify-content: center;
            min-width: 40px;
            height: 40px;
            padding: 8px 12px !important;
            margin: 0 !important;
            border: 1px solid #dee2e6 !important;
            border-radius: 8px !important;
            background-color: white !important;
            color: #6c757d !important;
            text-decoration: none !important;
            font-weight: 500 !important;
            transition: all 0.3s ease !important;
            cursor: pointer !important;
        }

        .page-link:hover {
            background-color: #f8f9fa !important;
            border-color: #81c408 !important;
            color: #81c408 !important;
            transform: translateY(-1px) !important;
            box-shadow: 0 2px 8px rgba(129, 196, 8, 0.2) !important;
        }

        .page-item.active .page-link {
            background-color: #81c408 !important;
            border-color: #81c408 !important;
            color: white !important;
            font-weight: 600 !important;
            box-shadow: 0 2px 8px rgba(129, 196, 8, 0.3) !important;
        }

        .page-item.disabled .page-link {
            background-color: #f8f9fa !important;
            border-color: #e9ecef !important;
            color: #adb5bd !important;
            cursor: not-allowed !important;
            opacity: 0.6 !important;
        }

        .page-item.disabled .page-link:hover {
            background-color: #f8f9fa !important;
            border-color: #e9ecef !important;
            color: #adb5bd !important;
            transform: none !important;
            box-shadow: none !important;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .pagination {
                gap: 3px;
            }

            .page-link {
                min-width: 35px;
                height: 35px;
                padding: 6px 10px !important;
                font-size: 0.9rem !important;
            }
        }

        @media (max-width: 480px) {
            .pagination {
                gap: 2px;
            }

            .page-link {
                min-width: 32px;
                height: 32px;
                padding: 5px 8px !important;
                font-size: 0.85rem !important;
            }
        }
    </style>

    <div class="pagination-container">
        <nav aria-label="Page navigation">
            <ul class="pagination">
                {{-- Previous Page Link --}}
                @if ($paginator->onFirstPage())
                    <li class="page-item disabled" aria-disabled="true" aria-label="Previous page">
                        <span class="page-link">
                            <i class="fas fa-chevron-left"></i>
                        </span>
                    </li>
                @else
                    <li class="page-item" aria-label="Previous page">
                        <a class="page-link" href="{{ $paginator->previousPageUrl() }}" rel="prev">
                            <i class="fas fa-chevron-left"></i>
                        </a>
                    </li>
                @endif

                {{-- Pagination Elements --}}
                @foreach ($elements as $element)
                    {{-- "Three Dots" Separator --}}
                    @if (is_string($element))
                        <li class="page-item disabled" aria-disabled="true">
                            <span class="page-link">{{ $element }}</span>
                        </li>
                    @endif

                    {{-- Array Of Links --}}
                    @if (is_array($element))
                        @foreach ($element as $page => $url)
                            @if ($page == $paginator->currentPage())
                                <li class="page-item active" aria-current="page" aria-label="Page {{ $page }}">
                                    <span class="page-link">{{ $page }}</span>
                                </li>
                            @else
                                <li class="page-item" aria-label="Page {{ $page }}">
                                    <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                                </li>
                            @endif
                        @endforeach
                    @endif
                @endforeach

                {{-- Next Page Link --}}
                @if ($paginator->hasMorePages())
                    <li class="page-item" aria-label="Next page">
                        <a class="page-link" href="{{ $paginator->nextPageUrl() }}" rel="next">
                            <i class="fas fa-chevron-right"></i>
                        </a>
                    </li>
                @else
                    <li class="page-item disabled" aria-disabled="true" aria-label="Next page">
                        <span class="page-link">
                            <i class="fas fa-chevron-right"></i>
                        </span>
                    </li>
                @endif
            </ul>
        </nav>
    </div>
@endif
