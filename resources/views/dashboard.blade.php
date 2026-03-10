<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<style>
    :root {
        --primary-gradient: linear-gradient(to bottom, #64B5D6 0%, #3E6D9C 100%);
        --card-bg: rgba(255, 255, 255, 0.95);
        --accent-blue: #3E6D9C;
        --accent-gold: #FFD700;
    }

    body {
        background: var(--primary-gradient) !important;
        background-attachment: fixed !important;
        min-height: 100vh;
    }

    .glass-container {
        padding: 2px 0;
    }

    .dashboard-card {
        background: var(--card-bg);
        border-radius: 24px;
        border: 1px solid rgba(255, 255, 255, 0.4);
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.08);
        padding: 2rem;
        margin-bottom: 2rem;
        transition: transform 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
        display: flex;
        flex-direction: column;
    }


    .card-scroll-body {
        max-height: 400px;
        overflow-y: auto;
        padding-right: 5px;
    }

    .card-scroll-body::-webkit-scrollbar {
        width: 6px;
    }

    .card-scroll-body::-webkit-scrollbar-thumb {
        background: #e2e8f0;
        border-radius: 10px;
    }

    .dashboard-card.h-100 {
        min-height: 500px;
    }

    .overview-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 1.5rem;
        margin-bottom: 2.5rem;
        width: 100%;
    }

    @media (max-width: 1024px) {
        .overview-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media (max-width: 640px) {
        .overview-grid {
            grid-template-columns: 1fr;
        }
    }

    .dashboard-metric-card {
        background: #ffffff;
        border-radius: 20px;
        padding: 1.5rem;
        text-align: left;
        box-shadow: 0 4px 20px rgba(0,0,0,0.04);
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        border: 1px solid rgba(226, 232, 240, 0.8);
        display: flex;
        flex-direction: column;
        justify-content: center;
        min-height: 140px;
        text-decoration: none !important;
        position: relative;
        overflow: hidden;
    }

    .dashboard-metric-card i.metric-bg-icon {
        position: absolute;
        right: -10px;
        bottom: -10px;
        font-size: 5rem;
        opacity: 0.05;
        transform: rotate(-15deg);
    }

    .dashboard-metric-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 12px 30px rgba(0,0,0,0.12);
        border-color: var(--accent-blue);
    }

    .metric-amount {
        font-size: 2.5rem;
        font-weight: 800;
        color: var(--accent-blue);
        line-height: 1;
        margin-bottom: 0.5rem;
        z-index: 1;
    }

    .metric-title {
        font-size: 1.1rem;
        font-weight: 700;
        color: #475569;
        text-transform: uppercase;
        letter-spacing: 1px;
        z-index: 1;
    }

    .highlight-metric {
        background: var(--accent-blue) !important;
        border: none !important;
        color: white;
    }

    .highlight-metric .metric-amount, .highlight-metric .metric-title {
        color: white;
    }

    .mini-list {
        list-style: none;
        padding: 0;
        margin: 1rem 0;
        text-align: left;
    }

    .mini-list-item {
        font-size: 1rem;
        padding: 8px 0;
        border-bottom: 1px solid rgba(0,0,0,0.03);
        color: #475569;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .mini-list-item:last-child {
        border-bottom: none;
    }
    
    /* Quick Actions */
    .quick-actions-bar {
        background: rgba(255, 255, 255, 0.7);
        backdrop-filter: blur(10px);
        border-radius: 100px;
        padding: 0.75rem 2rem;
        display: flex;
        gap: 2rem;
        margin-bottom: 2.5rem;
        border: 1px solid rgba(255, 255, 255, 0.3);
        box-shadow: 0 4px 15px rgba(0,0,0,0.05);
    }

    .action-btn {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        color: var(--accent-blue);
        font-weight: 700;
        font-size: 0.85rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        transition: all 0.2s;
        text-decoration: none !important;
    }

    .action-btn:hover {
        transform: translateY(-2px);
        color: #64B5D6;
    }

    /* Table Styling */
    .table-modern {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0 8px;
    }

    .table-modern th {
        padding: 1rem;
        font-size: 0.75rem;
        text-transform: uppercase;
        color: #64748b;
        border: none;
        position: sticky;
        top: 0;
        background: var(--card-bg);
        z-index: 10;
    }

    .table-modern td {
        padding: 1.25rem 1rem;
        background: #f8fafc;
        border: none;
        transition: background 0.2s;
    }

    .table-modern tr:nth-child(even) td {
        background: #f1f5f9;
    }

    .table-modern tr:hover td {
        background: #e2e8f0;
    }

    .table-modern tr td:first-child { border-radius: 15px 0 0 15px; }
    .table-modern tr td:last-child { border-radius: 0 15px 15px 0; }

    /* Badges */
    .badge-custom {
        padding: 6px 12px;
        border-radius: 8px;
        font-weight: 700;
        font-size: 0.7rem;
        text-transform: uppercase;
    }

    .badge-login { background: #dcfce7; color: #166534; }
    .badge-view { background: #dbeafe; color: #1e40af; }
    .badge-create { background: #fef9c3; color: #854d0e; }
    .badge-delete { background: #fee2e2; color: #991b1b; }

    /* FAB */
    .btn-fab {
        position: fixed;
        bottom: 30px;
        right: 30px;
        width: 60px;
        height: 60px;
        border-radius: 50%;
        background: var(--accent-gold);
        color: #000 !important;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
        box-shadow: 0 10px 25px rgba(0,0,0,0.2);
        z-index: 1000;
        transition: all 0.3s;
        border: none;
    }

    .btn-fab:hover {
        transform: scale(1.1) rotate(90deg);
        background: #e6c200;
        color: #000;
        text-decoration: none;
    }

    /* Advanced Dynamic Pagination Styles */
    .pagination-centered nav {
        display: flex;
        flex-direction: column;
        align-items: center;
        width: 100%;
    }

    .pagination-centered nav div:last-child {
        display: flex;
        justify-content: center;
        align-items: center;
        flex-wrap: wrap;
        gap: 6px;
        width: 100%;
        margin-top: 1rem;
    }

    .pagination-centered nav div:last-child a,
    .pagination-centered nav div:last-child span {
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

    .pagination-centered nav div:last-child a:hover {
        background: white;
        color: #22c55e;
        border-color: #22c55e;
        transform: translateY(-3px);
        box-shadow: 0 5px 15px rgba(34, 197, 94, 0.1);
    }

    /* Active Page (Green Highlight) */
    .pagination-centered nav div:last-child span[aria-current="page"] > span,
    .pagination-centered nav div:last-child .active-page {
        background: #22c55e !important;
        color: white !important;
        border: none !important;
        box-shadow: 0 4px 12px rgba(34, 197, 94, 0.3);
    }

    /* Ellipsis Styling */
    .pagination-centered nav div:last-child span[aria-disabled="true"] > span {
        background: transparent !important;
        border: none !important;
        color: #cbd5e1 !important;
        font-size: 1.1rem;
        letter-spacing: 2px;
        cursor: default;
    }

    /* Arrow Icons */
    .pagination-centered nav svg {
        width: 18px;
        height: 18px;
    }

    /* Hide redundant Laravel text */
    .pagination-centered nav div:first-child {
        display: none !important;
    }

    /* Main Grid Spacing */
    .dashboard-grid-container {
        display: flex;
        flex-direction: column;
        gap: 1.5rem;
    }

    @media (max-width: 640px) {
        .stat-grid {
            grid-template-columns: 1fr;
        }
        .dashboard-card {
            padding: 1.5rem;
        }
        .btn-fab {
            bottom: 20px;
            right: 20px;
            width: 50px;
            height: 50px;
        }
        .pagination-centered nav div:last-child a,
        .pagination-centered nav div:last-child span {
            min-width: 32px;
            height: 32px;
            font-size: 0.75rem;
        }
    }

    /* Accordion Styles */
    .accordion-btn {
        background-color: transparent;
        color: #333;
        cursor: pointer;
        padding: 1.25rem;
        width: 100%;
        border: none;
        text-align: left;
        outline: none;
        transition: 0.4s;
        display: flex;
        justify-content: space-between;
        align-items: center;
        border-bottom: 1px solid #f1f5f9;
        font-weight: 600;
        border-radius: 12px;
    }

    .accordion-btn:hover {
        background-color: #f8fafc;
    }

    .accordion-btn i.fa-chevron-down {
        transition: transform 0.3s ease;
    }

    .accordion-btn.active i.fa-chevron-down {
        transform: rotate(180deg);
    }

    .panel-content {
        max-height: 0;
        overflow: hidden;
        transition: max-height 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        background-color: white;
    }
    /* Skeleton Loading */
    @keyframes shimmer {
        0% { background-position: -200% 0; }
        100% { background-position: 200% 0; }
    }

    .skeleton-loading {
        background: linear-gradient(90deg, #f0f4f8 25%, #e1e7ee 50%, #f0f4f8 75%);
        background-size: 200% 100%;
        animation: shimmer 1.5s infinite;
        border-radius: 8px;
        color: transparent !important;
    }
    
    .loading-overlay {
        opacity: 0.5;
        pointer-events: none;
        filter: grayscale(0.5);
    }
</style>

<x-app-layout>

    <div class="glass-container">
        <div class="container-fluid px-5 px-xl-5 dashboard-grid-container" style="max-width: 90%; margin: 0 auto;">
            
            <!-- Statistics Overview (3x2 Grid) -->
            <div class="overview-grid">
                <!-- Total Hymns (Featured Card) -->
                <a href="{{ route('musics.index') }}" class="dashboard-metric-card highlight-metric shadow-lg">
                    <div class="metric-amount">{{ $totalChurchHymns->sum('musics_count') }}</div>
                    <div class="metric-title">Total Hymns</div>
                    <i class="fas fa-layer-group metric-bg-icon" style="font-size: 3.5rem; opacity: 0.2; position: absolute; right: 20px; bottom: 20px;"></i>
                </a>

                @foreach($totalChurchHymns as $hymn)
                    @php
                        $serviceDetails = match($hymn->name) {
                            'AWS' => ['name' => 'Adult Worship', 'icon' => 'fa-users', 'color' => '#3E6D9C'],
                            'CWS' => ['name' => 'Children Worship', 'icon' => 'fa-child', 'color' => '#64B5D6'],
                            'EM' => ['name' => 'Evangelical Mission', 'icon' => 'fa-bullhorn', 'color' => '#FFD700'],
                            'Wedding' => ['name' => 'Wedding', 'icon' => 'fa-heart', 'color' => '#f472b6'],
                            default => ['name' => $hymn->name, 'icon' => 'fa-music', 'color' => '#94a3b8']
                        };
                    @endphp
                    <a href="{{ route('musics.index', ['church_hymn_id' => $hymn->id]) }}" class="dashboard-metric-card">
                        <div class="metric-amount">{{ $hymn->musics_count }}</div>
                        <div class="metric-title">{{ $serviceDetails['name'] }}</div>
                        <i class="fas {{ $serviceDetails['icon'] }}" style="font-size: 2.5rem; opacity: 0.6; position: absolute; right: 20px; bottom: 20px; color: {{ $serviceDetails['color'] }};"></i>
                    </a>
                @endforeach
            </div>


            <!-- Playlists Section -->
            <div class="dashboard-card">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="section-title mb-0">
                        <i class="fab fa-spotify text-green-500"></i> Special Occasion Playlist
                    </h2>
                    @if (\App\Helpers\AccessRightsHelper::checkPermission('dashboard.playlist.add') == 'inline')
                        <a href="{{ route('playlists_management.index') }}" class="btn btn-sm btn-outline-primary rounded-circle shadow-sm">
                            <i class="fas fa-plus"></i>
                        </a>
                    @endif
                </div>

                <div class="mt-4 card-scroll-body">
                    @foreach($playlists as $playlist)
                        @php $playlistId = $playlist->id; @endphp
                        <button class="accordion-btn" onclick="toggleAccordion(this)">
                            <span><i class="fas fa-list-ul mr-2 opacity-50"></i> {{ $playlist->name }}</span>
                            <i class="fas fa-chevron-down text-xs opacity-50"></i>
                        </button>
                        <div class="panel-content">
                            <div class="table-responsive">
                                <table class="table-modern draggable-table" id="playlist-{{ $playlistId }}">
                                    <thead>
                                        <tr>
                                            <th class="text-center" width="50">#</th>
                                            <th>Title</th>
                                            <th class="text-center">Hymn Number</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($playlist->musics as $key => $music)
                                            <tr data-id="{{ $music->id }}" data-playlist-id="{{ $playlistId }}">
                                                <td class="text-center font-bold text-gray-400">{{ $key + 1 }}</td>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <i class="fas fa-music mr-3 text-blue-400"></i>
                                                        <a href="{{ route('musics.show', [$music->id, 'playlist_id' => $playlistId ?? null]) }}" class="text-blue-600 font-semibold hover:underline">
                                                            {{ $music->title }}
                                                        </a>
                                                    </div>
                                                </td>
                                                <td class="text-center font-medium">{{ $music->song_number ?? '-' }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

    <script>
        (function() {
            "use strict";

            const tables = document.querySelectorAll('.draggable-table');
            
            tables.forEach(table => {
                const tbody = table.querySelector('tbody');
                
                let currRow = null, dragElem = null, mouseDownX = 0, mouseDownY = 0, mouseX = 0, mouseY = 0, mouseDrag = false;

                function init() {
                    bindMouse();
                }

                function bindMouse() {
                    tbody.addEventListener('mousedown', (event) => {
                        if (event.button != 0) return true;

                        let target = getTargetRow(event.target);
                        if (target) {
                            currRow = target;
                            addDraggableRow(target);
                            currRow.classList.add('is-dragging');

                            let coords = getMouseCoords(event);
                            mouseDownX = coords.x;
                            mouseDownY = coords.y;

                            mouseDrag = true;
                        }
                    });

                    document.addEventListener('mousemove', (event) => {
                        if (!mouseDrag) return;

                        let coords = getMouseCoords(event);
                        mouseX = coords.x - mouseDownX;
                        mouseY = coords.y - mouseDownY;

                        moveRow(mouseX, mouseY);
                    });

                    document.addEventListener('mouseup', (event) => {
                        if (!mouseDrag) return;

                        currRow.classList.remove('is-dragging');
                        table.removeChild(dragElem);

                        dragElem = null;
                        mouseDrag = false;

                        // Save the new order
                        //saveOrder();
                    });
                }

                // function saveOrder() {
                //     const rows = Array.from(tbody.children);
                //     const order = rows.map((row, index) => ({
                //         id: row.dataset.id,
                //         position: index
                //     }));

                //     const playlistId = tbody.parentElement.id.split('-')[1];

                //     fetch(' route("playlists.updateOrder")', {
                //         method: 'POST',
                //         headers: {
                //             'Content-Type': 'application/json',
                //             'X-CSRF-TOKEN': '{{ csrf_token() }}'
                //         },
                //         body: JSON.stringify({ playlist_id: playlistId, order: order.map(item => item.id) })
                //     }).then(response => response.json())
                //       .then(data => {
                //           if (data.success) {
                //               console.log('Order updated successfully');
                //           }
                //       });
                // }

                function swapRow(row, index) {
                    let currIndex = Array.from(tbody.children).indexOf(currRow),
                        row1 = currIndex > index ? currRow : row,
                        row2 = currIndex > index ? row : currRow;

                    tbody.insertBefore(row1, row2);
                }

                function moveRow(x, y) {
                    dragElem.style.transform = `translate3d(${x}px, ${y}px, 0)`;

                    let dPos = dragElem.getBoundingClientRect(),
                        currStartY = dPos.y, currEndY = currStartY + dPos.height,
                        rows = getRows();

                    for (let i = 0; i < rows.length; i++) {
                        let rowElem = rows[i],
                            rowSize = rowElem.getBoundingClientRect(),
                            rowStartY = rowSize.y, rowEndY = rowStartY + rowSize.height;

                        if (currRow !== rowElem && isIntersecting(currStartY, currEndY, rowStartY, rowEndY)) {
                            if (Math.abs(currStartY - rowStartY) < rowSize.height / 2)
                                swapRow(rowElem, i);
                        }
                    }
                }

                function addDraggableRow(target) {
                    dragElem = target.cloneNode(true);
                    dragElem.classList.add('draggable-table__drag');
                    dragElem.style.height = getStyle(target, 'height');
                    dragElem.style.background = getStyle(target, 'backgroundColor');
                    for (let i = 0; i < target.children.length; i++) {
                        let oldTD = target.children[i],
                            newTD = dragElem.children[i];
                        newTD.style.width = getStyle(oldTD, 'width');
                        newTD.style.height = getStyle(oldTD, 'height');
                        newTD.style.padding = getStyle(oldTD, 'padding');
                        newTD.style.margin = getStyle(oldTD, 'margin');
                    }

                    table.appendChild(dragElem);

                    let tPos = target.getBoundingClientRect(),
                        dPos = dragElem.getBoundingClientRect();
                    dragElem.style.bottom = `${dPos.y - tPos.y - tPos.height}px`;
                    dragElem.style.left = "-1px";

                    document.dispatchEvent(new MouseEvent('mousemove', { view: window, cancelable: true, bubbles: true }));
                }

                function getRows() {
                    return tbody.querySelectorAll('tr');
                }

                function getTargetRow(target) {
                    let elemName = target.tagName.toLowerCase();

                    if (elemName === 'tr') return target;
                    if (elemName === 'td') return target.closest('tr');
                }

                function getMouseCoords(event) {
                    return {
                        x: event.clientX,
                        y: event.clientY
                    };
                }

                function getStyle(target, styleName) {
                    let compStyle = getComputedStyle(target),
                        style = compStyle[styleName];

                    return style ? style : null;
                }

                function isIntersecting(min0, max0, min1, max1) {
                    return Math.max(min0, max0) >= Math.min(min1, max1) && Math.min(min0, max0) <= Math.max(min1, max1);
                }

                init();
            });
        })();
    </script>

            @if (\App\Helpers\AccessRightsHelper::checkPermission('dashboard.hymns_info') == 'inline')
                <!-- Most Viewed Section -->
                <div class="dashboard-card" id="most-viewed-card">
                    <h3 class="section-title"><i class="fas fa-chart-line text-blue-500"></i> Most Viewed Hymns</h3>
                    <div class="card-scroll-body flex-grow">
                        <table class="table-modern">
                            <thead>
                                <tr>
                                    <th class="text-center">Hymn #</th>
                                    <th>Title</th>
                                    <th class="text-center">Views</th>
                                </tr>
                            </thead>
                            <tbody class="ajax-content">
                                @foreach($mostViewedHymns as $hymn)
                                    <tr>
                                        <td class="text-center font-bold text-muted">{{ $hymn->song_number }}</td>
                                        <td>
                                            <a href="{{ route('musics.show', $hymn->id) }}" class="d-flex align-items-center text-blue-600 font-semibold hover:underline">
                                                <i class="fas fa-music mr-2 opacity-30"></i>
                                                {{ $hymn->title }}
                                            </a>
                                        </td>
                                        <td class="text-center"><span class="badge badge-pill badge-light px-3 py-2 font-bold">{{ $hymn->views_count }}</span></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="pagination-centered ajax-pagination">
                        {{ $mostViewedHymns->links() }}
                    </div>
                </div>

                <div class="row">
                    <!-- Recent Activity -->
                    <div class="col-lg-7 mb-4">
                        <div class="dashboard-card h-100" id="activity-card">
                            <h3 class="section-title"><i class="fas fa-history text-muted"></i> Recent Activity</h3>
                            <div class="card-scroll-body flex-grow">
                                <table class="table-modern">
                                    <thead>
                                        <tr>
                                            <th>User</th>
                                            <th>Action</th>
                                            <th class="text-right">Time</th>
                                        </tr>
                                    </thead>
                                    <tbody class="ajax-content">
                                        @foreach($logs as $activity)
                                            @php
                                                $badgeClass = match(strtolower($activity->action)) {
                                                    'login' => 'badge-login',
                                                    'viewed' => 'badge-view',
                                                    'created' => 'badge-create',
                                                    'deleted' => 'badge-delete',
                                                    default => 'badge-light'
                                                };
                                            @endphp
                                            <tr>
                                                <td class="font-semibold text-dark">{{ optional($activity->user)->name }}</td>
                                                <td><span class="badge-custom {{ $badgeClass }}">{{ $activity->action }}</span></td>
                                                <td class="small text-muted text-right">{{ $activity->created_at->diffForHumans() }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="pagination-centered ajax-pagination">
                                {{ $logs->links() }}
                            </div>
                        </div>
                    </div>

                    <!-- Hymns Chart -->
                    <div class="col-lg-5 mb-4">
                        <div class="dashboard-card h-100">
                            <h3 class="section-title"><i class="fas fa-chart-pie text-purple-400"></i> Distribution</h3>
                            <div style="height: 300px; position: relative;" class="flex-grow d-flex align-items-center">
                                <canvas id="churchHymnsChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <!-- Language Stats -->
                    <div class="col-md-6 mb-4">
                        <div class="dashboard-card h-100">
                            <h3 class="section-title"><i class="fas fa-globe text-blue-400"></i> Hymns by Language</h3>
                            <table class="table-modern">
                                <tbody>
                                    @foreach($languageCounts as $language)
                                        <tr>
                                            <td class="font-semibold">{{ $language->name }}</td>
                                            <td class="text-right"><span class="badge badge-primary px-3 py-2" style="background-color: var(--accent-blue);">{{ $language->musics_count }}</span></td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Categories Chart -->
                    <div class="col-md-6 mb-4">
                        <div class="dashboard-card h-100">
                            <h3 class="section-title"><i class="fas fa-tags text-teal-400"></i> Categories Overview</h3>
                            <div style="height: 320px; position: relative;">
                                <canvas id="hymnCategoriesChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Footer Stats Grid -->
                <div class="row">
                    <div class="col-12 col-md-6 col-xl-3 mb-4">
                        <div class="dashboard-card p-4 d-flex flex-column h-100" style="min-height: 250px;">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h4 class="font-bold text-muted uppercase tracking-wider mb-0" style="font-size: 1.1rem;">Instrumentations</h4>
                                <span class="badge badge-primary rounded-pill" style="background-color: var(--accent-blue);">{{ $instrumentations->total() }}</span>
                            </div>
                            <div class="mini-list flex-grow-1">
                                @forelse($instrumentations as $item)
                                    <div class="mini-list-item"><i class="fas fa-drum text-muted mr-2 opacity-50"></i> {{ $item->name }}</div>
                                @empty
                                    <div class="text-muted small">No data entries.</div>
                                @endforelse
                            </div>
                            <div class="mt-3">
                                <a href="{{ route('instrumentations.index') }}" class="btn btn-sm btn-outline-primary btn-block rounded-pill">View All</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-xl-3 mb-4">
                        <div class="dashboard-card p-4 d-flex flex-column h-100" style="min-height: 250px;">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h4 class="font-bold text-muted uppercase tracking-wider mb-0" style="font-size: 1.1rem;">Ensemble Types</h4>
                                <span class="badge badge-primary rounded-pill" style="background-color: var(--accent-blue);">{{ $ensembleTypes->total() }}</span>
                            </div>
                            <div class="mini-list flex-grow-1">
                                @forelse($ensembleTypes as $item)
                                    <div class="mini-list-item"><i class="fas fa-users-cog text-muted mr-2 opacity-50"></i> {{ $item->name }}</div>
                                @empty
                                    <div class="text-muted small">No data entries.</div>
                                @endforelse
                            </div>
                            <div class="mt-3">
                                <a href="{{ route('ensemble_types.index') }}" class="btn btn-sm btn-outline-primary btn-block rounded-pill">View All</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-xl-3 mb-4">
                        <div class="dashboard-card p-4 d-flex flex-column h-100" style="min-height: 250px;">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h4 class="font-bold text-muted uppercase tracking-wider mb-0" style="font-size: 1.1rem;">Categories</h4>
                                <span class="badge badge-primary rounded-pill" style="background-color: var(--accent-blue);">{{ $categories->total() }}</span>
                            </div>
                            <div class="mini-list flex-grow-1">
                                @forelse($categories as $item)
                                    <div class="mini-list-item"><i class="fas fa-bookmark text-muted mr-2 opacity-50"></i> {{ $item->name }}</div>
                                @empty
                                    <div class="text-muted small">No data entries.</div>
                                @endforelse
                            </div>
                            <div class="mt-3">
                                <a href="{{ route('categories.index') }}" class="btn btn-sm btn-outline-primary btn-block rounded-pill">View All</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-xl-3 mb-4" id="hymn-credits-section">
                        <div class="dashboard-card p-4 d-flex flex-column h-100" style="min-height: 250px;">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h4 class="font-bold text-muted uppercase tracking-wider mb-0" style="font-size: 1.1rem;">Hymn Credits</h4>
                                <span class="badge badge-primary rounded-pill" style="background-color: var(--accent-blue);">{{ $credits->total() }}</span>
                            </div>
                            <div class="mini-list flex-grow-1">
                                @forelse($credits as $item)
                                    <div class="mini-list-item">
                                        <i class="fas fa-pen-nib text-muted mr-2 opacity-50"></i>
                                        <a href="{{ route('music_creators.profile', [$item->id, 'ref' => 'dashboard-credits']) }}" class="text-dark hover:text-blue-600 transition-colors">
                                            {{ $item->name }}
                                        </a>
                                    </div>
                                @empty
                                    <div class="text-muted small">No data entries.</div>
                                @endforelse
                            </div>
                            <div class="mt-3">
                                <a href="{{ route('credits.index') }}" class="btn btn-sm btn-outline-primary btn-block rounded-pill">View All</a>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        function toggleAccordion(btn) {
            btn.classList.toggle("active");
            var panel = btn.nextElementSibling;
            if (panel.style.maxHeight) {
                panel.style.maxHeight = null;
                panel.style.paddingTop = "0";
                panel.style.paddingBottom = "0";
            } else {
                panel.style.maxHeight = (panel.scrollHeight + 50) + "px";
                panel.style.paddingTop = "1rem";
                panel.style.paddingBottom = "1rem";
            }
        }

        document.addEventListener('DOMContentLoaded', function() {
            // Distribution Chart
            var distLabels = [];
            var distData = [];
            @foreach($totalChurchHymns as $hymn)
                distLabels.push('{{ $hymn->name }}');
                distData.push({{ $hymn->musics_count }});
            @endforeach

            if (distLabels.length > 0) {
                new Chart(document.getElementById('churchHymnsChart').getContext('2d'), {
                    type: 'doughnut',
                    data: {
                        labels: distLabels,
                        datasets: [{
                            data: distData,
                            backgroundColor: ['#64B5D6', '#3E6D9C', '#2a5298', '#1e3c72', '#a5f3fc', '#06b6d4'],
                            borderWidth: 2,
                            borderColor: '#ffffff'
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: { 
                                position: 'right', 
                                labels: { 
                                    boxWidth: 15, 
                                    padding: 20,
                                    font: { size: 12, weight: '600' } 
                                } 
                            },
                        },
                        cutout: '75%',
                        animation: { animateScale: true, animateRotate: true }
                    }
                });
            }

            // Categories Chart
            var catLabels = [];
            var catData = [];
            @foreach($categoryCounts as $categoryCount)
                catLabels.push('{{ $categoryCount->category_name }}');
                catData.push({{ $categoryCount->musics_count }});
            @endforeach

            if (catLabels.length > 0) {
                new Chart(document.getElementById('hymnCategoriesChart').getContext('2d'), {
                    type: 'bar',
                    data: {
                        labels: catLabels,
                        datasets: [{
                            label: 'Hymns',
                            data: catData,
                            backgroundColor: createGradient_cat(document.getElementById('hymnCategoriesChart').getContext('2d')),
                            borderRadius: 10,
                            borderSkipped: false,
                        }]
                    },
                    options: {
                        indexAxis: 'y',
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: { 
                            legend: { display: false },
                            tooltip: {
                                backgroundColor: 'rgba(30, 41, 59, 0.9)',
                                padding: 12,
                                cornerRadius: 10
                            }
                        },
                        scales: {
                            y: { 
                                grid: { display: false },
                                ticks: { font: { weight: '600' } }
                            },
                            x: { 
                                beginAtZero: true, 
                                grid: { color: '#f1f5f9' },
                                ticks: { font: { size: 10 } }
                            }
                        }
                    }
                });
            }

            function createGradient_cat(ctx) {
                const gradient = ctx.createLinearGradient(0, 0, 400, 0);
                gradient.addColorStop(0, '#3E6D9C'); // Navy
                gradient.addColorStop(0.5, '#64B5D6'); // Blue
                gradient.addColorStop(1, '#FFD700'); // Gold
                return gradient;
            }
        });

        // Draggable Table Logic
        (function() {
            "use strict";
            const tables = document.querySelectorAll('.draggable-table');
            tables.forEach(table => {
                const tbody = table.querySelector('tbody');
                if (!tbody) return;
                let currRow = null, dragElem = null, mouseDownX = 0, mouseDownY = 0, mouseX = 0, mouseY = 0, mouseDrag = false;
                
                tbody.addEventListener('mousedown', (e) => {
                    if (e.button != 0) return;
                    let target = e.target.closest('tr');
                    if (target) {
                        currRow = target;
                        dragElem = target.cloneNode(true);
                        dragElem.classList.add('position-fixed');
                        dragElem.style.zIndex = "9999";
                        dragElem.style.opacity = "0.8";
                        dragElem.style.pointerEvents = "none";
                        dragElem.style.background = "#fff";
                        dragElem.style.boxShadow = "0 5px 15px rgba(0,0,0,0.2)";
                        dragElem.style.width = target.offsetWidth + "px";
                        
                        document.body.appendChild(dragElem);
                        currRow.classList.add('opacity-25');
                        mouseDownX = e.clientX;
                        mouseDownY = e.clientY;
                        mouseDrag = true;
                    }
                });

                document.addEventListener('mousemove', (e) => {
                    if (!mouseDrag) return;
                    dragElem.style.left = (e.clientX - (mouseDownX - currRow.getBoundingClientRect().left)) + "px";
                    dragElem.style.top = (e.clientY - (mouseDownY - currRow.getBoundingClientRect().top)) + "px";
                    
                    let target = document.elementFromPoint(e.clientX, e.clientY)?.closest('tr');
                    if (target && target !== currRow && target.parentNode === tbody) {
                        const relPos = e.clientY - target.getBoundingClientRect().top;
                        if (relPos < target.offsetHeight / 2) {
                            tbody.insertBefore(currRow, target);
                        } else {
                            tbody.insertBefore(currRow, target.nextSibling);
                        }
                    }
                });

                document.addEventListener('mouseup', () => {
                    if (!mouseDrag) return;
                    currRow.classList.remove('opacity-25');
                    if (dragElem) dragElem.remove();
                    mouseDrag = false;
                });
            });
        })();

        // AJAX Pagination Logic
        $(document).on('click', '.ajax-pagination a', function(e) {
            e.preventDefault();
            const url = $(this).attr('href');
            if (!url || url === '#') return;

            const card = $(this).closest('.dashboard-card');
            const cardId = card.attr('id');
            const contentArea = card.find('.ajax-content');
            const paginationArea = card.find('.ajax-pagination');

            if (!cardId) {
                console.error('AJAX Pagination failed: Dashboard card missing ID');
                window.location.href = url; // Fallback
                return;
            }

            // Visual feedback
            card.addClass('loading-overlay');
            contentArea.find('tr').addClass('skeleton-loading');

            $.ajax({
                url: url,
                type: 'GET',
                success: function(response) {
                    const newHtml = $(response);
                    const newContent = newHtml.find('#' + cardId + ' .ajax-content').html();
                    const newPagination = newHtml.find('#' + cardId + ' .ajax-pagination').html();

                    if (newContent) {
                        contentArea.fadeOut(200, function() {
                            $(this).html(newContent).fadeIn(200);
                        });
                        paginationArea.html(newPagination);
                    } else {
                        window.location.href = url;
                    }
                },
                error: function() {
                    window.location.href = url;
                },
                complete: function() {
                    card.removeClass('loading-overlay');
                    card.find('.card-scroll-body').animate({ scrollTop: 0 }, 300);
                }
            });
        });
    </script>

    <!-- FAB -->
    @if (\App\Helpers\AccessRightsHelper::checkPermission('musics.add') == 'inline')
        <a href="{{ route('musics.create') }}" class="btn-fab" title="Add New Music">
            <i class="fas fa-plus"></i>
        </a>
    @endif
</x-app-layout>
