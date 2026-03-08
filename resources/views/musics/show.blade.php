<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

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
    <div class="py-2 sm:py-4">
        <div class="max-w-[90%] mx-auto sm:px-6 lg:px-8">
            <!-- Main Immersive Content Card -->
            <div class="main-glass-card shadow-2xl">
                <div class="p-6">
                    <!-- Internal Header (Standard Position) -->
                    <div class="flex justify-between items-center mb-4 pb-4 border-b border-gray-100 flex-wrap gap-4">
                        <div class="flex items-center gap-4">
                             <a href="{{ session()->has('url.intended') ? session('url.intended') : route('musics.index') }}" 
                               class="flex items-center gap-3 px-8 py-3 bg-slate-100 hover:bg-slate-200 text-slate-700 font-extrabold rounded-2xl transition-all active:scale-95 no-underline hover:text-slate-800 shadow-sm group">
                                <i class="fas fa-arrow-left text-lg transition-transform group-hover:-translate-x-1"></i>
                                <span class="hidden sm:inline">{{ __('Back') }}</span>
                            </a>
                            <div class="h-8 w-1 bg-blue-600 rounded-full mx-2"></div>
                            <h2 class="text-3xl font-black text-slate-800 uppercase tracking-tighter mb-0 flex items-center gap-3">
                                Music <span class="text-blue-600">Details</span>
                                <button id="showMusicDetailsBtn" class="premium-header-info-btn" title="View Masterpiece Details">
                                    <i class="fas fa-info-circle text-blue-500 hover:text-blue-600 transition-colors"></i>
                                </button>
                            </h2>
                        </div>
                    </div>



                

<!-- Music Details Glass Overlay Drawer -->
<div id="musicDetails" class="music-details-drawer glass-blur">
    <div class="drawer-header">
        <h3 class="drawer-title uppercase font-black tracking-widest">Hymn Masterpiece</h3>
        <button class="close-drawer" onclick="toggleDetails()">
            <i class="fas fa-times"></i>
        </button>
    </div>
    
    <div class="drawer-content p-6 scrollbar-hidden">
        <!-- Hymn Identity Section -->
        <div class="info-group mb-8 text-center">
            <span class="label-sm">Central Repository</span>
            <h4 class="font-black text-white uppercase leading-tight mt-1 mb-3" style="font-size: 1.5rem; letter-spacing: -0.5px;">{{ $music->title }}</h4>
            <div class="d-flex justify-content-center align-items-center gap-2">
                <span class="badge-pill-premium">Hymn #{{ $music->song_number }}</span>
            </div>
        </div>

        <!-- Language Selection (Internal) -->
        <div class="metadata-section mb-8">
            <div class="section-divider mb-4">
                <span>Available Editions</span>
            </div>
            <div class="d-flex flex-wrap gap-2 justify-content-center">
                @foreach($languages as $lang)
                    @php
                        $targetMusic = \App\Models\Music::where('song_number', $music->song_number)
                                                     ->where('language_id', $lang->id)
                                                     ->first();
                        $isCurrent = $lang->id == $music->language_id;
                    @endphp
                    @if($targetMusic)
                    <a href="{{ route('musics.show', ['id' => $targetMusic->id, 'languageId' => $lang->id, 'playlist_id' => $playlistId]) }}" 
                       class="language-pill {{ $isCurrent ? 'active' : '' }}">
                        {{ $lang->name }}
                    </a>
                    @endif
                @endforeach
            </div>
        </div>

        <!-- Details Grid -->
        <div class="metadata-section mb-8">
            <div class="section-divider mb-4">
                <span>Classification</span>
            </div>
            
            <div class="row g-3">
                <div class="col-12 mb-3">
                    <label class="custom-label">Categorization</label>
                    <div class="d-flex flex-wrap gap-2">
                        @forelse ($music->categories as $category)
                            <span class="badge-pill-glass">{{ $category->name }}</span>
                        @empty
                            <span class="text-white/40 text-xs italic">Uncategorized</span>
                        @endforelse
                    </div>
                </div>

                <div class="col-6 mb-3">
                    <label class="custom-label">Instrumentation</label>
                    <div class="d-flex flex-wrap gap-2">
                        @forelse ($music->instrumentations as $inst)
                            <span class="badge-pill-glass accent-gold">{{ $inst->name }}</span>
                        @empty
                            <span class="text-white/40 text-xs italic">Default</span>
                        @endforelse
                    </div>
                </div>

                <div class="col-6 mb-3">
                    <label class="custom-label">Ensemble</label>
                    <div class="d-flex flex-wrap gap-2">
                        @forelse ($music->ensembleTypes as $ens)
                            <span class="badge-pill-glass accent-blue">{{ $ens->name }}</span>
                        @empty
                            <span class="text-white/40 text-xs italic">Standard</span>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>

        @if (\App\Helpers\AccessRightsHelper::checkPermission('music_details.view_credits') == 'inline')
            <div class="metadata-section mb-8">
                <div class="section-divider mb-4">
                    <span>Creator Credits</span>
                </div>
                
                <div class="mb-4">
                    <label class="custom-label">Lyricist</label>
                    <ul class="creator-grid">
                        @forelse ($music->lyricists as $lyricist)
                            <li class="creator-item" data-creator-id="{{ $lyricist->id }}">
                                <i class="fas fa-feather-alt opacity-50 mr-2"></i> {{ $lyricist->name }}
                            </li>
                        @empty
                            <li class="text-white/40 text-xs italic">Credit Pending</li>
                        @endforelse
                    </ul>
                </div>

                <div class="mb-4">
                    <label class="custom-label">Composer</label>
                    <ul class="creator-grid">
                        @forelse ($music->composers as $composer)
                            <li class="creator-item" data-creator-id="{{ $composer->id }}">
                                <i class="fas fa-music opacity-50 mr-2"></i> {{ $composer->name }}
                            </li>
                        @empty
                            <li class="text-white/40 text-xs italic">Credit Pending</li>
                        @endforelse
                    </ul>
                </div>

                <div class="mb-4">
                    <label class="custom-label">Arranger</label>
                    <ul class="creator-grid">
                        @forelse ($music->arrangers as $arranger)
                            <li class="creator-item" data-creator-id="{{ $arranger->id }}">
                                <i class="fas fa-pencil-ruler opacity-50 mr-2"></i> {{ $arranger->name }}
                            </li>
                        @empty
                            <li class="text-white/40 text-xs italic">Credit Pending</li>
                        @endforelse
                    </ul>
                </div>
            </div>
        @endif

        <div class="metadata-section mb-10">
            <div class="section-divider mb-4">
                <span>Scriptural Basis</span>
            </div>
            <div class="verse-panel">
                <i class="fas fa-quote-left mb-2 opacity-30 gold-icon"></i>
                <p class="text-sm font-medium italic leading-relaxed">
                    {{ $music->verses_used ?: 'No specific scriptural references documented for this masterpiece.' }}
                </p>
            </div>
        </div>
    </div>
</div>





<style>
/* PREMIUM UI ENHANCEMENTS */
.glass-blur {
    backdrop-filter: blur(15px);
    -webkit-backdrop-filter: blur(15px);
}

.premium-info-trigger {
    position: fixed;
    left: 20px;
    top: 50%;
    transform: translateY(-50%);
    width: 60px;
    height: 60px;
    background: #007bff;
    color: white;
    border: 4px solid rgba(255,255,255,0.8);
    border-radius: 50%;
    font-size: 24px;
    cursor: pointer;
    z-index: 1050;
    box-shadow: 0 10px 30px rgba(0, 123, 255, 0.4);
    transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    display: flex;
    align-items: center;
    justify-content: center;
}

.premium-info-trigger:hover {
    transform: translateY(-50%) scale(1.1) rotate(15deg);
    box-shadow: 0 15px 40px rgba(0, 123, 255, 0.6);
}

.music-details-drawer {
    position: fixed;
    top: 0;
    left: 0;
    width: 440px;
    height: 100vh;
    z-index: 2050;
    border-right: 1px solid rgba(255,255,255,0.3);
    transform: translateX(-100%);
    transition: transform 0.6s cubic-bezier(0.16, 1, 0.3, 1);
    box-shadow: 20px 0 80px rgba(0,0,0,0.3);
    /* Lighter Dashboard Gradient */
    background: linear-gradient(to bottom, #82D1F0 0%, #4E9BCA 100%);
}

.music-details-drawer.active {
    transform: translateX(0);
}

.drawer-header {
    padding: 30px 40px;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.drawer-title { font-size: 0.8rem; font-weight: 950; color: white; margin: 0; }

.language-pill {
    padding: 8px 16px;
    background: rgba(255,255,255,0.1);
    border: 1px solid rgba(255,255,255,0.2);
    border-radius: 12px;
    color: white;
    font-size: 0.85rem;
    font-weight: 700;
    text-decoration: none !important;
    transition: all 0.3s;
}

.language-pill:hover { background: rgba(255,255,255,0.25); color: white; transform: translateY(-2px); }
.language-pill.active { background: white; color: #3E6D9C; border-color: white; box-shadow: 0 10px 20px rgba(0,0,0,0.1); }

.gold-icon { color: #FFD700; }

.close-drawer {
    width: 36px;
    height: 36px;
    border-radius: 50%;
    background: rgba(255,255,255,0.2);
    border: none;
    color: white;
    cursor: pointer;
    transition: all 0.2s;
}

.close-drawer:hover { background: rgba(255,255,255,0.3); }

.label-sm { font-size: 0.7rem; font-weight: 800; color: rgba(255,255,255,0.6); text-transform: uppercase; letter-spacing: 2px; }

.badge-pill-premium {
    padding: 6px 14px;
    background: rgba(255,255,255,0.15);
    color: white;
    border-radius: 50px;
    font-size: 0.75rem;
    font-weight: 900;
    border: 1px solid rgba(255,255,255,0.1);
}

.badge-pill-premium.secondary { background: rgba(255,255,255,0.05); color: rgba(255,255,255,0.8); }

.section-divider {
    display: flex;
    align-items: center;
    font-size: 0.7rem;
    font-weight: 950;
    text-transform: uppercase;
    letter-spacing: 1.5px;
    color: rgba(255,255,255,0.3);
}

.section-divider::after { content: ""; flex: 1; height: 1px; background: rgba(255,255,255,0.1); margin-left: 15px; }

.custom-label { font-size: 0.85rem; font-weight: 800; color: white; margin-bottom: 0.8rem; display: block; }

.badge-pill-glass {
    padding: 5px 12px;
    background: rgba(255,255,255,0.2);
    border-radius: 8px;
    font-size: 0.75rem;
    font-weight: 700;
    color: white;
    border: 1px solid rgba(255,255,255,0.1);
}

.badge-pill-glass.accent-gold { background: rgba(255, 215, 0, 0.2); color: #FFD700; border-color: rgba(255, 215, 0, 0.3); }
.badge-pill-glass.accent-blue { background: rgba(255, 255, 255, 0.3); color: white; }

.creator-grid { padding: 0; list-style: none; display: flex; flex-direction: column; gap: 8px; }

.creator-item {
    padding: 10px 15px;
    background: rgba(255,255,255,0.1);
    border: 1px solid rgba(255,255,255,0.05);
    border-radius: 12px;
    font-size: 0.9rem;
    font-weight: 700;
    color: white;
    cursor: pointer;
    transition: all 0.3s ease;
}

.creator-item:hover {
    transform: translateX(10px);
    background: rgba(255,255,255,0.2);
    border-color: rgba(255,255,255,0.2);
}

.verse-panel {
    background: rgba(255,255,255,0.1);
    border-radius: 16px;
    padding: 20px;
    border: 1px solid rgba(255,255,255,0.05);
    color: rgba(255,255,255,0.9);
}

.music-details-drawer h4 { color: white !important; }

/* CREATOR HOVER CARD */
#creatorDetails.premium-hover-card {
    position: fixed;
    z-index: 2100;
    width: 320px;
    background: rgba(255, 255, 255, 0.98);
    backdrop-filter: blur(20px);
    border-radius: 20px;
    border: 1px solid rgba(255,255,255,0.6);
    box-shadow: 0 30px 60px rgba(0,0,0,0.2);
    overflow: hidden;
    pointer-events: none;
    transition: opacity 0.3s cubic-bezier(0.16, 1, 0.3, 1), transform 0.3s cubic-bezier(0.16, 1, 0.3, 1);
    transform: scale(0.95);
    opacity: 0;
}

#creatorDetails.show {
    opacity: 1;
    transform: scale(1);
}

#creatorDetails img {
    width: 100%;
    height: 200px;
    object-fit: cover;
    border-bottom: 1px solid rgba(0,0,0,0.05);
}

.card-body-premium { padding: 24px; }
.card-duty-badge {
    padding: 2px 10px;
    background: #eff6ff;
    color: #2563eb;
    border-radius: 4px;
    font-size: 0.65rem;
    font-weight: 900;
    text-transform: uppercase;
    letter-spacing: 1px;
    display: inline-block;
}

/* MASTERPIECE WORKSPACE STYLING */
.masterpiece-workspace {
    width: 100%;
    margin-top: 0.5rem;
}

.main-content-stack {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 1rem;
    padding-bottom: 200px;
}

.performance-hub {
    width: 95%;
    max-width: 900px;
    background: rgba(255, 255, 255, 0.1);
    backdrop-filter: blur(25px);
    -webkit-backdrop-filter: blur(25px);
    padding: 1.25rem 2.5rem;
    border-radius: 2rem;
    border: 1px solid rgba(255,255,255,0.2);
    z-index: 2000;
    box-shadow: 0 20px 80px rgba(0,0,0,0.15);
    position: fixed;
    bottom: 2rem;
    left: 50%;
    transform: translateX(-50%);
    transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
}

.performance-hub:hover {
    background: rgba(255, 255, 255, 0.8);
    transform: translateX(-50%) translateY(-5px);
    box-shadow: 0 30px 100px rgba(0,0,0,0.2);
}

.track-selectors {
    display: flex;
    gap: 2rem;
    justify-content: center;
    flex-wrap: wrap;
    width: 100%;
    margin-bottom: 0.5rem;
}

.selector-group {
    display: flex;
    flex-direction: column;
    gap: 0.75rem;
    align-items: center;
}

.selector-label {
    font-size: 0.65rem;
    text-transform: uppercase;
    letter-spacing: 2px;
    font-weight: 950;
    color: #94a3b8;
}

.btn-group-premium {
    display: flex;
    background: rgba(255, 255, 255, 0.4);
    backdrop-filter: blur(10px);
    padding: 6px;
    border-radius: 18px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.03);
}

.track-tab {
    padding: 10px 24px;
    border: none;
    background: transparent;
    color: #64748b;
    font-weight: 800;
    font-size: 0.85rem;
    border-radius: 14px;
    cursor: pointer;
    transition: all 0.3s;
    display: flex;
    align-items: center;
    gap: 8px;
}

.track-tab:hover:not(.active) {
    background: #f1f5f9;
    color: #1e293b;
}

.track-tab.active {
    background: #3b82f6;
    color: white;
    box-shadow: 0 10px 25px rgba(59, 130, 246, 0.3);
}

.btn-download-masterpiece {
    background: #1e293b;
    color: white;
    padding: 12px 28px;
    border-radius: 14px;
    font-weight: 900;
    border: none;
    transition: all 0.3s;
    display: flex;
    align-items: center;
    gap: 12px;
}

.btn-download-masterpiece:hover {
    background: #0f172a;
    transform: translateY(-3px);
    box-shadow: 0 15px 35px rgba(15, 23, 42, 0.25);
}

.score-card {
    width: 100%;
    max-width: 1000px;
    background: white;
    padding: 3rem;
    border-radius: 2rem;
    box-shadow: inset 0 2px 10px rgba(0,0,0,0.05), 0 20px 50px rgba(0,0,0,0.05);
    position: relative;
    min-height: 800px;
}

.score-controls-floating {
    position: sticky;
    top: 20px;
    left: 50%;
    transform: translateX(-50%);
    z-index: 100;
    background: white;
    padding: 8px 15px;
    border-radius: 50px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.1);
    display: flex;
    align-items: center;
    gap: 15px;
    border: 1px solid #f1f5f9;
    width: fit-content;
    margin-bottom: -60px;
}

.zoom-action-btn {
    width: 34px;
    height: 34px;
    border-radius: 50%;
    border: none;
    background: #f1f5f9;
    color: #475569;
    cursor: pointer;
    transition: all 0.2s;
}

.zoom-action-btn:hover { background: #e2e8f0; color: #1e293b; }

.zoom-indicator {
    display: flex;
    align-items: center;
    gap: 8px;
    font-weight: 900;
    color: #64748b;
    font-size: 0.8rem;
    min-width: 70px;
    justify-content: center;
}

.score-render-area {
    display: flex;
    flex-direction: column;
    align-items: center;
    margin-top: 4rem;
}

.score-render-area canvas {
    max-width: 100%;
    height: auto;
    margin-bottom: 2rem;
    box-shadow: 0 15px 45px rgba(0,0,0,0.08);
}

.master-player-ui { width: 100%; border-radius: 12px; }

.hidden { display: none !important; }
.lyrics-view-centered {
    text-align: center;
    font-size: 1.4rem;
    line-height: 1.8;
    color: #334155;
    font-weight: 600;
    max-width: 600px;
    margin: 40px auto;
    font-family: 'Inter', sans-serif;
}
body { background: linear-gradient(to bottom, #5eb8d3, #4975b4); background-attachment: fixed; }
</style>


<script>
// --- UI INTERACTION LOGIC ---
document.addEventListener('DOMContentLoaded', () => {
    const creatorDetails = document.getElementById('creatorDetails');
    const musicDetailsDrawer = document.getElementById('musicDetails');
    let hoverTimeout;
    let currentCreatorId = null;

    // Robust Hover System
    document.body.addEventListener('mouseover', (event) => {
        const item = event.target.closest('[data-creator-id]');
        if (item) {
            clearTimeout(hoverTimeout);
            const creatorId = item.getAttribute('data-creator-id');
            if (currentCreatorId !== creatorId) {
                currentCreatorId = creatorId;
                hoverTimeout = setTimeout(() => displayCreatorDetails(creatorId, event), 150);
            }
        }
    }, true);

    document.body.addEventListener('mouseout', (event) => {
        const item = event.target.closest('[data-creator-id]');
        if (item) {
            clearTimeout(hoverTimeout);
            currentCreatorId = null;
            hideCreatorDetails();
        }
    }, true);

    function hideCreatorDetails() {
        creatorDetails.classList.remove('show');
        setTimeout(() => {
            if (!creatorDetails.classList.contains('show')) {
                creatorDetails.classList.add('hidden');
            }
        }, 150);
    }

    async function displayCreatorDetails(id, e) {
        try {
            const res = await fetch(`/creators/${id}`);
            const data = await res.json();
            
            const birthday = data.birthday && data.birthday !== '0000-00-00 00:00:00' 
                ? new Date(data.birthday).toLocaleDateString('en-US', { month: 'long', year: 'numeric' }) 
                : 'Unknown';

            creatorDetails.innerHTML = `
                <img src="${data.image ? '/storage/' + data.image : '/images/blank_image.png'}">
                <div class="card-body-premium">
                    <div class="card-duty-badge mb-2">${data.duty || 'Contributor'}</div>
                    <h5 class="font-black text-slate-800 mb-2">${data.name || 'Anonymous'}</h5>
                    <div class="card-meta-item">
                        <i class="fas fa-map-marker-alt"></i> ${data.local || 'N/A'}, ${data.district || ''}
                    </div>
                    <div class="card-meta-item">
                        <i class="fas fa-calendar-alt"></i> Born: ${birthday}
                    </div>
                    <div class="mt-3 p-3 rounded-lg bg-slate-50 border border-slate-100 italic text-xs text-slate-500">
                        ${data.music_background || 'No background information provided.'}
                    </div>
                </div>
            `;
            
            // Intelligent Positioning
            let x = e.clientX + 30;
            let y = e.clientY - 150;
            
            // Bounds check
            if (x + 350 > window.innerWidth) x = e.clientX - 350;
            if (y + 400 > window.innerHeight) y = window.innerHeight - 400;
            if (y < 20) y = 20;

            creatorDetails.style.left = `${x}px`;
            creatorDetails.style.top = `${y}px`;
            
            creatorDetails.classList.remove('hidden');
            requestAnimationFrame(() => creatorDetails.classList.add('show'));
        } catch (err) {
            if (err.name !== 'AbortError') console.error("Error fetching creator details:", err);
        }
    }

    window.toggleDetails = function() {
        musicDetailsDrawer.classList.toggle('active');
    };

    const infoTrigger = document.getElementById('showMusicDetailsBtn');
    if (infoTrigger) {
        infoTrigger.addEventListener('click', (e) => {
            e.stopPropagation();
            toggleDetails();
        });
    }

    // CLICK OUTSIDE TO CLOSE
    document.addEventListener('click', (e) => {
        if (musicDetailsDrawer.classList.contains('active')) {
            if (!musicDetailsDrawer.contains(e.target) && !infoTrigger.contains(e.target)) {
                musicDetailsDrawer.classList.remove('active');
            }
        }
    });

    // Prevent clicks inside the drawer from bubbling up
    musicDetailsDrawer.addEventListener('click', (e) => {
        e.stopPropagation();
    });
});
</script>

</script>

<div id="creatorDetails" class="hidden premium-hover-card"></div>

<!-- Integrated Masterpiece Workspace -->
<div class="masterpiece-workspace">
    <div class="main-content-stack">
        <!-- Part 1: Performance Hub (Audio & Toggles) -->
        <div class="performance-hub glass-blur show-up-animation">
            <div class="hub-inner">
                <div class="flex flex-col items-center gap-6">
                    <!-- Layer Selectors -->
                    <div class="track-selectors">
                        <div class="selector-group">
                            <span class="selector-label">Audio Layer</span>
                            <div class="btn-group-premium">
                                <button class="track-tab tab-button-mp3 active" data-path="{{ asset('storage/' . $music->vocals_mp3_path) }}">
                                    <i class="fas fa-microphone"></i> Vocals
                                </button>
                                <button class="track-tab tab-button-mp3" data-path="{{ asset('storage/' . $music->organ_mp3_path) }}">
                                    <i class="fas fa-keyboard"></i> Organ
                                </button>
                                <button class="track-tab tab-button-mp3" data-path="{{ asset('storage/' . $music->preludes_mp3_path) }}">
                                    <i class="fas fa-play-circle"></i> Preludes
                                </button>
                            </div>
                        </div>

                        <div class="selector-group">
                            <span class="selector-label">Visual Perspective</span>
                            <div class="btn-group-premium">
                                <button class="track-tab tab-button active" id="musicScoreButton" data-path="{{ asset('storage/' . $music->music_score_path) }}">
                                    <i class="fas fa-file-invoice"></i> Score
                                </button>
                                <button class="track-tab tab-button" id="lyricsButton" data-path="{{ asset('storage/' . $music->lyrics_path) }}">
                                    <i class="fas fa-align-center"></i> Lyrics
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Master Audio Player -->
                    <div class="player-wrapper w-full max-w-2xl">
                        <audio id="musicPlayer" controls preload="auto" class="master-player-ui">
                            <source id="audioSource" src="#" type="audio/mpeg">
                        </audio>
                    </div>

                    <!-- Action Hub -->
                    @if (\App\Helpers\AccessRightsHelper::checkPermission('music_details.download') == 'inline')
                    <div class="mt-2">
                        <button id="downloadButton" class="btn-download-masterpiece shadow-lg">
                            <i class="fas fa-cloud-download-alt"></i> Download Original Track
                        </button>
                    </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Part 2: Visual Hub (The Score) -->
        <div class="visual-hub mt-2 pb-24">
            <div class="score-card shadow-inner-premium">
                <div class="score-controls-floating">
                    <button class="zoom-action-btn" onclick="changeZoom(-0.5)" title="Zoom Out"><i class="fas fa-minus"></i></button>
                    <div class="zoom-indicator">
                        <i class="fas fa-search"></i>
                        <span id="zoomLevelText">100%</span>
                    </div>
                    <button class="zoom-action-btn" onclick="changeZoom(0.5)" title="Zoom In"><i class="fas fa-plus"></i></button>
                </div>
                
                <div id="pdf-container" class="score-render-area">
                    <!-- Masterpiece content renders here -->
                </div>
            </div>
        </div>
    </div>
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
        document.getElementById('zoomLevelText').innerText = '100%';
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

        // Function to switch audio track
        function switchTrack(path) {
            const musicPlayer = document.getElementById('musicPlayer');
            const audioSource = document.getElementById('audioSource');
            
            if (path) {
                audioSource.src = path;
                musicPlayer.load();
                // We keep it paused initially unless user hits play, 
                // but if it was already playing, we can resume.
                // For now, let's just load it.
            }
        }

        // Initial track load
        const activeMp3 = $('.tab-button-mp3.active').data('path');
        if (activeMp3) switchTrack(activeMp3);

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

    let currentScale = 1.5; // Optimized scale for high-fps performance and crisp visuals
    
    window.changeZoom = function(delta) {
        currentScale = Math.max(0.5, Math.min(6.0, currentScale + (delta * 0.5))); 
        document.getElementById('zoomLevelText').innerText = Math.round(currentScale / 1.5 * 100) + '%';
        renderContent($('.track-tab.active').data('path') || $('.tab-button.active').data('path'));
    };

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

// Function to render lyrics content
function renderLyrics(lyricsPath) {

    // Clear the PDF container and replace with lyrics content
    $('#pdf-container').html('<p>Loading lyrics...</p>');

    // Fetch the lyrics content from the server and display it
    $.ajax({
        url: lyricsPath,
        success: function(data) {
            $('#pdf-container').html('<div class="lyrics-view-centered">' + data.replace(/\n/g, '<br>') + '</div>');
        },
        error: function() {
            $('#pdf-container').html('<div class="error-msg">Failed to load lyrics.</div>');
        }
    });
}

});
</script>

<style>
.fixedbutton {
  position: fixed;
  right: 4px;
  top: 50%;
  transform: translateY(-50%);
  display: flex;
  justify-content: center;
  align-items: center;
  width: 20px;
  height: 20px;
  padding: 0;
  border-radius: 50%;
  background-color: #blue-600;
  color: #white;
}

#playlistBG
{
    
  background: linear-gradient(to bottom, #59a7cb, #4f87bc);
    border-radius: 10px; /* added border radius */
}

#playlistsContent
{
    
    
  background: linear-gradient(to bottom, #59a7cb, #4f87bc);
  border-radius: 10px; /* added border radius */
  box-shadow: 0 0 10px rgba(0,0,0,0.2);
}


#playlistable
{
    
  background: white;
  border-radius: 10px; /* added border radius */
  box-shadow: 0 0 10px rgba(0,0,0,0.2);
}
#playlistModal {
  max-width: 90vw;
  max-height: 90vh;
  overflow: hidden; /* Keep this to hide the horizontal scrollbar */
  overflow-y: auto;
  padding: 20px;
  margin: 20px auto;
  width: calc(100% - 80px);
  height: calc(100% - 80px);
  box-sizing: border-box;
  border-radius: 10px; /* added border radius */
  /* Add these styles to make it stick to the right side */
  right: 8px;
  top: 50%;
  transform: translateY(-50%);
  flex-direction: column;
  align-items: flex-end;
  position: fixed; /* Add this to make z-index work */
  z-index: 1000; /* Add this to bring the modal to the front */
}

#closeModal {
  font-size: 18px;
  padding: 8px;
  border: none;
  background-color: #5eb8d3;
  cursor: pointer;
  right:0;
  top:0;
}

#closeModal:hover {
  color: #333; /* dark gray hover color */
}


/* Add media queries to adjust the modal size on different screen sizes */
@media (max-width: 1024px) { /* iPad landscape */
  #playlistModal {
    width: calc(100% - 40px);
    height: calc(100% - 40px);
  }
}

@media (max-width: 768px) { /* iPad portrait */
  #playlistModal {
    width: calc(100% - 20px);
    height: calc(100% - 20px);
  }
}

@media (max-width: 480px) { /* Mobile devices */
  #playlistModal {
    width: calc(100% - 10px);
    height: calc(100% - 10px);
  }
}
/* iPhone 12, 12 Mini, 13, 13 Mini */
@media only screen and (min-device-width: 375px) and (max-device-width: 667px) and (-webkit-min-device-pixel-ratio: 2) {
  #playlistModal {
    width: calc(100% - 20px);
    height: calc(100% - 20px);
  }
}

/* iPhone 12 Pro, 12 Pro Max, 13 Pro, 13 Pro Max */
@media only screen and (min-device-width: 414px) and (max-device-width: 896px) and (-webkit-min-device-pixel-ratio: 3) {
  #playlistModal {
    width: calc(100% - 20px);
    height: calc(100% - 20px);
  }
}


</style>

<!-- Fixed button icon --> 
 <button id="playlistButton" style="  background-color: #007bff; /* dark blue color */
  border: 2px solid #FFFFFF; /* 2px white border */
  color: #FFFFFF; /* white text color */
  padding: 1rem; /* 1rem padding */
  border-radius: 50%; /* rounded full */
  box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2); " class="fixedbutton right-4 text-white p-4 rounded-full shadow-lg hidden"> 
   <i class="fas fa-music"></i>
</button>

<!-- <script>
    document.addEventListener('DOMContentLoaded', function () {
  const url = new URL(window.location.href);
const playlistIdParam = url.searchParams.get('playlist_id');

if (!playlistIdParam) {
  document.getElementById('playlistButton').style.display = 'none';
}
    });
</script> -->



<div id="playlistModal" class="hidden fixed inset-0 flex justify-center items-center">
    <div id="playlistBG" class="p-6 rounded-lg w-1/2 relative" style="box-shadow: 0 0 10px rgba(0,0,0,0.2);">
        <button id="closeModal" class="absolute top-0 right-0 mt-2 mr-2 px-4 py-2 bg-red-600 text-white rounded hidden">
            <i class="fas fa-times"></i>
        </button>
        <h2 class="text-xl mb-4 text-white"><b>Playlists</b></h2>
        <div id="playlistsContent"></div>
    </div>
</div>


<script>
 document.addEventListener('DOMContentLoaded', function () {
  const playlistButton = document.getElementById('playlistButton');
  const playlistModal = document.getElementById('playlistModal');
  const closeModal = document.getElementById('closeModal');
  const playlistsContent = document.getElementById('playlistsContent');


  const urlParams = new URLSearchParams(window.location.search);
    const playlistId = urlParams.get('playlist_id');

    // Fetch playlist items
    fetch(`/playlists?playlist_id=${playlistId}`)
      .then(response => response.json())
      .then(data => {
        let content = '';
        data.playlists.forEach(playlist => {
          content += `
            <div id='playlistable' class="mb-4">
              <h4 class="text-lg font-bold text-white text-center" style="background: linear-gradient(to bottom, #59a7cb, #4f87bc);">${playlist.name}</h4>
              <table class="myTableClass min-w-full mt-3 mb-3 table-auto w-full">
                <thead>
                  <tr>
                    <th class="px-4 py-2 bg-gray-50 text-center text-s font-large text-black uppercase tracking-wider">#</th>
                    <th class="px-4 py-2 bg-gray-50 text-center text-s font-large text-black uppercase tracking-wider"></th>
                    <th class="px-4 py-2 bg-gray-50 text-left text-s font-large text-black uppercase tracking-wider">Title</th>
                    <th class="px-4 py-2 bg-gray-50 text-center text-s font-large text-black uppercase tracking-wider">Hymn Number</th>
                  </tr>
                </thead>
                <tbody>`;
          playlist.musics.forEach((music, index) => {
            content += `
              <tr data-index="${index}" data-path="${music.vocals_mp3_path}">
                <td class="text-center border-gray-300 px-4 py-2 whitespace-nowrap">${index + 1}</td>
                <td class="text-center border-gray-300 px-4 py-2 whitespace-nowrap">
                  <!-- equalizer will be added here -->
                </td>
                <td class="text-left border-gray-300 px-4 py-0 whitespace-nowrap">
                  <a href="/musics/${music.id}?playlist_id=${playlist.id}" class="text-blue-600 hover:underline">
                    ${music.title}
                  </a>
                </td>
                <td class="text-center border-gray-300 px-4 py-2 whitespace-nowrap">${music.song_number ?? '-'}</td>
              </tr>
            `;
          });
          content += `
                </tbody>
              </table>
            </div>
          `;
        });
 
      
      playlistsContent.innerHTML = content;
          // Get all playlist items from the modal
  const playlistCount = playlistsContent.querySelectorAll('tbody tr a'); 

  console.log('Playlist Items Found:', playlistCount.length);

  if (playlistCount.length > 0) {
   
        // Insert playlist into modal content
        //playlistModal.classList.remove('hidden'); // Open the modal
        playlistButton.classList.remove('hidden');
  }
  else{
    playlistButton.classList.add('hidden');
  }
    
        const tables = playlistsContent.querySelectorAll('.myTableClass');
        tables.forEach(table => {
          const tds = Array.from(table.querySelectorAll('tr'));
          const currentUrl = window.location.href;
          tds.forEach(td => {
            const aTag = td.querySelector('a');
            if (aTag && aTag.href === currentUrl) {
              td.style.fontWeight = 'bold';
              td.style.color = '#F3F7EC';
              td.style.backgroundColor = '#57a2c9';
              td.style.borderRadius = '10px';

              // Add equalizer to the equalizer column
              const equalizerTd = td.cells[1]; // get the equalizer column
              const equalizerSpan = document.createElement('span');
              equalizerSpan.className = 'equalizer';
              const bar1 = document.createElement('span');
              bar1.className = 'bar';
              const bar2 = document.createElement('span');
              const bar3 = document.createElement('span');
              equalizerSpan.appendChild(bar1);
              equalizerSpan.appendChild(bar2);
              equalizerSpan.appendChild(bar3);
              equalizerTd.appendChild(equalizerSpan);
            }
          });
        });
 
        // Now that playlist is loaded, call playNextTrack
        enableNextTrackAutoPlay();
      })
      .catch(error => {
        console.error('Error fetching playlists:', error);
      });

// Handle opening and closing of playlist modal
playlistButton.addEventListener('click', function () {
    const playlistsContent = document.getElementById('playlistsContent');
    const playlistCount = playlistsContent.querySelectorAll('tbody tr a'); 
    const playlistModal = document.getElementById('playlistModal'); // Ensure you have the modal element

    if (playlistCount.length > 0) {
        // Check if the modal is currently hidden
        if (playlistModal.classList.contains('hidden')) {
            // Open the modal
            playlistModal.classList.remove('hidden');
        } else {
            // Close the modal
            playlistModal.classList.add('hidden');
        }
    } else {
        // Optionally handle the case where there are no playlists
        console.log("No playlists available.");
    }
});

  // Close modal when clicking outside
  window.addEventListener('click', function(event) {
    if (event.target === playlistModal) {
      playlistModal.classList.add('hidden');
    }
  });
});

// Function to enable next track autoplay after playlist is loaded
function enableNextTrackAutoPlay() {
  const playlistContent = document.getElementById('playlistsContent');

  // Get all playlist items from the modal
  const playlistItems = playlistContent.querySelectorAll('tbody tr a'); 

  console.log('Playlist Items Found:', playlistItems.length);

  if (playlistItems.length === 0) {
    console.log('No playlist items found.');
    return;
  }

  // Event listener for when the audio track ends
  const musicPlayer = document.getElementById('musicPlayer');
  musicPlayer.addEventListener('ended', function () {
    console.log('Current track ended, attempting to play next track...');
    playNextTrack(playlistItems);
  });
}

// Function to play the next track in the playlist
function playNextTrack(playlistItems) {
  const currentUrl = window.location.href;

  // Loop through the playlist items and find the current track
  for (let i = 0; i < playlistItems.length; i++) {
    const item = playlistItems[i];

    if (item.href === currentUrl) {
      const nextItem = playlistItems[i + 1]; // Get the next track

      if (nextItem) {
        console.log('Navigating to the next track:', nextItem.href);
        window.location.href = nextItem.href; // Navigate to the next track
      } else {
        console.log('No more tracks in the playlist.');
      }
      break;
    }
  }
}
</script>

<style>
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

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
