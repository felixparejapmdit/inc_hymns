<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400..900;1,400..900&family=Outfit:wght@100..900&display=swap" rel="stylesheet">

<!-- Include Bootstrap CSS -->
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

<!-- Include jQuery before Bootstrap -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<link rel="stylesheet" href="{{ asset('css/musicplayer.css') }}">
<link rel="stylesheet" href="{{ asset('css/musicdetails.css') }}">
<script src="https://cdnjs.cloudflare.com/ajax/libs/howler/2.2.3/howler.min.js"></script>

<!-- Verify if the script path is correct and file exists -->
<script>
    console.log("Loading musicplayer.js from: {{ asset('js/musicplayer.js') }}");
</script>
<script src="{{ asset('js/musicplayer.js') }}"></script>

<x-app-layout>
    <div class="py-0">
        <div class="max-w-[95%] mx-auto sm:px-4 lg:px-6">
            <!-- Main Immersive Content Card -->
            <div class="main-glass-card shadow-2xl relative">
                <div class="px-6 pb-6 pt-3">



                


                    <!-- Floating Action Group (Left Center) -->
                    <div class="floating-action-group">
                        <button id="toggleDetails" class="floating-action-btn shadow-2xl" title="Hymn Information">
                            <i class="fas fa-info-circle"></i>
                            <span class="btn-tooltip">Details</span>
                        </button>
                        <button id="playlistButton" class="floating-action-btn shadow-2xl hidden" title="Playlist">
                            <i class="fas fa-list-ul"></i>
                            <span class="btn-tooltip">Playlist</span>
                        </button>
                    </div>

                    <!-- Details Overlay (For Spotlight) -->
                    <div id="detailsOverlay" class="modal-overlay-premium"></div>

                    <!-- Details Sidebar (Left-Side persistent/toggleable) -->
                    <div id="detailsDrawer" class="details-drawer shadow-3xl custom-scrollbar-premium">
                        <!-- Drawer Header -->
                        <div class="drawer-header-premium p-4 d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="text-blue-500 font-bold uppercase tracking-widest mb-1" style="font-size: 0.65rem;">Hymn Metadata</h6>
                                <h5 class="font-black text-slate-800 uppercase tracking-tighter mb-0" style="font-size: 1.1rem; font-family: 'Outfit', sans-serif;">Hymn Narrative</h5>
                            </div>
                            <button id="closeDetails" class="drawer-close-btn"><i class="fas fa-times"></i></button>
                        </div>

                        <div class="p-4 pt-0">
                            <!-- Hymn Identity Card -->
                            <div class="identity-hero-card mb-5 overflow-hidden">
                                <div class="identity-glow"></div>
                                <div class="p-5 text-center relative z-10">
                                    <div class="mb-3">
                                        <span class="badge-accent">Masterpiece Edition</span>
                                    </div>
                                    <h4 class="font-black text-slate-800 uppercase leading-none mb-4 hymn-title-display">
                                        {{ $music->title }}
                                    </h4>
                                    <div class="d-flex justify-content-center">
                                        <div class="song-num-hex animate-float">
                                            <span class="text-xs font-bold block opacity-60">HYMN</span>
                                            <span class="text-xl font-black">{{ $music->song_number }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Metadata Sections -->
                            <div class="metadata-stack">
                                <!-- Editions Section -->
                                <div class="section-group mb-5">
                                    <label class="section-label"><i class="fas fa-language"></i> Available Editions</label>
                                    <div class="d-flex flex-wrap gap-2">
                                        @foreach($languages as $lang)
                                            @php
                                                $targetMusic = \App\Models\Music::where('song_number', $music->song_number)->where('language_id', $lang->id)->first();
                                                $isCurrent = $lang->id == $music->language_id;
                                            @endphp
                                            @if($targetMusic)
                                            <a href="{{ route('musics.show', ['id' => $targetMusic->id, 'languageId' => $lang->id, 'playlist_id' => $playlistId]) }}" 
                                               class="edition-pill {{ $isCurrent ? 'active' : '' }}">
                                                {{ $lang->name }}
                                            </a>
                                            @endif
                                        @endforeach
                                    </div>
                                </div>

                                <!-- Classification Grid -->
                                <div class="row g-3 mb-5">
                                    <div class="col-6">
                                        <div class="info-tag-box">
                                            <label class="tag-label"><i class="fas fa-layer-group"></i> Category</label>
                                            <div class="tag-values">
                                                @foreach ($music->categories as $category)
                                                    <span class="tag-item">{{ $category->name }}</span>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="info-tag-box">
                                            <label class="tag-label"><i class="fas fa-guitar"></i> Instrument</label>
                                            <div class="tag-values">
                                                @foreach ($music->instrumentations as $inst)
                                                    <span class="tag-item accent-gold">{{ $inst->name }}</span>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Production Credits -->
                                <div class="section-group mb-5">
                                    <label class="section-label"><i class="fas fa-wand-magic-sparkles"></i> Production Credits</label>
                                    <div class="credit-plate p-4">
                                        <div class="credit-row d-flex align-items-center mb-3">
                                            <div class="credit-icon"><i class="fas fa-pen-nib"></i></div>
                                            <div class="flex-grow-1 ml-3">
                                                <div class="credit-title">Lyricist</div>
                                                <div class="credit-name">
                                                    @foreach ($music->lyricists as $lyricist)
                                                        <span class="creator-item-inline" 
                                                            data-creator-id="{{ $lyricist->id }}" 
                                                            data-name="{{ $lyricist->name }}" 
                                                            data-role="Lyricist"
                                                            data-local="{{ $lyricist->local ?? '' }}"
                                                            data-district="{{ $lyricist->district ?? '' }}"
                                                            data-duty="{{ $lyricist->duty ?? '' }}"
                                                            data-birthday="{{ $lyricist->birthday ? \Carbon\Carbon::parse($lyricist->birthday)->format('F d, Y') : '' }}"
                                                            data-image="{{ $lyricist->image ? asset('storage/' . $lyricist->image) : asset('images/blank_image.png') }}"
                                                            data-background="{{ $lyricist->music_background ?? '' }}"
                                                            >{{ $lyricist->name }}</span>{{ !$loop->last ? ',' : '' }}
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                        <div class="credit-row d-flex align-items-center">
                                            <div class="credit-icon"><i class="fas fa-music"></i></div>
                                            <div class="flex-grow-1 ml-3">
                                                <div class="credit-title">Composer</div>
                                                <div class="credit-name">
                                                    @foreach ($music->composers as $composer)
                                                        <span class="creator-item-inline" 
                                                            data-creator-id="{{ $composer->id }}" 
                                                            data-name="{{ $composer->name }}" 
                                                            data-role="Composer"
                                                            data-local="{{ $composer->local ?? '' }}"
                                                            data-district="{{ $composer->district ?? '' }}"
                                                            data-duty="{{ $composer->duty ?? '' }}"
                                                            data-birthday="{{ $composer->birthday ? \Carbon\Carbon::parse($composer->birthday)->format('F d, Y') : '' }}"
                                                            data-image="{{ $composer->image ? asset('storage/' . $composer->image) : asset('images/blank_image.png') }}"
                                                            data-background="{{ $composer->music_background ?? '' }}"
                                                            >{{ $composer->name }}</span>{{ !$loop->last ? ',' : '' }}
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Scriptural Basis -->
                                <div class="section-group">
                                    <label class="section-label"><i class="fas fa-book-bible"></i> Scriptural Basis</label>
                                    <div class="verse-card-premium p-4">
                                        <i class="fas fa-quote-left quote-accent"></i>
                                        <p class="verse-text-premium">{{ $music->verses_used ?: 'No specific scriptural references documented for this masterpiece.' }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Reconfigurable Multi-Mode Spotlight (Center) -->
                    <div id="centerSpotlight" class="center-spotlight-panel shadow-4xl custom-scrollbar-premium">
                        <!-- Mode 1: Full Hymn Info (Displayed by default or on Title Hover) -->
                        <div id="spotlightHymnInfo" class="spotlight-content-mode p-5">
                            <h2 class="spotlight-title text-center mb-5">{{ $music->title }}</h2>
                            <div class="metadata-stack">
                                <div class="row g-4 text-center">
                                    <div class="col-6">
                                        <label class="section-label d-block mb-3"><i class="fas fa-layer-group"></i> Category</label>
                                        <div class="tag-values">
                                            @foreach ($music->categories as $category)
                                                <span class="tag-item mx-1">{{ $category->name }}</span>
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <label class="section-label d-block mb-3"><i class="fas fa-guitar"></i> Instrument</label>
                                        <div class="tag-values">
                                            @foreach ($music->instrumentations as $inst)
                                                <span class="tag-item accent-gold mx-1">{{ $inst->name }}</span>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-5 text-center">
                                    <label class="section-label d-block mb-3"><i class="fas fa-wand-magic-sparkles"></i> Production Credits</label>
                                    <div class="credit-plate p-4 d-flex justify-content-center gap-5">
                                        <div>
                                            <span class="credit-title d-block mb-1">Lyricist</span>
                                            @foreach ($music->lyricists as $lyricist)
                                                <span class="font-bold text-slate-700">{{ $lyricist->name }}</span>{{ !$loop->last ? ',' : '' }}
                                            @endforeach
                                        </div>
                                        <div>
                                            <span class="credit-title d-block mb-1">Composer</span>
                                            @foreach ($music->composers as $composer)
                                                <span class="font-bold text-slate-700">{{ $composer->name }}</span>{{ !$loop->last ? ',' : '' }}
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-5 text-center">
                                    <label class="section-label d-block mb-3"><i class="fas fa-book-bible"></i> Scriptural Basis</label>
                                    <div class="verse-card-premium p-4">
                                        <p class="verse-text-premium">{{ $music->verses_used ?: 'No documented verses.' }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Mode 2: Per-Name Creator Spotlight (Dynamic) -->
                        <div id="spotlightNameInfo" class="spotlight-content-mode hidden p-5 text-center h-full d-flex flex-column align-items-center justify-content-center">
                            <img id="spotlightCreatorImage" src="" alt="Creator Image" class="rounded-circle mb-3 shadow-lg object-cover hidden" style="width: 140px; height: 140px; border: 4px solid white;">
                            <span id="spotlightRole" class="spotlight-badge mb-3">CONTRBUTOR</span>
                            <h2 id="spotlightCreatorName" class="spotlight-hero-text">CREATOR NAME</h2>
                            <div class="spotlight-accent mt-4 mb-4"></div>
                            
                            <div class="d-flex gap-4 justify-content-center mt-3 text-slate-500" id="spotlightCreatorDetailsContainer">
                                <div id="spotlightCreatorDutyContainer" class="d-flex flex-column align-items-center hidden">
                                    <i class="fas fa-building mb-2 text-xl text-blue-400"></i>
                                    <span id="spotlightCreatorDuty" class="font-bold text-sm uppercase tracking-wide"></span>
                                </div>
                                <div id="spotlightCreatorLocationContainer" class="d-flex flex-column align-items-center hidden">
                                    <i class="fas fa-map-marker-alt mb-2 text-xl text-blue-400"></i>
                                    <span id="spotlightCreatorLocation" class="font-bold text-sm uppercase tracking-wide"></span>
                                </div>
                                <div id="spotlightCreatorBirthdayContainer" class="d-flex flex-column align-items-center hidden">
                                    <i class="fas fa-birthday-cake mb-2 text-xl text-blue-400"></i>
                                    <span id="spotlightCreatorBirthday" class="font-bold text-sm uppercase tracking-wide"></span>
                                </div>
                            </div>
                            
                            <div id="spotlightCreatorBackgroundContainer" class="mt-4 px-4 hidden" style="max-width: 600px; color: #64748b; font-size: 0.95rem; line-height: 1.6; font-style: italic;">
                                <i class="fas fa-quote-left text-blue-300 mb-2 opacity-50 text-2xl"></i>
                                <p id="spotlightCreatorBackground" class="mb-0"></p>
                            </div>
                        </div>
                    </div>

                    <div class="workspace-viewport">
                        <!-- Main Content: Digital Music Stand -->
                        <div class="music-stand-master-view pt-0 pb-4">
                            <div class="digital-music-stand shadow-2xl overflow-hidden rounded-3xl mx-auto" style="background: white; max-width: 900px; transition: all 0.5s ease;">
                                <div id="pdf-container" class="score-render-area-new" style="padding: 1.5rem;">
                                    <!-- Sheet music renders here -->
                                </div>
                            </div>
                        </div>

                        <!-- Fixed Bottom Hub: Performance Hub (Ultra-Transparent) -->
                        <div class="performance-hub-fixed-bottom shadow-3xl">
                            <div class="px-3 pt-2 pb-2 px-md-4 pt-md-3 pb-md-3 w-100 h-100 d-flex flex-column justify-content-center">
                                <!-- Top Row: Compact Controls -->
                                <div class="row m-0 mb-2 mb-md-3 justify-content-center w-100">
                                    <div class="col-12 col-md-auto p-0 d-flex justify-content-center">
                                        <div class="btn-group-premium p-1 p-md-2 rounded-3xl bg-slate-900/5 backdrop-blur-md d-flex gap-1 gap-md-2 flex-wrap justify-content-center text-center mx-auto" style="width: auto; max-width: 100%;">
                                            @php
                                                $hasVocals = !empty($music->vocals_mp3_path);
                                                $hasOrgan = !empty($music->organ_mp3_path);
                                                $hasPreludes = !empty($music->preludes_mp3_path);
                                                $hasScore = !empty($music->music_score_path);
                                                $hasLyrics = !empty($music->lyrics_path);
                                            @endphp

                                            <button class="track-tab tab-button-mp3 {{ $hasVocals ? 'active' : 'disabled opacity-40 grayscale pointer-events-none' }} hub-mini-btn vocals-active" 
                                                data-path="{{ $hasVocals ? asset('storage/' . $music->vocals_mp3_path) : '' }}" {{ $hasVocals ? '' : 'disabled' }}>
                                                <i class="fas fa-microphone d-block d-sm-inline mb-1 mb-sm-0 mr-sm-1"></i> <span>Vocals</span>
                                            </button>
                                            <button class="track-tab tab-button-mp3 hub-mini-btn {{ $hasOrgan ? '' : 'disabled opacity-40 grayscale pointer-events-none' }}" 
                                                data-path="{{ $hasOrgan ? asset('storage/' . $music->organ_mp3_path) : '' }}" {{ $hasOrgan ? '' : 'disabled' }}>
                                                <i class="fas fa-keyboard d-block d-sm-inline mb-1 mb-sm-0 mr-sm-1"></i> <span>Organ</span>
                                            </button>
                                            <button class="track-tab tab-button-mp3 hub-mini-btn {{ $hasPreludes ? '' : 'disabled opacity-40 grayscale pointer-events-none' }}" 
                                                data-path="{{ $hasPreludes ? asset('storage/' . $music->preludes_mp3_path) : '' }}" {{ $hasPreludes ? '' : 'disabled' }}>
                                                <i class="fas fa-play-circle d-block d-sm-inline mb-1 mb-sm-0 mr-sm-1"></i> <span>PreLudes</span>
                                            </button>
                                            <div class="mx-1 mx-md-2 border-l border-slate-300"></div>
                                            <button class="track-tab tab-button active hub-mini-btn score-active {{ $hasScore ? '' : 'disabled opacity-40 grayscale pointer-events-none' }}" 
                                                data-path="{{ $hasScore ? asset('storage/' . $music->music_score_path) : '' }}" {{ $hasScore ? '' : 'disabled' }}>
                                                <i class="fas fa-file-invoice d-block d-sm-inline mb-1 mb-sm-0 mr-sm-1"></i> <span>Score</span>
                                            </button>
                                            <button class="track-tab tab-button hub-mini-btn {{ $hasLyrics ? '' : 'disabled opacity-40 grayscale pointer-events-none' }}" 
                                                data-path="{{ $hasLyrics ? asset('storage/' . $music->lyrics_path) : '' }}" {{ $hasLyrics ? '' : 'disabled' }}>
                                                <i class="fas fa-align-center d-block d-sm-inline mb-1 mb-sm-0 mr-sm-1"></i> <span>Lyrics</span>
                                            </button>
                                        </div>
                                    </div>
                                </div>

                                <!-- Player Row: Custom Interactive Seeker -->
                                <div class="row m-0 align-items-center justify-content-center w-100">
                                    <div class="col-12 col-md-8 col-lg-6 p-0 custom-premium-player">
                                        <audio id="musicPlayer" preload="auto"></audio>
                                        <div class="d-flex align-items-center justify-content-between gap-3 w-100">
                                            <!-- Main Play/Pause -->
                                            <button id="mainPlayBtn" class="main-play-sphere flex-shrink-0 shadow-lg">
                                                <i class="fas fa-play"></i>
                                            </button>
                                            
                                            <!-- Progress Section -->
                                            <div class="progress-metries flex-grow-1" style="min-width: 0;">
                                                <div class="d-flex justify-content-between align-items-end mb-1">
                                                    <span id="currentTime" class="timestamp-label font-monospace">0:00</span>
                                                    <span id="totalDuration" class="timestamp-label font-monospace">0:00</span>
                                                </div>
                                                <div class="slider-container mt-1">
                                                    <input type="range" id="progressBar" class="premium-scrubber" min="0" max="100" value="0">
                                                    <div class="progress-bar-fill" id="progressFill"></div>
                                                </div>
                                            </div>

                                            <!-- Volume Control (Desktop Only) -->
                                            <div class="volume-dock d-none d-lg-flex align-items-center gap-2 flex-shrink-0">
                                                <i class="fas fa-volume-low text-slate-400"></i>
                                                <input type="range" id="volumeBar" class="volume-slider-mini" min="0" max="1" step="0.05" value="1">
                                            </div>
                                        </div>
                                    </div>

                                    @if (\App\Helpers\AccessRightsHelper::checkPermission('music_details.download') == 'inline')
                                    <div class="col-12 col-md-auto p-0 mt-3 mt-md-0 ml-md-4 text-center d-none d-sm-block">
                                        <button id="downloadButton" class="hub-download-btn whitespace-nowrap shadow-lg">
                                            <i class="fas fa-cloud-download-alt mr-2"></i> Download Track
                                        </button>
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>





<style>
/* WORKSPACE REFINEMENT */
/* FLOATING ACTION BUTTONS */
.floating-action-group {
    position: fixed;
    left: 2rem;
    top: 50%;
    transform: translateY(-50%);
    display: flex;
    flex-direction: column;
    gap: 1.5rem;
    z-index: 2000;
}

.floating-action-btn {
    width: 60px;
    height: 60px;
    border-radius: 50%;
    background: white;
    border: none;
    color: #475569;
    font-size: 1.25rem;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    position: relative;
    box-shadow: 0 10px 30px rgba(0,0,0,0.12);
}

.floating-action-btn:hover {
    transform: scale(1.1);
    color: #2563eb;
    background: #f8fafc;
}

.floating-action-btn.active {
    background: #2563eb;
    color: white;
}

.btn-tooltip {
    position: absolute;
    left: 75px;
    background: #1e293b;
    color: white;
    padding: 6px 12px;
    border-radius: 8px;
    font-size: 0.75rem;
    font-weight: 800;
    text-transform: uppercase;
    opacity: 0;
    pointer-events: none;
    transform: translateX(-10px);
    transition: all 0.3s;
    white-space: nowrap;
}

.floating-action-btn:hover .btn-tooltip {
    opacity: 1;
    transform: translateX(0);
}

/* DARK MODE ADAPTATIONS */
body.night-mode .floating-action-btn {
    background: #1e293b;
    color: #94a3b8;
    border: 1px solid rgba(255,255,255,0.1);
}

body.night-mode .floating-action-btn:hover {
    color: #3b82f6;
    background: #0f172a;
}

body.night-mode .details-drawer {
    background: rgba(15, 23, 42, 0.95);
    border-right: 1px solid rgba(255,255,255,0.05);
}

body.night-mode .details-drawer h5 {
    color: #f1f5f9 !important;
}

body.night-mode .performance-hub-fixed-bottom {
    background: rgba(15, 23, 42, 0.9);
    border-color: rgba(255,255,255,0.1);
}

.performance-hub-fixed-bottom {
    position: fixed;
    bottom: 0;
    left: 0;
    width: 100%;
    background: rgba(255, 255, 255, 0.9);
    backdrop-filter: blur(20px);
    z-index: 2100;
    border-top: 1px solid rgba(0,0,0,0.05);
}

body.night-mode .hub-mini-btn {
    color: #94a3b8;
}

/* LEFT-SIDE DETAILS Sidebar */
.details-drawer {
    position: fixed;
    top: 0;
    left: -450px;
    width: 400px;
    max-width: 85vw;
    height: 100vh;
    background: rgba(255, 255, 255, 0.95);
    backdrop-filter: blur(40px);
    z-index: 2200;
    transition: all 0.6s cubic-bezier(0.16, 1, 0.3, 1);
    border-right: 1px solid rgba(255, 255, 255, 0.5);
    pointer-events: all;
    overflow-y: auto;
    box-shadow: 20px 0 60px rgba(0,0,0,0.1);
}

.details-drawer.open {
    left: 0;
}

/* CENTERED DETAILS SPOTLIGHT (ON HOVER) */
.center-spotlight-panel {
    position: fixed;
    top: 50%;
    left: 50%;
    width: 650px;
    max-width: 90vw;
    height: auto;
    max-height: 80vh;
    background: rgba(255, 255, 255, 0.98);
    backdrop-filter: blur(60px);
    z-index: 2300;
    transition: all 0.5s cubic-bezier(0.16, 1, 0.3, 1);
    border: 1px solid white;
    border-radius: 40px;
    transform: translate(-50%, -45%) scale(0.9);
    opacity: 0;
    pointer-events: none;
    overflow-y: auto;
    box-shadow: 0 60px 120px rgba(0,0,0,0.25);
}

.center-spotlight-panel.active {
    opacity: 1;
    transform: translate(-50%, -50%) scale(1);
}

.spotlight-hero-text {
    font-family: 'Playfair Display', serif;
    font-size: 5rem;
    font-weight: 900;
    color: #1e293b;
    margin: 0;
    text-shadow: 0 10px 40px rgba(0,0,0,0.1);
    line-height: 1;
}

.spotlight-accent {
    width: 100px;
    height: 4px;
    background: #3b82f6;
    border-radius: 2px;
}

.spotlight-badge {
    display: inline-block;
    font-size: 0.7rem;
    font-weight: 900;
    text-transform: uppercase;
    letter-spacing: 4px;
    color: #3b82f6;
    background: rgba(59, 130, 246, 0.1);
    padding: 4px 12px;
    border-radius: 4px;
}

.modal-overlay-premium {
    position: fixed;
    top: 0;
    left: 0;
    width: 100vw;
    height: 100vh;
    background: rgba(0,0,0,0.2);
    backdrop-filter: blur(10px);
    z-index: 2250;
    display: none;
    opacity: 0;
    transition: all 0.4s;
    pointer-events: none; /* Prevents stealing hover events from drawer */
}

.modal-overlay-premium.active {
    display: block;
    opacity: 1;
}

body.night-mode .details-drawer,
body.night-mode .center-spotlight-panel {
    background: rgba(15, 23, 42, 0.95);
    border-color: rgba(255,255,255,0.1);
}

body.night-mode .spotlight-title {
    color: white;
}

.spotlight-label-wrap {
    text-align: center;
    padding: 3rem;
    border-radius: 40px;
    background: radial-gradient(circle at center, rgba(255,255,255,0.1) 0%, transparent 70%);
}

.spotlight-badge {
    display: inline-block;
    font-size: 0.7rem;
    font-weight: 900;
    text-transform: uppercase;
    letter-spacing: 4px;
    color: #3b82f6;
    margin-bottom: 1rem;
    opacity: 0.8;
}

.spotlight-hero-text {
    font-family: 'Playfair Display', serif;
    font-size: 5rem;
    font-weight: 900;
    color: #1e293b;
    margin: 0;
    text-shadow: 0 10px 40px rgba(0,0,0,0.1);
    line-height: 1;
}

.spotlight-divider {
    width: 100px;
    height: 4px;
    background: #3b82f6;
    margin: 2rem auto 0;
    border-radius: 2px;
}

body.night-mode .spotlight-hero-text {
    color: white;
}

/* ENHANCED DETAILS PANEL UI */
.drawer-header-premium {
    background: rgba(255, 255, 255, 0.8);
    backdrop-filter: blur(10px);
    border-bottom: 1px solid rgba(0,0,0,0.05);
    position: sticky;
    top: 0;
    z-index: 100;
}

.drawer-close-btn {
    width: 32px;
    height: 32px;
    border-radius: 50%;
    border: none;
    background: #f1f5f9;
    color: #64748b;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.3s;
}

.drawer-close-btn:hover {
    background: #fee2e2;
    color: #ef4444;
    transform: rotate(90deg);
}

.identity-hero-card {
    background: linear-gradient(135deg, #1e293b 0%, #0f172a 100%);
    border-radius: 24px;
    position: relative;
    box-shadow: 0 20px 40px rgba(0,0,0,0.15);
}

.identity-glow {
    position: absolute;
    top: -50%;
    left: -50%;
    width: 200%;
    height: 200%;
    background: radial-gradient(circle at center, rgba(37, 99, 235, 0.15) 0%, transparent 70%);
    pointer-events: none;
}

.hymn-title-display {
    color: white;
    font-size: 1.4rem;
    letter-spacing: -0.5px;
    font-family: 'Playfair Display', serif;
    text-shadow: 0 4px 10px rgba(0,0,0,0.3);
}

.badge-accent {
    background: rgba(37, 99, 235, 0.2);
    color: #60a5fa;
    padding: 4px 12px;
    border-radius: 20px;
    font-size: 0.6rem;
    font-weight: 800;
    text-transform: uppercase;
    letter-spacing: 1px;
    border: 1px solid rgba(37, 99, 235, 0.3);
}

.song-num-hex {
    background: white;
    width: 70px;
    height: 70px;
    border-radius: 18px;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    box-shadow: 0 10px 20px rgba(0,0,0,0.2);
}

.section-label {
    display: block;
    font-size: 0.65rem;
    font-weight: 900;
    text-transform: uppercase;
    color: #64748b;
    margin-bottom: 12px;
    letter-spacing: 1px;
    display: flex;
    align-items: center;
    gap: 8px;
}

.section-label i {
    color: #2563eb;
    font-size: 0.8rem;
}

.edition-pill {
    padding: 8px 16px;
    border-radius: 12px;
    background: #f8fafc;
    border: 1px solid #e2e8f0;
    color: #475569;
    font-size: 0.75rem;
    font-weight: 700;
    transition: all 0.3s;
    text-decoration: none !important;
}

.edition-pill:hover {
    border-color: #2563eb;
    color: #2563eb;
    background: white;
}

.edition-pill.active {
    background: #2563eb;
    color: white;
    border-color: #2563eb;
    box-shadow: 0 4px 10px rgba(37, 99, 235, 0.3);
}

.info-tag-box {
    background: #f8fafc;
    border-radius: 16px;
    padding: 12px;
    border: 1px solid #f1f5f9;
    height: 100%;
}

.tag-label {
    font-size: 0.55rem;
    font-weight: 800;
    text-transform: uppercase;
    color: #94a3b8;
    margin-bottom: 8px;
    display: block;
}

.tag-item {
    display: inline-block;
    font-size: 0.7rem;
    font-weight: 800;
    color: #1e293b;
    background: white;
    padding: 4px 10px;
    border-radius: 8px;
    margin: 2px;
    box-shadow: 0 2px 4px rgba(0,0,0,0.02);
}

.tag-item.accent-gold {
    color: #b45309;
    background: #fffbeb;
}

.credit-plate {
    background: white;
    border-radius: 20px;
    border: 1px solid #f1f5f9;
    box-shadow: 0 10px 30px rgba(0,0,0,0.03);
}

.credit-icon {
    width: 40px;
    height: 40px;
    border-radius: 12px;
    background: #eff6ff;
    color: #2563eb;
    display: flex;
    align-items: center;
    justify-content: center;
}

.credit-title {
    font-size: 0.6rem;
    font-weight: 800;
    text-transform: uppercase;
    color: #94a3b8;
}

.credit-name {
    font-size: 0.85rem;
    font-weight: 700;
    color: #1e293b;
}

.verse-card-premium {
    background: linear-gradient(135deg, #f0f9ff 0%, #e0f2fe 100%);
    border-radius: 20px;
    position: relative;
    overflow: hidden;
}

.quote-accent {
    position: absolute;
    top: 10px;
    left: 15px;
    font-size: 2rem;
    color: #bae6fd;
    opacity: 0.5;
}

.verse-text-premium {
    font-family: 'Playfair Display', serif;
    font-style: italic;
    color: #0c4a6e;
    line-height: 1.6;
    margin-bottom: 0;
    position: relative;
    z-index: 10;
}

.animate-float {
    animation: float 4s ease-in-out infinite;
}

@keyframes float {
    0%, 100% { transform: translateY(0px); }
    50% { transform: translateY(-10px); }
}


/* PERFORMANCE HUB BOTTOM CENTER (Enhanced Transparency) */
.performance-hub-fixed-bottom {
    position: fixed;
    bottom: 1rem;
    left: 50%;
    transform: translateX(-50%);
    width: 95%;
    max-width: 900px;
    background: rgba(255, 255, 255, 0.4); /* Ultra Transparent */
    backdrop-filter: blur(25px) saturate(200%);
    -webkit-backdrop-filter: blur(25px) saturate(200%);
    border: 1px solid rgba(255, 255, 255, 0.5);
    border-radius: 30px;
    z-index: 1000;
    transition: all 0.5s cubic-bezier(0.16, 1, 0.3, 1);
    box-shadow: 0 20px 50px rgba(0,0,0,0.1);
}

.performance-hub-fixed-bottom:hover {
    background: rgba(255, 255, 255, 0.6);
}

.main-play-sphere {
    width: 50px;
    height: 50px;
    border-radius: 50%;
    background: #2563eb;
    color: white;
    border: none;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.2rem;
    box-shadow: 0 10px 20px rgba(37, 99, 235, 0.3);
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
}

.main-play-sphere:hover {
    transform: scale(1.1);
    background: #1d4ed8;
    box-shadow: 0 15px 30px rgba(37, 99, 235, 0.4);
}

.timestamp-label {
    font-size: 0.65rem;
    font-weight: 800;
    color: #475569;
    letter-spacing: 0.5px;
}

.slider-container {
    position: relative;
    height: 6px;
    background: rgba(0,0,0,0.05);
    border-radius: 10px;
    display: flex;
    align-items: center;
}

.premium-scrubber {
    position: absolute;
    width: 100%;
    height: 100%;
    -webkit-appearance: none;
    background: transparent;
    z-index: 10;
    cursor: pointer;
}

.premium-scrubber::-webkit-slider-thumb {
    -webkit-appearance: none;
    width: 14px;
    height: 14px;
    border-radius: 50%;
    background: #2563eb;
    border: 2px solid white;
    box-shadow: 0 0 10px rgba(0,0,0,0.1);
    cursor: pointer;
    transition: transform 0.2s;
}

.premium-scrubber:hover::-webkit-slider-thumb {
    transform: scale(1.3);
}

.progress-bar-fill {
    position: absolute;
    height: 100%;
    background: #2563eb;
    border-radius: 10px;
    width: 0%;
    pointer-events: none;
}

.volume-slider-mini {
    width: 80px;
    height: 4px;
}

.hub-mini-btn {
    padding: 6px 12px;
    border: none;
    background: transparent;
    color: #64748b;
    font-size: 0.65rem;
    font-weight: 800;
    text-transform: uppercase;
    border-radius: 10px;
    transition: all 0.2s;
    display: flex;
    align-items: center;
    gap: 4px;
}

.hub-mini-btn:hover {
    background: rgba(37, 99, 235, 0.05);
    color: #2563eb;
}

.hub-mini-btn.active {
    background: white;
    color: #2563eb;
    box-shadow: 0 4px 12px rgba(0,0,0,0.05);
}

.hub-download-btn {
    background: #0f172a;
    color: white;
    border: none;
    padding: 10px 30px;
    border-radius: 50px;
    font-size: 0.75rem;
    font-weight: 800;
    text-transform: uppercase;
    letter-spacing: 1px;
    transition: all 0.3s;
}

.hub-download-btn:hover {
    background: #2563eb;
    transform: translateY(-2px);
    box-shadow: 0 10px 20px rgba(37, 99, 235, 0.2);
}

/* STAND VIEWPORT */
.music-stand-master-view {
    padding-bottom: 200px; /* Space for fixed hub */
}

.workspace-btn:hover {
    transform: translateY(-3px);
    box-shadow: 0 10px 20px rgba(0,0,0,0.1);
    color: #2563eb;
    border-color: #2563eb;
}

.workspace-btn.active {
    background: #2563eb;
    color: white;
    border-color: #2563eb;
}

/* DARK MODE SYSTEM */
body.night-mode {
    background-color: #0f172a;
}

body.night-mode .main-glass-card {
    background: rgba(30, 41, 59, 0.8);
    border: 1px solid rgba(255,255,255,0.05);
}

body.night-mode .sidebar-card,
body.night-mode .sidebar-workspace-wrapper {
    background: #1e293b !important;
    border-color: rgba(255,255,255,0.05) !important;
}

body.night-mode .text-slate-800, 
body.night-mode .text-slate-700,
body.night-mode h4 {
    color: #f1f5f9 !important;
}

body.night-mode .digital-music-stand {
    background: #111827 !important;
    border: 1px solid rgba(255,255,255,0.1);
}

body.night-mode .workspace-btn {
    background: #334155;
    border-color: #475569;
    color: #cbd5e1;
}

/* STAGE MODE (FULLSCREEN) */
.stage-mode .sidebar-column {
    display: none !important;
}

.stage-mode .music-stand-column {
    flex: 0 0 100% !important;
    max-width: 100% !important;
}

.stage-mode .main-workspace-root {
    padding: 1rem !important;
}

/* MOBILE RESPONSIVENESS (VERTICAL DRAWER) */
@media (max-width: 991px) {
    .sidebar-workspace-wrapper, .music-stand-workspace-wrapper {
        position: relative !important;
        top: 0 !important;
        height: auto !important;
        max-height: none !important;
    }
    
    .sidebar-column {
        order: 2; /* Move info below sheet music on mobile */
    }
    
    .music-stand-column {
        order: 1;
        margin-bottom: 2rem;
    }
    
    .performance-dock-static {
        position: sticky;
        bottom: 0;
        z-index: 1000;
        background: white;
        margin: 0 -1.5rem;
        padding: 1rem 1.5rem;
        box-shadow: 0 -10px 30px rgba(0,0,0,0.1);
    }
    
    body.night-mode .performance-dock-static {
        background: #1e293b;
    }
}

.h-100 { height: 100%; }

.sidebar-meta-wrap {
    padding-bottom: 10px;
}

.audio-btn, .view-btn {
    transition: all 0.3s cubic-bezier(0.19, 1, 0.22, 1);
}

.audio-btn.active {
    background: #2563eb !important;
    color: white !important;
    box-shadow: 0 10px 25px rgba(37, 99, 235, 0.3);
    transform: scale(1.02);
}

.view-btn.active {
    background: #0f172a !important;
    color: white !important;
    box-shadow: 0 10px 20px rgba(15, 23, 42, 0.3);
    transform: scale(1.02);
}

/* CUSTOM SCROLLBARS FOR WORKSPACE */
.custom-scrollbar::-webkit-scrollbar {
    width: 6px;
    background: transparent;
}

.custom-scrollbar::-webkit-scrollbar-thumb {
    background: rgba(0,0,0,0.1);
    border-radius: 10px;
}

.custom-scrollbar::-webkit-scrollbar-track {
    background: transparent;
}

.audio-btn {
    background: #ffffff;
    border: 1px solid #e2e8f0;
    color: #64748b;
    box-shadow: 0 4px 6px rgba(0,0,0,0.02);
}

.audio-btn:hover {
    background: #f8fafc;
    color: #2563eb;
    transform: translateY(-2px);
}

.audio-btn.active {
    background: #2563eb !important;
    color: white !important;
    border-color: #2563eb !important;
    box-shadow: 0 8px 20px rgba(37, 99, 235, 0.3);
}

.view-btn {
    background: #f1f5f9;
    border: 1px solid transparent;
    color: #475569;
}

.view-btn.active {
    background: #1e293b !important;
    color: white !important;
    box-shadow: 0 8px 15px rgba(30, 41, 59, 0.2);
}

.btn-premium-dark {
    background: #1e293b;
    color: white;
    border: none;
    transition: all 0.3s;
    font-size: 0.75rem;
}

.btn-premium-dark:hover {
    background: #0f172a;
    transform: translateY(-2px);
    box-shadow: 0 12px 25px rgba(0,0,0,0.2);
}

.active-scale:active {
    transform: scale(0.95);
}

/* CUSTOM SCROLLBARS FOR WORKSPACE */
.custom-scrollbar::-webkit-scrollbar {
    width: 0px; 
    background: transparent;
}

.h-full { height: 100%; }

.performance-hub-bottom {
    display: none !important;
}

.language-pill-sidebar {
    padding: 6px 12px;
    background: #f8fafc;
    border: 1px solid #e2e8f0;
    border-radius: 10px;
    color: #475569;
    font-size: 0.75rem;
    font-weight: 700;
    text-decoration: none !important;
    transition: all 0.2s;
}

.language-pill-sidebar:hover { background: #f1f5f9; color: #1e293b; }
.language-pill-sidebar.active { background: #3b82f6; color: white; border-color: #3b82f6; }

.badge-pill-sidebar {
    padding: 4px 10px;
    background: #f1f5f9;
    border-radius: 6px;
    font-size: 0.7rem;
    font-weight: 800;
    color: #64748b;
}

.sidebar-btn-group {
    background: #f8fafc !important;
    border: 1px solid #e2e8f0;
}

.sidebar-btn-group .track-tab {
    font-size: 0.75rem;
    padding: 8px 12px;
}

.sidebar-credit-label {
    font-size: 0.65rem;
    font-weight: 800;
    color: #94a3b8;
    text-transform: uppercase;
    display: flex;
    align-items: center;
    gap: 5px;
    margin-bottom: 2px;
}

.sidebar-credit-value {
    font-size: 0.85rem;
    font-weight: 700;
    color: #1e293b;
}

.creator-item-inline { cursor: pointer; transition: color 0.2s; }
.creator-item-inline:hover { color: #3b82f6; text-decoration: underline; }

.verse-panel-sidebar {
    background: #f8fafc;
    border-radius: 12px;
    padding: 15px;
    font-size: 0.85rem;
}

.digital-music-stand {
    background: white;
    padding: 2rem 1.5rem;
    border-radius: 2.5rem;
    min-height: 90vh;
    border: 1px solid rgba(0,0,0,0.05);
    display: flex;
    justify-content: center;
}
.score-render-area-new canvas {
    width: 100% !important; /* Back to full width */
    max-width: 100%;
    height: auto !important;
    margin-bottom: 2.5rem;
    box-shadow: 0 15px 45px rgba(0,0,0,0.1);
}

.score-render-area-new {
    display: flex;
    flex-direction: column;
    align-items: center;
}

.score-render-area-new canvas {
    width: 100% !important;
    height: auto !important;
    margin-bottom: 2rem;
    box-shadow: 0 10px 30px rgba(0,0,0,0.05);
}

.lyrics-view-centered {
    width: 100%;
    margin-top: 1rem;
    padding: 2rem;
}

.premium-hover-card {
    position: fixed;
    z-index: 3000;
    pointer-events: none;
    opacity: 0;
    transform: translateY(10px);
    transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
}
.premium-hover-card.show {
    opacity: 1;
    transform: translateY(0);
}
.creator-hover-wrapper {
    width: 320px;
    background: rgba(255, 255, 255, 0.9);
    backdrop-filter: blur(20px);
    border-radius: 24px;
    border: 1px solid rgba(255, 255, 255, 0.5);
    box-shadow: 0 20px 50px rgba(0,0,0,0.15);
    overflow: hidden;
    display: flex;
    flex-direction: column;
}
.creator-hover-img {
    width: 100%;
    height: 180px;
    object-fit: cover;
}
.creator-hover-content {
    padding: 1.5rem;
}
.creator-hover-badge {
    display: inline-block;
    padding: 4px 12px;
    background: #eff6ff;
    color: #2563eb;
    border-radius: 100px;
    font-size: 0.7rem;
    font-weight: 800;
    text-transform: uppercase;
    margin-bottom: 0.75rem;
}
.creator-hover-title {
    font-size: 1.25rem;
    font-weight: 900;
    color: #1e293b;
    margin-bottom: 0.5rem;
}
.creator-hover-meta {
    display: flex;
    flex-direction: column;
    gap: 4px;
    margin-bottom: 1rem;
}
.creator-hover-meta span {
    font-size: 0.75rem;
    color: #64748b;
    display: flex;
    align-items: center;
    gap: 6px;
}
.creator-hover-bio {
    font-size: 0.8rem;
    color: #475569;
    line-height: 1.5;
    background: #f8fafc;
    padding: 12px;
    border-radius: 12px;
    font-style: italic;
}
.repo-badge {
    display: inline-block;
    font-size: 0.65rem;
    font-weight: 900;
    text-transform: uppercase;
    color: #94a3b8;
    letter-spacing: 2px;
}
.lyrics-view-centered {
    width: 100%;
    display: flex;
    justify-content: center;
    padding: 2rem 1rem;
}

.lyrics-card {
    background: #fdfdfd;
    border: 1px solid #f1f5f9;
    padding: 3rem;
    border-radius: 2rem;
    text-align: center;
    font-size: 1.5rem;
    line-height: 2;
    color: #1e293b;
    font-weight: 600;
    max-width: 700px;
    width: 100%;
    font-family: 'Outfit', sans-serif;
    box-shadow: 0 10px 40px rgba(0,0,0,0.02);
}

.fade-in {
    animation: fadeIn 0.5s ease-out;
}

@keyframes fadeIn {
    from { opacity: 0; transform: translateY(10px); }
    to { opacity: 1; transform: translateY(0); }
}
/* Mobile Responsiveness */
@media (max-width: 991px) {
    .sidebar-sticky {
        position: relative;
        top: 0;
    }
    
    .digital-music-stand {
        padding: 1rem;
        margin-top: 1.5rem;
    }
}

@media (max-width: 768px) {
    .floating-action-group {
        left: auto;
        right: 1.5rem;
        top: auto;
        bottom: 120px;
        flex-direction: row;
        transform: none;
    }
    
    .floating-action-btn {
        width: 50px;
        height: 50px;
        font-size: 1.1rem;
    }
    
    .details-drawer {
        left: -100vw;
        width: 100vw;
        max-width: 100vw;
    }
    
    .center-spotlight-panel {
        width: 95vw;
        max-width: 95vw;
    }
    
    .spotlight-hero-text {
        font-size: 2.5rem;
    }
    
    .performance-hub-fixed-bottom {
        bottom: 0 !important;
        border-radius: 20px 20px 0 0 !important;
        width: 100% !important;
        max-width: 100% !important;
        border-bottom: none !important;
        border-left: none !important;
        border-right: none !important;
        box-shadow: 0 -10px 30px rgba(0,0,0,0.1) !important;
    }
    .btn-group-premium {
        transform: scale(0.9);
        width: 100%;
        display: flex;
        flex-wrap: nowrap !important;
        justify-content: space-between !important;
        padding: 4px !important;
    }
    .hub-mini-btn {
        flex: 1 1 0;
        padding: 4px 0 !important;
        font-size: 0.55rem !important;
        flex-direction: column !important;
        justify-content: center !important;
    }
    .hub-mini-btn i {
        font-size: 1rem !important;
        margin-bottom: 2px !important;
        margin-right: 0 !important;
    }
    .hub-mini-btn span {
        display: none !important; /* On really small screens, hide the text and leave icons */
    }
    @media (min-width: 400px) {
        .hub-mini-btn span {
            display: inline-block !important; /* Show text again if slightly wider phone */
            font-size: 0.55rem;
        }
    }
    .custom-premium-player {
        padding: 0 0.5rem !important;
        width: 100%;
    }
    .main-play-sphere {
        width: 45px !important;
        height: 45px !important;
        font-size: 1.1rem !important;
    }
    .timestamp-label {
        font-size: 0.6rem !important;
        font-weight: 700 !important;
    }
    .premium-scrubber {
        height: 6px !important;
    }
    .progress-bar-fill {
        height: 6px !important;
    }
    .masterpiece-workspace-new {
        padding-bottom: 160px; /* Give room at bottom so PDF isn't hidden by player */
    }
    .digital-music-stand {
        margin-bottom: 30px;
    }
}

body { 
    background: linear-gradient(135deg, #64B5D6 0%, #3E6D9C 100%) !important; 
    background-attachment: fixed !important; 
    min-height: 100vh;
}

body::before {
    content: "";
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-image: 
        radial-gradient(circle at 2px 2px, rgba(255,255,255,0.05) 1px, transparent 0);
    background-size: 32px 32px;
    pointer-events: none;
    z-index: 0;
}
</style>

<!-- Masterpiece Workspace (Refactored Container) -->
<div class="masterpiece-workspace-new mt-4">
    <!-- Row injected by HTML section above -->
</div>


<link rel="stylesheet" href="https://cdn.plyr.io/3.6.8/plyr.css" />
<script src="https://cdn.plyr.io/3.6.8/plyr.polyfilled.js"></script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.11.338/pdf.min.js"></script>
<!-- JavaScript/jQuery to handle tab switching -->
<script>
$(document).ready(function() {
    // Initial rendering based on active tab
    const initialPath = $('.tab-button.active').data('path');
    if (initialPath) {
        renderContent(initialPath);
    }


        // Handle tab button click
        $('.tab-button-mp3').click(function() {
            // Remove active class from all buttons
            $('.tab-button-mp3').removeClass('active');
            // Add active class to the clicked button
            $(this).addClass('active');
            
            const path = $(this).data('path');
            switchTrack(path);
        });

        // Robust Global Switch Track
        window.switchTrack = function(path) {
            const musicPlayer = document.getElementById('musicPlayer');
            const mainPlayBtn = document.getElementById('mainPlayBtn');
            const pb = document.getElementById('progressBar');
            const pf = document.getElementById('progressFill');
            const ct = document.getElementById('currentTime');
            
            if (path && musicPlayer) {
                musicPlayer.src = path;
                musicPlayer.load();
                
                // Scrub UI Reset
                if(pb) pb.value = 0;
                if(pf) pf.style.width = '0%';
                if(ct) ct.textContent = '0:00';
                if(mainPlayBtn) mainPlayBtn.innerHTML = '<i class="fas fa-play"></i>';
            }
        }

        // Initial track load
        const activeMp3 = $('.tab-button-mp3.active').data('path');
        if (activeMp3) switchTrack(activeMp3);

        const musicPlayer = document.getElementById('musicPlayer');
        let hasLoggedPlay = false;

        musicPlayer.addEventListener('play', function() {
            if (!hasLoggedPlay) {
                $.post('{{ route("musics.log_play", $music->id) }}', {
                    _token: '{{ csrf_token() }}'
                }).done(function() {
                    hasLoggedPlay = true;
                    console.log('Play logged successfully');
                });
            }
        });

        // Reset log flag when track changes
        $('.tab-button-mp3').click(function() {
            hasLoggedPlay = false;
        });

        // Auto-scroll logic for tab switching
        function scrollToStandTop() {
            const stand = document.querySelector('.digital-music-stand');
            if (stand) {
                stand.scrollIntoView({ behavior: 'smooth', block: 'start' });
            }
        }

        // Download Logic
        $('#downloadButton').click(function() {
            const activeTab = $('.tab-button-mp3.active');
            const path = activeTab.data('path');
            if (path) {
                const title = '{{ $music->title }}';
                const trackType = activeTab.text().trim();
                const link = document.createElement('a');
                link.href = path;
                link.download = `${title}_${trackType}`;
                link.click();
            }
        });



    // Handle tab button click
    $('.tab-button').click(function() {
        // Remove active class from all buttons
        $('.tab-button').removeClass('active');

        // Add active class to the clicked button
        $(this).addClass('active');

        // Get the path from the button's data attribute
        var path = $(this).data('path');

        // Render content based on the clicked button's path
        renderContent(path);
        scrollToStandTop();
    });

    // Function to render content (PDF or lyrics) based on path
    function renderContent(path) {
        if (path.toLowerCase().endsWith('.pdf')) {
            // Display PDF content
            renderPDF(path);
        } else {
            // Display lyrics content
            renderLyrics(path);
        }
    }

    let currentScale = 1.35; // Increased scale for 'fitted' but large look

    // Function to render PDF content
    function renderPDF(pdfPath) {
        // Clear the PDF container
        $('#pdf-container').empty();

        // Use PDF.js to render the PDF
        pdfjsLib.getDocument(pdfPath).promise.then(function(pdf) {
            // Loop through each page and render it
            for (let pageNum = 1; pageNum <= pdf.numPages; pageNum++) {
                pdf.getPage(pageNum).then(function(page) {
                    var viewport = page.getViewport({ scale: currentScale });
                    
                    // Create a canvas for each page
                    var canvas = document.createElement('canvas');
                    canvas.width = viewport.width;
                    canvas.height = viewport.height;
                    $('#pdf-container').append(canvas);

                    var context = canvas.getContext('2d');

                    var renderContext = {
                        canvasContext: context,
                        viewport: viewport
                    };

                    page.render(renderContext);
                });
            }
        });
    }

function renderLyrics(lyricsPath) {
    const container = $('#pdf-container');
    container.html('<div class="animate-pulse text-slate-400 p-8 text-center"><i class="fas fa-circle-notch fa-spin mr-2"></i> Transcribing lyrics...</div>');

    $.ajax({
        url: lyricsPath,
        success: function(data) {
            const lyricsHtml = `<div class="lyrics-view-centered fade-in">
                <div class="lyrics-card shadow-sm">
                    ${data.replace(/\n/g, '<br>')}
                </div>
            </div>`;
            container.html(lyricsHtml);
        },
        error: function() {
            container.html('<div class="error-msg p-8 text-center text-red-500"><i class="fas fa-exclamation-circle mr-2"></i> Failed to load lyrics.</div>');
        }
    });
}

});
</script>

<style>
/* PREMIUM PLAYLIST DRAWER STYLES */
#playlistModal {
    position: fixed;
    top: 0;
    left: -450px;
    width: 400px;
    height: 100vh;
    background: rgba(255, 255, 255, 0.7);
    backdrop-filter: blur(30px) saturate(180%);
    -webkit-backdrop-filter: blur(30px) saturate(180%);
    z-index: 2000;
    box-shadow: 15px 0 50px rgba(0,0,0,0.15);
    transition: all 0.5s cubic-bezier(0.16, 1, 0.3, 1);
    display: none; /* Strictly hidden by default */
    flex-direction: column;
    padding: 0;
    margin: 0;
    border-right: 1px solid rgba(255, 255, 255, 0.4);
}

#playlistModal.show-drawer {
    display: flex; /* Show only when toggled */
    left: 0;
}

#playlistBG {
    height: 100%;
    display: flex;
    flex-direction: column;
    background: transparent !important;
    padding: 2rem 1.5rem;
}

.playlist-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 2rem;
    padding-bottom: 1rem;
    border-bottom: 1px solid #f1f5f9;
}

.playlist-header h2 {
    font-size: 1.5rem;
    font-weight: 900;
    color: #1e293b;
    margin: 0;
    text-transform: uppercase;
    letter-spacing: -0.5px;
}

#playlistable {
    background: white;
    border-radius: 16px;
    padding: 0;
    margin-bottom: 1.5rem;
    border: 1px solid #f1f5f9;
    box-shadow: 0 4px 15px rgba(0,0,0,0.03);
    overflow: hidden;
}

.playlist-title-banner {
    background: #f8fafc;
    padding: 12px;
    font-weight: 800;
    color: #475569;
    border-bottom: 1px solid #f1f5f9;
    font-size: 0.9rem;
    text-transform: uppercase;
}

.playlist-table {
    width: 100%;
    border-collapse: separate;
    border-spacing: 0;
}

/* PLAYLIST ROW ENHANCEMENTS */
.playlist-row-item {
    display: flex;
    align-items: center;
    padding: 12px 16px;
    margin: 4px 8px;
    border-radius: 14px;
    transition: all 0.3s;
    cursor: pointer;
    background: rgba(255,255,255,0.4);
    border: 1px solid transparent;
}

.playlist-row-item:hover {
    background: white;
    transform: translateX(5px);
    box-shadow: 0 5px 15px rgba(0,0,0,0.05);
    border-color: #e2e8f0;
}

.playlist-row-item.active {
    background: white;
    border-color: #2563eb;
    box-shadow: 0 10px 25px rgba(37, 99, 235, 0.1);
}

.playlist-art-wrap {
    width: 45px;
    height: 45px;
    border-radius: 10px;
    background: #f1f5f9;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-right: 15px;
    color: #94a3b8;
    position: relative;
    overflow: hidden;
}

.active .playlist-art-wrap {
    background: #eff6ff;
    color: #2563eb;
}

.playlist-track-info {
    flex-grow: 1;
}

.playlist-track-title {
    font-weight: 800;
    color: #1e293b;
    font-size: 0.85rem;
    display: block;
    margin-bottom: 2px;
}

.playlist-track-meta {
    font-size: 0.7rem;
    color: #94a3b8;
    font-weight: 600;
}

.playlist-track-num {
    font-size: 0.75rem;
    font-weight: 900;
    color: #cbd5e1;
    margin-right: 15px;
    width: 20px;
}

.active .playlist-track-num {
    color: #2563eb;
}


.playlist-overlay {
    position: fixed;
    top: 0;
    left: 0;
    width: 100vw;
    height: 100vh;
    background: rgba(0,0,0,0.3);
    backdrop-filter: blur(4px);
    z-index: 1900;
    display: none; /* Hide element completely */
    transition: opacity 0.3s;
}

.playlist-overlay.active {
    display: block; /* Show as block for overlay effect */
}

@media (max-width: 500px) {
    #playlistModal {
        width: 100%;
        left: -100%;
    }
}
.creator-item-inline {
    cursor: pointer;
    color: #2563eb;
    text-decoration: none;
    transition: all 0.3s;
    font-weight: 700;
    padding: 2px 8px;
    border-radius: 6px;
    display: inline-block;
}
.creator-item-inline:hover {
    color: white;
    background: #2563eb;
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(37, 99, 235, 0.2);
}


</style>

<div id="playlistOverlay" class="playlist-overlay"></div>

<div id="playlistModal">
    <div id="playlistBG">
        <div class="playlist-header">
            <h2>Playlist</h2>
            <button id="closeModal" class="text-slate-400 hover:text-slate-600 transition-colors">
                <i class="fas fa-times text-xl"></i>
            </button>
        </div>
        <div id="playlistsContent"></div>
    </div>
</div>


<script>
/**
 * --- HYMN SHOW PAGE MASTER ORCHESTRATOR ---
 * Handles: Custom Player, Seeker, Playlist Drawer, and Details Drawer.
 */
document.addEventListener('DOMContentLoaded', () => {
    // UI Element Refs
    const musicPlayer = document.getElementById('musicPlayer');
    const mainPlayBtn = document.getElementById('mainPlayBtn');
    const playlistButton = document.getElementById('playlistButton');
    const playlistModal = document.getElementById('playlistModal');
    const closeModal = document.getElementById('closeModal');
    const playlistsContent = document.getElementById('playlistsContent');
    const playlistOverlay = document.getElementById('playlistOverlay');
    const toggleDetails = document.getElementById('toggleDetails');
    const detailsDrawer = document.getElementById('detailsDrawer');
    const closeDetails = document.getElementById('closeDetails');
    const detailsOverlay = document.getElementById('detailsOverlay');
    const progressBar = document.getElementById('progressBar');
    const progressFill = document.getElementById('progressFill');
    const currentTimeEl = document.getElementById('currentTime');
    const totalDurationEl = document.getElementById('totalDuration');
    const volumeBar = document.getElementById('volumeBar');

    const urlParams = new URLSearchParams(window.location.search);
    const playlistId = urlParams.get('playlist_id');

    // 1. PLAYLIST ENGINE & VISIBILITY
    if (playlistId && playlistId !== 'null' && playlistId !== '') {
        fetch(`/playlists?playlist_id=${playlistId}`)
            .then(res => res.json())
            .then(data => {
                let content = '';
                if (data.playlists && data.playlists.length > 0) {
                    data.playlists.forEach(playlist => {
                        content += `
                        <div id='playlistable' class="bg-transparent border-0 shadow-none">
                            <div class="playlist-header-mini px-3 mb-3 d-flex align-items-center justify-content-between">
                                <span class="text-xs font-black uppercase tracking-widest text-slate-400">${playlist.name}</span>
                                <span class="badge py-1 px-2 bg-slate-100 text-slate-500 rounded-lg text-xs font-black">${playlist.musics.length} TRACKS</span>
                            </div>
                            <div class="playlist-modern-list pb-4">`;
                        
                        playlist.musics.forEach((music, index) => {
                            const isCurrent = window.location.href.includes(`/musics/${music.id}`);
                            content += `
                            <div class="playlist-row-item ${isCurrent ? 'active' : ''}" onclick="window.location.href='/musics/${music.id}?playlist_id=${playlist.id}&autoplay=true'">
                                <div class="playlist-track-num">${(index + 1).toString().padStart(2, '0')}</div>
                                <div class="playlist-art-wrap">
                                    <i class="fas ${isCurrent ? 'fa-volume-up' : 'fa-music'}"></i>
                                    <div class="eq-container-${music.id} absolute"></div>
                                </div>
                                <div class="playlist-track-info">
                                    <span class="playlist-track-title">${music.title}</span>
                                    <div class="playlist-track-meta">
                                        <span><i class="fas fa-hashtag mr-1"></i>${music.song_number ?? 'N/A'}</span>
                                    </div>
                                </div>
                                <div class="playlist-action pr-1">
                                    <i class="fas fa-chevron-right text-slate-200 text-xs"></i>
                                </div>
                            </div>`;
                        });
                        content += `</div></div>`;
                    });
                    
                    playlistsContent.innerHTML = content;
                    const rows = playlistsContent.querySelectorAll('.playlist-row-item');
                    if (rows.length > 0 && playlistButton) {
                        playlistButton.classList.remove('hidden');
                        playlistButton.style.display = 'flex'; // Ensure visible
                    }
                }
            })
            .catch(err => console.error("Playlist Fetch Error:", err));
    }

    // 2. CUSTOM AUDIO PLAYER LOGIC
    if (musicPlayer) {
        const formatTime = (s) => isNaN(s) ? "0:00" : `${Math.floor(s / 60)}:${Math.floor(s % 60).toString().padStart(2, '0')}`;

        // Play/Pause Control
        if (mainPlayBtn) {
            mainPlayBtn.addEventListener('click', () => {
                if (musicPlayer.paused) musicPlayer.play();
                else musicPlayer.pause();
            });
        }

        // Sync Seek Bar & Timestamps
        musicPlayer.addEventListener('timeupdate', () => {
            if (musicPlayer.duration) {
                const percent = (musicPlayer.currentTime / musicPlayer.duration) * 100;
                if (progressBar) progressBar.value = percent;
                if (progressFill) progressFill.style.width = percent + '%';
                if (currentTimeEl) currentTimeEl.textContent = formatTime(musicPlayer.currentTime);
            }
        });

        musicPlayer.addEventListener('loadedmetadata', () => {
            if (totalDurationEl) totalDurationEl.textContent = formatTime(musicPlayer.duration);
        });

        // Sync Play/Pause Icons
        musicPlayer.addEventListener('play', () => { if (mainPlayBtn) mainPlayBtn.innerHTML = '<i class="fas fa-pause"></i>'; });
        musicPlayer.addEventListener('pause', () => { if (mainPlayBtn) mainPlayBtn.innerHTML = '<i class="fas fa-play"></i>'; });

        // Auto-advance Playlist
        musicPlayer.addEventListener('ended', () => { playNextTrack(); });

        // User Seeking (Scrubbing)
        if (progressBar) {
            progressBar.addEventListener('input', () => {
                if (musicPlayer.duration) {
                    const seekTo = (progressBar.value / 100) * musicPlayer.duration;
                    if (progressFill) progressFill.style.width = progressBar.value + '%';
                    if (currentTimeEl) currentTimeEl.textContent = formatTime(seekTo);
                }
            });
            progressBar.addEventListener('change', () => {
                if (musicPlayer.duration) musicPlayer.currentTime = (progressBar.value / 100) * musicPlayer.duration;
            });
        }

        // Volume
        if (volumeBar) {
            volumeBar.addEventListener('input', () => { musicPlayer.volume = volumeBar.value; });
        }

        // Handle Autoplay from URL
        if (urlParams.get('autoplay') === 'true') {
            musicPlayer.addEventListener('canplay', () => {
                musicPlayer.play().catch(e => console.log("Autoplay blocked by browser policy."));
            }, { once: true });
        }
    }

    // 3. UI DRAWER CONTROLS
    // Playlist Modal
    if (playlistButton) {
        playlistButton.addEventListener('click', () => {
            if(playlistModal) playlistModal.classList.toggle('show-drawer');
            if(playlistOverlay) playlistOverlay.classList.toggle('active');
        });
    }

    if (closeModal) {
        closeModal.addEventListener('click', () => {
            if(playlistModal) playlistModal.classList.remove('show-drawer');
            if(playlistOverlay) playlistOverlay.classList.remove('active');
        });
    }

    if (playlistOverlay) {
        playlistOverlay.addEventListener('click', () => {
            if(playlistModal) playlistModal.classList.remove('show-drawer');
            if(playlistOverlay) playlistOverlay.classList.remove('active');
        });
    }

    // Multi-Mode Dynamic Spotlight Logic
    const centerSpotlight = document.getElementById('centerSpotlight');
    const spotlightHymn = document.getElementById('spotlightHymnInfo');
    const spotlightName = document.getElementById('spotlightNameInfo');
    const spotlightCreatorNameText = document.getElementById('spotlightCreatorName');
    const spotlightCreatorRoleText = document.getElementById('spotlightRole');

    const hymnTitleInSidebar = document.querySelector('.hymn-title-display');
    const creatorNameLinks = document.querySelectorAll('.creator-item-inline');

    // Toggle Sidebar on Click
    if (toggleDetails && detailsDrawer) {
        toggleDetails.addEventListener('click', () => {
            detailsDrawer.classList.toggle('open');
            toggleDetails.classList.toggle('active');
        });
    }

    // Reveal Full Hymn Info on Title Hover
    if (hymnTitleInSidebar && centerSpotlight && spotlightHymn && spotlightName) {
        hymnTitleInSidebar.addEventListener('mouseenter', () => {
            spotlightName.classList.add('hidden');
            spotlightHymn.classList.remove('hidden');
            centerSpotlight.classList.add('active');
            if(detailsOverlay) detailsOverlay.classList.add('active');
        });
        hymnTitleInSidebar.addEventListener('mouseleave', () => {
            centerSpotlight.classList.remove('active');
            if(detailsOverlay) detailsOverlay.classList.remove('active');
        });
    }

    // Reveal Creator Info on Per-Name Hover
    creatorNameLinks.forEach(link => {
        link.addEventListener('mouseenter', () => {
            const name = link.getAttribute('data-name');
            const role = link.getAttribute('data-role');
            
            if(spotlightCreatorNameText) spotlightCreatorNameText.textContent = name;
            if(spotlightCreatorRoleText) spotlightCreatorRoleText.textContent = role;
            
            // Handle extended details
            const duty = link.getAttribute('data-duty');
            const local = link.getAttribute('data-local');
            const district = link.getAttribute('data-district');
            const birthday = link.getAttribute('data-birthday');
            const image = link.getAttribute('data-image');
            const background = link.getAttribute('data-background');
            
            const imgEl = document.getElementById('spotlightCreatorImage');
            if(imgEl) {
                if(image) {
                    imgEl.src = image;
                    imgEl.classList.remove('hidden');
                } else {
                    imgEl.classList.add('hidden');
                }
            }

            const bgCont = document.getElementById('spotlightCreatorBackgroundContainer');
            if(bgCont) {
                if(background && background.trim() !== '') {
                    bgCont.classList.remove('hidden');
                    document.getElementById('spotlightCreatorBackground').textContent = background;
                } else {
                    bgCont.classList.add('hidden');
                }
            }
            
            const contDuty = document.getElementById('spotlightCreatorDutyContainer');
            if(contDuty) {
                if(duty) {
                    contDuty.classList.remove('hidden');
                    document.getElementById('spotlightCreatorDuty').textContent = duty;
                } else {
                    contDuty.classList.add('hidden');
                }
            }
            
            const contLoc = document.getElementById('spotlightCreatorLocationContainer');
            if(contLoc) {
                let locText = "";
                if(local) locText += local;
                if(local && district) locText += ", ";
                if(district) locText += district;
                
                if(locText) {
                    contLoc.classList.remove('hidden');
                    document.getElementById('spotlightCreatorLocation').textContent = locText;
                } else {
                    contLoc.classList.add('hidden');
                }
            }
            
            const contBday = document.getElementById('spotlightCreatorBirthdayContainer');
            if(contBday) {
                if(birthday) {
                    contBday.classList.remove('hidden');
                    document.getElementById('spotlightCreatorBirthday').textContent = birthday;
                } else {
                    contBday.classList.add('hidden');
                }
            }

            spotlightHymn.classList.add('hidden');
            spotlightName.classList.remove('hidden');
            spotlightName.classList.add('d-flex'); // Ensure flex centering

            centerSpotlight.classList.add('active');
            if(detailsOverlay) detailsOverlay.classList.add('active');
        });
        link.addEventListener('mouseleave', () => {
            centerSpotlight.classList.remove('active');
            if(detailsOverlay) detailsOverlay.classList.remove('active');
            
            // Clean up display mode
            setTimeout(() => {
                if(!centerSpotlight.classList.contains('active')) {
                    spotlightName.classList.remove('d-flex');
                }
            }, 500);
        });
    });

    if (closeDetails && detailsDrawer) {
        closeDetails.addEventListener('click', () => {
            detailsDrawer.classList.remove('open');
            toggleDetails.classList.remove('active');
        });
    }

    // Close on Outside Click
    document.addEventListener('click', (e) => {
        if (detailsDrawer && detailsDrawer.classList.contains('open')) {
            if (!detailsDrawer.contains(e.target) && !toggleDetails.contains(e.target)) {
                detailsDrawer.classList.remove('open');
                if(toggleDetails) toggleDetails.classList.remove('active');
                if(detailsOverlay) detailsOverlay.classList.remove('active');
            }
        }
    });

    // Close on Escape Key
    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape') {
            if (detailsDrawer) detailsDrawer.classList.remove('open');
            if (toggleDetails) toggleDetails.classList.remove('active');
            if (detailsOverlay) detailsOverlay.classList.remove('active');
            if (playlistModal) playlistModal.classList.remove('show-drawer');
            if (playlistOverlay) playlistOverlay.classList.remove('active');
        }
    });
});

/**
 * Global Helper for Playlist Navigation
 */
function playNextTrack() {
    const list = document.querySelector('.playlist-modern-list');
    if (!list) return;
    const tracks = Array.from(list.querySelectorAll('.playlist-row-item'));
    const currentIdx = tracks.findIndex(t => t.classList.contains('active'));
    if (currentIdx !== -1 && currentIdx < tracks.length - 1) {
        const next = tracks[currentIdx + 1];
        const match = next.getAttribute('onclick').match(/'([^']+)'/);
        if (match) window.location.href = match[1];
    }
}
</script>

<style>
.custom-scrollbar-premium::-webkit-scrollbar {
    width: 5px;
}
.custom-scrollbar-premium::-webkit-scrollbar-thumb {
    background: #e2e8f0;
    border-radius: 10px;
}
.custom-scrollbar-premium::-webkit-scrollbar-thumb:hover {
    background: #cbd5e1;
}

body.night-mode .custom-scrollbar-premium::-webkit-scrollbar-thumb {
    background: #475569;
}

/* PERFORMANCE DOCK STYLES */
.performance-dock-static {
    flex-shrink: 0;
    background: rgba(255,255,255,0.4);
    border-radius: 0 0 20px 20px;
}

.performance-control-plate {
    background: linear-gradient(135deg, rgba(255, 255, 255, 0.99) 0%, rgba(248, 250, 252, 0.96) 100%) !important;
    border: 1px solid white !important;
    border-radius: 24px !important;
    box-shadow: 0 -15px 40px rgba(0,0,0,0.08) !important;
}

body.night-mode .performance-control-plate {
    background: linear-gradient(135deg, #1e293b 0%, #0f172a 100%) !important;
    border-color: rgba(255,255,255,0.1) !important;
}

.hidden {
  display: none;
}
   .equalizer {
        display: inline-block;
        margin-left: 5px;
    }

   .bar {
        display: inline-block;
        width: 2px;
        height: 10px;
        background: linear-gradient(to bottom, #90ef52, #6ecf2e);
        background-size: 100% 200px;
        background-position: 0% 100%;
        animation: equalizer 1s infinite;
        margin: 0 1px;
    }

    @keyframes equalizer {
        0% {
            height: 10px;
            background-position: 0% 100%;
        }
        50% {
            height: 15px;
            background-position: 0% 50%;
        }
        100% {
            height: 10px;
            background-position: 0% 100%;
        }
    }
</style>

</x-app-layout>
