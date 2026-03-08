<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<style>
    :root {
        --primary-gradient: linear-gradient(to bottom, #64B5D6 0%, #3E6D9C 100%);
        --card-bg: rgba(255, 255, 255, 0.95);
        --accent-blue: #3E6D9C;
        --accent-gold: #FFD700;
        --row-even: #f8fafc;
        --row-hover: #e2e8f0;
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
        position: relative;
    }

    /* Table Styling */
    .table-modern {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0 8px;
    }

    .table-modern th {
        padding: 1.25rem 1rem;
        font-size: 0.8rem;
        text-transform: uppercase;
        color: #64748b;
        border: none;
        background: transparent;
        font-weight: 700;
        letter-spacing: 0.5px;
        cursor: pointer;
        transition: color 0.2s;
    }

    .table-modern th:hover {
        color: var(--accent-blue);
    }

    .table-modern td {
        padding: 0.9rem 1.25rem;
        background: #ffffff;
        border: none;
        transition: all 0.2s ease;
        vertical-align: middle;
        font-size: 0.95rem;
    }

    .table-modern tr:hover td {
        background: #f1f7ff;
        color: var(--accent-blue);
    }

    .table-modern tr:hover .hymn-number {
        background: var(--accent-blue);
        color: white;
    }

    /* Playlist Look Enhancements */
    .hymn-title-link {
        font-weight: 700;
        color: #334155;
        text-decoration: none !important;
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .play-icon-hover {
        opacity: 0;
        color: var(--accent-blue);
        transition: all 0.2s;
        font-size: 0.8rem;
    }

    .table-modern tr:hover .play-icon-hover {
        opacity: 1;
        transform: translateX(4px);
    }

    /* Search & Filter Bar */
    .filter-bar {
        background: rgba(255, 255, 255, 0.7);
        backdrop-filter: blur(10px);
        border-radius: 20px;
        padding: 1.5rem;
        margin-bottom: 2.5rem;
        border: 1px solid rgba(255, 255, 255, 0.3);
        box-shadow: 0 4px 15px rgba(0,0,0,0.05);
        position: relative;
        z-index: 50;
    }

    .custom-input, .custom-select {
        border-radius: 12px !important;
        border: 1px solid #e2e8f0 !important;
        padding: 0.6rem 1rem !important;
        height: auto !important;
        font-weight: 500;
        transition: all 0.3s;
    }

    /* Primary & Secondary Buttons */
    .btn-action {
        padding: 0.6rem 1.5rem;
        border-radius: 12px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        transition: all 0.3s;
    }

    /* Multi-Select Combo Box Styles */
    .combo-box { position: relative; width: 100%; margin-bottom: 0px; z-index: 10; }
    .combo-box:focus-within { z-index: 2000; }
    .input-container {
        background: white;
        border-radius: 50px;
        padding: 6px 16px;
        border: 1px solid #e2e8f0;
        cursor: pointer;
        display: flex;
        flex-wrap: wrap;
        align-items: center;
        gap: 8px;
        min-height: 48px;
        transition: all 0.3s;
        box-shadow: 0 1px 3px rgba(0,0,0,0.02);
        position: relative;
        z-index: 1;
    }
    .input-container:hover { border-color: var(--accent-blue); }
    .selected-items { display: flex; flex-wrap: wrap; gap: 6px; }
    .selected-tag {
        background: #f1f5f9;
        color: #334155;
        padding: 4px 10px;
        border-radius: 50px;
        font-size: 0.75rem;
        font-weight: 800;
        display: flex;
        align-items: center;
        gap: 6px;
        border: 1px solid #e2e8f0;
        text-transform: uppercase;
    }
    .selected-tag span {
        cursor: pointer;
        color: #94a3b8;
        font-size: 1.1rem;
        line-height: 1;
    }
    .selected-tag span:hover { color: #ef4444; }
    .combo-box input {
        border: none !important;
        outline: none !important;
        flex: 1;
        min-width: 120px;
        font-weight: 700;
        color: #1e293b;
        font-size: 0.9rem;
        background: transparent;
    }
    .options-container {
        position: absolute;
        top: calc(100% + 8px);
        left: 0;
        width: 100%;
        background: white;
        border-radius: 20px;
        box-shadow: 0 15px 50px rgba(0,0,0,0.25);
        z-index: 9999 !important;
        max-height: 350px;
        overflow-y: auto;
        display: none;
        padding: 12px;
        border: 1px solid rgba(0,0,0,0.1);
    }
    .options-container.active { display: block; animation: fadeUp 0.15s ease-out; }
    .option-item {
        padding: 6px 14px;
        border-radius: 12px;
        transition: all 0.2s;
        font-weight: 700;
        color: #475569;
        font-size: 0.85rem;
    }
    .option-item:hover { background: #f8fafc; }
    .option-item label {
        display: flex !important;
        flex-direction: row !important;
        align-items: center !important;
        justify-content: flex-start !important;
        width: 100%;
        cursor: pointer;
        margin-bottom: 0;
        padding: 5px 0;
        gap: 0; /* Remove gap, use margin on checkbox */
    }
    .option-item input[type="checkbox"] {
        width: 18px !important;
        height: 18px !important;
        min-width: 18px !important;
        max-width: 18px !important;
        margin-right: 12px !important;
        cursor: pointer;
        /* Force standard checkbox look */
        appearance: checkbox !important;
        -webkit-appearance: checkbox !important;
        border: 2px solid #cbd5e1 !important;
        background-color: #ffffff !important;
        accent-color: var(--accent-blue) !important;
    }
    @keyframes fadeUp { from { opacity: 0; transform: translateY(10px); } to { opacity: 1; transform: translateY(0); } }

    .discovery-search {
        background: #f8fafc;
        border: 2px solid #e2e8f0;
        border-radius: 50px;
        padding: 12px 24px;
        font-weight: 800;
        width: 100%;
        max-width: 400px;
        transition: all 0.3s;
    }
    .discovery-search:focus { border-color: var(--accent-blue); box-shadow: 0 0 0 5px rgba(62,109,156,0.1); outline: none; }

    #context-menu {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(15, 23, 42, 0.4);
        backdrop-filter: blur(12px);
        -webkit-backdrop-filter: blur(12px);
        z-index: 9999;
        overflow-y: auto;
        padding: 4rem 2rem;
        opacity: 0;
        transition: opacity 0.4s ease;
    }

    #context-menu.visible { opacity: 1; }

    .modal-content-glass {
        background: rgba(255, 255, 255, 0.9);
        border-radius: 32px;
        padding: 3rem;
        width: 100%;
        max-width: 1100px;
        margin: 0 auto;
        box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
        border: 1px solid rgba(255, 255, 255, 0.3);
        transform: translateY(20px);
        transition: transform 0.4s ease;
    }

    #context-menu.visible .modal-content-glass { transform: translateY(0); }

    .category-card {
        background: white;
        border-radius: 20px;
        padding: 1.75rem 1rem;
        text-align: center;
        border: 1px solid #e2e8f0;
        transition: all 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
        cursor: pointer;
        height: 100%;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        position: relative;
        overflow: hidden;
    }

    .category-card i {
        font-size: 1.5rem;
        color: var(--accent-blue);
        margin-bottom: 0.75rem;
        opacity: 0.8;
    }

    .category-card:hover { border-color: var(--accent-blue); transform: translateY(-8px); box-shadow: 0 12px 20px rgba(62, 109, 156, 0.1); }
    .category-card.active { background: var(--accent-blue); color: white; }
    .category-card.active i { color: white; }

    /* Custom Snackbar/Toast */
    #snackbar {
        visibility: hidden;
        min-width: 250px;
        background-color: #334155;
        color: #fff;
        text-align: center;
        border-radius: 12px;
        padding: 16px;
        position: fixed;
        z-index: 10001;
        left: 50%;
        bottom: 30px;
        transform: translateX(-50%);
        font-weight: 600;
        box-shadow: 0 10px 25px rgba(0,0,0,0.2);
    }

    #snackbar.show {
        visibility: visible;
        animation: fadein 0.5s, fadeout 0.5s 2.5s;
    }

    @keyframes fadein { from {bottom: 0; opacity: 0;} to {bottom: 30px; opacity: 1;} }
    @keyframes fadeout { from {bottom: 30px; opacity: 1;} to {bottom: 0; opacity: 0;} }

    /* Custom Modal */
    .custom-modal-overlay {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(15, 23, 42, 0.6);
        backdrop-filter: blur(4px);
        z-index: 10000;
        align-items: center;
        justify-content: center;
    }

    .custom-modal {
        background: white;
        border-radius: 24px;
        width: 100%;
        max-width: 400px;
        padding: 2rem;
        box-shadow: 0 20px 40px rgba(0,0,0,0.2);
        animation: modalSlide 0.3s ease-out;
    }

    @keyframes modalSlide { from { transform: translateY(20px); opacity: 0; } to { transform: translateY(0); opacity: 1; } }

    /* Centered Playlist Modal */
    .playlist-modal-overlay {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(15, 23, 42, 0.6);
        backdrop-filter: blur(8px);
        z-index: 10000;
        align-items: center;
        justify-content: center;
    }

    .playlist-modal {
        background: white;
        border-radius: 28px;
        width: 90%;
        max-width: 450px;
        padding: 2.5rem;
        box-shadow: 0 25px 60px rgba(0,0,0,0.3);
        animation: modalSlide 0.3s ease-out;
        position: relative;
    }

    .submenu-item {
        padding: 10px 15px;
        border-radius: 8px;
        cursor: pointer;
        font-size: 0.85rem;
        font-weight: 600;
        color: #475569;
        transition: all 0.2s;
        border: none;
        background: transparent;
        width: 100%;
        text-align: left;
    }

    .submenu-item:hover {
        background: #f1f5f9;
        color: var(--accent-blue);
    }

    .submenu-divider {
        height: 1px;
        background: #f1f5f9;
        margin: 8px 0;
    }

    /* Page Skeleton */
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
    
    .loading-overlay { opacity: 0.6; pointer-events: none; filter: grayscale(0.5); }

    .hymn-number {
        font-family: 'Inter', sans-serif;
        font-weight: 800;
        color: var(--accent-blue);
        background: #eef2ff;
        padding: 4px 12px;
        border-radius: 8px;
        font-size: 0.9rem;
    }

    .btn-icon-sm {
        width: 36px;
        height: 36px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 10px;
        transition: all 0.2s;
        border: 1px solid #e2e8f0;
        background: white;
        color: #64748b;
    }

    .btn-icon-sm:hover {
        background: var(--accent-blue);
        color: white;
        border-color: var(--accent-blue);
    }

    @media (max-width: 768px) {
        .filter-bar { padding: 1rem !important; border-radius: 20px !important; }
        .options-container { width: 100% !important; position: fixed !important; bottom: 0; left: 0; border-radius: 20px 20px 0 0 !important; max-height: 80vh !important; }
        .search-pill-container { margin-bottom: 0.5rem; }
        .pagination-centered nav div:last-child { gap: 4px; }
        .container-fluid { max-width: 98% !important; padding-left: 1rem !important; padding-right: 1rem !important; }
        .dashboard-card { padding: 1rem !important; }
    }

    /* PAGINATION STYLES (DASHBOARD SYNC) */
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
        background: #fff;
        color: #64748b;
        border: 1px solid #e2e8f0;
    }

    .pagination-centered nav div:last-child a:hover {
        background: #f8fafc;
        color: var(--accent-blue);
        border-color: var(--accent-blue);
        transform: translateY(-3px);
        box-shadow: 0 5px 15px rgba(62, 109, 156, 0.1);
    }

    .pagination-centered nav div:last-child span[aria-current="page"] > span {
        background: var(--accent-blue) !important;
        color: white !important;
        border: none !important;
        box-shadow: 0 4px 12px rgba(62, 109, 156, 0.3);
    }

    .pagination-centered nav div:last-child span[aria-disabled="true"] > span {
        background: transparent !important;
        border: none !important;
        color: #cbd5e1 !important;
        cursor: default;
    }

    .pagination-centered nav div:first-child { display: none !important; }
</style>

<x-app-layout>
    <div class="glass-container">
        <div class="container-fluid px-5 px-xl-5" style="max-width: 90%; margin: 0 auto;">
            
            <!-- Page Header (Premium Single-Row Layout) -->
            <div class="mb-4 pt-3">
                <div class="d-flex align-items-center flex-wrap gap-3">
                    <div class="d-flex align-items-center">
                        <h1 class="font-black text-4xl text-slate-800 tracking-tighter mb-0 uppercase">Hymn Library</h1>
                        
                        @if($churchHymn)
                            <div class="mx-3 d-none d-md-block" style="width: 2px; height: 30px; background: rgba(0,0,0,0.1); border-radius: 2px;"></div>
                            <span class="badge badge-primary px-3 py-2 rounded-pill shadow-sm d-flex align-items-center" style="background: var(--accent-blue); font-weight: 800; font-size: 0.85rem; letter-spacing: 0.5px;">
                                <i class="fas fa-building mr-2"></i> {{ $churchHymn->name === 'EM' ? 'Evangelical Mission' : $churchHymn->name }}
                            </span>
                        @endif
                    </div>

                    <button id="showCategoriesBtn" class="btn btn-white rounded-circle shadow-sm border p-0 d-flex align-items-center justify-content-center hover-scale transition-all" title="Browse Categories" style="width: 45px; height: 45px; border-color: #e2e8f0 !important;">
                        <i class="fas fa-tags text-blue-500" style="font-size: 1.1rem;"></i>
                    </button>
                </div>
            </div>
            
            <!-- Filter Bar -->
            <div class="filter-bar shadow-sm border-0" style="background: rgba(255, 255, 255, 0.4); border-radius: 30px; padding: 1.2rem 2rem; position: relative; z-index: 100; overflow: visible;">
                <form id="searchForm" method="GET" action="{{ route('musics.index') }}">
                    <input type="hidden" name="church_hymn_id" value="{{ request()->input('church_hymn_id') }}">
                    <div class="row align-items-center g-3" style="position: relative; z-index: 100;">
                        <div class="col-lg-4">
                            <div class="search-pill-container shadow-sm" style="background: #fff; border-radius: 50px; padding: 2px 20px; border: 1px solid #e2e8f0; display: flex; align-items: center; transition: all 0.3s;">
                                <i class="fas fa-search text-muted opacity-40 mr-3"></i>
                                <input type="text" id="searchInput" name="query" class="form-control border-0 bg-transparent shadow-none font-bold py-2" value="{{ request('query') }}" placeholder="Find your favorite hymns..." onkeypress="handleEnterKey(event)" style="font-size: 0.95rem; color: #1e293b; height: 44px;">
                            </div>
                        </div>
                        
                        <div class="col-lg-4">
                            <div class="combo-box" id="language-combo">
                                <div class="input-container" onclick="toggleFilterDropdown('language-options')">
                                    <div class="selected-items" id="selected-languages">
                                        <!-- Tags appear here -->
                                        @foreach($languages as $lang)
                                            @php
                                                $selectedLangs = request('language_ids', []);
                                                // Default to Tagalog (1) if nothing selected
                                                if (empty($selectedLangs) && empty(request('query'))) {
                                                    $selectedLangs = [1];
                                                }
                                            @endphp
                                            @if(in_array($lang->id, $selectedLangs))
                                                <div class="selected-tag" data-id="{{ $lang->id }}">{{ $lang->name }} <span onclick="event.stopPropagation(); removeFilterTag(this, 'language', '{{ $lang->id }}')">×</span></div>
                                            @endif
                                        @endforeach
                                    </div>
                                    <input type="text" id="language-search" placeholder="Languages..." autocomplete="off">
                                </div>
                                <div id="language-options" class="options-container">
                                    <div class="option-item" data-search="ALL LANGUAGES">
                                        <label>
                                            <input type="checkbox" name="language_ids[]" value="All" 
                                                {{ in_array('All', request('language_ids', [])) ? 'checked' : '' }}
                                                onclick="handleAllFilterSelection('language')">
                                            <span>All Languages</span>
                                        </label>
                                    </div>
                                    @foreach($languages as $lang)
                                        <div class="option-item" data-search="{{ strtoupper($lang->name) }}">
                                            <label>
                                                <input type="checkbox" name="language_ids[]" value="{{ $lang->id }}" 
                                                    {{ in_array($lang->id, request('language_ids', [1])) ? 'checked' : '' }}
                                                    onclick="updateFilterTags('language')">
                                                <span>{{ $lang->name }} ({{ $lang->musics_count }})</span>
                                            </label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4">
                            <div class="combo-box" id="category-combo">
                                <div class="input-container" onclick="toggleFilterDropdown('category-options')">
                                    <div class="selected-items" id="selected-categories">
                                        @foreach($categories as $cat)
                                            @if(is_array(request('category_ids')) && in_array($cat->id, request('category_ids')))
                                                <div class="selected-tag" data-id="{{ $cat->id }}">{{ $cat->name }} <span onclick="event.stopPropagation(); removeFilterTag(this, 'category', '{{ $cat->id }}')">×</span></div>
                                            @endif
                                        @endforeach
                                    </div>
                                    <input type="text" id="category-search" placeholder="Categories..." autocomplete="off">
                                </div>
                                <div id="category-options" class="options-container">
                                    <div class="option-item" data-search="ALL CATEGORIES">
                                        <label>
                                            <input type="checkbox" name="category_ids[]" value="All" 
                                                {{ in_array('All', request('category_ids', [])) ? 'checked' : '' }}
                                                onclick="handleAllFilterSelection('category')">
                                            <span>All Categories</span>
                                        </label>
                                    </div>
                                    @foreach($categories as $cat)
                                        <div class="option-item" data-search="{{ strtoupper($cat->name) }}">
                                            <label>
                                                <input type="checkbox" name="category_ids[]" value="{{ $cat->id }}" 
                                                    {{ (is_array(request('category_ids')) && in_array($cat->id, request('category_ids'))) ? 'checked' : '' }}
                                                    onclick="updateFilterTags('category')">
                                                <span>{{ $cat->name }} ({{ $cat->musics_count }})</span>
                                            </label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

            <!-- Main Display Card -->
            <div class="dashboard-card" id="music-list-card">
                <div class="mb-4">
                    <h3 class="text-lg font-bold text-slate-700 m-0"><i class="fas fa-list-ul mr-2 text-blue-400"></i> Hymn Collection</h3>
                </div>

                <div class="table-responsive tableswipe" id="swipe-container">
                    <table class="table-modern" id="hymnsTable">
                        <thead>
                            <tr>
                                <th class="text-center" style="width: 100px;" onclick="sortTable(0)">Hymn # <i class="fas fa-sort ml-1 opacity-30"></i></th>
                                <th onclick="sortTable(1)">Title <i class="fas fa-sort ml-1 opacity-30"></i></th>
                                <th>Category</th>
                                <th class="text-center">Language</th>
                                @if (\App\Helpers\AccessRightsHelper::checkPermission('musics.action') == 'inline')
                                    <th class="text-center">Actions</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody id="musicList" class="ajax-content">
                            @forelse($musics as $music)
                                <tr>
                                    <td class="text-center">
                                        <span class="hymn-number">{{ $music->song_number }}</span>
                                    </td>
                                    <td>
                                        <div class="d-flex flex-column">
                                            <a href="{{ route('musics.show', ['id' => $music->id, 'songNumber' => $music->song_number, 'languageId' => $music->language_id, 'playlistId' => $music->playlist_id ?? $playlistId]) }}" class="hymn-title-link">
                                                <i class="fas fa-play-circle play-icon-hover"></i> {{ $music->title }}
                                            </a>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="flex flex-wrap gap-1">
                                            @foreach($music->categories as $category)
                                                <span class="badge badge-light border text-muted px-2 py-1" style="font-size: 0.65rem; border-radius: 6px;">{{ $category->name }}</span>
                                            @endforeach
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <span class="text-slate-600 font-semibold small uppercase">{{ $music->language->name }}</span>
                                    </td>
                                    @if (\App\Helpers\AccessRightsHelper::checkPermission('musics.action') == 'inline')
                                        <td class="text-center" style="vertical-align: middle;">
                                            <div class="d-inline-flex align-items-center justify-content-center gap-2">
                                                @if (\App\Helpers\AccessRightsHelper::checkPermission('musics.edit') == 'inline')
                                                    <a href="{{ route('musics.edit', $music->id) }}" class="btn-icon-sm" title="Edit">
                                                        <i class="fas fa-pen-nib small"></i>
                                                    </a>
                                                @endif

                                                @if (\App\Helpers\AccessRightsHelper::checkPermission('musics.playlist') == 'inline')
                                                    <button class="btn-icon-sm playlist-trigger" data-music-id="{{ $music->id }}" title="Add to Playlist">
                                                        <i class="fas fa-folder-plus small"></i>
                                                    </button>
                                                @endif

                                                @if (\App\Helpers\AccessRightsHelper::checkPermission('musics.delete') == 'inline')
                                                    <form id="deleteForm{{$music->id}}" method="POST" action="{{ route('musics.destroy', $music->id) }}" class="m-0 d-inline-flex">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="button" onclick="confirmDelete({{$music->id}})" class="btn-icon-sm hover:bg-red-500 hover:text-white" title="Delete">
                                                            <i class="fas fa-trash-alt small"></i>
                                                        </button>
                                                    </form>
                                                @endif
                                            </div>
                                        </td>
                                    @endif
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center py-5">
                                        <p class="text-muted font-bold">No hymns found matching your search.</p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Pagination Area (Centered Dashboard Style) -->
                <div class="mt-4 pt-4 border-top text-center">
                    <div class="pagination-centered ajax-pagination">
                        {{ $musics->appends(request()->except('page'))->links('pagination::bootstrap-4') }}
                    </div>
                    <div class="text-muted small mt-3 font-bold opacity-60">
                        Showing {{ $musics->firstItem() }} to {{ $musics->lastItem() }} of {{ $musics->total() }} results
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Playlist Selection Modal -->
    <div id="playlistSubmenu" class="playlist-modal-overlay">
        <div class="playlist-modal">
            <div class="d-flex justify-between items-center mb-4">
                <div>
                    <h3 class="text-xl font-black text-slate-800 uppercase tracking-tight mb-0">Select Playlist</h3>
                    <p class="text-muted small font-bold m-0 opacity-60">Add this hymn to your collection</p>
                </div>
                <button onclick="$('#playlistSubmenu').removeClass('visible').hide()" class="btn btn-light rounded-circle shadow-sm"><i class="fas fa-times"></i></button>
            </div>
            
            <div id="existingPlaylists" class="overflow-y-auto mb-4" style="max-height: 300px; padding-right: 5px;">
                <!-- Fetched Playlists -->
            </div>

            <div class="submenu-divider"></div>

            <button class="btn btn-primary btn-block rounded-pill font-bold py-3 mt-3 shadow-md add-new-btn" style="background: var(--accent-blue); border: none;">
                <i class="fas fa-plus-circle mr-2"></i> Create New Playlist
            </button>
        </div>
    </div>

    <!-- Discovery Modal Overlay -->
    <div id="context-menu">
        <div class="modal-content-glass">
            <div class="d-flex justify-between items-center mb-5">
                <div>
                    <h2 class="text-3xl font-black text-slate-800 uppercase tracking-tighter mb-0">Discovery</h2>
                    <p class="text-muted small font-bold uppercase tracking-widest pl-1 mt-1 opacity-60">Browse hymns by category</p>
                </div>
                <div class="flex-grow-1 px-5">
                    <div class="position-relative">
                        <i class="fas fa-search position-absolute" style="left: 20px; top: 50%; translate: 0 -50%; color: #94a3b8;"></i>
                        <input type="text" id="modalSearch" class="discovery-search" placeholder="Search categories..." style="padding-left: 50px; max-width: 100%;">
                    </div>
                </div>
                <button onclick="closeCategoryModal()" class="btn btn-light rounded-circle shadow-sm p-3"><i class="fas fa-times"></i></button>
            </div>
            <div class="row" id="modalCategoryList">
                @foreach($topCategories as $category)
                    <div class="col-6 col-md-4 col-lg-3 mb-4">
                        <div class="category-card" onclick="selectCategoryExplicitly({{ $category->id }})">
                            <i class="fas fa-bookmark"></i>
                            <div class="font-bold text-slate-700" style="font-size: 0.9rem;">{{ $category->name }}</div>
                            <div class="small opacity-50 font-black mt-1" style="color: var(--accent-blue);">{{ $category->musics_count }} HYMNS</div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <div id="overlay" class="fixed top-0 left-0 w-screen h-screen bg-black bg-opacity-30 backdrop-blur-sm z-50 hidden"></div>

    <!-- Create Playlist Modal -->
    <div id="createPlaylistModal" class="custom-modal-overlay">
        <div class="custom-modal">
            <h3 class="text-xl font-bold text-slate-800 mb-2">New Playlist</h3>
            <p class="text-muted small mb-4">Give your playlist a descriptive name.</p>
            <input type="text" id="playlistNameInput" class="form-control mb-4 custom-input" placeholder="e.g., Special Service 2024">
            <div class="d-flex gap-2">
                <button onclick="closePlaylistModal()" class="btn btn-light rounded-pill flex-1 font-bold">Cancel</button>
                <button onclick="submitNewPlaylist()" class="btn btn-primary rounded-pill flex-1 font-bold" style="background: var(--accent-blue);">Create</button>
            </div>
        </div>
    </div>

    <!-- Notification Toast -->
    <div id="snackbar">Added successfully!</div>

    <!-- Delete Confirmation Modal -->
    <div id="deleteModal" class="custom-modal-overlay">
        <div class="custom-modal text-center">
            <div class="mb-4">
                <i class="fas fa-exclamation-triangle" style="font-size: 3.5rem; color: #ef4444; opacity: 0.9;"></i>
            </div>
            <h3 class="text-2xl font-black text-slate-800 uppercase tracking-tighter mb-2">Careful!</h3>
            <p class="text-muted font-bold small mb-4 px-3">Are you sure you want to permanently delete this hymn from the library? This cannot be undone.</p>
            <div class="d-flex gap-2 px-2">
                <button onclick="closeDeleteModal()" class="btn btn-light rounded-pill flex-1 font-bold py-3 shadow-sm hover:bg-slate-50">Cancel</button>
                <button id="confirmDeleteFinal" class="btn btn-danger rounded-pill flex-1 font-bold py-3 shadow-md" style="background: #ef4444; border: none;">Yes, Delete</button>
            </div>
        </div>
    </div>

    <script>
        // --- ENHANCED FILTERING & SEARCH ---
        
        function toggleFilterDropdown(id) {
            $('.options-container').not(`#${id}`).removeClass('active');
            $(`#${id}`).toggleClass('active');
        }

        function handleAllFilterSelection(type) {
            const allChecked = $(`#${type}-options input[value="All"]`).prop('checked');
            if (allChecked) {
                // If "All" is checked, uncheck everything else
                $(`#${type}-options input`).not('[value="All"]').prop('checked', false);
            }
            updateFilterTags(type);
        }

        function updateFilterTags(type) {
            const containerId = type === 'category' ? '#selected-categories' : `#selected-${type}s`;
            const container = $(containerId);
            const options = $(`#${type}-options`);
            
            // If any specific option is checked, uncheck "All"
            const specificChecked = options.find('input:checked').not('[value="All"]').length > 0;
            if (specificChecked) {
                options.find('input[value="All"]').prop('checked', false);
            }

            container.empty();
            options.find('input:checked').each(function() {
                const label = $(this).closest('label').find('span').text().split(' (')[0];
                const id = $(this).val();
                container.append(`<div class="selected-tag anim-pop" data-id="${id}">${label} <span onclick="event.stopPropagation(); removeFilterTag(this, '${type}', '${id}')">×</span></div>`);
            });
            performLiveSearch();
        }

        function removeFilterTag(span, type, id) {
            $(`#${type}-options input[value="${id}"]`).prop('checked', false);
            $(span).parent().remove();
            performLiveSearch();
        }

        // Dropdown Search Listeners
        ['language', 'category'].forEach(type => {
            $(`#${type}-search`).on('input', function() {
                const val = $(this).val().toUpperCase();
                $(`#${type}-options .option-item`).each(function() {
                    $(this).toggle($(this).data('search').includes(val));
                });
                $(`#${type}-options`).addClass('active');
            });
        });

        // Discovery Modal Search
        $('#modalSearch').on('input', function() {
            const val = $(this).val().toUpperCase();
            $('#modalCategoryList .col-6').each(function() {
                const text = $(this).find('.font-bold').text().toUpperCase();
                $(this).toggle(text.includes(val));
            });
        });

        // Close dropdowns on outside click
        $(document).on('click', function(e) {
            if (!$(e.target).closest('.combo-box').length) {
                $('.options-container').removeClass('active');
            }
        });

        let searchTimeout = null;
        const searchInput = document.getElementById("searchInput");

        if (searchInput) {
            searchInput.addEventListener("input", function() {
                clearTimeout(searchTimeout);
                searchTimeout = setTimeout(() => {
                    performLiveSearch();
                }, 300); // 300ms debounce
            });
        }

        function handleEnterKey(e) { 
            if (e.keyCode === 13) { 
                e.preventDefault(); 
                clearTimeout(searchTimeout);
                performLiveSearch(); 
            } 
        }

        function performLiveSearch(requestedUrl = null) {
            const form = document.getElementById("searchForm");
            const baseUrl = form.getAttribute('action');
            let finalUrl;

            if (requestedUrl) {
                finalUrl = requestedUrl;
            } else {
                const formData = new FormData(form);
                const params = new URLSearchParams();

                const churchHymnId = formData.get('church_hymn_id');
                if (churchHymnId) params.append('church_hymn_id', churchHymnId);

                const query = formData.get('query');
                if (query) params.append('query', query);

                // Languages
                formData.getAll('language_ids[]').forEach(id => {
                    if (id) params.append('language_ids[]', id);
                });

                // Categories
                formData.getAll('category_ids[]').forEach(id => {
                    if (id) params.append('category_ids[]', id);
                });

                finalUrl = baseUrl + '?' + params.toString();
            }

            // Sync URL
            window.history.pushState({}, '', finalUrl);

            const card = $('#music-list-card');
            card.addClass('loading-overlay');
            $('.table-modern tbody tr').addClass('skeleton-loading');

            $.get(finalUrl, (res) => {
                const html = $(res);
                $('#musicList').html(html.find('#musicList').html());
                $('.ajax-pagination').html(html.find('.ajax-pagination').html());
                
                // Update dynamic counts
                html.find('.option-item').each(function() {
                    const searchKey = $(this).data('search');
                    const newCountText = $(this).find('span').text();
                    $(`.option-item[data-search="${searchKey}"] span`).text(newCountText);
                });

                card.removeClass('loading-overlay');
                // Scroll to top of table
                $('html, body').animate({ scrollTop: $("#music-list-card").offset().top - 100 }, 200);
            });
        }

        // AJAX Pagination Interceptor
        $(document).on('click', '.ajax-pagination a', function(e) {
            e.preventDefault();
            const url = $(this).attr('href');
            if (url) performLiveSearch(url);
        });

        function submitSearchForm() { performLiveSearch(); }

        // 2. Table Sorting (Restored & Fixed)
        let sortDirections = [1, 1, 1, 1]; 
        function sortTable(n) {
            let table = document.getElementById("hymnsTable");
            let rows = table.rows;
            let switching = true, shouldSwitch, i;
            let dir = sortDirections[n] === 1 ? "asc" : "desc";

            while (switching) {
                switching = false;
                for (i = 1; i < (rows.length - 1); i++) {
                    shouldSwitch = false;
                    let x = rows[i].getElementsByTagName("TD")[n];
                    let y = rows[i + 1].getElementsByTagName("TD")[n];
                    let xVal = x.innerText.toLowerCase();
                    let yVal = y.innerText.toLowerCase();
                    
                    if (n === 0) { // Numeric Hymn #
                        xVal = parseInt(xVal) || 0;
                        yVal = parseInt(yVal) || 0;
                    }

                    if (dir === "asc") {
                        if (xVal > yVal) { shouldSwitch = true; break; }
                    } else if (dir === "desc") {
                        if (xVal < yVal) { shouldSwitch = true; break; }
                    }
                }
                if (shouldSwitch) {
                    rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
                    switching = true;
                }
            }
            sortDirections[n] *= -1; // Toggle direction
        }

        // 3. Swipe Pagination (Restored)
        document.addEventListener('DOMContentLoaded', function() {
            let startY = 0;
            const container = document.getElementById('swipe-container');
            if (container) {
                container.addEventListener('touchstart', (e) => startY = e.touches[0].pageY);
                container.addEventListener('touchend', (e) => {
                    let endY = e.changedTouches[0].pageY;
                    if (Math.abs(startY - endY) > 80) { // Swipe sensitivity
                        if (startY > endY) { // Swipe Up -> Next
                            $('.pagination a[rel="next"]').first().click();
                        } else { // Swipe Down -> Prev
                            $('.pagination a[rel="prev"]').first().click();
                        }
                    }
                });
            }
        });

        // 4. Playlist Modal (Centered Implementation)
        let activeMusicId = null;
        $(document).on('click', '.playlist-trigger', function(e) {
            e.stopPropagation();
            const btn = $(this);
            activeMusicId = btn.data('music-id');
            const menu = $('#playlistSubmenu');
            
            // Show as centered modal
            menu.css('display', 'flex').addClass('visible');

            // Fetch dynamic list
            $('#existingPlaylists').html('<div class="p-4 text-center"><i class="fas fa-circle-notch fa-spin text-blue-400 text-2xl"></i></div>');
            fetch('/playlists')
                .then(res => res.json())
                .then(data => {
                    let html = '';
                    data.playlists.forEach(pl => {
                        html += `
                            <button class="submenu-item add-to-existing d-flex justify-between items-center py-3 border-bottom" data-playlist-id="${pl.id}">
                                <span><i class="fas fa-list-ul mr-3 opacity-40"></i> ${pl.name}</span>
                                <i class="fas fa-chevron-right small opacity-30"></i>
                            </button>`;
                    });
                    $('#existingPlaylists').html(html || '<div class="p-4 text-center text-muted font-bold small">No playlists found. Create one below!</div>');
                });
        });

        // Close modal when clicking outside the content
        $('#playlistSubmenu').click(function(e) {
            if (e.target === this) $(this).removeClass('visible').hide();
        });

        $(document).click(() => $('#playlistSubmenu').removeClass('visible'));

        $(document).on('click', '.add-new-btn', function() {
            $('#createPlaylistModal').css('display', 'flex');
            $('#playlistNameInput').focus().val('');
        });

        function closePlaylistModal() { $('#createPlaylistModal').hide(); }

        function submitNewPlaylist() {
            const name = $('#playlistNameInput').val();
            if (name) {
                addMusicToPlaylist(null, name);
                closePlaylistModal();
            }
        }

        $(document).on('click', '.add-to-existing', function() {
            addMusicToPlaylist($(this).data('playlist-id'), null);
        });

        function showNotification(msg, isError = false) {
            const snack = $('#snackbar');
            snack.text(msg).css('background-color', isError ? '#ef4444' : '#334155').addClass('show');
            setTimeout(() => snack.removeClass('show'), 3000);
        }

        function addMusicToPlaylist(playlistId, playlistName) {
            const body = playlistId ? { music_id: activeMusicId } : { name: playlistName, music_id: activeMusicId };
            const url = playlistId ? `/playlists/${playlistId}/add` : '/playlists';
            
            fetch(url, {
                method: 'POST',
                headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
                body: JSON.stringify(body)
            }).then(res => res.json()).then(data => {
                if (data.success) {
                    showNotification('Hymn added to playlist!');
                } else {
                    showNotification('Error: ' + (data.message || 'Could not add hymn'), true);
                }
            });
        }

        // --- STYLING & MODAL CORE ---
        let pendingDeleteId = null;
        function confirmDelete(id) { 
            pendingDeleteId = id;
            $('#deleteModal').css('display', 'flex').addClass('visible');
        }

        function closeDeleteModal() { 
            $('#deleteModal').hide(); 
        }

        $('#confirmDeleteFinal').click(function() {
            if (pendingDeleteId) {
                $('#deleteForm' + pendingDeleteId).submit();
            }
        });
        
        function selectCategoryExplicitly(id) {
            const url = new URL(window.location.href);
            url.searchParams.set('category_ids[]', id);
            window.location.href = url.href;
        }

        function closeCategoryModal() { 
            $('#context-menu').removeClass('visible'); 
            $('#overlay').addClass('hidden');
            setTimeout(() => $('#context-menu').hide(), 400);
        }

        // Trigger Category Modal
        const browseBtn = document.getElementById('showCategoriesBtn');
        if (browseBtn) {
            browseBtn.onclick = () => {
                $('#context-menu').css('display', 'block');
                setTimeout(() => $('#context-menu').addClass('visible'), 10);
            };
        }
        $('#overlay').click(closeCategoryModal);

        // AJAX Pagination & Skeleton Trigger
        $(document).on('click', '.ajax-pagination a', function(e) {
            e.preventDefault();
            const url = $(this).attr('href');
            if (!url || url === '#') return;
            
            const card = $('#music-list-card');
            card.addClass('loading-overlay');
            $('#musicList tr').addClass('skeleton-loading');

            $.get(url, (res) => {
                const html = $(res);
                $('#musicList').html(html.find('#musicList').html());
                $('.ajax-pagination').html(html.find('.ajax-pagination').html());
                card.removeClass('loading-overlay');
                window.scrollTo({ top: card.offset().top - 120, behavior: 'smooth' });
            });
        });
    </script>
</x-app-layout>
