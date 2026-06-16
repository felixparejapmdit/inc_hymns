<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

@php
    $topCategories = collect($categoryCounts ?? [])->sortByDesc('musics_count')->take(5);
    $topLanguages = collect($languageCounts ?? [])->sortByDesc('musics_count')->take(5);
    $topInstrumentations = collect($instrumentations->items() ?? [])->take(5);
    $topEnsembles = collect($ensembleTypes->items() ?? [])->take(5);
    $topCredits = collect($credits->items() ?? [])->take(5);
    $churchHymnByName = collect($totalChurchHymns ?? [])->keyBy('name');
    $hymnBreakdown = [
        [
            'key' => 'AWS',
            'label' => 'Adult Worship',
            'icon' => 'fa-users',
            'color' => '#3E6D9C',
            'bg' => 'rgba(62,109,156,0.12)',
        ],
        [
            'key' => 'CWS',
            'label' => 'Children Worship',
            'icon' => 'fa-child',
            'color' => '#0f766e',
            'bg' => 'rgba(13,148,136,0.12)',
        ],
        [
            'key' => 'EM',
            'label' => 'Evangelical Mission',
            'icon' => 'fa-bullhorn',
            'color' => '#d97706',
            'bg' => 'rgba(217,119,6,0.12)',
        ],
        [
            'key' => 'Wedding',
            'label' => 'Wedding',
            'icon' => 'fa-heart',
            'color' => '#db2777',
            'bg' => 'rgba(219,39,119,0.12)',
        ],
        [
            'key' => 'Pasalamat',
            'label' => 'Pasalamat',
            'icon' => 'fa-hands-praying',
            'color' => '#7c3aed',
            'bg' => 'rgba(124,58,237,0.12)',
        ],
    ];
    $dashboardStats = [
        [
            'label' => 'Total Hymns',
            'value' => $totalChurchHymns->sum('musics_count') ?? 0,
            'icon' => 'fa-book-open',
            'href' => route('musics.index'),
        ],
        [
            'label' => 'Users',
            'value' => $totalUsers ?? 0,
            'icon' => 'fa-users',
            'href' => route('users.index'),
        ],
        [
            'label' => 'Lyricists',
            'value' => $totalLyricists ?? 0,
            'icon' => 'fa-pen-nib',
            'href' => route('credits.index', ['designation' => 'lyricists']),
        ],
        [
            'label' => 'Composers',
            'value' => $totalComposers ?? 0,
            'icon' => 'fa-music',
            'href' => route('credits.index', ['designation' => 'composers']),
        ],
        [
            'label' => 'Arrangers',
            'value' => $totalArrangers ?? 0,
            'icon' => 'fa-sliders',
            'href' => route('credits.index', ['designation' => 'arrangers']),
        ],
        [
            'label' => 'Playlists',
            'value' => isset($playlists) ? $playlists->count() : 0,
            'icon' => 'fa-list-ul',
            'href' => route('playlists_management.index'),
        ],
    ];
@endphp

<style>
    :root {
        --primary-gradient: linear-gradient(to bottom, #64B5D6 0%, #3E6D9C 100%);
        --card-bg: rgba(255, 255, 255, 0.95);
        --accent-blue: #3E6D9C;
        --accent-gold: #FFD700;
    }

    body {
        background: linear-gradient(to bottom, #64B5D6 0%, #3E6D9C 100%) !important;
        background-attachment: fixed !important;
        min-height: 100vh;
    }

    .glass-container {
        padding: 2px 0;
        animation: fadeInUp 0.6s cubic-bezier(0.16, 1, 0.3, 1);
    }

    @keyframes fadeInUp {
        from { opacity: 0; transform: translateY(16px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .dashboard-card {
        background: var(--card-bg);
        border-radius: 22px;
        border: 1px solid rgba(255, 255, 255, 0.4);
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.08);
        padding: 1.5rem;
        margin-bottom: 2rem;
        transition: transform 0.28s cubic-bezier(0.34, 1.56, 0.64, 1), box-shadow 0.28s ease, border-color 0.28s ease;
        display: flex;
        flex-direction: column;
        position: relative;
    }

    .dashboard-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 18px 48px rgba(0, 0, 0, 0.12);
        border-color: rgba(62, 109, 156, 0.25);
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

    .dashboard-card.h-100 { min-height: 500px; }

    .dashboard-tab-nav {
        display: inline-flex;
        gap: 0.75rem;
        padding: 0.4rem;
        border-radius: 999px;
        background: rgba(255, 255, 255, 0.22);
        border: 1px solid rgba(255, 255, 255, 0.28);
        backdrop-filter: blur(12px);
        margin: 0 0 1.25rem;
        box-shadow: 0 8px 28px rgba(0, 0, 0, 0.08);
    }

    .dashboard-tab-btn {
        border: none;
        background: transparent;
        color: rgba(15, 23, 42, 0.72);
        padding: 0.8rem 1.2rem;
        border-radius: 999px;
        font-weight: 800;
        letter-spacing: 0.6px;
        text-transform: uppercase;
        font-size: 0.78rem;
        transition: all 0.25s ease;
    }

    .dashboard-tab-btn.active {
        background: #fff;
        color: var(--accent-blue);
        box-shadow: 0 8px 18px rgba(62, 109, 156, 0.14);
    }

    .dashboard-tab-panel { display: none; animation: fadeInUp 0.5s cubic-bezier(0.16, 1, 0.3, 1); }
    .dashboard-tab-panel.active { display: block; }

    .drilldown-trigger {
        appearance: none;
        border: 1px solid rgba(226, 232, 240, 0.8);
        cursor: pointer;
        text-align: left;
        width: 100%;
    }

    .drilldown-trigger .metric-title,
    .drilldown-trigger .metric-amount,
    .drilldown-trigger .stat-subtitle {
        pointer-events: none;
    }

    .drilldown-trigger .stat-subtitle {
        display: flex;
        align-items: center;
        gap: 0.35rem;
        color: #64748b;
    }

    .drilldown-trigger .stat-subtitle i {
        font-size: 0.8rem;
    }

    .hymn-drilldown-modal {
        position: fixed;
        inset: 0;
        background: rgba(15, 23, 42, 0.62);
        backdrop-filter: blur(10px);
        z-index: 2200;
        display: none;
        align-items: center;
        justify-content: center;
        padding: 1.25rem;
    }

    .hymn-drilldown-modal.active {
        display: flex;
        animation: fadeInUp 0.2s ease;
    }

    .hymn-drilldown-panel {
        width: min(860px, 100%);
        max-height: min(86vh, 780px);
        overflow: hidden;
        border-radius: 28px;
        background: rgba(255, 255, 255, 0.96);
        border: 1px solid rgba(255, 255, 255, 0.55);
        box-shadow: 0 35px 90px rgba(15, 23, 42, 0.3);
        display: flex;
        flex-direction: column;
    }

    .hymn-drilldown-header {
        padding: 1.4rem 1.5rem;
        border-bottom: 1px solid #e2e8f0;
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        gap: 1rem;
        background: linear-gradient(180deg, rgba(248,250,252,0.96), rgba(255,255,255,0.96));
    }

    .hymn-drilldown-kicker {
        margin: 0 0 0.25rem;
        font-size: 0.72rem;
        font-weight: 900;
        letter-spacing: 1.6px;
        text-transform: uppercase;
        color: var(--accent-blue);
    }

    .hymn-drilldown-title {
        margin: 0;
        font-size: 1.25rem;
        font-weight: 900;
        color: #0f172a;
    }

    .hymn-drilldown-close {
        border: none;
        background: #e2e8f0;
        color: #334155;
        width: 40px;
        height: 40px;
        border-radius: 999px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        transition: all 0.2s ease;
    }

    .hymn-drilldown-close:hover {
        background: #cbd5e1;
        transform: scale(1.04);
    }

    .hymn-drilldown-body {
        padding: 1.25rem 1.5rem 1.5rem;
        overflow: auto;
    }

    .hymn-drilldown-grid {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 0.9rem;
    }

    .hymn-breakdown-item {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 1rem;
        width: 100%;
        padding: 1rem 1rem 1rem 1rem;
        border-radius: 18px;
        border: 1px solid rgba(226, 232, 240, 0.95);
        background: #f8fafc;
        text-decoration: none !important;
        transition: all 0.22s ease;
    }

    .hymn-breakdown-item:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 24px rgba(15, 23, 42, 0.08);
        border-color: rgba(62, 109, 156, 0.3);
    }

    .hymn-breakdown-left {
        display: flex;
        align-items: center;
        gap: 0.9rem;
        min-width: 0;
    }

    .hymn-breakdown-icon {
        width: 44px;
        height: 44px;
        border-radius: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        font-size: 1rem;
    }

    .hymn-breakdown-copy {
        min-width: 0;
    }

    .hymn-breakdown-name {
        margin: 0;
        font-weight: 900;
        color: #0f172a;
        font-size: 0.98rem;
        line-height: 1.2;
    }

    .hymn-breakdown-hint {
        margin: 0.2rem 0 0;
        font-size: 0.76rem;
        color: #64748b;
    }

    .hymn-breakdown-meta {
        flex-shrink: 0;
        display: inline-flex;
        align-items: center;
        gap: 0.35rem;
        padding: 0.45rem 0.7rem;
        border-radius: 999px;
        background: white;
        border: 1px solid #e2e8f0;
        color: #334155;
        font-weight: 800;
        font-size: 0.8rem;
    }

    .hymn-drilldown-footer {
        padding-top: 1rem;
        display: flex;
        justify-content: flex-end;
    }

    .hymn-drilldown-note {
        margin: 0;
        color: #64748b;
        font-size: 0.84rem;
    }

    .stats-grid {
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: 1rem;
        margin-bottom: 1.5rem;
    }

    .stat-card {
        min-height: 180px;
        justify-content: space-between;
        position: relative;
        overflow: hidden;
        border: 0;
        border-radius: 24px;
        background: linear-gradient(180deg, rgba(191, 219, 254, 0.32) 0%, rgba(219, 234, 254, 0.18) 100%);
        color: #ffffff;
        text-decoration: none !important;
        box-shadow: none;
        isolation: isolate;
        padding: 1.3rem 1.35rem;
        transition: transform 0.28s cubic-bezier(0.34, 1.56, 0.64, 1), box-shadow 0.28s ease, border-color 0.28s ease;
    }

    .stat-card::before {
        content: '';
        position: absolute;
        inset: 0;
        background:
            radial-gradient(circle at 18% 18%, rgba(255,255,255,0.10) 0 6%, transparent 7%),
            radial-gradient(circle at 82% 78%, rgba(255,255,255,0.05) 0 10%, transparent 11%),
            linear-gradient(180deg, rgba(255, 255, 255, 0.08), rgba(255, 255, 255, 0));
        pointer-events: none;
    }

    .stat-card-link {
        cursor: pointer;
    }

    .stat-card-link:hover {
        transform: translateY(-4px);
        box-shadow: none;
    }

    .stat-card .metric-icon-circle {
        display: none;
    }

    .stat-card-watermark {
        position: absolute;
        right: 1rem;
        bottom: 0.9rem;
        font-size: 4.25rem;
        color: rgba(255, 255, 255, 0.2);
        pointer-events: none;
        z-index: 0;
    }

    .stat-card-body {
        position: relative;
        z-index: 1;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        min-height: 100%;
        gap: 1rem;
    }

    .stat-card .metric-amount {
        font-size: clamp(3rem, 4vw, 4.35rem);
        font-weight: 900;
        color: #ffffff;
        margin-bottom: 0.15rem;
        line-height: 1;
        letter-spacing: -0.04em;
    }

    .stat-card .metric-title {
        font-size: 0.9rem;
        font-weight: 800;
        color: rgba(255,255,255,0.82);
        letter-spacing: 0.9px;
        text-transform: uppercase;
    }

    .stat-card .stat-subtitle {
        display: none;
    }

    .compact-card {
        padding: 1.35rem;
    }

    .section-card-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 1rem;
        margin-bottom: 1rem;
    }

    .section-card-title {
        margin: 0;
        font-size: 1.02rem;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: 0.4px;
        color: #334155;
    }

    .section-card-title i {
        margin-right: 0.5rem;
        color: var(--accent-blue);
    }

    .section-link {
        font-size: 0.8rem;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: 0.6px;
        color: var(--accent-blue);
        text-decoration: none !important;
    }

    .section-link:hover { color: #64B5D6; }

    .top-five-list {
        display: flex;
        flex-direction: column;
        gap: 0.6rem;
    }

    .top-five-item {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 1rem;
        padding: 0.8rem 0.9rem;
        border-radius: 14px;
        background: rgba(248, 250, 252, 0.9);
        border: 1px solid rgba(226, 232, 240, 0.85);
    }

    .top-five-link {
        color: inherit;
        text-decoration: none !important;
        transition: transform 0.2s ease, box-shadow 0.2s ease, border-color 0.2s ease, background-color 0.2s ease;
    }

    .top-five-item:hover {
        transform: translateX(2px);
        box-shadow: 0 8px 20px rgba(15, 23, 42, 0.06);
    }

    .top-five-item .item-name {
        font-weight: 700;
        color: #334155;
    }

    .top-five-item .item-meta {
        font-weight: 800;
        color: var(--accent-blue);
        flex-shrink: 0;
    }

    .chart-frame {
        height: 320px;
        position: relative;
        border-radius: 20px;
        padding: 0.35rem 0 0;
    }

    .chart-frame.small { height: 290px; }

    .chart-frame canvas { filter: saturate(1.08) contrast(1.02); }

    .collapsible-card .accordion-btn {
        border-bottom: 0;
        border-radius: 16px;
        background: rgba(248, 250, 252, 0.95);
    }

    .collapsible-card .panel-content {
        border-radius: 0 0 16px 16px;
        background: transparent;
    }

    .overview-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 1.5rem;
        margin-bottom: 2.5rem;
        width: 100%;
    }

    .overview-grid > .dashboard-metric-card:first-child {
        grid-column: 1 / -1;
    }

    @media (max-width: 1024px) {
        .overview-grid {
            gap: 1.25rem;
        }
        .stats-grid {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }
    }

    @media (max-width: 640px) {
        .overview-grid {
            grid-template-columns: 1fr;
            gap: 1rem;
        }
        .stats-grid {
            grid-template-columns: 1fr;
        }
    }

    .dashboard-metric-card {
        background: #ffffff;
        border-radius: 20px;
        padding: 1.5rem;
        text-align: left;
        box-shadow: 0 4px 20px rgba(0,0,0,0.04);
        transition: all 0.35s cubic-bezier(0.34, 1.56, 0.64, 1);
        border: 1px solid rgba(226, 232, 240, 0.8);
        display: flex;
        flex-direction: column;
        justify-content: center;
        min-height: 140px;
        text-decoration: none !important;
        position: relative;
        overflow: hidden;
    }

    .dashboard-metric-card::before {
        content: '';
        position: absolute;
        inset: 0;
        border-radius: 20px;
        opacity: 0;
        transition: opacity 0.35s ease;
        background: linear-gradient(135deg, rgba(62, 109, 156, 0.04), rgba(100, 181, 214, 0.08));
    }

    .dashboard-metric-card:hover::before {
        opacity: 1;
    }

    .dashboard-metric-card i.metric-bg-icon {
        position: absolute;
        right: 16px;
        bottom: 16px;
        font-size: 3.5rem;
        opacity: 0.08;
        transition: all 0.4s cubic-bezier(0.34, 1.56, 0.64, 1);
    }

    .dashboard-metric-card:hover i.metric-bg-icon {
        opacity: 0.15;
        transform: scale(1.1) rotate(-5deg);
    }

    .dashboard-metric-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 16px 40px rgba(0,0,0,0.12);
        border-color: var(--accent-blue);
    }

    .metric-icon-circle {
        width: 48px;
        height: 48px;
        border-radius: 16px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.3rem;
        margin-bottom: 1rem;
        z-index: 1;
        transition: all 0.35s ease;
    }

    .dashboard-metric-card:hover .metric-icon-circle {
        transform: scale(1.08);
    }

    .metric-amount {
        font-size: 2.2rem;
        font-weight: 800;
        color: var(--accent-blue);
        line-height: 1.1;
        margin-bottom: 0.35rem;
        z-index: 1;
    }

    .metric-title {
        font-size: 0.85rem;
        font-weight: 700;
        color: #64748b;
        text-transform: uppercase;
        letter-spacing: 0.8px;
        z-index: 1;
    }

    /* Hero featured card */
    .highlight-metric {
        background: linear-gradient(135deg, #3E6D9C 0%, #2a5298 100%) !important;
        border: none !important;
        color: white;
        min-height: 120px;
        padding: 1.75rem 2rem;
        display: flex;
        flex-direction: row;
        align-items: center;
        justify-content: space-between;
    }

    .highlight-metric .metric-left {
        display: flex;
        flex-direction: column;
        z-index: 1;
    }

    .highlight-metric .metric-amount {
        font-size: 3rem;
        color: white;
    }

    .highlight-metric .metric-title {
        font-size: 1rem;
        color: rgba(255,255,255,0.85);
        letter-spacing: 1.5px;
    }

    .highlight-metric .metric-icon-hero {
        font-size: 3.5rem;
        opacity: 0.2;
        z-index: 1;
    }

    .highlight-metric::after {
        content: '';
        position: absolute;
        width: 200px;
        height: 200px;
        border-radius: 50%;
        background: rgba(255,255,255,0.06);
        top: -50px;
        right: -50px;
    }

    .highlight-metric:hover {
        transform: translateY(-4px);
        box-shadow: 0 20px 50px rgba(62, 109, 156, 0.35);
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
        .dashboard-tab-nav {
            width: 100%;
            justify-content: space-between;
            gap: 0.35rem;
        }
        .dashboard-tab-btn {
            flex: 1 1 0;
            font-size: 0.7rem;
            padding: 0.7rem 0.85rem;
        }
        .hymn-drilldown-grid {
            grid-template-columns: 1fr;
        }
        .stat-grid {
            grid-template-columns: 1fr;
        }
        .dashboard-card {
            padding: 1.25rem;
            border-radius: 18px;
        }
        .stat-card {
            min-height: 160px;
            padding: 1rem 1rem;
            border-radius: 22px;
        }
        .dashboard-card.h-100 {
            min-height: auto;
        }
        .btn-fab {
            bottom: 20px;
            right: 20px;
            width: 50px;
            height: 50px;
            font-size: 1.25rem;
        }
        .pagination-centered nav div:last-child a,
        .pagination-centered nav div:last-child span {
            min-width: 32px;
            height: 32px;
            font-size: 0.75rem;
        }
        .highlight-metric {
            flex-direction: column;
            align-items: flex-start;
            padding: 1.25rem 1.5rem;
            min-height: 100px;
        }
        .highlight-metric .metric-amount {
            font-size: 2.25rem;
        }
        .highlight-metric .metric-icon-hero {
            position: absolute;
            right: 16px;
            bottom: 16px;
            font-size: 2.5rem;
        }
        .dashboard-card .row {
            margin-left: 0;
            margin-right: 0;
        }
        .dashboard-card .row > [class*="col-"] {
            padding-left: 0;
            padding-right: 0;
        }
        .mini-list-item {
            font-size: 0.875rem;
        }
        .accordion-btn {
            padding: 1rem 0.75rem;
            font-size: 0.875rem;
        }
        .table-modern td {
            padding: 0.875rem 0.625rem;
            font-size: 0.8125rem;
        }
        .table-modern th {
            padding: 0.75rem 0.625rem;
            font-size: 0.6875rem;
        }
        .container-fluid.px-5 {
            padding-left: 1rem !important;
            padding-right: 1rem !important;
        }
        .section-title {
            font-size: 1rem;
        }
    }

    @media (max-width: 480px) {
        .stat-card {
            min-height: 145px;
            padding: 0.95rem 0.9rem;
        }
        .dashboard-metric-card {
            padding: 1.125rem;
            min-height: 110px;
        }
        .metric-amount {
            font-size: 2.2rem;
        }
        .metric-title {
            font-size: 0.72rem;
        }
        .stat-card-watermark {
            font-size: 3.5rem;
        }
        .overview-grid {
            gap: 0.75rem;
        }
        .stats-grid {
            gap: 0.85rem;
        }
        .hymn-drilldown-panel {
            border-radius: 22px;
        }
        .hymn-drilldown-header,
        .hymn-drilldown-body {
            padding-left: 1rem;
            padding-right: 1rem;
        }
        .container-fluid.px-5 {
            padding-left: 0.75rem !important;
            padding-right: 0.75rem !important;
        }
        .dashboard-grid-container {
            gap: 1rem;
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
        transition: all 0.25s ease;
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
        transition: transform 0.35s cubic-bezier(0.34, 1.56, 0.64, 1);
    }

    .accordion-btn.active i.fa-chevron-down {
        transform: rotate(180deg);
    }

    .panel-content {
        max-height: 0;
        overflow: hidden;
        transition: max-height 0.4s cubic-bezier(0.4, 0, 0.2, 1), padding 0.3s ease, opacity 0.3s ease;
        background-color: white;
        opacity: 0;
    }

    .panel-content.open {
        opacity: 1;
    }
    /* Skeleton Loading */
    @keyframes shimmer {
        0% { background-position: -200% 0; }
        100% { background-position: 200% 0; }
    }

    @keyframes pulse-soft {
        0%, 100% { opacity: 1; }
        50% { opacity: 0.6; }
    }

    .skeleton-loading {
        background: linear-gradient(90deg, #f0f4f8 25%, #e1e7ee 50%, #f0f4f8 75%);
        background-size: 200% 100%;
        animation: shimmer 1.5s infinite;
        border-radius: 8px;
        color: transparent !important;
    }

    .skeleton-card {
        background: #fff;
        border-radius: 20px;
        padding: 1.5rem;
        animation: pulse-soft 1.8s ease-in-out infinite;
    }

    .skeleton-card .s-block {
        background: linear-gradient(90deg, #f0f4f8 25%, #e1e7ee 50%, #f0f4f8 75%);
        background-size: 200% 100%;
        animation: shimmer 1.5s infinite;
        border-radius: 8px;
    }

    .dashboard-loading .dashboard-card,
    .dashboard-loading .dashboard-metric-card {
        overflow: hidden;
    }

    .dashboard-loading .dashboard-card::after,
    .dashboard-loading .dashboard-metric-card::after {
        content: '';
        position: absolute;
        inset: 0;
        background: linear-gradient(120deg, rgba(255,255,255,0) 20%, rgba(255,255,255,0.35) 50%, rgba(255,255,255,0) 80%);
        background-size: 200% 100%;
        animation: shimmer 1.4s infinite;
        opacity: 0.28;
        pointer-events: none;
    }
    
    .loading-overlay {
        opacity: 0.5;
        pointer-events: none;
        filter: grayscale(0.5);
        transition: all 0.3s ease;
    }

    /* Ripple effect for buttons */
    .ripple-btn {
        position: relative;
        overflow: hidden;
        cursor: pointer;
    }

    .ripple-btn::after {
        content: '';
        position: absolute;
        inset: 0;
        background: radial-gradient(circle at var(--x, 50%) var(--y, 50%), rgba(255,255,255,0.3) 0%, transparent 70%);
        opacity: 0;
        transition: opacity 0.3s;
        pointer-events: none;
    }

    .ripple-btn:active::after {
        opacity: 1;
        transition: 0s;
    }

    /* Smooth scroll for card scroll bodies */
    .card-scroll-body {
        scroll-behavior: smooth;
    }
</style>

<x-app-layout>

    <div class="glass-container">
        <div class="container-fluid px-5 px-xl-5 dashboard-grid-container" style="max-width: 90%; margin: 0 auto;">
            @if (
                \App\Helpers\AccessRightsHelper::checkPermission('dashboard') == 'inline'
                || \App\Helpers\AccessRightsHelper::checkPermission('dashboard.hymns_info') == 'inline'
            )
                <div class="dashboard-tab-nav" role="tablist" aria-label="Dashboard sections">
                    <button type="button" class="dashboard-tab-btn active" data-dashboard-tab="overview">Overview</button>
                    <button type="button" class="dashboard-tab-btn" data-dashboard-tab="analytics">Detailed Analytics</button>
                </div>

                <div id="dashboard-overview" class="dashboard-tab-panel active">
                    <div class="stats-grid">
                        @foreach($dashboardStats as $stat)
                            @if($loop->first)
                                <button
                                    type="button"
                                    class="dashboard-card stat-card stat-card-link drilldown-trigger group w-full text-left"
                                    data-hymn-breakdown-trigger
                                    aria-haspopup="dialog"
                                    aria-controls="hymnBreakdownModal"
                                >
                                    <div class="stat-card-body">
                                        <div class="metric-title">{{ $stat['label'] }}</div>
                                        <div class="metric-amount">{{ $stat['value'] }}</div>
                                    </div>
                                    <i class="fas {{ $stat['icon'] }} stat-card-watermark" aria-hidden="true"></i>
                                </button>
                            @else
                                <a
                                    href="{{ $stat['href'] }}"
                                    class="dashboard-card stat-card stat-card-link group block w-full text-left"
                                >
                                    <div class="stat-card-body">
                                        <div class="metric-title">{{ $stat['label'] }}</div>
                                        <div class="metric-amount">{{ $stat['value'] }}</div>
                                    </div>
                                    <i class="fas {{ $stat['icon'] }} stat-card-watermark" aria-hidden="true"></i>
                                </a>
                            @endif
                        @endforeach
                    </div>

                    <div id="hymnBreakdownModal" class="hymn-drilldown-modal" aria-hidden="true">
                        <div class="hymn-drilldown-panel" role="dialog" aria-modal="true" aria-labelledby="hymnBreakdownTitle">
                            <div class="hymn-drilldown-header">
                                <div>
                                    <p class="hymn-drilldown-kicker">Hymn Breakdown</p>
                                    <h3 class="hymn-drilldown-title" id="hymnBreakdownTitle">Total Hymns by Church Hymn</h3>
                                </div>
                                <button type="button" class="hymn-drilldown-close" data-hymn-breakdown-close aria-label="Close hymn breakdown">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                            <div class="hymn-drilldown-body">
                                <div class="hymn-drilldown-grid">
                                    @foreach($hymnBreakdown as $item)
                                        @php
                                            $hymnGroup = $churchHymnByName->get($item['key']);
                                            $hymnCount = $hymnGroup->musics_count ?? 0;
                                            $hymnUrl = $hymnGroup ? route('musics.index', ['church_hymn_id' => $hymnGroup->id]) : '#';
                                        @endphp
                                        @if($hymnGroup)
                                            <a href="{{ $hymnUrl }}" class="hymn-breakdown-item">
                                                <div class="hymn-breakdown-left">
                                                    <div class="hymn-breakdown-icon" style="background: {{ $item['bg'] }}; color: {{ $item['color'] }};">
                                                        <i class="fas {{ $item['icon'] }}"></i>
                                                    </div>
                                                    <div class="hymn-breakdown-copy">
                                                        <p class="hymn-breakdown-name">{{ $item['label'] }}</p>
                                                        <p class="hymn-breakdown-hint">{{ $item['key'] }} group</p>
                                                    </div>
                                                </div>
                                                <div class="hymn-breakdown-meta">
                                                    <span>{{ $hymnCount }}</span>
                                                    <i class="fas fa-arrow-right"></i>
                                                </div>
                                            </a>
                                        @else
                                            <div class="hymn-breakdown-item" style="opacity:0.5; pointer-events:none;">
                                                <div class="hymn-breakdown-left">
                                                    <div class="hymn-breakdown-icon" style="background: {{ $item['bg'] }}; color: {{ $item['color'] }};">
                                                        <i class="fas {{ $item['icon'] }}"></i>
                                                    </div>
                                                    <div class="hymn-breakdown-copy">
                                                        <p class="hymn-breakdown-name">{{ $item['label'] }}</p>
                                                        <p class="hymn-breakdown-hint">No data available</p>
                                                    </div>
                                                </div>
                                                <div class="hymn-breakdown-meta">
                                                    <span>0</span>
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                                <div class="hymn-drilldown-footer">
                                    <p class="hymn-drilldown-note">Tip: click any group to open its filtered hymn list.</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-7 mb-4">
                            <div class="dashboard-card h-100" id="playlist-card">
                                <div class="section-card-header">
                                    <h2 class="section-card-title mb-0">
                                        <i class="fas fa-list-ul"></i> Special Occasion Playlist
                                    </h2>
                                    @if (\App\Helpers\AccessRightsHelper::checkPermission('dashboard.playlist.add') == 'inline')
                                        <a href="{{ route('playlists_management.index') }}" class="section-link">Add</a>
                                    @endif
                                </div>
                                <div class="mt-2 card-scroll-body">
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
                        </div>

                        <div class="col-lg-5 mb-4">
                            <div class="dashboard-card h-100" id="most-viewed-card">
                                <div class="section-card-header">
                                    <h2 class="section-card-title mb-0">
                                        <i class="fas fa-chart-line"></i> Most Viewed Hymns
                                    </h2>
                                </div>
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
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-12 mb-4">
                            <div class="dashboard-card h-100" id="activity-card">
                                <div class="section-card-header">
                                    <h2 class="section-card-title mb-0">
                                        <i class="fas fa-clock"></i> Recent Activity
                                    </h2>
                                </div>
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
                    </div>
                </div>

                <div id="dashboard-analytics" class="dashboard-tab-panel">
                    <div class="row">
                        <div class="col-lg-7 mb-4">
                            <div class="dashboard-card h-100 compact-card">
                                <div class="section-card-header">
                                    <h2 class="section-card-title mb-0">
                                        <i class="fas fa-chart-pie"></i> Distribution
                                    </h2>
                                </div>
                                <div class="chart-frame">
                                    <canvas id="churchHymnsChart"></canvas>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-5 mb-4">
                            <div class="dashboard-card h-100 compact-card">
                                <div class="section-card-header">
                                    <h2 class="section-card-title mb-0">
                                        <i class="fas fa-globe"></i> Hymns by Language
                                    </h2>
                                    <a href="{{ route('languages.index') }}" class="section-link">View All</a>
                                </div>
                                <div class="top-five-list">
                                    @foreach($topLanguages as $language)
                                        <a href="{{ route('musics.index', ['language_ids' => [$language->id]]) }}" class="top-five-item top-five-link">
                                            <span class="item-name">{{ $language->name }}</span>
                                            <span class="item-meta">{{ $language->musics_count }}</span>
                                        </a>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-7 mb-4">
                            <div class="dashboard-card h-100 compact-card">
                                <div class="section-card-header">
                                    <h2 class="section-card-title mb-0">
                                        <i class="fas fa-tags"></i> Categories Overview
                                    </h2>
                                    <a href="{{ route('categories.index') }}" class="section-link">View All</a>
                                </div>
                                <div class="chart-frame small">
                                    <canvas id="hymnCategoriesChart"></canvas>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-5 mb-4">
                            <div class="dashboard-card h-100 compact-card">
                                <div class="section-card-header">
                                    <h2 class="section-card-title mb-0">
                                        <i class="fas fa-tags"></i> Top 5 Categories
                                    </h2>
                                    <a href="{{ route('categories.index') }}" class="section-link">View All</a>
                                </div>
                                <div class="top-five-list">
                                    @foreach($topCategories as $categoryCount)
                                        <a href="{{ route('musics.index', ['category_ids' => [$categoryCount->id]]) }}" class="top-five-item top-five-link">
                                            <span class="item-name">{{ $categoryCount->category_name }}</span>
                                            <span class="item-meta">{{ $categoryCount->musics_count }}</span>
                                        </a>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-6 mb-4">
                            <div class="dashboard-card collapsible-card compact-card">
                                <button class="accordion-btn" onclick="toggleAccordion(this)">
                                    <span><i class="fas fa-sliders-h mr-2 opacity-50"></i> Instrumentations</span>
                                    <i class="fas fa-chevron-down text-xs opacity-50"></i>
                                </button>
                                <div class="panel-content">
                                    <div class="top-five-list mt-2">
                                        @foreach($topInstrumentations as $item)
                                            <div class="top-five-item">
                                                <span class="item-name"><i class="fas fa-guitar mr-2 opacity-50"></i>{{ $item->name }}</span>
                                            </div>
                                        @endforeach
                                    </div>
                                    <div class="mt-3">
                                        <a href="{{ route('instrumentations.index') }}" class="btn btn-sm btn-outline-primary btn-block rounded-pill">View All</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6 mb-4">
                            <div class="dashboard-card collapsible-card compact-card">
                                <button class="accordion-btn" onclick="toggleAccordion(this)">
                                    <span><i class="fas fa-pen-nib mr-2 opacity-50"></i> Hymn Credits</span>
                                    <i class="fas fa-chevron-down text-xs opacity-50"></i>
                                </button>
                                <div class="panel-content">
                                    <div class="top-five-list mt-2">
                                        @foreach($topCredits as $item)
                                            <div class="top-five-item">
                                                <span class="item-name">
                                                    <a href="{{ route('music_creators.profile', [$item->id, 'ref' => 'dashboard-credits']) }}" class="text-dark hover:text-blue-600 transition-colors">
                                                        {{ $item->name }}
                                                    </a>
                                                </span>
                                            </div>
                                        @endforeach
                                    </div>
                                    <div class="mt-3">
                                        <a href="{{ route('credits.index') }}" class="btn btn-sm btn-outline-primary btn-block rounded-pill">View All</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-12 mb-4">
                            <div class="dashboard-card collapsible-card compact-card">
                                <button class="accordion-btn" onclick="toggleAccordion(this)">
                                    <span><i class="fas fa-layer-group mr-2 opacity-50"></i> Ensemble Types</span>
                                    <i class="fas fa-chevron-down text-xs opacity-50"></i>
                                </button>
                                <div class="panel-content">
                                    <div class="top-five-list mt-2">
                                        @foreach($topEnsembles as $item)
                                            <div class="top-five-item">
                                                <span class="item-name"><i class="fas fa-users mr-2 opacity-50"></i>{{ $item->name }}</span>
                                            </div>
                                        @endforeach
                                    </div>
                                    <div class="mt-3">
                                        <a href="{{ route('ensemble_types.index') }}" class="btn btn-sm btn-outline-primary btn-block rounded-pill">View All</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.body.classList.add('dashboard-loading');

        // Add ripple effect to all buttons with .login-btn or .action-btn
        document.addEventListener('pointerdown', function(e) {
            const btn = e.target.closest('.login-btn, .action-btn, .btn-fab, .btn');
            if (!btn) return;
            const rect = btn.getBoundingClientRect();
            btn.style.setProperty('--x', ((e.clientX - rect.left) / rect.width * 100) + '%');
            btn.style.setProperty('--y', ((e.clientY - rect.top) / rect.height * 100) + '%');
        });

        const dashboardTabButtons = document.querySelectorAll('.dashboard-tab-btn');
        const dashboardTabPanels = document.querySelectorAll('.dashboard-tab-panel');
        const hymnBreakdownModal = document.getElementById('hymnBreakdownModal');
        const hymnBreakdownTrigger = document.querySelector('[data-hymn-breakdown-trigger]');
        const hymnBreakdownClose = document.querySelector('[data-hymn-breakdown-close]');

        function switchDashboardTab(name) {
            dashboardTabButtons.forEach(btn => {
                btn.classList.toggle('active', btn.dataset.dashboardTab === name);
            });
            dashboardTabPanels.forEach(panel => {
                panel.classList.toggle('active', panel.id === `dashboard-${name}`);
            });
        }

        dashboardTabButtons.forEach(btn => {
            btn.addEventListener('click', () => switchDashboardTab(btn.dataset.dashboardTab));
        });

        function openHymnBreakdown() {
            if (!hymnBreakdownModal) return;
            hymnBreakdownModal.classList.add('active');
            hymnBreakdownModal.setAttribute('aria-hidden', 'false');
            document.body.style.overflow = 'hidden';
        }

        function closeHymnBreakdown() {
            if (!hymnBreakdownModal) return;
            hymnBreakdownModal.classList.remove('active');
            hymnBreakdownModal.setAttribute('aria-hidden', 'true');
            document.body.style.overflow = '';
        }

        if (hymnBreakdownTrigger) {
            hymnBreakdownTrigger.addEventListener('click', openHymnBreakdown);
        }
        if (hymnBreakdownClose) {
            hymnBreakdownClose.addEventListener('click', closeHymnBreakdown);
        }
        if (hymnBreakdownModal) {
            hymnBreakdownModal.addEventListener('click', (e) => {
                if (e.target === hymnBreakdownModal) {
                    closeHymnBreakdown();
                }
            });
        }
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape' && hymnBreakdownModal?.classList.contains('active')) {
                closeHymnBreakdown();
            }
        });

        function toggleAccordion(btn) {
            btn.classList.toggle("active");
            var panel = btn.nextElementSibling;
            if (panel.classList.contains("open")) {
                panel.classList.remove("open");
                panel.style.maxHeight = null;
                panel.style.paddingTop = "0";
                panel.style.paddingBottom = "0";
            } else {
                panel.classList.add("open");
                panel.style.maxHeight = (panel.scrollHeight + 50) + "px";
                panel.style.paddingTop = "1rem";
                panel.style.paddingBottom = "1rem";
            }
        }

        document.addEventListener('DOMContentLoaded', function() {
            switchDashboardTab('overview');

            // Distribution Chart
            var distLabels = [];
            var distData = [];
            @foreach($totalChurchHymns as $hymn)
                distLabels.push('{{ $hymn->name }}');
                distData.push({{ $hymn->musics_count }});
            @endforeach

            const churchHymnsCanvas = document.getElementById('churchHymnsChart');
            if (distLabels.length > 0 && churchHymnsCanvas) {
                new Chart(churchHymnsCanvas.getContext('2d'), {
                    type: 'doughnut',
                    data: {
                        labels: distLabels,
                        datasets: [{
                            data: distData,
                            backgroundColor: ['#0f766e', '#1d4ed8', '#f59e0b', '#ef4444', '#8b5cf6', '#14b8a6'],
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
            @foreach($topCategories as $categoryCount)
                catLabels.push('{{ $categoryCount->category_name }}');
                catData.push({{ $categoryCount->musics_count }});
            @endforeach

            const hymnCategoriesCanvas = document.getElementById('hymnCategoriesChart');
            if (catLabels.length > 0 && hymnCategoriesCanvas) {
                new Chart(hymnCategoriesCanvas.getContext('2d'), {
                    type: 'bar',
                    data: {
                        labels: catLabels,
                        datasets: [{
                            label: 'Hymns',
                            data: catData,
                            backgroundColor: ['#0f766e', '#1d4ed8', '#f59e0b', '#ef4444', '#8b5cf6'],
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

            setTimeout(() => {
                document.body.classList.remove('dashboard-loading');
            }, 350);
        });

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
