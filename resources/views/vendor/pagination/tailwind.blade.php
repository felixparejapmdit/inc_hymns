{{-- INC Hymns pagination — self-contained widget used by every ->links() call.
     Green active state, flex container, 44px touch targets on mobile.
     Styles are emitted once per page via @once, so the look is identical on
     every page regardless of layout or page-local CSS. --}}
@if ($paginator->hasPages())
    @once
        <style>
            .inc-pg {
                display: flex;
                flex-wrap: wrap;
                align-items: center;
                justify-content: center;
                gap: 6px;
                width: 100%;
                margin: 1rem auto 0;
            }
            .inc-pg-btn {
                display: inline-flex;
                align-items: center;
                justify-content: center;
                flex: 0 0 auto;
                min-width: 38px;
                height: 38px;
                padding: 0 0.55rem;
                border-radius: 12px;
                background: #ffffff;
                color: #64748b;
                border: 1px solid #e2e8f0;
                font-weight: 700;
                font-size: 0.85rem;
                line-height: 1;
                text-decoration: none !important;
                transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
                box-shadow: 0 1px 2px rgba(15, 23, 42, 0.05);
            }
            a.inc-pg-btn:hover {
                color: #22c55e;
                border-color: #22c55e;
                transform: translateY(-2px);
                box-shadow: 0 5px 15px rgba(34, 197, 94, 0.12);
            }
            .inc-pg-btn.is-active {
                background: #22c55e; /* Tailwind green-500 */
                color: #ffffff;
                border-color: #22c55e;
                box-shadow: 0 4px 12px rgba(34, 197, 94, 0.3);
                cursor: default;
            }
            .inc-pg-btn.is-disabled {
                background: #f8fafc;
                color: #cbd5e1;
                box-shadow: none;
                cursor: default;
            }
            .inc-pg-arrow svg {
                width: 16px;
                height: 16px;
            }
            .inc-pg-dots {
                color: #94a3b8;
                font-weight: 700;
                padding: 0 0.2rem;
            }
            @media (max-width: 768px) {
                /* 44px minimum touch targets on mobile */
                .inc-pg-btn {
                    min-width: 44px;
                    height: 44px;
                    border-radius: 14px;
                }
            }
        </style>
    @endonce

    <div class="inc-pg" role="navigation" aria-label="{{ __('Pagination Navigation') }}">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <span class="inc-pg-btn inc-pg-arrow is-disabled" aria-disabled="true" aria-label="{{ __('pagination.previous') }}">
                <svg fill="currentColor" viewBox="0 0 20 20" aria-hidden="true">
                    <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                </svg>
            </span>
        @else
            <a href="{{ $paginator->previousPageUrl() }}" rel="prev" class="inc-pg-btn inc-pg-arrow" aria-label="{{ __('pagination.previous') }}">
                <svg fill="currentColor" viewBox="0 0 20 20" aria-hidden="true">
                    <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                </svg>
            </a>
        @endif

        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
                <span class="inc-pg-dots" aria-disabled="true">{{ $element }}</span>
            @endif

            {{-- Array Of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <span class="inc-pg-btn is-active" aria-current="page">{{ $page }}</span>
                    @else
                        <a href="{{ $url }}" class="inc-pg-btn" aria-label="{{ __('Go to page :page', ['page' => $page]) }}">{{ $page }}</a>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" rel="next" class="inc-pg-btn inc-pg-arrow" aria-label="{{ __('pagination.next') }}">
                <svg fill="currentColor" viewBox="0 0 20 20" aria-hidden="true">
                    <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                </svg>
            </a>
        @else
            <span class="inc-pg-btn inc-pg-arrow is-disabled" aria-disabled="true" aria-label="{{ __('pagination.next') }}">
                <svg fill="currentColor" viewBox="0 0 20 20" aria-hidden="true">
                    <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                </svg>
            </span>
        @endif
    </div>
@endif
