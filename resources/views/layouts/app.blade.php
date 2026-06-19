<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'INC Hymns') }}</title>

        <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">
        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Other head elements -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
            /* Adjust the body padding to account for fixed headers */
            body {
                padding-top: 100px; /* Adjust as necessary to match the combined height of Navigation and Page Heading */
            }
            .fixed-header {
                position: fixed;
                top: 0;
                width: 100%;
                z-index: 50;
                background: rgba(255, 255, 255, 0.75);
                backdrop-filter: blur(10px);
                -webkit-backdrop-filter: blur(10px);
                border-bottom: 1px solid rgba(255, 255, 255, 0.3);
                box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
            }
            .fixed-header nav {
                background: transparent !important;
                border: none !important;
            }
            .fixed-page-heading {
                position: fixed;
                top: 60px; /* Adjust based on the height of the navigation */
                width: 100%;
                z-index: 40;
                box-shadow: 0 1px 4px rgba(0, 0, 0, 0.1);
            }
            .page-shell {
                width: 100%;
                max-width: 90%;
                margin: 0 auto;
            }

            .page-header-shell {
                display: flex;
                justify-content: space-between;
                align-items: flex-start;
                gap: 1.5rem;
                margin: 0.5rem 0 1.5rem;
                flex-wrap: wrap;
            }

            .page-kicker {
                display: inline-flex;
                align-items: center;
                gap: 0.5rem;
                padding: 0.4rem 0.8rem;
                border-radius: 999px;
                background: rgba(255, 255, 255, 0.18);
                color: rgba(255, 255, 255, 0.85);
                font-size: 0.72rem;
                font-weight: 900;
                letter-spacing: 0.14em;
                text-transform: uppercase;
                margin-bottom: 0.9rem;
            }

            .page-title {
                font-size: clamp(2.2rem, 4vw, 3.5rem);
                line-height: 0.95;
                color: #fff;
                font-weight: 950;
                letter-spacing: -0.04em;
                margin-bottom: 0.6rem;
            }

            .page-subtitle {
                color: rgba(255, 255, 255, 0.8);
                font-size: 0.95rem;
                font-weight: 700;
                letter-spacing: 0.04em;
                margin-bottom: 0;
                max-width: 42rem;
            }

            .toolbar-stack {
                display: flex;
                align-items: center;
                gap: 0.8rem;
                flex-wrap: wrap;
                justify-content: flex-end;
            }

            .page-action-btn {
                min-height: 48px;
                min-width: 140px;
                padding: 0 1.25rem;
                border-radius: 999px;
                display: inline-flex;
                align-items: center;
                justify-content: center;
                gap: 0.6rem;
                font-weight: 900;
                letter-spacing: 0.04em;
                text-decoration: none !important;
                transition: transform 0.2s ease, box-shadow 0.2s ease, background 0.2s ease, color 0.2s ease;
            }

            .page-action-btn i,
            .page-action-btn span {
                line-height: 1;
            }

            .page-action-btn:hover {
                transform: translateY(-1px);
            }

            .page-action-btn-secondary {
                background: rgba(255, 255, 255, 0.16);
                color: #fff;
                border: 1px solid rgba(255, 255, 255, 0.28);
                box-shadow: 0 10px 25px rgba(0, 0, 0, 0.08);
            }

            .page-action-btn-secondary:hover {
                color: #fff;
                background: rgba(255, 255, 255, 0.24);
            }

            .page-action-btn-primary {
                background: #fff;
                color: #3e6d9c;
                border: 1px solid rgba(255, 255, 255, 0.7);
                box-shadow: 0 14px 30px rgba(0, 0, 0, 0.1);
            }

            .page-action-btn-primary:hover {
                color: #22486c;
                background: #f8fbff;
            }

            .pagination-centered nav,
            .pagination-centered .pagination {
                display: flex;
                flex-direction: column;
                align-items: center;
                width: 100%;
            }

            .pagination-centered nav div:last-child,
            .pagination-centered .pagination {
                display: flex;
                justify-content: center;
                align-items: center;
                flex-wrap: wrap;
                gap: 6px;
                width: 100%;
                margin-top: 1rem;
            }

            .pagination-centered nav div:last-child a,
            .pagination-centered nav div:last-child span,
            .pagination-centered .page-link {
                display: inline-flex;
                align-items: center;
                justify-content: center;
                min-width: 38px;
                height: 38px;
                border-radius: 12px;
                font-weight: 700;
                font-size: 0.85rem;
                transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
                text-decoration: none !important;
                background: #f8fafc;
                color: #64748b;
                border: 1px solid #e2e8f0;
            }

            .pagination-centered nav div:last-child a:hover,
            .pagination-centered .page-link:hover {
                background: #fff;
                color: #22c55e;
                border-color: #22c55e;
                transform: translateY(-3px);
                box-shadow: 0 5px 15px rgba(34, 197, 94, 0.1);
            }

            .pagination-centered nav div:last-child span[aria-current="page"] > span,
            .pagination-centered .page-item.active .page-link,
            .pagination-centered .active-page {
                background: #22c55e !important;
                color: #fff !important;
                border: none !important;
                box-shadow: 0 4px 12px rgba(34, 197, 94, 0.3);
            }

            .pagination-centered nav div:last-child span[aria-disabled="true"] > span,
            .pagination-centered .page-item.disabled .page-link {
                background: transparent !important;
                border: none !important;
                color: #cbd5e1 !important;
                box-shadow: none !important;
                cursor: default;
            }

            .pagination-centered nav svg {
                width: 18px;
                height: 18px;
            }

            .pagination-centered nav div:first-child {
                display: none !important;
            }

            .pagination-centered .pagination {
                margin-bottom: 0;
            }

            .global-hymn-search-overlay {
                position: fixed;
                inset: 0;
                z-index: 8000;
                display: none;
                align-items: flex-start;
                justify-content: center;
                padding: 8vh 1rem 1rem;
                background: rgba(15, 23, 42, 0.52);
                backdrop-filter: blur(14px);
                -webkit-backdrop-filter: blur(14px);
            }

            .global-hymn-search-overlay.active {
                display: flex;
            }

            .global-hymn-search-shell {
                width: min(760px, calc(100vw - 1.5rem));
                max-height: min(78vh, 780px);
                display: flex;
                flex-direction: column;
                overflow: hidden;
                border-radius: 28px;
                background: linear-gradient(180deg, rgba(255, 255, 255, 0.99) 0%, rgba(243, 249, 255, 0.98) 100%);
                border: 1px solid rgba(148, 163, 184, 0.18);
                box-shadow: 0 34px 90px rgba(15, 23, 42, 0.28);
            }

            .global-hymn-search-top {
                padding: 1.15rem 1.15rem 0.9rem;
                border-bottom: 1px solid rgba(226, 232, 240, 0.95);
                background: linear-gradient(180deg, rgba(255, 255, 255, 0.96), rgba(245, 250, 255, 0.96));
            }

            .global-hymn-search-label-row {
                display: flex;
                align-items: center;
                justify-content: space-between;
                gap: 1rem;
                margin-bottom: 0.85rem;
            }

            .global-hymn-search-kicker {
                margin: 0;
                font-size: 0.72rem;
                letter-spacing: 0.18em;
                text-transform: uppercase;
                font-weight: 900;
                color: #5b84af;
            }

            .global-hymn-search-hint {
                display: inline-flex;
                align-items: center;
                gap: 0.35rem;
                padding: 0.35rem 0.7rem;
                border-radius: 999px;
                background: rgba(62, 109, 156, 0.09);
                color: #3e6d9c;
                font-size: 0.72rem;
                font-weight: 800;
                letter-spacing: 0.04em;
                white-space: nowrap;
            }

            .global-hymn-search-input-wrap {
                display: flex;
                align-items: center;
                gap: 0.75rem;
                padding: 0.85rem 1rem;
                border-radius: 18px;
                border: 1px solid rgba(148, 163, 184, 0.28);
                background: rgba(255, 255, 255, 0.92);
                box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.75);
            }

            .global-hymn-search-input-wrap i {
                color: #7b93ad;
                font-size: 1rem;
            }

            .global-hymn-search-input {
                flex: 1;
                border: none;
                outline: none;
                background: transparent;
                color: #1e293b;
                font-size: 1rem;
                font-weight: 700;
            }

            .global-hymn-search-input::placeholder {
                color: #8aa0b8;
                font-weight: 600;
            }

            .global-hymn-search-clear {
                width: 2rem;
                height: 2rem;
                border: none;
                border-radius: 999px;
                background: rgba(100, 116, 139, 0.08);
                color: #475569;
                display: inline-flex;
                align-items: center;
                justify-content: center;
                flex-shrink: 0;
                transition: all 0.2s ease;
            }

            .global-hymn-search-clear:hover {
                background: rgba(62, 109, 156, 0.14);
                color: #1d4f7a;
            }

            .global-hymn-search-results {
                overflow-y: auto;
                padding: 0.9rem 0.9rem 1rem;
            }

            .global-hymn-search-empty {
                min-height: 180px;
                display: flex;
                align-items: center;
                justify-content: center;
                text-align: center;
                color: #64748b;
                font-weight: 700;
                border-radius: 20px;
                border: 1px dashed rgba(148, 163, 184, 0.3);
                background: rgba(255, 255, 255, 0.55);
            }

            .global-hymn-search-result {
                width: 100%;
                display: flex;
                align-items: center;
                justify-content: space-between;
                gap: 1rem;
                padding: 0.9rem 1rem;
                border-radius: 18px;
                border: 1px solid rgba(226, 232, 240, 0.92);
                background: rgba(255, 255, 255, 0.94);
                text-decoration: none !important;
                transition: transform 0.2s ease, box-shadow 0.2s ease, border-color 0.2s ease, background 0.2s ease;
                color: #1e293b;
            }

            .global-hymn-search-result + .global-hymn-search-result {
                margin-top: 0.65rem;
            }

            .global-hymn-search-result:hover,
            .global-hymn-search-result.is-active {
                transform: translateY(-1px);
                border-color: rgba(62, 109, 156, 0.28);
                background: linear-gradient(180deg, rgba(248, 251, 255, 1), rgba(240, 247, 255, 1));
                box-shadow: 0 12px 30px rgba(15, 23, 42, 0.08);
            }

            .global-hymn-search-result-main {
                display: flex;
                align-items: center;
                gap: 0.9rem;
                min-width: 0;
                flex: 1;
            }

            .global-hymn-search-chip {
                min-width: 3rem;
                height: 3rem;
                border-radius: 16px;
                display: inline-flex;
                align-items: center;
                justify-content: center;
                background: rgba(62, 109, 156, 0.12);
                color: #3e6d9c;
                flex-shrink: 0;
                font-weight: 900;
            }

            .global-hymn-search-result-title {
                font-size: 1rem;
                font-weight: 900;
                color: #1e293b;
                line-height: 1.2;
                overflow: hidden;
                text-overflow: ellipsis;
                display: -webkit-box;
                -webkit-line-clamp: 2;
                -webkit-box-orient: vertical;
            }

            .global-hymn-search-result-meta {
                margin-top: 0.15rem;
                color: #64748b;
                font-size: 0.82rem;
                font-weight: 700;
                display: flex;
                gap: 0.5rem;
                flex-wrap: wrap;
            }

            .global-hymn-search-result-arrow {
                width: 2rem;
                height: 2rem;
                border-radius: 999px;
                display: inline-flex;
                align-items: center;
                justify-content: center;
                flex-shrink: 0;
                background: rgba(62, 109, 156, 0.1);
                color: #3e6d9c;
            }

            .global-hymn-search-footer {
                padding: 0 1rem 1rem;
                display: flex;
                justify-content: space-between;
                align-items: center;
                gap: 0.75rem;
                border-top: 1px solid rgba(226, 232, 240, 0.8);
                background: rgba(255, 255, 255, 0.9);
            }

            .global-hymn-search-footer small {
                color: #64748b;
                font-weight: 700;
            }

            .global-hymn-search-view-all {
                border: none;
                border-radius: 999px;
                padding: 0.75rem 1rem;
                font-weight: 900;
                letter-spacing: 0.03em;
                color: #fff;
                background: linear-gradient(135deg, #3e6d9c, #64b5d6);
                box-shadow: 0 10px 22px rgba(62, 109, 156, 0.2);
                transition: transform 0.2s ease, box-shadow 0.2s ease;
            }

            .global-hymn-search-view-all:hover {
                transform: translateY(-1px);
                box-shadow: 0 14px 26px rgba(62, 109, 156, 0.24);
            }

            @media (max-width: 768px) {
                .page-shell {
                    max-width: 98%;
                }
                .page-header-shell {
                    gap: 1rem;
                }
                .page-title {
                    font-size: clamp(1.85rem, 8vw, 2.5rem);
                }
                .page-action-btn {
                    min-width: 128px;
                    min-height: 44px;
                }
                .pagination-centered nav div:last-child a,
                .pagination-centered nav div:last-child span,
                .pagination-centered .page-link {
                    min-width: 32px;
                    height: 32px;
                    font-size: 0.75rem;
                }

                .global-hymn-search-overlay {
                    padding-top: 5vh;
                }

                .global-hymn-search-shell {
                    width: calc(100vw - 1rem);
                    max-height: 84vh;
                    border-radius: 22px;
                }

                .global-hymn-search-top {
                    padding: 1rem 0.95rem 0.85rem;
                }

                .global-hymn-search-label-row {
                    flex-direction: column;
                    align-items: flex-start;
                }

                .global-hymn-search-footer {
                    flex-direction: column;
                    align-items: stretch;
                }
            }
        </style>
    </head>

    <body class="font-sans antialiased">
        @auth
            <script>
                (function () {
                    const idleTimeoutMs = 60 * 60 * 1000;
                    const loginUrl = @json(url('/login'));
                    let idleTimer = null;
                    let hasLoggedOut = false;

                    function performLogout() {
                        if (hasLoggedOut) return;
                        hasLoggedOut = true;
                        window.location.replace(loginUrl);
                    }

                    function resetTimer() {
                        if (hasLoggedOut) return;
                        window.clearTimeout(idleTimer);
                        idleTimer = window.setTimeout(performLogout, idleTimeoutMs);
                    }

                    ['mousemove', 'mousedown', 'keydown', 'scroll', 'touchstart', 'click'].forEach(eventName => {
                        window.addEventListener(eventName, resetTimer, { passive: true });
                    });

                    window.addEventListener('focus', resetTimer);
                    document.addEventListener('visibilitychange', () => {
                        if (!document.hidden) {
                            resetTimer();
                        }
                    });

                    resetTimer();
                })();
            </script>
        @endauth

        <div class="min-h-screen bg-white-100 dark:bg-gray-900">
            <!-- Navigation -->
            <div class="fixed-header">
                @include('layouts.navigation')
            </div>

            <!-- Page Heading -->
            @if (isset($header))
                <header class="fixed-page-heading bg-white dark:bg-gray-800 shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main class="{{ isset($header) ? 'mt-44' : '' }}" style="{{ isset($header) ? '' : 'margin-top: 2px;' }}">
                {{ $slot }}
            </main>
        </div>

        @auth
            <div id="globalHymnSearchOverlay" class="global-hymn-search-overlay" aria-hidden="true">
                <div class="global-hymn-search-shell" role="dialog" aria-modal="true" aria-labelledby="globalHymnSearchTitle">
                    <div class="global-hymn-search-top">
                        <div class="global-hymn-search-label-row">
                            <div>
                                <p class="global-hymn-search-kicker">Advanced search</p>
                                <h3 id="globalHymnSearchTitle" style="margin: 0; font-size: 1.35rem; font-weight: 950; color: #1e293b;">Search hymns anywhere</h3>
                            </div>
                            <div class="global-hymn-search-hint">
                                <i class="fas fa-keyboard"></i>
                                Ctrl + K
                            </div>
                        </div>
                        <div class="global-hymn-search-input-wrap">
                            <i class="fas fa-search"></i>
                            <input id="globalHymnSearchInput" class="global-hymn-search-input" type="text" placeholder="Search hymns, numbers, lyrics, titles..." autocomplete="off">
                            <button type="button" id="globalHymnSearchClear" class="global-hymn-search-clear" title="Clear search" hidden>
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <div id="globalHymnSearchResults" class="global-hymn-search-results">
                        <div class="global-hymn-search-empty">
                            Type to search the hymn library.
                        </div>
                    </div>
                    <div class="global-hymn-search-footer">
                        <small id="globalHymnSearchStatus">Search across titles, hymn numbers, lyrics, categories, and creators.</small>
                        <button type="button" id="globalHymnSearchViewAll" class="global-hymn-search-view-all" disabled>
                            View all results
                        </button>
                    </div>
                </div>
            </div>
        @endauth

        @auth
            <script>
                (function () {
                    const overlay = document.getElementById('globalHymnSearchOverlay');
                    const input = document.getElementById('globalHymnSearchInput');
                    const results = document.getElementById('globalHymnSearchResults');
                    const clearButton = document.getElementById('globalHymnSearchClear');
                    const status = document.getElementById('globalHymnSearchStatus');
                    const viewAllButton = document.getElementById('globalHymnSearchViewAll');
                    const searchEndpoint = @json(route('musics.global_search'));
                    const libraryUrl = @json(route('musics.index'));
                    let lastFocusedElement = null;
                    let debounceTimer = null;
                    let abortController = null;
                    let activeIndex = -1;
                    let lastResults = [];

                    function setOverlayOpen(isOpen) {
                        if (!overlay) return;
                        overlay.classList.toggle('active', isOpen);
                        overlay.setAttribute('aria-hidden', isOpen ? 'false' : 'true');
                        document.body.style.overflow = isOpen ? 'hidden' : '';
                    }

                    function openSearch() {
                        lastFocusedElement = document.activeElement;
                        setOverlayOpen(true);
                        window.requestAnimationFrame(() => {
                            if (input) {
                                input.focus();
                                input.select();
                            }
                        });
                    }

                    function closeSearch() {
                        setOverlayOpen(false);
                        if (abortController) {
                            abortController.abort();
                            abortController = null;
                        }
                        if (lastFocusedElement && typeof lastFocusedElement.focus === 'function') {
                            lastFocusedElement.focus();
                        }
                    }

                    function buildLibraryUrl(query) {
                        const url = new URL(libraryUrl, window.location.origin);
                        url.searchParams.set('query', query);
                        return url.toString();
                    }

                    function setResultsLoading(query) {
                        results.innerHTML = `
                            <div class="global-hymn-search-empty">
                                Searching${query ? ` for “${escapeHtml(query)}”` : ''}...
                            </div>
                        `;
                        status.textContent = 'Searching the hymn library...';
                        viewAllButton.disabled = true;
                        lastResults = [];
                        activeIndex = -1;
                    }

                    function escapeHtml(value) {
                        return String(value)
                            .replace(/&/g, '&amp;')
                            .replace(/</g, '&lt;')
                            .replace(/>/g, '&gt;')
                            .replace(/"/g, '&quot;')
                            .replace(/'/g, '&#39;');
                    }

                    function renderResults(items, query) {
                        lastResults = items || [];
                        activeIndex = lastResults.length ? 0 : -1;

                        if (!lastResults.length) {
                            results.innerHTML = `
                                <div class="global-hymn-search-empty">
                                    No hymns matched “${escapeHtml(query)}”.
                                </div>
                            `;
                            status.textContent = 'Try a different title, hymn number, lyric line, category, or creator.';
                            viewAllButton.disabled = false;
                            return;
                        }

                        results.innerHTML = lastResults.map((item, index) => {
                            const meta = [
                                item.song_number ? `Hymn # ${escapeHtml(item.song_number)}` : null,
                                item.language ? escapeHtml(item.language) : null,
                                item.church_hymn ? escapeHtml(item.church_hymn) : null,
                            ].filter(Boolean).join(' · ');

                            return `
                                <a href="${escapeHtml(item.url)}" class="global-hymn-search-result ${index === activeIndex ? 'is-active' : ''}" data-index="${index}">
                                    <div class="global-hymn-search-result-main">
                                        <div class="global-hymn-search-chip">
                                            <i class="fas fa-music"></i>
                                        </div>
                                        <div style="min-width: 0;">
                                            <div class="global-hymn-search-result-title">${escapeHtml(item.title || 'Untitled hymn')}</div>
                                            <div class="global-hymn-search-result-meta">${meta || 'Open hymn details'}</div>
                                        </div>
                                    </div>
                                    <div class="global-hymn-search-result-arrow">
                                        <i class="fas fa-arrow-right"></i>
                                    </div>
                                </a>
                            `;
                        }).join('');

                        status.textContent = `${lastResults.length} result${lastResults.length === 1 ? '' : 's'} found.`;
                        viewAllButton.disabled = false;
                        syncActiveResult();
                    }

                    function syncActiveResult() {
                        const nodes = results.querySelectorAll('.global-hymn-search-result');
                        nodes.forEach((node, index) => node.classList.toggle('is-active', index === activeIndex));
                        if (nodes[activeIndex]) {
                            nodes[activeIndex].scrollIntoView({ block: 'nearest' });
                        }
                    }

                    function fetchResults(query) {
                        if (abortController) {
                            abortController.abort();
                        }

                        if (!query) {
                            results.innerHTML = `
                                <div class="global-hymn-search-empty">
                                    Type to search the hymn library.
                                </div>
                            `;
                            status.textContent = 'Search across titles, hymn numbers, lyrics, categories, and creators.';
                            viewAllButton.disabled = true;
                            lastResults = [];
                            activeIndex = -1;
                            return;
                        }

                        setResultsLoading(query);

                        abortController = new AbortController();
                        const url = new URL(searchEndpoint, window.location.origin);
                        url.searchParams.set('q', query);

                        fetch(url.toString(), {
                            headers: { 'Accept': 'application/json' },
                            signal: abortController.signal,
                        })
                            .then(response => response.ok ? response.json() : Promise.reject(response))
                            .then(payload => {
                                renderResults(Array.isArray(payload?.data) ? payload.data : [], query);
                            })
                            .catch(error => {
                                if (error?.name === 'AbortError') return;
                                results.innerHTML = `
                                    <div class="global-hymn-search-empty">
                                        Search is temporarily unavailable.
                                    </div>
                                `;
                                status.textContent = 'Open the hymn library to continue searching.';
                                viewAllButton.disabled = false;
                            });
                    }

                    function scheduleSearch() {
                        window.clearTimeout(debounceTimer);
                        const query = input ? input.value.trim() : '';
                        clearButton.hidden = query.length === 0;
                        debounceTimer = window.setTimeout(() => fetchResults(query), 220);
                    }

                    if (input) {
                        input.addEventListener('input', scheduleSearch);
                        input.addEventListener('keydown', function (event) {
                            if (event.key === 'ArrowDown') {
                                event.preventDefault();
                                if (!lastResults.length) return;
                                activeIndex = Math.min(activeIndex + 1, lastResults.length - 1);
                                syncActiveResult();
                            } else if (event.key === 'ArrowUp') {
                                event.preventDefault();
                                if (!lastResults.length) return;
                                activeIndex = Math.max(activeIndex - 1, 0);
                                syncActiveResult();
                            } else if (event.key === 'Enter') {
                                event.preventDefault();
                                if (lastResults.length && lastResults[activeIndex]) {
                                    window.location.href = lastResults[activeIndex].url;
                                } else {
                                    const query = input.value.trim();
                                    if (query) {
                                        window.location.href = buildLibraryUrl(query);
                                    }
                                }
                            } else if (event.key === 'Escape') {
                                event.preventDefault();
                                closeSearch();
                            }
                        });
                    }

                    if (clearButton) {
                        clearButton.addEventListener('click', function () {
                            if (input) {
                                input.value = '';
                                input.focus();
                            }
                            clearButton.hidden = true;
                            fetchResults('');
                        });
                    }

                    if (viewAllButton) {
                        viewAllButton.addEventListener('click', function () {
                            const query = input ? input.value.trim() : '';
                            if (query) {
                                window.location.href = buildLibraryUrl(query);
                            }
                        });
                    }

                    if (overlay) {
                        overlay.addEventListener('click', function (event) {
                            if (event.target === overlay) {
                                closeSearch();
                            }
                        });
                    }

                    document.addEventListener('keydown', function (event) {
                        const isK = event.key.toLowerCase() === 'k';

                        if ((event.ctrlKey || event.metaKey) && isK) {
                            event.preventDefault();
                            if (overlay && overlay.classList.contains('active')) {
                                if (input) input.focus();
                                return;
                            }
                            openSearch();
                            return;
                        }

                        if (event.key === 'Escape' && overlay && overlay.classList.contains('active')) {
                            event.preventDefault();
                            closeSearch();
                        }
                    });
                })();
            </script>
        @endauth

    </body>
</html>
