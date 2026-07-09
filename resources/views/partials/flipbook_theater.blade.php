{{-- ════════════════════════════════════════════════════════════════════ --}}
{{-- FLIPBOOK THEATER — Integrated Multimedia Player Interface            --}}
{{-- ════════════════════════════════════════════════════════════════════ --}}

<div id="flipbook-theater">

    {{-- ── TOP BAR ──────────────────────────────────────────────────── --}}
    <div class="fb-top-bar">
        <div class="fb-top-left" style="display:flex; align-items:center; gap:8px;">
            <span class="fb-badge" style="background:rgba(59,130,246,.15); color:#60a5fa; padding:4px 10px; border-radius:6px; font-size:.6rem; font-weight:800; letter-spacing:1px; border:1px solid rgba(59,130,246,.3);">
                HYMNS <span id="fb-load-pct" style="margin-left:4px; display:none;">0%</span>
            </span>
            <button id="fb-theme-toggle" class="fb-ctrl-btn" title="Toggle Light/Dark Mode" style="width:30px;height:30px;font-size:0.8rem;">
                <i class="fas fa-sun"></i>
            </button>
        </div>

        <div class="fb-top-center" style="display:flex; align-items:center; gap:8px;">
            {{-- Vocals: disabled if no file --}}
            <button type="button"
                class="fb-track-pill {{ empty($music->vocals_mp3_path) ? 'fb-pill-disabled' : '' }}"
                @if(!empty($music->vocals_mp3_path))
                    data-src="{{ asset('storage/'.$music->vocals_mp3_path) }}"
                    data-label="Vocals"
                @else
                    disabled title="No Vocals file available"
                @endif>
                <i class="fas fa-microphone"></i><span>Vocals</span>
            </button>
            {{-- Organ: disabled if no file --}}
            <button type="button"
                class="fb-track-pill {{ empty($music->organ_mp3_path) ? 'fb-pill-disabled' : '' }}"
                @if(!empty($music->organ_mp3_path))
                    data-src="{{ asset('storage/'.$music->organ_mp3_path) }}"
                    data-label="Organ"
                @else
                    disabled title="No Organ file available"
                @endif>
                <i class="fas fa-keyboard"></i><span>Organ</span>
            </button>
            {{-- Preludes: disabled if no file --}}
            <button type="button"
                class="fb-track-pill {{ empty($music->preludes_mp3_path) ? 'fb-pill-disabled' : '' }}"
                @if(!empty($music->preludes_mp3_path))
                    data-src="{{ asset('storage/'.$music->preludes_mp3_path) }}"
                    data-label="Preludes"
                @else
                    disabled title="No Preludes file available"
                @endif>
                <i class="fas fa-music"></i><span>Preludes</span>
            </button>
        </div>

        <div class="fb-top-right">
            <div class="fb-view-toggle" style="margin-right:12px; display:flex; gap:6px;">
                {{-- Score button: disabled if no music score file --}}
                <button id="fb-view-score"
                    class="fb-track-pill {{ !empty($music->music_score_path) ? 'active' : 'fb-pill-disabled' }}"
                    title="{{ empty($music->music_score_path) ? 'No Music Score file available' : 'Music Score' }}"
                    {{ empty($music->music_score_path) ? 'disabled' : '' }}>
                    <i class="fas fa-file-invoice"></i><span>Score</span>
                </button>
                {{-- Lyrics button: disabled if no lyrics file --}}
                <button id="fb-view-lyrics"
                    class="fb-track-pill {{ empty($music->lyrics_path) ? 'fb-pill-disabled' : '' }}"
                    title="{{ empty($music->lyrics_path) ? 'No Lyrics file available' : 'Text Lyrics' }}"
                    {{ empty($music->lyrics_path) ? 'disabled' : '' }}>
                    <i class="fas fa-align-center"></i><span>Lyrics</span>
                </button>
            </div>

            {{-- On mobile this whole group collapses into the ⋮ "More" menu
                 below, so the top bar doesn't overflow into multiple crowded
                 rows. On desktop fb-more-panel lays out inline as normal. --}}
            <button type="button" id="fb-more-toggle" class="fb-ctrl-btn fb-more-toggle-btn" title="More options">
                <i class="fas fa-ellipsis-vertical"></i>
            </button>
            <div id="fb-more-panel" class="fb-more-panel">
                <div class="fb-extra-ctrls" style="margin-right:12px; display:flex; gap:6px;">
                    <button id="fb-details-btn" class="fb-track-pill" title="Hymn Details"><i class="fas fa-info-circle"></i><span>Details</span></button>
                    <button id="fb-playlist-btn"
                        class="fb-track-pill {{ $music->playlists->count() === 0 ? 'fb-pill-disabled' : '' }}"
                        title="{{ $music->playlists->count() === 0 ? 'This music is not included in any playlist' : 'Current Playlist' }}"
                        {{ $music->playlists->count() === 0 ? 'disabled' : '' }}>
                        <i class="fas fa-list-ul"></i><span>Playlist</span>
                    </button>
                </div>

                <div class="fb-zoom-ctrl" style="margin-right:12px;">
                    <button id="fb-zoom-out" class="fb-ctrl-btn"><i class="fas fa-minus"></i></button>
                    <span id="fb-zoom-label">100%</span>
                    <button id="fb-zoom-in" class="fb-ctrl-btn"><i class="fas fa-plus"></i></button>
                    <button id="fb-zoom-reset" class="fb-ctrl-btn" title="Reset Zoom"><i class="fas fa-rotate-left"></i></button>
                </div>
                <div class="fb-dl-wrap" style="position:relative;">
                    <button id="fb-dl-toggle" class="fb-ctrl-btn" style="margin-right:12px;" title="Download"><i class="fas fa-download"></i><span class="fb-more-hide-desktop">Download</span></button>
                    <div id="fb-dropdown" class="fb-dropdown" style="display:none;">
                        <a id="fb-dl-pdf" class="fb-dl-item" href="{{ !empty($music->music_score_path) ? asset('storage/'.$music->music_score_path) : '#' }}" download="{{ $music->title }} - Score.pdf" {{ empty($music->music_score_path) ? 'style=pointer-events:none;opacity:0.4;' : '' }}>
                            <i class="fas fa-file-pdf"></i> Score (PDF)
                        </a>
                        <a id="fb-dl-mp3" class="fb-dl-item" href="#" download="{{ $music->title }}.mp3" style="{{ empty($music->vocals_mp3_path) && empty($music->organ_mp3_path) && empty($music->preludes_mp3_path) ? 'pointer-events:none;opacity:0.4;' : '' }}">
                            <i class="fas fa-music"></i> Audio (MP3)
                        </a>
                        <a id="fb-dl-lyrics" class="fb-dl-item" href="{{ !empty($music->lyrics_path) ? asset('storage/'.$music->lyrics_path) : '#' }}" download="{{ $music->title }} - Lyrics.pdf" {{ empty($music->lyrics_path) ? 'style=pointer-events:none;opacity:0.4;' : '' }}>
                            <i class="fas fa-align-center"></i> Lyrics
                        </a>
                    </div>
                </div>
                <button id="fb-fullscreen" class="fb-ctrl-btn" style="margin-right:12px;" title="Fullscreen"><i class="fas fa-expand"></i><span class="fb-more-hide-desktop">Fullscreen</span></button>
            </div>
            <button id="fb-close" class="fb-ctrl-btn fb-close-btn" title="Close"><i class="fas fa-times"></i></button>
        </div>
    </div>

    {{-- ── STAGE ─────────────────────────────────────────────────────── --}}
    <div class="fb-stage" id="fb-stage">

        {{-- LOAD ERROR STATE: shown if the score/lyrics PDF fails to fetch or
             stalls, so a slow/blocked CDN never leaves a blank screen with no
             way forward. --}}
        <div id="fb-load-error" class="fb-load-error" hidden>
            <div class="fb-load-error-icon"><i class="fas fa-triangle-exclamation"></i></div>
            <h3>This hymn couldn't load</h3>
            <p>The score may be taking too long to reach you, or the connection was interrupted.</p>
            <div class="fb-load-error-actions">
                <button type="button" id="fb-load-retry" class="fb-load-error-btn fb-load-error-btn-primary">
                    <i class="fas fa-rotate-right"></i> Try again
                </button>
                <a href="{{ route('musics.index') }}" class="fb-load-error-btn">
                    <i class="fas fa-arrow-left"></i> Back to hymn list
                </a>
            </div>
        </div>

        {{-- SCORE VIEW (Flipbook) --}}
        <div id="fb-score-view" style="display:flex;width:100%;height:100%;min-width:100%;min-height:100%;align-items:center;justify-content:center;gap:12px;box-sizing:border-box;position:relative;">
            <button class="fb-nav-arrow" id="fb-prev" disabled>
                <i class="fas fa-chevron-left"></i>
            </button>
            <div class="fb-book-wrap fb-zoom-surface" id="fb-book-wrap">
                <div class="fb-book" id="fb-book">
                    <div class="fb-page fb-page-left">
                        <div class="fb-page-inner">
                            <canvas id="fb-canvas-left" class="fb-canvas"></canvas>
                            <div class="fb-page-num" id="fb-num-left"></div>
                            <div class="fb-page-curl fb-curl-tl"></div>
                        </div>
                    </div>
                    <div class="fb-spine"><div class="fb-spine-line"></div></div>
                    <div class="fb-page fb-page-right">
                        <div class="fb-page-inner">
                            <canvas id="fb-canvas-right" class="fb-canvas"></canvas>
                            <div class="fb-page-num" id="fb-num-right"></div>
                            <div class="fb-page-curl fb-curl-br"></div>
                        </div>
                    </div>
                    {{-- 3D Page Turn overlay (Content Loaded dynamically) --}}
                    <div id="fb-turning-page" class="fb-turning-page">
                        <div class="fb-tp-front"><canvas id="fb-canvas-turn-front" class="fb-canvas"></canvas></div>
                        <div class="fb-tp-back" ><canvas id="fb-canvas-turn-back"  class="fb-canvas"></canvas></div>
                    </div>
                </div>
            </div>
            <button class="fb-nav-arrow" id="fb-next">
                <i class="fas fa-chevron-right"></i>
            </button>
        </div>

        {{-- LYRICS VIEW --}}
        <div id="fb-lyrics-view" class="fb-lyrics-view">
            <div id="fb-lyrics-inner" class="fb-lyrics-inner fb-zoom-surface"></div>
        </div>
    </div>

    <!-- Start Overlay (For Auto-play blocks) -->
    <div id="fb-start-overlay" class="fb-start-overlay">
        <div class="fb-start-card">
            <div class="fb-start-icon"><i class="fas fa-play"></i></div>
            <h3>Begin Experience</h3>
            <p>Click anywhere to start the immersive player</p>
        </div>
    </div>

    <!-- Exit Transition Overlay: fades in over the theater before redirecting,
         so the underlying show page never flashes through -->
    <div id="fb-exit-overlay" class="fb-exit-overlay" aria-hidden="true">
        <div class="fb-exit-spinner"></div>
    </div>

    {{-- Hidden audio element --}}
    <audio id="fb-audio" preload="auto"></audio>

    {{-- ── BOTTOM COMMAND CENTER ───────────────────────── --}}
    <div class="fb-command-center" id="fb-command-center">
        <button class="fb-cc-handle" id="fb-cc-handle" title="Collapse/Expand Player">
            <i class="fas fa-chevron-down" id="fb-cc-toggle-icon"></i>
        </button>

        {{-- Title Strip: Hymn Title centered at the top of the command center --}}
        <div class="fb-title-strip">
            <div class="fb-eq-visualizer" id="fb-eq-visualizer" style="margin-right:8px;">
                <div class="fb-eq-bar"></div><div class="fb-eq-bar"></div><div class="fb-eq-bar"></div><div class="fb-eq-bar"></div>
            </div>
            <h2 class="fb-hymn-title-bottom">{{ $music->title }}</h2>
            <span id="fb-track-status" class="fb-track-status-bottom">Ready</span>
        </div>

        {{-- Row 1: Audio Player --}}
        <div class="fb-audio-row">
            <button class="fb-play-sphere" id="fb-play-btn">
                <i class="fas fa-play" id="fb-play-icon"></i>
            </button>
            <span class="fb-timestamp" id="fb-current-time">0:00</span>
            <div class="fb-audio-track-wrap">
                <input type="range" class="fb-audio-scrubber" id="fb-audio-scrubber" min="0" max="100" value="0">
                <div class="fb-audio-fill" id="fb-audio-fill"></div>
            </div>
            <span class="fb-timestamp" id="fb-duration">0:00</span>
            <div class="fb-vol-wrap">
                <i class="fas fa-volume-low fb-vol-icon"></i>
                <input type="range" class="fb-vol-slider" id="fb-volume" min="0" max="1" step="0.05" value="1">
            </div>
            <div class="fb-now-playing" id="fb-now-playing">
                <span id="fb-track-label" style="font-size:.65rem;font-weight:700;color:#94a3b8;text-transform:uppercase;letter-spacing:1px;">No Track</span>
            </div>
        </div>

        {{-- Row 2: Page Scrubber (score mode only) --}}
        <div class="fb-page-row" id="fb-page-row">
            <span class="fb-page-counter">
                <i class="fas fa-book-open" style="opacity:.45;margin-right:5px;"></i>
                Spread <strong id="fb-spread-label">1–2</strong> / <strong id="fb-total-label">—</strong>
            </span>
            <div class="fb-scrub-wrap">
                <input type="range" class="fb-scrubber" id="fb-scrubber" min="1" max="1" step="1" value="1">
                <div class="fb-scrub-fill" id="fb-scrub-fill"></div>
            </div>
            <span class="fb-hint"><i class="fas fa-keyboard" style="opacity:.35;margin-right:4px;"></i>← → · Swipe · +/−</span>
        </div>
    </div>

    {{-- ── INTERNAL MODALS (Hymn Details & Playlist) ────────────────── --}}
    <div id="fb-sub-overlay" class="fb-sub-overlay">
        {{-- Hymn Details Modal --}}
        <div id="fb-details-modal" class="fb-sub-modal">
            <div class="fb-modal-header">
                <h3>Hymn Details</h3>
                <button class="fb-modal-close" id="fb-close-details"><i class="fas fa-times"></i></button>
            </div>
            <div class="fb-modal-content custom-scrollbar">
                <div class="fb-details-grid">
                    <div class="fb-detail-card main">
                        <span class="fb-detail-label">Masterpiece</span>
                        <h1 class="fb-detail-title">{{ $music->title }}</h1>
                        <div class="fb-detail-number"><span>NO.</span> {{ $music->song_number }}</div>
                    </div>
                    
                    <div class="fb-detail-row">
                        <div class="fb-detail-card">
                            <span class="fb-detail-label"><i class="fas fa-layer-group"></i> Category</span>
                            <div class="fb-detail-tags">
                                @forelse($music->categories as $c) <span class="fb-tag">{{ $c->name }}</span> @empty <span class="fb-tag opacity-50">Uncategorized</span> @endforelse
                            </div>
                        </div>
                        <div class="fb-detail-card">
                            <span class="fb-detail-label"><i class="fas fa-users"></i> Ensemble</span>
                            <div class="fb-detail-tags">
                                @forelse($music->ensembleTypes as $e) <span class="fb-tag ensemble">{{ $e->name }}</span> @empty <span class="fb-tag opacity-50">Standard</span> @endforelse
                            </div>
                        </div>
                    </div>

                    <div class="fb-detail-card full">
                        <span class="fb-detail-label"><i class="fas fa-pen-nib"></i> Credits</span>
                        <div class="fb-credits-list">
                            <div class="fb-credit-item">
                                <i class="fas fa-feather"></i> <strong>Lyricist:</strong> 
                                @foreach ($music->lyricists as $lyricist)
                                    <span class="fb-creator-link"
                                        data-creator-id="{{ $lyricist->id }}" 
                                        data-name="{{ $lyricist->name }}" 
                                        data-role="Lyricist"
                                        data-profile-url="{{ route('music_creators.profile', $lyricist->id) }}"
                                        data-local="{{ $lyricist->local ?? '' }}"
                                        data-district="{{ $lyricist->district ?? '' }}"
                                        data-duty="{{ $lyricist->duty ?? '' }}"
                                        data-birthday="{{ $lyricist->birthday ? \Carbon\Carbon::parse($lyricist->birthday)->format('F d, Y') : '' }}"
                                        data-image="{{ $lyricist->image ? asset('storage/' . $lyricist->image) : asset('images/blank_image.png') }}"
                                        data-background="{{ $lyricist->music_background ?? '' }}"
                                        >{{ $lyricist->name }}</span>{{ !$loop->last ? ',' : '' }}
                                @endforeach
                            </div>
                            <div class="fb-credit-item">
                                <i class="fas fa-music"></i> <strong>Composer:</strong> 
                                @foreach ($music->composers as $composer)
                                    <span class="fb-creator-link"
                                        data-creator-id="{{ $composer->id }}" 
                                        data-name="{{ $composer->name }}" 
                                        data-role="Composer"
                                        data-profile-url="{{ route('music_creators.profile', $composer->id) }}"
                                        data-local="{{ $composer->local ?? '' }}"
                                        data-district="{{ $composer->district ?? '' }}"
                                        data-duty="{{ $composer->duty ?? '' }}"
                                        data-birthday="{{ $composer->birthday ? \Carbon\Carbon::parse($composer->birthday)->format('F d, Y') : '' }}"
                                        data-image="{{ $composer->image ? asset('storage/' . $composer->image) : asset('images/blank_image.png') }}"
                                        data-background="{{ $composer->music_background ?? '' }}"
                                        >{{ $composer->name }}</span>{{ !$loop->last ? ',' : '' }}
                                @endforeach
                            </div>
                            <div class="fb-credit-item">
                                <i class="fas fa-headphones"></i> <strong>Arranger:</strong> 
                                @foreach ($music->arrangers as $arranger)
                                    <span class="fb-creator-link"
                                        data-creator-id="{{ $arranger->id }}" 
                                        data-name="{{ $arranger->name }}" 
                                        data-role="Arranger"
                                        data-profile-url="{{ route('music_creators.profile', $arranger->id) }}"
                                        data-local="{{ $arranger->local ?? '' }}"
                                        data-district="{{ $arranger->district ?? '' }}"
                                        data-duty="{{ $arranger->duty ?? '' }}"
                                        data-birthday="{{ $arranger->birthday ? \Carbon\Carbon::parse($arranger->birthday)->format('F d, Y') : '' }}"
                                        data-image="{{ $arranger->image ? asset('storage/' . $arranger->image) : asset('images/blank_image.png') }}"
                                        data-background="{{ $arranger->music_background ?? '' }}"
                                        >{{ $arranger->name }}</span>{{ !$loop->last ? ',' : '' }}
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <div class="fb-detail-card full">
                        <span class="fb-detail-label"><i class="fas fa-book-bible"></i> Scriptural Basis</span>
                        <p class="fb-verse-text">{{ $music->verses_used ?: 'No specific scriptural references documented.' }}</p>
                    </div>

                    <div id="fb-creator-spotlight" class="fb-creator-spotlight" hidden>
                        <div class="fb-creator-spotlight-head">
                            <div>
                                <span class="fb-detail-label"><i class="fas fa-user-pen"></i> Creator Spotlight</span>
                                <h4 id="fb-creator-name" class="fb-creator-name">Select a creator</h4>
                                <p id="fb-creator-role" class="fb-creator-role">Hover or click a name to inspect their profile.</p>
                            </div>
                            <button type="button" class="fb-creator-spotlight-close" id="fb-creator-close" aria-label="Close creator spotlight">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                        <div class="fb-creator-spotlight-body">
                            <img id="fb-creator-image" class="fb-creator-image" src="{{ asset('images/blank_image.png') }}" alt="Creator portrait">
                            <div class="fb-creator-meta">
                                <div class="fb-creator-meta-row">
                                    <span class="fb-creator-meta-label">Location</span>
                                    <span id="fb-creator-location" class="fb-creator-meta-value">-</span>
                                </div>
                                <div class="fb-creator-meta-row">
                                    <span class="fb-creator-meta-label">Birthday</span>
                                    <span id="fb-creator-birthday" class="fb-creator-meta-value">-</span>
                                </div>
                                <div class="fb-creator-meta-row">
                                    <span class="fb-creator-meta-label">Duty</span>
                                    <span id="fb-creator-duty" class="fb-creator-meta-value">-</span>
                                </div>
                                <a id="fb-creator-profile-link" class="fb-creator-profile-link" href="#" target="_blank" rel="noopener">
                                    View full profile
                                </a>
                            </div>
                        </div>
                        <p id="fb-creator-background" class="fb-creator-background"></p>
                    </div>
                </div>
            </div>
        </div>

        {{-- Playlist Modal --}}
        <div id="fb-playlist-modal" class="fb-sub-modal">
            <div class="fb-modal-header">
                <h3>Current Playlist</h3>
                <button class="fb-modal-close" id="fb-close-playlist"><i class="fas fa-times"></i></button>
            </div>
            <div class="fb-modal-content custom-scrollbar" id="fb-playlist-content">
                {{-- Loaded via JS --}}
                <div class="fb-loader"><i class="fas fa-circle-notch fa-spin"></i> Loading...</div>
            </div>
        </div>
    </div>

</div>{{-- /flipbook-theater --}}

<style>
/* ─── THEATER OVERLAY ──────────────────────────────────── */
#flipbook-theater {
    position:fixed;
    inset: 0;
    z-index: 9999;
    --fb-turn-duration: 840ms;
    --fb-turn-ease: cubic-bezier(0.18, 0.88, 0.22, 1);
    background: radial-gradient(ellipse at 20% 10%, #1a2744 0%, #0c1628 55%, #0a0f1e 100%);
    display: flex;
    flex-direction: column;
    overflow: hidden;
    border-radius: 0;
    box-shadow: 0 0 0 1px rgba(255,255,255,0.06), 0 60px 120px -20px rgba(0,0,0,0.95);
    border: none;
}
#flipbook-theater::before {
    content:''; position:absolute; inset:0; pointer-events:none; z-index:0;
    background:
        radial-gradient(ellipse at 50% 0%, rgba(37,99,235,0.18) 0%, transparent 55%),
        radial-gradient(ellipse at 90% 90%, rgba(29,78,216,0.10) 0%, transparent 45%),
        radial-gradient(ellipse at 5% 80%, rgba(15,50,150,0.07) 0%, transparent 40%);
}

/* ─── TOP BAR ──────────────────────────────────────────── */
.fb-top-bar {
    position:relative; z-index:10; flex-shrink:0;
    display:flex; align-items:center; justify-content:space-between; gap:16px;
    padding:10px 22px;
    background: rgba(10,17,36,0.88);
    backdrop-filter: blur(24px);
    -webkit-backdrop-filter: blur(24px);
    border-bottom: 1px solid rgba(255,255,255,0.07);
    box-shadow: 0 1px 0 rgba(255,255,255,0.03), 0 4px 24px rgba(0,0,0,0.3);
}
.fb-top-left,
.fb-top-center,
.fb-top-right {
    min-width: 0;
}

/* Track pills */
.fb-track-group { display:flex; align-items:center; gap:6px; flex-shrink:0; }
.fb-track-pill {
    display:flex; align-items:center; gap:7px;
    padding:6px 13px; border-radius:20px; border:1px solid rgba(255,255,255,.09);
    background:rgba(255,255,255,.05); color:#94a3b8;
    font-size:.67rem; font-weight:800; text-transform:uppercase; letter-spacing:.6px;
    cursor:pointer; transition:all .22s cubic-bezier(0.4,0,0.2,1); white-space:nowrap;
    position:relative; overflow:hidden;
}
.fb-track-pill::before {
    content:''; position:absolute; inset:0; border-radius:20px;
    background: rgba(255,255,255,0);
    transition: background 0.22s;
    pointer-events:none;
}
.fb-track-pill i { font-size:.72rem; transition:color .22s; }
.fb-track-pill:hover:not(:disabled) { background:rgba(59,130,246,.12); border-color:rgba(59,130,246,.28); color:#93c5fd; transform:translateY(-1px); box-shadow:0 4px 12px rgba(37,99,235,.12); }
.fb-track-pill:active:not(:disabled) { transform:translateY(0); box-shadow:none; }
.fb-track-pill.active {
    background:linear-gradient(135deg,#2563eb,#1e50d9);
    border-color:rgba(96,165,250,.45); color:#fff;
    box-shadow:0 4px 18px rgba(37,99,235,.38), inset 0 1px 0 rgba(255,255,255,.12);
}
.fb-track-pill.active i { color:#bfdbfe; }

/* Disabled pill state */
.fb-pill-disabled {
    opacity: 0.32 !important;
    cursor: not-allowed !important;
    pointer-events: none;
    border-color: rgba(255,255,255,0.04) !important;
    background: rgba(255,255,255,0.02) !important;
    color: #3d4f6a !important;
    box-shadow: none !important;
    transform: none !important;
}
.fb-pill-disabled i { color: #2d3d52 !important; }

/* Title center */
.fb-title-center { flex:1; text-align:center; min-width:0; }
.fb-hymn-title {
    font-family:'Outfit',sans-serif;
    font-size:1rem; font-weight:800; color:#f1f5f9; margin:0; line-height:1.2;
    white-space:nowrap; overflow:hidden; text-overflow:ellipsis;
}
.fb-hymn-sub { font-size:.6rem; color:#475569; font-weight:600; letter-spacing:.4px; }

/* Right group - Fixed alignment */
.fb-top-right {
    display:flex;
    align-items:center;
    gap:8px;
    flex-shrink:0;
}
.fb-vdivider { width:1px; height:22px; background:rgba(255,255,255,.07); margin:0 2px; }
.fb-ctrl-btn {
    width:34px; height:34px; border-radius:10px; border:1px solid rgba(255,255,255,.07);
    background:rgba(255,255,255,.04); color:#7a90ab;
    font-size:.82rem; display:flex; align-items:center; justify-content:center;
    cursor:pointer; transition:all .2s cubic-bezier(0.4,0,0.2,1); flex-shrink:0;
}
.fb-ctrl-btn i {
    display: flex;
    align-items: center;
    justify-content: center;
}
.fb-ctrl-btn:hover { background:rgba(59,130,246,.16); border-color:rgba(59,130,246,.25); color:#60a5fa; transform:translateY(-1px); }
.fb-ctrl-btn:active { transform:translateY(0); }
.fb-close-btn:hover { background:rgba(239,68,68,.16); border-color:rgba(239,68,68,.25); color:#f87171; transform:translateY(-1px); }
.fb-zoom-label { font-size:.68rem; color:#5a6f88; font-weight:700; min-width:36px; text-align:center; font-family:'Outfit',sans-serif; }

/* View toggle - Fixed alignment */
.fb-view-toggle, .fb-extra-ctrls {
    display:flex; align-items:center; gap:4px;
    background:rgba(10,18,38,0.55); padding:3px; border-radius:14px;
    border:1px solid rgba(255,255,255,0.07);
    box-shadow: inset 0 1px 2px rgba(0,0,0,0.2);
}

/* ── "MORE" OVERFLOW MENU ─────────────────────────────────────────
   Desktop: fb-more-panel lays out inline exactly like the controls used
   to, and the kebab trigger is hidden — no visual change from before.
   Mobile (≤768px): the kebab becomes the only trigger for Details,
   Playlist, Zoom, Download and Fullscreen, collapsing what used to be
   2-3 crowded rows into a single dropdown sheet. Score/Lyrics and Close
   stay always visible since those are primary, frequently-used controls. */
.fb-more-toggle-btn { display: none; }
.fb-more-panel {
    display: flex;
    align-items: center;
}
.fb-more-hide-desktop { display: none; }

@media(max-width:768px){
    .fb-more-toggle-btn { display:flex; }
    .fb-more-panel {
        position: absolute;
        top: calc(100% + 10px);
        right: 8px;
        z-index: 150;
        flex-direction: column;
        align-items: stretch;
        gap: 10px;
        min-width: 220px;
        max-width: calc(100vw - 24px);
        padding: 12px;
        border-radius: 18px;
        background: rgba(10,18,38,0.97);
        backdrop-filter: blur(20px); -webkit-backdrop-filter: blur(20px);
        border: 1px solid rgba(255,255,255,.1);
        box-shadow: 0 24px 60px rgba(0,0,0,.6), 0 0 0 1px rgba(255,255,255,.04);
        display: none;
    }
    .fb-more-panel.open { display: flex; }
    .fb-more-panel .fb-extra-ctrls,
    .fb-more-panel .fb-zoom-ctrl,
    .fb-more-panel .fb-dl-wrap {
        background: transparent; border: none; box-shadow: none; padding: 0;
        margin-right: 0 !important;
    }
    .fb-more-panel .fb-extra-ctrls,
    .fb-more-panel .fb-zoom-ctrl {
        flex-direction: column;
        align-items: stretch;
        gap: 8px;
    }
    /* Full-width, labelled rows are easier to read/tap in a vertical sheet
       than the icon-only pills used in the compact horizontal bar */
    .fb-more-panel .fb-track-pill,
    .fb-more-panel #fb-fullscreen,
    .fb-more-panel #fb-dl-toggle {
        width: 100%;
        justify-content: flex-start;
        gap: 10px;
        padding: 0 14px;
    }
    .fb-more-panel .fb-track-pill span,
    .fb-more-panel .fb-more-hide-desktop {
        display: inline;
    }
    .fb-more-panel .fb-zoom-ctrl {
        flex-direction: row;
        justify-content: center;
    }
    .fb-more-panel #fb-dropdown {
        position: static;
        margin-top: 8px;
        width: 100%;
        box-shadow: none;
        border-color: rgba(255,255,255,.06);
    }
}

/* Zoom control row */
.fb-zoom-ctrl {
    display:flex; align-items:center; gap:3px;
    background:rgba(10,18,38,0.55); padding:3px; border-radius:14px;
    border:1px solid rgba(255,255,255,0.07);
    box-shadow: inset 0 1px 2px rgba(0,0,0,0.2);
}
.fb-zoom-ctrl .fb-ctrl-btn { width:30px; height:30px; background:transparent; border:none; font-size:0.72rem; }
.fb-zoom-ctrl .fb-ctrl-btn:hover { background:rgba(255,255,255,0.06); border:none; transform:none; }

/* Download */
.fb-dl-wrap { position:relative; }
.fb-dropdown {
    display:none; position:absolute; top:calc(100% + 10px); right:0;
    background:rgba(10,18,38,0.97);
    backdrop-filter:blur(20px); -webkit-backdrop-filter:blur(20px);
    border:1px solid rgba(255,255,255,.1); border-radius:16px;
    padding:6px; min-width:170px; z-index:100;
    box-shadow:0 24px 60px rgba(0,0,0,.6), 0 0 0 1px rgba(255,255,255,.04);
}
.fb-dl-item {
    display:flex; align-items:center; gap:9px;
    padding:9px 13px; border-radius:10px; color:#94a3b8;
    font-size:.71rem; font-weight:700; text-decoration:none; transition:all .15s;
    white-space:nowrap;
}
.fb-dl-item:hover { background:rgba(59,130,246,.14); color:#93c5fd; }
.fb-dl-item i { width:14px; text-align:center; color:#3b82f6; }

/* ─── STAGE ─────────────────────────────────────────────── */
.fb-stage {
    flex:1; position:relative; z-index:5;
    display:flex; align-items:center; justify-content:center;
    overflow-y:auto;
    overflow-x:hidden;
    padding:25px; /* Consistent internal margins */
    touch-action: auto;
}
.fb-stage.fb-zoomed {
    align-items: flex-start;
    justify-content: flex-start;
    cursor: grab;
}
.fb-stage.fb-zoomed.fb-panning { cursor: grabbing; }
.fb-zoom-surface.fb-no-anim { transition: none !important; }

/* ─── BOOK ───────────────────────────────────────────────── */
/* perspective on wrap; preserve-3d on book so children inherit 3D context */
.fb-book-wrap {
    display:flex; align-items:center; justify-content:center;
    width: 100%; height: 100%;
    min-width: 100%;
    min-height: 100%;
    flex: 0 0 auto;
    perspective: 1600px;
    perspective-origin: 50% 48%;
}
.fb-zoom-surface {
    transform: scale(1);
    transform-origin: 50% 50%;
    transition: transform 150ms cubic-bezier(0.4,0,0.2,1);
    will-change: transform;
    overflow-x: hidden;
}
.fb-book {
    display:flex; align-items:stretch;
    box-shadow:
        0 80px 160px rgba(0,0,0,.95),
        0 30px 70px rgba(0,0,0,.75),
        0 0 0 1px rgba(255,255,255,.06),
        0 0 0 3px rgba(0,0,0,.4);
    border: none;
    overflow: visible;
    position: relative;
    transform-style: preserve-3d;
    box-sizing: border-box;
    max-width: 100%;
    max-height: 100%;
    border-radius: 2px 6px 6px 2px;
    transition: box-shadow 0.3s ease;
}
.fb-book.is-flipping {
    box-shadow:
        0 100px 200px rgba(0,0,0,.98),
        0 40px 90px rgba(0,0,0,.8),
        0 0 0 1px rgba(255,255,255,.07),
        0 0 0 3px rgba(0,0,0,.5);
}
.fb-book.is-flipping .fb-page {
    opacity: 0.98;
    filter: brightness(0.995) saturate(0.99);
}
.fb-page {
    background:#fff; overflow:hidden; position:relative; flex-shrink:0;
    box-shadow: inset 0 0 80px rgba(0,0,0,0.04);
    width: var(--fb-page-width, 400px);
    height: var(--fb-page-height, 600px);
    box-sizing: border-box;
    /* translateZ(0) promotes each page to its own GPU layer; the width/height
       ease smooths the one-shot snap to new page dimensions after a resize */
    transform: translateZ(0);
    backface-visibility: hidden;
    -webkit-backface-visibility: hidden;
    transition: width 0.22s ease, height 0.22s ease, opacity 0.16s ease, filter 0.16s ease;
}
.fb-page-left  { border-radius:3px 0 0 3px; }
.fb-page-right { border-radius:0 5px 5px 0; }
.fb-page-inner { width:100%; height:100%; position:relative; overflow:hidden; contain: layout paint; }
.fb-canvas { display:block; width:100% !important; height:auto !important; max-width: 100%; }

/* Single page overrides (mobile/tablet, or when fbTotal === 1) — the
   turning leaf stays enabled here (unlike before) so single-page mode gets
   the exact same true 3D content-flip as the desktop two-page spread; it
   just spans the full page width instead of half. */
.fb-book-wrap.fb-single-page .fb-page-right,
.fb-book-wrap.fb-single-page .fb-spine {
    display: none !important;
}
.fb-book-wrap.fb-single-page .fb-page-left {
    border-radius: 4px 6px 6px 4px !important;
}
.fb-book-wrap.fb-single-page .fb-turning-page {
    width: 100%;
}
.fb-page-num { position:absolute; bottom:9px; left:50%; transform:translateX(-50%); font-size:.58rem; font-weight:700; color:#b0b8c4; font-family:'Outfit',sans-serif; letter-spacing:.3px; }
.fb-page-curl { position:absolute; width:40px; height:40px; pointer-events:none; z-index:10; opacity:0.7; }
.fb-curl-tl { top:0; left:0; background:linear-gradient(135deg,#c0c6cd 0%,rgba(255,255,255,0) 60%); border-radius:0 0 100% 0; box-shadow:2px 2px 6px rgba(0,0,0,.08); }
.fb-curl-br { bottom:0; right:0; background:linear-gradient(315deg,#c0c6cd 0%,rgba(255,255,255,0) 60%); border-radius:100% 0 0 0; box-shadow:-2px -2px 6px rgba(0,0,0,.08); }
.fb-spine {
    width:16px; flex-shrink:0;
    background:linear-gradient(to right, #7a8898 0%, #b8c4d0 35%, #d4dce6 55%, #c8d0da 70%, #a0acba 100%);
    display:flex; align-items:center; justify-content:center;
    box-shadow:inset -4px 0 8px rgba(0,0,0,.18),inset 3px 0 6px rgba(255,255,255,.12), inset 1px 0 0 rgba(255,255,255,.2);
}
.fb-spine-line { width:1px; height:88%; background:rgba(0,0,0,.08); border-radius:1px; }

/* ══ PAGE TURN ANIMATION ══════════════════════════════════════════ */

/* The turning page pivots from the spine edge */
.fb-turning-page {
    position: absolute;
    top: 0;
    width: 50%;
    height: 100%;
    transform-style: preserve-3d;
    pointer-events: none;
    z-index: 50;
    display: none;
    will-change: transform, opacity, filter;
    border-radius: 0 5px 5px 0;
    overflow: visible;
    backface-visibility: hidden;
    -webkit-backface-visibility: hidden;
    transform: translateZ(0);
}

.fb-turning-page::before,
.fb-turning-page::after {
    content: '';
    position: absolute;
    inset: 0;
    pointer-events: none;
    border-radius: inherit;
}

.fb-turning-page::before {
    opacity: 0;
}

.fb-turning-page::after {
    opacity: 0.08;
}

/* Front face: the page you see while it lifts */
.fb-tp-front, .fb-tp-back {
    position: absolute; inset: 0;
    backface-visibility: hidden;
    -webkit-backface-visibility: hidden;
}
.fb-tp-front {
    background: #ffffff;
    box-shadow: inset -10px 0 24px rgba(0,0,0,0.06);
    border-radius: 0 5px 5px 0;
}
.fb-tp-back {
    /* Reverse page face — warm paper, subtly tinted */
    background: linear-gradient(to right, #f0ece6 0%, #f5f3ef 100%);
    transform: rotateY(180deg);
    box-shadow: inset 10px 0 24px rgba(0,0,0,0.05);
    border-radius: 0 5px 5px 0;
}

/* Dynamic curl shading: a light/shadow wash sweeps over the leaf faces while
   they rotate — the visual cue that paper is bending, not a flat card.
   Only opacity animates, so it stays on the compositor. */
.fb-tp-front::after,
.fb-tp-back::after {
    content: '';
    position: absolute; inset: 0;
    pointer-events: none;
    opacity: 0;
    border-radius: inherit;
}
.fb-tp-front::after {
    background: linear-gradient(to left,
        rgba(0,0,0,0.26) 0%, rgba(0,0,0,0.05) 38%,
        rgba(255,255,255,0.12) 68%, rgba(255,255,255,0) 100%);
}
.fb-tp-back::after {
    background: linear-gradient(to right,
        rgba(0,0,0,0.22) 0%, rgba(0,0,0,0.04) 42%,
        rgba(255,255,255,0.10) 72%, rgba(255,255,255,0) 100%);
}
.fb-turning-right .fb-tp-front::after,
.fb-turning-right .fb-tp-back::after,
.fb-turning-left .fb-tp-front::after,
.fb-turning-left .fb-tp-back::after {
    animation: fb-leaf-shade 0.65s cubic-bezier(0.22, 1, 0.36, 1) forwards;
}
@keyframes fb-leaf-shade {
    0%   { opacity: 0; }
    30%  { opacity: 1; }
    70%  { opacity: 1; }
    100% { opacity: 0; }
}

/* Promote the book to its own GPU layer only while an animation is live —
   permanent will-change wastes compositor memory */
.fb-book.is-flipping {
    will-change: transform;
}

@keyframes fb-turn-forward {
    0%   {
        transform: rotateY(0deg) translateZ(0px);
        filter: brightness(1);
    }
    16%  {
        transform: translateX(-1.2%) rotateY(-14deg) translateZ(14px) scaleX(0.996) scaleY(1.003);
        filter: brightness(0.99) saturate(0.995);
    }
    38%  {
        transform: translateX(-4.4%) rotateY(-60deg) translateZ(46px) scaleX(0.976) scaleY(1.008);
        filter: brightness(0.94) saturate(0.988);
    }
    60%  {
        transform: translateX(-7%) rotateY(-94deg) translateZ(68px) scaleX(0.958) scaleY(1.012);
        filter: brightness(0.87) saturate(0.984);
    }
    82%  {
        transform: translateX(-4%) rotateY(-136deg) translateZ(38px) scaleX(0.975) scaleY(1.006);
        filter: brightness(0.95) saturate(0.99);
    }
    100% {
        transform: translateX(0) rotateY(-180deg) translateZ(0px) scaleX(1) scaleY(1);
        filter: brightness(1) saturate(1);
    }
}

@keyframes fb-turn-backward {
    0%   {
        transform: rotateY(-180deg) translateZ(0px);
        filter: brightness(1);
    }
    16%  {
        transform: translateX(1.2%) rotateY(-166deg) translateZ(14px) scaleX(0.996) scaleY(1.003);
        filter: brightness(0.99) saturate(0.995);
    }
    38%  {
        transform: translateX(4.4%) rotateY(-120deg) translateZ(46px) scaleX(0.976) scaleY(1.008);
        filter: brightness(0.94) saturate(0.988);
    }
    60%  {
        transform: translateX(7%) rotateY(-86deg) translateZ(68px) scaleX(0.958) scaleY(1.012);
        filter: brightness(0.87) saturate(0.984);
    }
    82%  {
        transform: translateX(4%) rotateY(-44deg) translateZ(38px) scaleX(0.975) scaleY(1.006);
        filter: brightness(0.95) saturate(0.99);
    }
    100% {
        transform: translateX(0) rotateY(0deg) translateZ(0px) scaleX(1) scaleY(1);
        filter: brightness(1) saturate(1);
    }
}

@keyframes fb-turn-shadow-forward {
    0%   { opacity: 0; transform: translateX(-1%) scaleX(0.98); }
    18%  { opacity: 0.18; }
    48%  { opacity: 0.82; transform: translateX(-6%) scaleX(0.92); }
    76%  { opacity: 0.5; transform: translateX(-2%) scaleX(0.96); }
    100% { opacity: 0; transform: translateX(-1%) scaleX(0.98); }
}
@keyframes fb-turn-shadow-backward {
    0%   { opacity: 0; transform: translateX(1%) scaleX(0.98); }
    18%  { opacity: 0.18; }
    48%  { opacity: 0.82; transform: translateX(6%) scaleX(0.92); }
    76%  { opacity: 0.5; transform: translateX(2%) scaleX(0.96); }
    100% { opacity: 0; transform: translateX(1%) scaleX(0.98); }
}
@keyframes fb-turn-glow-forward {
    0%   { opacity: 0.06; transform: translateX(1%) scaleX(0.98); }
    34%  { opacity: 0.16; }
    56%  { opacity: 0.24; transform: translateX(-4%) scaleX(0.9); }
    100% { opacity: 0.06; transform: translateX(1%) scaleX(0.98); }
}
@keyframes fb-turn-glow-backward {
    0%   { opacity: 0.06; transform: translateX(-1%) scaleX(0.98); }
    34%  { opacity: 0.16; }
    56%  { opacity: 0.24; transform: translateX(4%) scaleX(0.9); }
    100% { opacity: 0.06; transform: translateX(-1%) scaleX(0.98); }
}


.fb-turning-right {
    right: 0; left: auto;
    transform-origin: left center;
    animation: fb-turn-forward var(--fb-turn-duration) var(--fb-turn-ease) forwards;
}
.fb-turning-left {
    left: 0; right: auto;
    transform-origin: right center;
    animation: fb-turn-backward var(--fb-turn-duration) var(--fb-turn-ease) forwards;
}
.fb-turning-right::before {
    background: linear-gradient(to right, rgba(0,0,0,0.42) 0%, rgba(0,0,0,0.18) 22%, rgba(0,0,0,0.06) 44%, transparent 78%);
    animation: fb-turn-shadow-forward var(--fb-turn-duration) var(--fb-turn-ease) forwards;
}
.fb-turning-left::before {
    background: linear-gradient(to left, rgba(0,0,0,0.42) 0%, rgba(0,0,0,0.18) 22%, rgba(0,0,0,0.06) 44%, transparent 78%);
    animation: fb-turn-shadow-backward var(--fb-turn-duration) var(--fb-turn-ease) forwards;
}
.fb-turning-right::after {
    background: linear-gradient(to left, rgba(255,255,255,0.2) 0%, rgba(255,255,255,0.08) 28%, transparent 74%);
    animation: fb-turn-glow-forward var(--fb-turn-duration) var(--fb-turn-ease) forwards;
}
.fb-turning-left::after {
    background: linear-gradient(to right, rgba(255,255,255,0.2) 0%, rgba(255,255,255,0.08) 28%, transparent 74%);
    animation: fb-turn-glow-backward var(--fb-turn-duration) var(--fb-turn-ease) forwards;
}

/* ── MANUAL (pointer-driven) FLIP — drag-to-flip physics ─────────────
   JS drives the leaf transform each frame via requestAnimationFrame; the
   shadow/glow overlays follow drag progress through --fb-drag-shade
   instead of a fixed keyframe timeline. */
.fb-turning-page.fb-manual { will-change: transform; }
.fb-manual-fwd  { right: 0; left: auto; transform-origin: left center; }
.fb-manual-back { left: 0; right: auto; transform-origin: right center; }
.fb-manual-fwd::before {
    background: linear-gradient(to right, rgba(0,0,0,0.42) 0%, rgba(0,0,0,0.18) 22%, rgba(0,0,0,0.06) 44%, transparent 78%);
    opacity: calc(var(--fb-drag-shade, 0) * 0.82);
}
.fb-manual-back::before {
    background: linear-gradient(to left, rgba(0,0,0,0.42) 0%, rgba(0,0,0,0.18) 22%, rgba(0,0,0,0.06) 44%, transparent 78%);
    opacity: calc(var(--fb-drag-shade, 0) * 0.82);
}
.fb-manual-fwd::after {
    background: linear-gradient(to left, rgba(255,255,255,0.2) 0%, rgba(255,255,255,0.08) 28%, transparent 74%);
    opacity: calc(0.06 + var(--fb-drag-shade, 0) * 0.18);
}
.fb-manual-back::after {
    background: linear-gradient(to right, rgba(255,255,255,0.2) 0%, rgba(255,255,255,0.08) 28%, transparent 74%);
    opacity: calc(0.06 + var(--fb-drag-shade, 0) * 0.18);
}
.fb-turning-page.fb-manual .fb-tp-front::after,
.fb-turning-page.fb-manual .fb-tp-back::after {
    animation: none;
    opacity: var(--fb-drag-shade, 0);
}
.fb-stage.fb-drag-flipping {
    cursor: grabbing;
    user-select: none;
    -webkit-user-select: none;
}

/* Nav arrows — Publuu-inspired: circular, ghost by default, reveal on hover */
.fb-nav-arrow {
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    width: 48px; height: 48px;
    border-radius: 50%;
    border: 1px solid rgba(255,255,255,0.22);
    background: rgba(15,23,42,0.68);
    color: #f1f5f9;
    font-size: 1rem;
    display: flex; align-items: center; justify-content: center;
    cursor: pointer;
    transition: opacity 0.24s ease, background 0.22s ease, border-color 0.22s ease,
                box-shadow 0.22s ease, transform 0.18s cubic-bezier(0.4,0,0.2,1);
    backdrop-filter: blur(18px);
    -webkit-backdrop-filter: blur(18px);
    /* Glassmorphism + a soft blue glow ring so the button reads clearly
       against a dark backdrop without needing hover to become visible —
       hover on a touchscreen never fires, so this can't be the resting state. */
    box-shadow: 0 4px 18px rgba(0,0,0,0.35), 0 0 0 1px rgba(96,165,250,0.14),
                inset 0 1px 0 rgba(255,255,255,0.1);
    z-index: 80;
    opacity: 0.62;
}
#fb-prev { left: 16px; }
#fb-next { right: 16px; }
#fb-stage:hover .fb-nav-arrow:not(:disabled) { opacity: 0.95; }
.fb-nav-arrow:hover:not(:disabled) {
    background: rgba(37,99,235,0.45);
    border-color: rgba(96,165,250,0.5);
    color: #fff;
    transform: translateY(-50%) scale(1.1);
    box-shadow: 0 6px 22px rgba(37,99,235,0.32), inset 0 1px 0 rgba(255,255,255,0.1);
    opacity: 1 !important;
}
.fb-nav-arrow:active:not(:disabled) {
    transform: translateY(-50%) scale(0.95);
    box-shadow: 0 2px 8px rgba(37,99,235,0.2);
}
.fb-nav-arrow:disabled {
    opacity: 0 !important;
    pointer-events: none;
}

/* Lyrics view */
#fb-lyrics-view::-webkit-scrollbar-thumb { background:rgba(255,255,255,.1); border-radius:4px; }

/* ── EQ Visualizer ─────────────────────────────────────────────── */
.fb-eq-visualizer { display:flex; align-items:flex-end; gap:2px; height:12px; margin-right:8px; display: none; }
.fb-eq-visualizer.show { display: flex; }
.fb-eq-bar { width:2px; height:30%; background:#3b82f6; border-radius:1px; transition:height 0.2s ease; }
.fb-eq-bar.animating { animation:fb-eq-anim 0.6s ease-in-out infinite alternate; }
.fb-eq-bar:nth-child(2) { animation-delay:0.1s; }
.fb-eq-bar:nth-child(3) { animation-delay:0.3s; }
.fb-eq-bar:nth-child(4) { animation-delay:0.2s; }
@keyframes fb-eq-anim { 0%{height:20%} 100%{height:100%} }

/* ── Start Overlay ─────────────────────────────────────────────── */
.fb-start-overlay {
    position:absolute; inset:0; background:rgba(6,12,26,0.9);
    z-index:99999; display:none; align-items:center; justify-content:center; cursor:pointer;
}
.fb-start-overlay.show { display:flex; animation:fb-fade-in 0.4s ease; }
.fb-start-card { text-align:center; color:white; }
.fb-start-icon { font-size:4rem; color:#3b82f6; margin-bottom:1rem; filter:drop-shadow(0 0 20px rgba(59,130,246,0.5)); }
.fb-start-card h3 { font-family:'Outfit',sans-serif; font-weight:800; text-transform:uppercase; letter-spacing:2px; }
@keyframes fb-fade-in { from{opacity:0} to{opacity:1} }

/* ── LOAD ERROR STATE ──────────────────────────────────────────── */
.fb-load-error {
    position: absolute;
    inset: 0;
    z-index: 90000;
    display: none;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    text-align: center;
    padding: 2rem;
    background: rgba(6, 12, 26, 0.94);
    backdrop-filter: blur(6px);
    -webkit-backdrop-filter: blur(6px);
    color: #e2e8f0;
}
.fb-load-error:not([hidden]) { display: flex; animation: fb-fade-in 0.3s ease; }
.fb-load-error-icon { font-size: 2.75rem; color: #f59e0b; margin-bottom: 1rem; }
.fb-load-error h3 { margin: 0 0 0.5rem; font-family:'Outfit',sans-serif; font-weight: 800; font-size: 1.2rem; color: #f8fafc; }
.fb-load-error p { margin: 0 0 1.5rem; max-width: 32rem; color: #94a3b8; font-size: 0.9rem; line-height: 1.6; }
.fb-load-error-actions { display: flex; gap: 0.75rem; flex-wrap: wrap; justify-content: center; }
.fb-load-error-btn {
    display: inline-flex; align-items: center; gap: 0.5rem;
    min-height: 44px; padding: 0 1.25rem;
    border-radius: 999px; font-weight: 800; font-size: 0.85rem;
    text-decoration: none !important; cursor: pointer;
    border: 1px solid rgba(255,255,255,0.16);
    background: rgba(255,255,255,0.06);
    color: #e2e8f0;
    transition: all 0.2s ease;
}
.fb-load-error-btn:hover { background: rgba(255,255,255,0.12); color: #fff; transform: translateY(-1px); }
.fb-load-error-btn-primary { background: linear-gradient(135deg, #2563eb, #1d4ed8); border-color: rgba(96,165,250,0.4); color: #fff; }
.fb-load-error-btn-primary:hover { background: linear-gradient(135deg, #3b82f6, #2563eb); color: #fff; }

/* ── EXIT TRANSITION OVERLAY ───────────────────────────────────── */
.fb-exit-overlay {
    position: absolute; inset: 0; z-index: 100000;
    background: #0a0f1e; /* matches the theater backdrop for a seamless fade */
    opacity: 0; pointer-events: none;
    display: flex; align-items: center; justify-content: center;
    transition: opacity 0.28s ease;
}
#flipbook-theater.fb-exiting .fb-exit-overlay {
    opacity: 1;
    pointer-events: auto; /* swallow clicks while navigating */
}
.fb-exit-spinner {
    width: 34px; height: 34px; border-radius: 50%;
    border: 3px solid rgba(148,163,184,0.25);
    border-top-color: #3b82f6;
    animation: fb-exit-spin 0.7s linear infinite;
    opacity: 0;
    transition: opacity 0.2s ease 0.3s; /* only shows if the next page is slow */
}
#flipbook-theater.fb-exiting .fb-exit-spinner { opacity: 1; }
@keyframes fb-exit-spin { to { transform: rotate(360deg); } }
#flipbook-theater.fb-light-mode .fb-exit-overlay { background: #e8eef6; }

/* ── RESIZE FREEZE: no transitions/animations while the window is being
      dragged, so breakpoint/page-size recalcs can't produce mid-resize jitter */
#flipbook-theater.fb-resizing .fb-page,
#flipbook-theater.fb-resizing .fb-book,
#flipbook-theater.fb-resizing .fb-turning-page,
#flipbook-theater.fb-resizing .fb-zoom-surface {
    transition: none !important;
    animation: none !important;
}

/* ─── BOTTOM COMMAND CENTER ────────────────────────────── */
.fb-command-center {
    position:relative; z-index:10; flex-shrink:0;
    padding-bottom: 10px;
    background: rgba(8,14,30,0.95);
    backdrop-filter: blur(24px);
    -webkit-backdrop-filter: blur(24px);
    border-top: none;
    box-shadow: 0 -20px 40px rgba(0,0,0,0.55);
    overflow: visible;
}

/* Title Strip — centered hymn title at the top of the command center */
.fb-title-strip {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    padding: 5px 20px 4px;
    border-bottom: 1px solid rgba(255,255,255,0.04);
}
.fb-hymn-title-bottom {
    margin: 0;
    font-family: 'Outfit', sans-serif;
    font-size: 0.88rem;
    font-weight: 800;
    color: #f1f5f9;
    text-align: center;
    letter-spacing: 0.4px;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
    max-width: 58vw;
}
.fb-track-status-bottom {
    font-size: .57rem;
    font-weight: 700;
    color: #3d5068;
    text-transform: uppercase;
    letter-spacing: 1.8px;
    white-space: nowrap;
    flex-shrink: 0;
}

/* Audio Row */
.fb-audio-row {
    display:flex; align-items:center; gap:10px;
    padding:6px 18px 4px;
}
.fb-play-sphere {
    width:36px; height:36px; border-radius:50%; flex-shrink:0;
    background:linear-gradient(145deg,#2d6cf0,#1a47c2);
    border: 1px solid rgba(96,165,250,.3);
    color:#fff; font-size:.85rem;
    display:flex; align-items:center; justify-content:center;
    cursor:pointer; transition:all .25s cubic-bezier(0.4,0,0.2,1);
    box-shadow:0 4px 14px rgba(37,99,235,.38), inset 0 1px 0 rgba(255,255,255,.15);
}
.fb-play-sphere:hover {
    transform:scale(1.1) translateY(-1px);
    box-shadow:0 10px 28px rgba(37,99,235,.5), inset 0 1px 0 rgba(255,255,255,.15);
    background:linear-gradient(145deg,#3b80ff,#2256d6);
}
.fb-play-sphere:active { transform:scale(0.96); }
.fb-now-playing-wrap {
    padding:5px 12px; background:rgba(255,255,255,0.04); border-radius:20px;
    border:1px solid rgba(255,255,255,0.06); min-width:110px; text-align:center;
}
.fb-timestamp { font-size:.63rem; font-weight:800; color:#3d5068; font-family:'Outfit',monospace; white-space:nowrap; }
.fb-audio-track-wrap {
    flex:1; position:relative; height:4px;
    background:rgba(255,255,255,.07); border-radius:8px;
    display:flex; align-items:center; min-width:80px;
    cursor:pointer;
}
.fb-audio-track-wrap:hover { height:5px; }
.fb-audio-scrubber {
    position:absolute; width:100%; height:100%;
    -webkit-appearance:none; background:transparent; cursor:pointer; z-index:5;
}
.fb-audio-scrubber::-webkit-slider-thumb {
    -webkit-appearance:none; width:13px; height:13px; border-radius:50%;
    background:#3b82f6; border:2px solid rgba(255,255,255,.9);
    box-shadow:0 0 8px rgba(59,130,246,.5); cursor:pointer; transition:transform .18s;
}
.fb-audio-scrubber::-webkit-slider-thumb:hover { transform:scale(1.35); }
.fb-audio-fill { position:absolute; height:100%; background:linear-gradient(to right,#2d6cf0,#60a5fa); border-radius:8px; pointer-events:none; width:0%; }
.fb-vol-wrap { display:flex; align-items:center; gap:6px; flex-shrink:0; }
.fb-vol-icon { color:#3d5068; font-size:.68rem; }
.fb-vol-slider { width:68px; height:3px; -webkit-appearance:none; background:rgba(255,255,255,.09); border-radius:4px; cursor:pointer; }
.fb-vol-slider::-webkit-slider-thumb { -webkit-appearance:none; width:11px; height:11px; border-radius:50%; background:#3b82f6; cursor:pointer; }
.fb-now-playing { display:flex; align-items:center; gap:8px; padding:4px 12px; background:rgba(255,255,255,.04); border-radius:20px; border:1px solid rgba(255,255,255,.06); flex-shrink:0; }
.fb-eq-dot {
    width:7px; height:7px; border-radius:50%;
    background:#3b82f6; flex-shrink:0;
    box-shadow:0 0 0 0 rgba(59,130,246,.5);
}
.fb-eq-dot.playing { animation:fb-eq-pulse 1.4s ease infinite; }
@keyframes fb-eq-pulse { 0%{box-shadow:0 0 0 0 rgba(59,130,246,.5)} 70%{box-shadow:0 0 0 6px rgba(59,130,246,0)} 100%{box-shadow:0 0 0 0 rgba(59,130,246,0)} }

/* Page scrubber row */
.fb-page-row {
    display:flex; align-items:center; gap:12px;
    padding:2px 18px 6px;
}

/* ── COLLAPSIBLE PLAYER HANDLE ──────────────────────────────────── */
.fb-cc-handle {
    position: absolute;
    top: -16px; left: 50%;
    transform: translateX(-50%);
    width: 48px; height: 18px;
    background: rgba(8,14,30,0.92);
    border: 1px solid rgba(255,255,255,0.07);
    border-bottom: none;
    border-radius: 10px 10px 0 0;
    display: flex; align-items: center; justify-content: center;
    cursor: pointer; color: #3d5068; font-size: 0.5rem;
    transition: color 0.2s ease, background 0.2s ease;
    z-index: 11;
}
.fb-cc-handle:hover { color: #60a5fa; background: rgba(12,20,42,0.96); }
.fb-command-center {
    position: relative; /* ensure handle positions relative to it */
}
.fb-command-center.fb-cc-collapsed .fb-audio-row,
.fb-command-center.fb-cc-collapsed .fb-page-row {
    display: none !important;
}
.fb-command-center.fb-cc-collapsed .fb-title-strip {
    padding: 5px 20px;
    border-bottom: none;
}
.fb-command-center.fb-cc-collapsed {
    padding-bottom: 4px;
}

/* ── FLIP SHADOW CAST ────────────────────────────────────────────── */
.fb-book::after {
    content: '';
    position: absolute;
    top: 0; left: 0;
    width: 50%; height: 100%;
    background: linear-gradient(to left, rgba(0,0,0,0.22) 0%, transparent 65%);
    pointer-events: none;
    z-index: 45;
    opacity: 0;
    border-radius: 3px 0 0 3px;
}
.fb-book.is-flipping::after {
    animation: fb-book-shadow var(--fb-turn-duration) var(--fb-turn-ease) forwards;
}
@keyframes fb-book-shadow {
    0%   { opacity: 0; }
    28%  { opacity: 1; }
    72%  { opacity: 1; }
    100% { opacity: 0; }
}

/* ── SEAMLESS THEATER BACKGROUND ─────────────────────────────────── */
.fb-command-center::before {
    content: '';
    position: absolute;
    top: -18px; left: 0; right: 0;
    height: 18px;
    background: linear-gradient(to bottom, transparent, rgba(8,14,30,0.92));
    pointer-events: none;
    z-index: -1;
}
.fb-page-counter,.fb-hint { font-size:.61rem; font-weight:700; color:#2d3f54; white-space:nowrap; }
.fb-page-counter strong { color:#4a6278; }
.fb-scrub-wrap { flex:1; position:relative; height:3px; background:rgba(255,255,255,.05); border-radius:8px; display:flex; align-items:center; cursor:pointer; }
.fb-scrub-wrap:hover { height:4px; }
.fb-scrubber { position:absolute; width:100%; height:100%; -webkit-appearance:none; background:transparent; cursor:pointer; z-index:5; }
.fb-scrubber::-webkit-slider-thumb { -webkit-appearance:none; width:13px; height:13px; border-radius:50%; background:#3b82f6; border:2px solid #0a0f1e; cursor:pointer; box-shadow:0 0 7px rgba(59,130,246,.4); transition:transform .18s; }
.fb-scrubber::-webkit-slider-thumb:hover { transform:scale(1.3); }
.fb-scrub-fill { position:absolute; height:100%; background:rgba(59,130,246,.45); border-radius:8px; pointer-events:none; width:0%; }

/* Responsive — icon-only pills on small screens (≤900px) */
@media(max-width:900px){
    /* Hide pill text — show icon only */
    .fb-track-pill span { display:none; }
    .fb-track-pill { padding:7px 10px; gap:0; }
    .fb-track-pill i { font-size:0.85rem; }
    /* Tighten the top bar */
    .fb-top-bar { gap:6px; padding:8px 12px; }
    .fb-badge span { display:none; }
    .fb-badge { padding:3px 6px !important; font-size:0.55rem !important; }
}

/* Full pill text visible on desktop (>900px) */
@media(min-width:901px){
    .fb-track-pill span { display:inline; }
}

/* Extra-small screens */
@media(max-width:768px){
    .fb-top-bar {
        gap: 4px;
        padding: 6px 8px;
        flex-wrap: nowrap;
    }
    /* Keep left/center/right side-by-side in a single row instead of each
       stacking onto its own full-width line — that's what turned this into
       3 rows. Groups shrink to fit their content instead of stretching. */
    .fb-top-left,
    .fb-top-center,
    .fb-top-right {
        width: auto;
        flex: 0 1 auto;
        justify-content: flex-start;
        flex-wrap: nowrap;
        gap: 4px !important;
    }
    .fb-top-left { flex-shrink: 0; }
    .fb-top-center { justify-content: center; flex: 1 1 auto; min-width: 0; }
    .fb-top-right { flex-shrink: 0; margin-right: 0 !important; }
    .fb-view-toggle { margin-right: 4px !important; }
    .fb-badge { white-space: nowrap; }
    .fb-hymn-title { font-size:0.8rem !important; }
    .fb-nav-arrow {
        width:44px; height:44px; font-size:.9rem;
        background: rgba(15,23,42,0.82); border-radius: 50%;
        border-color: rgba(255,255,255,0.28);
        backdrop-filter: blur(14px); -webkit-backdrop-filter: blur(14px);
        /* Touch has no :hover, so the arrows must be clearly visible at rest
           — not dependent on #fb-stage:hover, which a touchscreen never fires. */
        opacity: 0.9 !important;
        box-shadow: 0 4px 16px rgba(0,0,0,0.4), 0 0 0 1px rgba(96,165,250,0.22),
                    inset 0 1px 0 rgba(255,255,255,0.12);
    }
    .fb-nav-arrow:active:not(:disabled) { opacity: 1 !important; }
    .fb-nav-arrow:disabled { opacity: 0 !important; }
    #flipbook-theater.fb-light-mode .fb-nav-arrow { opacity: 0.95 !important; }
    #fb-prev { left: 8px; }
    #fb-next { right: 8px; }
    .fb-stage { padding: 6px !important; }
    .fb-vol-wrap,
    .fb-now-playing {
        display: flex;
    }
    .fb-vol-wrap {
        gap: 4px;
    }
    .fb-vol-slider {
        width: 54px;
    }
    .fb-now-playing {
        padding: 3px 8px;
    }
    /* "Spread 1-2/3" and the "← → · Swipe · +/-" hint are redundant on a
       touchscreen (you're already swiping/scrubbing) — drop both so the
       scrubber gets the full row width instead of being squeezed between them. */
    .fb-page-counter,
    .fb-hint {
        display: none;
    }
    .fb-page-row {
        padding: 2px 14px 6px;
        gap: 0;
    }
    /* 40px touch targets: full 44px would wrap the dense toolbar to 3+ rows
       and eat the reading stage — 40px is the compact-toolbar compromise */
    .fb-ctrl-btn { width:40px; height:40px; border-radius:10px; }
    .fb-view-btn { width:40px; height:40px; }
    .fb-track-pill { min-height:40px; min-width:40px; justify-content:center; }
    .fb-play-sphere { width:44px; height:44px; }
    .fb-zoom-label { min-width:28px; font-size:0.58rem; }
    #flipbook-theater { inset: 0; }
    .fb-book { box-shadow: 0 24px 60px rgba(0,0,0,0.6), 0 0 0 1px rgba(255,255,255,0.05); }
    .fb-lyrics-view { padding: 1rem !important; }
    .fb-lyrics-inner { font-size: 1rem !important; line-height: 1.8 !important; width: 100% !important; }
    .fb-lyrics-card { border-radius: 20px; padding: 1.1rem !important; }
    .fb-lyrics-pages { gap: 1rem; }
    .fb-lyrics-text { font-size: 0.96rem !important; line-height: 1.85 !important; }
}

/* ── LYRICS STYLE OVERRIDES ── */
.fb-lyrics-view {
    display:none; width:100%; height:100%; overflow-y:auto; overflow-x:hidden;
    padding:2.25rem 1.5rem; scroll-behavior: smooth;
    background: transparent;
    align-items:flex-start;
    justify-content:center;
}
.fb-lyrics-inner {
    width:min(100%, 920px);
    min-height: 100%;
    margin:0 auto;
    font-family:'Playfair Display',serif;
    font-size:1.35rem; line-height:2.2;
    color:#e2e8f0; text-align:center;
    transition: all 0.3s ease;
}
.fb-lyrics-shell {
    width:100%;
    display:flex;
    justify-content:center;
}
.fb-lyrics-card {
    width:100%;
    background: rgba(15, 23, 42, 0.78);
    border: 1px solid rgba(148, 163, 184, 0.16);
    border-radius: 28px;
    box-shadow: 0 30px 70px rgba(0, 0, 0, 0.35);
    padding: clamp(1.25rem, 3vw, 2.5rem);
    overflow: hidden;
}
.fb-lyrics-pages {
    display:flex;
    flex-direction:column;
    gap:1.25rem;
}
.fb-lyrics-page {
    width:100%;
    display:flex;
    justify-content:center;
}
.fb-lyrics-page canvas {
    display:block;
    max-width:100%;
    height:auto;
    border-radius: 18px;
    box-shadow: 0 16px 40px rgba(0,0,0,.35);
    background: #fff;
}
.fb-lyrics-text {
    font-size: clamp(1rem, 1.8vw, 1.35rem);
    line-height: 1.95;
    text-align:center;
    white-space:pre-wrap;
    word-break:break-word;
}
.fb-lyrics-line {
    margin: 0 0 .5rem;
    padding: .25rem .5rem;
    border-radius: 999px;
    transition: background-color .18s ease, color .18s ease, box-shadow .18s ease, opacity .18s ease;
    scroll-margin-block: 35vh;
    will-change: background-color, color, box-shadow;
}
.fb-lyrics-line--timed {
    display: inline-block;
    min-width: min(100%, 18rem);
}
.fb-lyrics-line.is-active {
    background: rgba(59, 130, 246, 0.18);
    color: #f8fafc;
    box-shadow: inset 0 0 0 1px rgba(96, 165, 250, 0.22), 0 8px 24px rgba(37, 99, 235, 0.14);
}
.fb-lyrics-line--spacer {
    height: 1.1em;
    margin: 0;
    padding: 0;
    border-radius: 0;
    background: transparent;
    box-shadow: none;
    will-change: auto;
}
.fb-lyrics-empty {
    color:#94a3b8;
    padding: 3rem 1.5rem;
    text-align:center;
    font-size: 1rem;
    line-height: 1.8;
}

/* ── INTERAL MODAL STYLES ── */
.fb-sub-overlay {
    position: fixed; inset: 0; z-index: 220;
    background: transparent;
    display: none; align-items: stretch; justify-content: flex-end;
    pointer-events: none;
}
.fb-sub-overlay.active { display: flex; animation: fb-fade-in 0.3s ease; }

.fb-sub-modal {
    display: none; background: #ffffff; width: 100%; max-width: none;
    height: 100%; border-radius: 0; box-shadow: -24px 0 60px rgba(0,0,0,0.35);
    overflow: hidden; flex-direction: column; pointer-events: auto;
}
.fb-sub-modal.active { display: flex; animation: fb-slide-right 0.35s cubic-bezier(0.16, 1, 0.3, 1); }

.fb-sub-overlay.active .fb-sub-modal {
    width: var(--fb-drawer-width, clamp(320px, 34vw, 460px));
    min-width: 300px;
}

#flipbook-theater.fb-right-drawer-open {
    --fb-drawer-width: clamp(320px, 34vw, 460px);
}
#flipbook-theater.fb-right-drawer-open .fb-top-bar,
#flipbook-theater.fb-right-drawer-open .fb-stage,
#flipbook-theater.fb-right-drawer-open .fb-command-center {
    padding-right: calc(24px + var(--fb-drawer-width));
}
#flipbook-theater.fb-right-drawer-open .fb-stage {
    min-width: 0;
}
#flipbook-theater {
    overflow-x: hidden;
}

@media (max-width: 1200px) {
    #flipbook-theater.fb-right-drawer-open {
        --fb-drawer-width: min(42vw, 400px);
    }
}

@media (max-width: 768px) {
    #flipbook-theater.fb-right-drawer-open {
        --fb-drawer-width: min(82vw, 340px);
    }
    #flipbook-theater.fb-right-drawer-open .fb-top-bar,
    #flipbook-theater.fb-right-drawer-open .fb-stage,
    #flipbook-theater.fb-right-drawer-open .fb-command-center {
        padding-right: calc(16px + var(--fb-drawer-width));
    }
}

.fb-modal-header {
    background: #f8fafc; padding: 1.25rem 1.5rem; border-bottom: 1px solid #e2e8f0;
    display: flex; align-items: center; justify-content: space-between;
}
.fb-modal-header h3 { font-family: 'Outfit', sans-serif; font-weight: 800; color: #1e293b; margin: 0; font-size: 1.1rem; }
.fb-modal-close { width: 32px; height: 32px; border-radius: 50%; border: none; background: #fee2e2; color: #ef4444; cursor: pointer; }

.fb-modal-content { flex: 1; overflow-y: auto; padding: 1.5rem; }

/* Details UI */
.fb-details-grid { display: flex; flex-direction: column; gap: 1rem; }
.fb-detail-card { background: #f8fafc; padding: 1.15rem 1.25rem; border-radius: 14px; border: 1px solid #eef2f7; box-shadow: 0 1px 3px rgba(0,0,0,0.04); }
.fb-detail-card.main { background: linear-gradient(135deg,#0c1628,#14204a); color: white; border: none; text-align: center; border-radius: 16px; box-shadow: 0 6px 24px rgba(0,0,0,0.18); }
.fb-detail-label { display: block; font-size: 0.63rem; font-weight: 900; color: #94a3b8; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 0.5rem; }
.fb-detail-title { font-family: 'Playfair Display', serif; font-size: 1.7rem; font-weight: 900; margin-bottom: 0.5rem; }
.fb-detail-number { font-size: 0.78rem; font-weight: 800; font-family: 'Outfit', sans-serif; }
.fb-detail-tags { display: flex; flex-wrap: wrap; gap: 5px; }
.fb-tag { background: white; padding: 3px 10px; border-radius: 8px; font-size: 0.73rem; font-weight: 700; color: #475569; border: 1px solid #e2e8f0; }
.fb-tag.ensemble { background: #eff6ff; color: #2563eb; border-color: #bfdbfe; }
.fb-credits-list { display: flex; flex-direction: column; gap: 0.5rem; font-size: 0.84rem; color: #334155; }
.fb-verse-text { font-family: 'Playfair Display', serif; font-style: italic; font-size: 0.95rem; color: #0c4a6e; line-height: 1.65; margin: 0; }
.fb-creator-link {
    cursor: pointer;
    color: #2563eb;
    font-weight: 700;
    transition: color 0.2s ease, text-decoration-color 0.2s ease, opacity 0.2s ease;
}
.fb-creator-link:hover,
.fb-creator-link:focus {
    color: #1d4ed8;
    text-decoration: underline;
    outline: none;
}

.fb-creator-spotlight {
    margin-top: 1rem;
    padding: 1rem;
    background: linear-gradient(180deg, #ffffff 0%, #f8fafc 100%);
    border: 1px solid #e2e8f0;
    border-radius: 16px;
    box-shadow: 0 10px 30px rgba(15,23,42,0.08);
    display: flex;
    flex-direction: column;
    gap: 0.9rem;
}
.fb-creator-spotlight-head {
    display: flex;
    align-items: flex-start;
    justify-content: space-between;
    gap: 1rem;
}
.fb-creator-name {
    margin: 0.15rem 0 0.2rem;
    font-family: 'Outfit', sans-serif;
    font-weight: 800;
    color: #0f172a;
    font-size: 1rem;
    line-height: 1.25;
}
.fb-creator-role {
    margin: 0;
    font-size: 0.82rem;
    color: #64748b;
    line-height: 1.6;
}
.fb-creator-spotlight-close {
    width: 30px;
    height: 30px;
    flex: 0 0 30px;
    border: none;
    border-radius: 999px;
    background: #fee2e2;
    color: #ef4444;
    cursor: pointer;
}
.fb-creator-spotlight-body {
    display: flex;
    align-items: flex-start;
    gap: 0.9rem;
}
.fb-creator-image {
    width: 74px;
    height: 74px;
    border-radius: 16px;
    object-fit: cover;
    flex: 0 0 74px;
    background: #e2e8f0;
    border: 1px solid #cbd5e1;
}
.fb-creator-meta {
    flex: 1;
    min-width: 0;
    display: grid;
    gap: 0.55rem;
}
.fb-creator-meta-row {
    display: flex;
    flex-direction: column;
    gap: 0.1rem;
}
.fb-creator-meta-label {
    font-size: 0.62rem;
    font-weight: 900;
    letter-spacing: 1px;
    text-transform: uppercase;
    color: #94a3b8;
}
.fb-creator-meta-value {
    font-size: 0.88rem;
    color: #1e293b;
    line-height: 1.4;
    word-break: break-word;
}
.fb-creator-profile-link {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: fit-content;
    padding: 0.5rem 0.9rem;
    margin-top: 0.15rem;
    border-radius: 10px;
    background: #e0f2fe;
    color: #0f4c81;
    font-size: 0.7rem;
    font-weight: 800;
    text-transform: uppercase;
    letter-spacing: 0.7px;
    text-decoration: none;
    transition: transform 0.2s ease, background 0.2s ease, box-shadow 0.2s ease;
}
.fb-creator-profile-link:hover {
    transform: translateY(-2px);
    background: #bae6fd;
    box-shadow: 0 4px 12px rgba(14,116,144,0.15);
}
.fb-creator-background {
    margin: 0;
    padding-top: 0.2rem;
    border-top: 1px solid #e2e8f0;
    color: #334155;
    font-size: 0.88rem;
    line-height: 1.75;
    white-space: pre-wrap;
}

@media (max-width: 768px) {
    .fb-creator-spotlight-body {
        flex-direction: column;
    }
    .fb-creator-image {
        width: 100%;
        height: auto;
        aspect-ratio: 1 / 1;
        max-width: 140px;
    }
}

@keyframes fb-slide-right { from{opacity:0; transform:translateX(32px)} to{opacity:1; transform:translateX(0)} }

/* ─── LIGHT MODE OVERRIDES ────────────────────────────── */
#flipbook-theater.fb-light-mode {
    background: radial-gradient(ellipse at 20% 10%, #e8eef6 0%, #d4dde8 55%, #c8d4e0 100%);
    box-shadow: 0 0 0 1px rgba(0,0,0,0.08), 0 50px 100px -20px rgba(0,0,0,0.25);
}
#flipbook-theater.fb-light-mode::before {
    background:
        radial-gradient(ellipse at 50% 0%, rgba(37,99,235,0.06) 0%, transparent 55%),
        radial-gradient(ellipse at 90% 90%, rgba(29,78,216,0.04) 0%, transparent 45%);
}
#flipbook-theater.fb-light-mode .fb-top-bar,
#flipbook-theater.fb-light-mode .fb-command-center {
    background: rgba(255,255,255,0.92);
    backdrop-filter: blur(20px); -webkit-backdrop-filter: blur(20px);
    border-color: rgba(0,0,0,0.07);
    box-shadow: none;
}
#flipbook-theater.fb-light-mode .fb-badge {
    color: #2563eb !important; border-color: rgba(37,99,235,0.35) !important; background: rgba(37,99,235,0.08) !important;
}
#flipbook-theater.fb-light-mode .fb-track-pill {
    background: rgba(0,0,0,0.04); border-color: rgba(0,0,0,0.09); color: #475569;
}
#flipbook-theater.fb-light-mode .fb-track-pill:hover:not(:disabled) {
    background: rgba(255,255,255,0.85); border-color: rgba(0,0,0,0.14); color: #0f172a; box-shadow: 0 3px 10px rgba(0,0,0,0.08);
}
#flipbook-theater.fb-light-mode .fb-track-pill.active {
    background: linear-gradient(135deg,#2563eb,#1d4ed8); color: #ffffff; border-color: #3b82f6;
    box-shadow: 0 4px 14px rgba(37,99,235,0.3);
}
#flipbook-theater.fb-light-mode .fb-pill-disabled {
    background: rgba(0,0,0,0.02) !important; border-color: rgba(0,0,0,0.04) !important; color: #94a3b8 !important;
}
#flipbook-theater.fb-light-mode .fb-pill-disabled i { color: #c0ccd8 !important; }
#flipbook-theater.fb-light-mode .fb-view-toggle,
#flipbook-theater.fb-light-mode .fb-extra-ctrls,
#flipbook-theater.fb-light-mode .fb-zoom-ctrl {
    background: rgba(241,245,249,0.7); border-color: rgba(0,0,0,0.07); box-shadow: inset 0 1px 2px rgba(0,0,0,0.06);
}
#flipbook-theater.fb-light-mode .fb-ctrl-btn {
    background: rgba(0,0,0,0.04); border-color: rgba(0,0,0,0.07); color: #5a6f88;
}
#flipbook-theater.fb-light-mode .fb-ctrl-btn:hover { background: rgba(37,99,235,0.1); border-color: rgba(37,99,235,0.2); color: #2563eb; transform:translateY(-1px); }
#flipbook-theater.fb-light-mode .fb-close-btn:hover { background: rgba(239,68,68,0.1); border-color: rgba(239,68,68,0.2); color: #dc2626; }
#flipbook-theater.fb-light-mode .fb-title-strip { border-color: rgba(0,0,0,0.05); }
#flipbook-theater.fb-light-mode .fb-hymn-title-bottom {
    background: none;
    -webkit-background-clip: initial;
    -webkit-text-fill-color: initial;
    background-clip: initial;
    color: #0f172a;
}
#flipbook-theater.fb-light-mode .fb-track-status-bottom,
#flipbook-theater.fb-light-mode .fb-timestamp,
#flipbook-theater.fb-light-mode .fb-zoom-label,
#flipbook-theater.fb-light-mode .fb-vol-icon,
#flipbook-theater.fb-light-mode .fb-page-counter,
#flipbook-theater.fb-light-mode .fb-page-counter strong {
    color: #475569;
}
#flipbook-theater.fb-light-mode .fb-audio-track-wrap,
#flipbook-theater.fb-light-mode .fb-scrub-wrap { background: rgba(0,0,0,0.09); }
#flipbook-theater.fb-light-mode .fb-vol-slider { background: rgba(0,0,0,0.12); }
#flipbook-theater.fb-light-mode .fb-now-playing { background: rgba(0,0,0,0.03); border-color: rgba(0,0,0,0.05); }
#flipbook-theater.fb-light-mode #fb-track-label { color: #475569 !important; }
#flipbook-theater.fb-light-mode .fb-nav-arrow {
    background: rgba(255,255,255,0.78); border-color: rgba(15,23,42,0.1); color: #475569;
    box-shadow: 0 4px 14px rgba(15,23,42,0.1);
}
#flipbook-theater.fb-light-mode #fb-stage:hover .fb-nav-arrow:not(:disabled) { opacity: 0.88; }
#flipbook-theater.fb-light-mode .fb-nav-arrow:hover:not(:disabled) {
    background: #ffffff; color: #2563eb; border-color: rgba(37,99,235,0.3);
    box-shadow: 0 6px 18px rgba(37,99,235,0.18); transform: translateY(-50%) scale(1.1);
    opacity: 1 !important;
}
#flipbook-theater.fb-light-mode .fb-nav-arrow:disabled { opacity: 0 !important; pointer-events: none; }
#flipbook-theater.fb-light-mode .fb-book {
    box-shadow: 0 40px 80px rgba(0,0,0,0.16), 0 12px 32px rgba(0,0,0,0.10), 0 0 0 1px rgba(0,0,0,0.08);
}
#flipbook-theater.fb-light-mode .fb-spine {
    background: linear-gradient(to right, #d8e0ea, #f4f7fb, #e8eef4);
    box-shadow: inset -3px 0 6px rgba(0,0,0,.07), inset 3px 0 5px rgba(255,255,255,.5);
}
#flipbook-theater.fb-light-mode .fb-command-center {
    background: rgba(245,248,252,0.97);
    box-shadow: 0 -20px 40px rgba(0,0,0,0.1);
}
#flipbook-theater.fb-light-mode .fb-command-center::before {
    background: linear-gradient(to bottom, transparent, rgba(245,248,252,0.97));
}
#flipbook-theater.fb-light-mode .fb-cc-handle {
    background: rgba(245,248,252,0.97);
    border-color: rgba(0,0,0,0.07);
    color: #94a3b8;
}
#flipbook-theater.fb-light-mode .fb-cc-handle:hover { color: #2563eb; }
#flipbook-theater.fb-light-mode .fb-book::after {
    background: linear-gradient(to left, rgba(0,0,0,0.1) 0%, transparent 65%);
}
</style>

<script>
(function() {
'use strict';

/* ── Asset Paths (from Blade) ──────────────────────────────────── */
const PATHS = {
    score:   @json($music->music_score_path ? asset("storage/".$music->music_score_path) : ""),
    lyrics:  @json($music->lyrics_path ? asset("storage/".$music->lyrics_path) : ""),
    vocals:  @json($music->vocals_mp3_path ? asset("storage/".$music->vocals_mp3_path) : ""),
    organ:   @json($music->organ_mp3_path ? asset("storage/".$music->organ_mp3_path) : ""),
    preludes:@json($music->preludes_mp3_path ? asset("storage/".$music->preludes_mp3_path) : ""),
};
const MUSIC_INDEX_URL = @json(route('musics.index', ['church_hymn_id' => $music->church_hymn_id]));

const TIMED_SYNC = {
    lyrics: @json($music->lyrics_sync ?? null),
    score: @json($music->score_sync ?? null),
};

function normalizeMediaUrl(url) {
    if (!url) return '';
    let cleaned = String(url).trim();
    if ((cleaned.startsWith('"') && cleaned.endsWith('"')) || (cleaned.startsWith("'") && cleaned.endsWith("'"))) {
        cleaned = cleaned.slice(1, -1);
    }

    const textarea = document.createElement('textarea');
    textarea.innerHTML = cleaned;
    cleaned = textarea.value.trim();

    return cleaned;
}

function escapeHtml(text) {
    return String(text)
        .replace(/&/g, '&amp;')
        .replace(/</g, '&lt;')
        .replace(/>/g, '&gt;')
        .replace(/"/g, '&quot;')
        .replace(/'/g, '&#39;');
}

function toFiniteNumber(value) {
    const number = Number(value);
    return Number.isFinite(number) ? number : null;
}

function normalizeTimedEntries(source) {
    if (!Array.isArray(source)) return [];

    return source
        .map((entry, index) => {
            const start = toFiniteNumber(entry?.start ?? entry?.time ?? entry?.begin);
            if (start === null || start < 0) {
                return null;
            }

            return {
                id: entry?.id || `fb-sync-${index}`,
                text: String(entry?.text ?? entry?.lyric ?? entry?.label ?? '').trim(),
                start,
                end: toFiniteNumber(entry?.end ?? entry?.stop ?? entry?.finish),
                page: toFiniteNumber(entry?.page ?? entry?.pageIndex),
                x: toFiniteNumber(entry?.x),
                y: toFiniteNumber(entry?.y),
                w: toFiniteNumber(entry?.w ?? entry?.width),
                h: toFiniteNumber(entry?.h ?? entry?.height),
                kind: entry?.kind || 'line',
                measure: entry?.measure ?? null,
            };
        })
        .filter(Boolean)
        .sort((a, b) => a.start - b.start)
        .map((entry, index, entries) => {
            const next = entries[index + 1];
            const fallbackEnd = next ? Math.max(entry.start, next.start - 0.01) : entry.start + 2.5;
            const end = entry.end !== null && entry.end > entry.start ? entry.end : fallbackEnd;
            return { ...entry, end };
        });
}

function parseLrcTimedEntries(rawText) {
    const lines = String(rawText || '').replace(/\r/g, '').split('\n');
    const entries = [];
    let sawTimedLine = false;

    lines.forEach(line => {
        const tagRegex = /\[(\d{2,}):(\d{2}(?:\.\d{1,3})?)\]/g;
        const tags = [...line.matchAll(tagRegex)];
        const text = line.replace(/\[\d{2,}:\d{2}(?:\.\d{1,3})?\]/g, '').trim();

        if (!tags.length) {
            return;
        }

        sawTimedLine = true;

        tags.forEach(tag => {
            const minutes = parseInt(tag[1], 10);
            const seconds = parseFloat(tag[2]);
            entries.push({
                text,
                start: (minutes * 60) + seconds,
                end: null,
                kind: 'line',
            });
        });
    });

    return sawTimedLine ? normalizeTimedEntries(entries) : [];
}

function getTimedLyricsEntries(rawText) {
    const syncEntries = normalizeTimedEntries(TIMED_SYNC.lyrics);
    if (syncEntries.length) {
        return syncEntries;
    }
    return parseLrcTimedEntries(rawText);
}

let lyricsSyncEntries = [];
let lyricsSyncNodes = [];
let activeLyricsSyncIndex = -1;

function setActiveLyricsLine(nextIndex) {
    if (!lyricsSyncNodes.length) return;

    if (activeLyricsSyncIndex >= 0 && lyricsSyncNodes[activeLyricsSyncIndex]) {
        lyricsSyncNodes[activeLyricsSyncIndex].classList.remove('is-active');
        lyricsSyncNodes[activeLyricsSyncIndex].removeAttribute('aria-current');
    }

    activeLyricsSyncIndex = nextIndex;

    if (activeLyricsSyncIndex >= 0 && lyricsSyncNodes[activeLyricsSyncIndex]) {
        const node = lyricsSyncNodes[activeLyricsSyncIndex];
        node.classList.add('is-active');
        node.setAttribute('aria-current', 'true');
    }
}

function syncLyricsHighlight(currentTime, forceScroll = false) {
    if (!lyricsSyncEntries.length || currentView !== 'lyrics') return;

    const leadIn = 0.25;
    let activeIndex = -1;
    const previousIndex = activeLyricsSyncIndex;

    let low = 0;
    let high = lyricsSyncEntries.length - 1;
    while (low <= high) {
        const mid = Math.floor((low + high) / 2);
        const entry = lyricsSyncEntries[mid];
        if (currentTime + leadIn < entry.start) {
            high = mid - 1;
        } else if (currentTime > entry.end) {
            low = mid + 1;
        } else {
            activeIndex = mid;
            break;
        }
    }

    if (activeIndex === -1) {
        activeIndex = Math.max(0, low - 1);
        const candidate = lyricsSyncEntries[activeIndex];
        if (!candidate || currentTime + leadIn < candidate.start) {
            activeIndex = -1;
        }
    }

    if (activeIndex === previousIndex && !forceScroll) {
        return;
    }

    setActiveLyricsLine(activeIndex);

    if (activeIndex >= 0 && lyricsSyncNodes[activeIndex] && (forceScroll || activeIndex !== previousIndex)) {
        lyricsSyncNodes[activeIndex].scrollIntoView({
            behavior: 'auto',
            block: 'center',
            inline: 'nearest',
        });
    }
}

function renderLyricsTextContent(rawText) {
    const clean = String(rawText || '')
        .replace(/\[\d{2,}:\d{2}(\.\d+)?\]/g, '')
        .replace(/\r/g, '')
        .trim();

    lyricsSyncEntries = getTimedLyricsEntries(rawText);
    activeLyricsSyncIndex = -1;
    lyricsSyncNodes = [];

    lyricsView.style.display = 'flex';
    scoreView.style.display = 'none';
    pageRow.style.display = 'none';

    if (!clean) {
        lyricsInner.innerHTML = '<div class="fb-lyrics-empty">No lyrics found.</div>';
        return;
    }

    const timedLines = lyricsSyncEntries.length ? lyricsSyncEntries : [];
    const lines = timedLines.length
        ? timedLines
        : clean.split('\n').map((line, index) => ({
            id: `fb-line-${index}`,
            text: line.trim(),
            start: null,
            end: null,
            kind: 'line',
        }));

    const html = lines.map((line, index) => {
        const text = String(line.text || '').trim();
        if (!text) {
            return '<div class="fb-lyrics-line fb-lyrics-line--spacer" aria-hidden="true"></div>';
        }

        const startAttr = line.start !== null && line.start !== undefined ? ` data-start="${line.start}"` : '';
        const endAttr = line.end !== null && line.end !== undefined ? ` data-end="${line.end}"` : '';
        const dataAttr = line.start !== null && line.start !== undefined
            ? ` data-sync-index="${index}" tabindex="-1"${startAttr}${endAttr}`
            : '';
        const lineClass = line.start !== null && line.start !== undefined
            ? 'fb-lyrics-line fb-lyrics-line--timed'
            : 'fb-lyrics-line';

        return `<p class="${lineClass}"${dataAttr}>${escapeHtml(text)}</p>`;
    }).join('');

    lyricsInner.innerHTML = `
        <div class="fb-lyrics-shell">
            <div class="fb-lyrics-card">
                <div class="fb-lyrics-text">${html}</div>
            </div>
        </div>
    `;
    lyricsSyncNodes = Array.from(lyricsInner.querySelectorAll('.fb-lyrics-line--timed'));
    applyZoomTransform(50, 50);
    syncLyricsHighlight(audio.currentTime || 0, true);
}

function renderLyricsPdfContent(pdf) {
    if (!pdf) return;

    lyricsView.style.display = 'none';
    scoreView.style.display = 'flex';
    pageRow.style.display = 'flex';
    lyricsSyncNodes = [];
    activeLyricsSyncIndex = -1;

    fbPdfDoc = pdf;
    fbTotal  = pdf.numPages;
    fbSpread = 1;

    if (totalLbl) totalLbl.textContent = fbTotal;
    if (scrubber) scrubber.max = Math.max(1, fbTotal);

    renderSpread(1, false);
    applyZoomTransform(50, 50);
}

function getActiveZoomTarget() {
    if (scoreView && scoreView.style.display !== 'none' && fbBookWrap) {
        return fbBookWrap;
    }
    return lyricsInner;
}

function clampZoom(value) {
    return Math.min(MAX_ZOOM, Math.max(MIN_ZOOM, value));
}

function clampPanValues() {
    if (fbZoom <= 1.01) { panX = 0; panY = 0; return; }
    const target = getActiveZoomTarget();
    if (!target || !fbStage) return;
    const maxX = Math.max(0, (target.offsetWidth * fbZoom - fbStage.clientWidth) / 2 + 60);
    const maxY = Math.max(0, (target.offsetHeight * fbZoom - fbStage.clientHeight) / 2 + 60);
    panX = Math.min(maxX, Math.max(-maxX, panX));
    panY = Math.min(maxY, Math.max(-maxY, panY));
}

function applyZoomTransform(originX = 50, originY = 50) {
    const target = getActiveZoomTarget();
    if (!target) return;

    zoomOrigin = {
        x: Math.max(0, Math.min(100, originX)),
        y: Math.max(0, Math.min(100, originY)),
    };

    clampPanValues();
    target.style.transformOrigin = `${zoomOrigin.x}% ${zoomOrigin.y}%`;
    target.style.transform = `translate3d(${panX}px, ${panY}px, 0) scale(${fbZoom})`;
    if (fbStage) {
        fbStage.classList.toggle('fb-zoomed', fbZoom > 1.01);
    }

    if (zoomLabel) {
        zoomLabel.textContent = Math.round(fbZoom * 100) + '%';
    }
}

function setZoomLevel(nextZoom, originX = zoomOrigin.x, originY = zoomOrigin.y) {
    fbZoom = clampZoom(nextZoom);
    applyZoomTransform(originX, originY);
    scheduleZoomRerender();
}

function getZoomOriginFromPoint(target, clientX, clientY) {
    if (!target) return { x: 50, y: 50 };
    const rect = target.getBoundingClientRect();
    if (!rect.width || !rect.height) return { x: 50, y: 50 };

    return {
        x: ((clientX - rect.left) / rect.width) * 100,
        y: ((clientY - rect.top) / rect.height) * 100,
    };
}

/* ── DOM refs ──────────────────────────────────────────────────── */
const theater     = document.getElementById('flipbook-theater');
const fbBook      = document.getElementById('fb-book');
const canvasL     = document.getElementById('fb-canvas-left');
const canvasR     = document.getElementById('fb-canvas-right');
const numL        = document.getElementById('fb-num-left');
const numR        = document.getElementById('fb-num-right');
const spreadLbl   = document.getElementById('fb-spread-label');
const totalLbl    = document.getElementById('fb-total-label');
const scrubber    = document.getElementById('fb-scrubber');
const scrubFill   = document.getElementById('fb-scrub-fill');
const prevBtn     = document.getElementById('fb-prev');
const nextBtn     = document.getElementById('fb-next');
const scoreView   = document.getElementById('fb-score-view');
const fbBookWrap  = document.getElementById('fb-book-wrap');
const lyricsView  = document.getElementById('fb-lyrics-view');
const lyricsInner = document.getElementById('fb-lyrics-inner');
const pageRow     = document.getElementById('fb-page-row');
const audio       = document.getElementById('fb-audio');
const playBtn     = document.getElementById('fb-play-btn');
const playIcon    = document.getElementById('fb-play-icon');
const curTime     = document.getElementById('fb-current-time');
const durTime     = document.getElementById('fb-duration');
const audioScrub  = document.getElementById('fb-audio-scrubber');
const audioFill   = document.getElementById('fb-audio-fill');
const volSlider   = document.getElementById('fb-volume');
const trackLabel  = document.getElementById('fb-track-label');
const eqDot       = document.getElementById('fb-eq-dot');
const zoomLabel   = document.getElementById('fb-zoom-label');
const closeBtn    = document.getElementById('fb-close');
const fsBtn       = document.getElementById('fb-fullscreen');
const zoomIn      = document.getElementById('fb-zoom-in');
const zoomOut     = document.getElementById('fb-zoom-out');
const zoomReset   = document.getElementById('fb-zoom-reset');
const dlToggle    = document.getElementById('fb-dl-toggle');
const dlDropdown  = document.getElementById('fb-dropdown');
const fbStage     = document.getElementById('fb-stage');
const themeToggle = document.getElementById('fb-theme-toggle');
const loadErrorEl = document.getElementById('fb-load-error');
const loadRetryBtn = document.getElementById('fb-load-retry');

/* ── State ─────────────────────────────────────────────────────── */
let fbPdfDoc = null, fbTotal = 0, fbSpread = 1, fbZoom = 1.0;
const MIN_ZOOM = 0.5;
const MAX_ZOOM = 3.0;
const ZOOM_STEP = 0.15;
const isMobileView = () => window.innerWidth < 1024;
let scoreDoc = null, lyricsDoc = null; // Store both separately
let currentView = 'score';   // 'score' | 'lyrics'
let lyricsLoaded = false;
let lyricsTextCache = '';
let zoomOrigin = { x: 50, y: 50 };
let panX = 0, panY = 0;

function nextPaint() {
    return new Promise(resolve => requestAnimationFrame(() => requestAnimationFrame(resolve)));
}

function copyCanvasContents(sourceCanvas, targetCanvas, numEl, pageNum) {
    if (!sourceCanvas || !targetCanvas) return;

    const width = sourceCanvas.width || sourceCanvas.clientWidth;
    const height = sourceCanvas.height || sourceCanvas.clientHeight;
    if (!width || !height) return;

    if (targetCanvas.width !== width) targetCanvas.width = width;
    if (targetCanvas.height !== height) targetCanvas.height = height;

    const cssWidth = sourceCanvas.style.width || (sourceCanvas.clientWidth ? `${sourceCanvas.clientWidth}px` : '');
    const cssHeight = sourceCanvas.style.height || (sourceCanvas.clientHeight ? `${sourceCanvas.clientHeight}px` : '');
    if (cssWidth) targetCanvas.style.width = cssWidth;
    if (cssHeight) targetCanvas.style.height = cssHeight;

    const ctx = targetCanvas.getContext('2d');
    ctx.clearRect(0, 0, targetCanvas.width, targetCanvas.height);
    ctx.drawImage(sourceCanvas, 0, 0);

    if (numEl && typeof pageNum !== 'undefined' && pageNum !== null) {
        numEl.textContent = pageNum;
    }
}

function clearCanvasContents(targetCanvas) {
    if (!targetCanvas) return;
    const ctx = targetCanvas.getContext('2d');
    ctx.clearRect(0, 0, targetCanvas.width || targetCanvas.clientWidth || 0, targetCanvas.height || targetCanvas.clientHeight || 0);
}

function clearPageContents(canvas, numEl) {
    clearCanvasContents(canvas);
    if (numEl) numEl.textContent = '';
}

function freezeBookLayout() {
    if (!fbBook) return null;
    const rect = fbBook.getBoundingClientRect();
    const snapshot = {
        width: fbBook.style.width,
        height: fbBook.style.height,
        minWidth: fbBook.style.minWidth,
        minHeight: fbBook.style.minHeight,
        maxWidth: fbBook.style.maxWidth,
        maxHeight: fbBook.style.maxHeight,
    };

    fbBook.style.width = `${rect.width}px`;
    fbBook.style.height = `${rect.height}px`;
    fbBook.style.minWidth = `${rect.width}px`;
    fbBook.style.minHeight = `${rect.height}px`;
    fbBook.style.maxWidth = `${rect.width}px`;
    fbBook.style.maxHeight = `${rect.height}px`;

    return snapshot;
}

function restoreBookLayout(snapshot) {
    if (!fbBook || !snapshot) return;
    fbBook.style.width = snapshot.width || '';
    fbBook.style.height = snapshot.height || '';
    fbBook.style.minWidth = snapshot.minWidth || '';
    fbBook.style.minHeight = snapshot.minHeight || '';
    fbBook.style.maxWidth = snapshot.maxWidth || '';
    fbBook.style.maxHeight = snapshot.maxHeight || '';
}

const PAGE_CACHE_LIMIT = 12;
const MAX_ZOOM_QUALITY = 3;
const MAX_PAGE_PIXELS = 12000000; // per-page raster budget (~48MB RGBA) to avoid canvas limits
let renderCacheSignature = '';
const renderedPageCache = new Map();
const renderedPagePromises = new Map();
let prefetchTimer = null;
let zoomRerenderTimer = null;

/* Bucketed render quality: pages are re-rasterized at the zoom level so the
   vector PDF stays crisp instead of CSS-stretching a fixed-size canvas. */
function getZoomQuality() {
    if (fbZoom <= 1.01) return 1;
    return Math.min(MAX_ZOOM_QUALITY, Math.ceil(fbZoom * 2) / 2);
}

/* After zoom settles, re-render the visible spread at the new quality bucket.
   The CSS scale() transform gives instant feedback; this swaps in sharp pixels. */
function scheduleZoomRerender() {
    clearTimeout(zoomRerenderTimer);
    zoomRerenderTimer = setTimeout(() => {
        zoomRerenderTimer = null;
        if (!fbPdfDoc || theater.style.display === 'none') return;
        if (_isAnimating) { scheduleZoomRerender(); return; }
        if (getPageCacheSignature() === renderCacheSignature) return;
        if (scoreView && scoreView.style.display !== 'none') {
            renderSpread(fbSpread, false);
        }
    }, 200);
}

function cancelPagePrefetch() {
    if (prefetchTimer === null) return;
    if ('cancelIdleCallback' in window) {
        cancelIdleCallback(prefetchTimer);
    } else {
        clearTimeout(prefetchTimer);
    }
    prefetchTimer = null;
}

function createRenderCanvas(width, height) {
    const canvas = document.createElement('canvas');
    canvas.width = width;
    canvas.height = height;
    return canvas;
}

function getPageCacheSignature() {
    const docKey = fbPdfDoc?.fingerprint || scoreDoc?.fingerprint || 'no-doc';
    const stageW = fbStage ? Math.round(fbStage.clientWidth) : 0;
    const stageH = fbStage ? Math.round(fbStage.clientHeight) : 0;
    const dpr = Math.round((window.devicePixelRatio || 1) * 100);

    return [
        docKey,
        isMobileView() ? 'mobile' : 'desktop',
        `${stageW}x${stageH}`,
        `dpr${dpr}`,
        `q${getZoomQuality()}`,
    ].join('|');
}

function ensurePageCacheSignature() {
    const signature = getPageCacheSignature();
    if (signature !== renderCacheSignature) {
        renderCacheSignature = signature;
        renderedPageCache.clear();
        renderedPagePromises.clear();
    }
    return signature;
}

function trimPageCache() {
    while (renderedPageCache.size > PAGE_CACHE_LIMIT) {
        const oldestKey = renderedPageCache.keys().next().value;
        renderedPageCache.delete(oldestKey);
    }
}

function getPrefetchPages(centerSpread) {
    return [
        centerSpread - 3,
        centerSpread - 2,
        centerSpread - 1,
        centerSpread,
        centerSpread + 1,
        centerSpread + 2,
        centerSpread + 3,
    ].filter(pageNum => pageNum >= 1 && pageNum <= fbTotal);
}

function warmPages(pageNums) {
    if (!fbPdfDoc) return;
    const pages = Array.from(new Set(pageNums)).filter(pageNum => pageNum >= 1 && pageNum <= fbTotal);
    if (!pages.length) return;

    const signature = ensurePageCacheSignature();
    pages.forEach(pageNum => {
        const key = `${signature}|p:${pageNum}`;
        if (renderedPageCache.has(key) || renderedPagePromises.has(key)) return;
        getRenderedPage(pageNum, { updateLayout: false }).catch(() => {});
    });
}

function warmFlipTransition(centerSpread) {
    warmPages(getPrefetchPages(centerSpread));
}

function schedulePagePrefetch(centerSpread) {
    if (!fbPdfDoc) return;
    cancelPagePrefetch();
    const runPrefetch = () => {
        prefetchTimer = null;
        warmPages(getPrefetchPages(centerSpread));
    };

    if ('requestIdleCallback' in window) {
        prefetchTimer = requestIdleCallback(runPrefetch, { timeout: 300 });
    } else {
        prefetchTimer = setTimeout(runPrefetch, 80);
    }
}

function getRenderedPage(pageNum, options = {}) {
    const updateLayout = options.updateLayout !== false;
    if (!fbPdfDoc || pageNum < 1 || pageNum > fbTotal) {
        return Promise.resolve(null);
    }

    const signature = ensurePageCacheSignature();
    const key = `${signature}|p:${pageNum}`;

    if (renderedPageCache.has(key)) {
        return Promise.resolve(renderedPageCache.get(key));
    }

    if (renderedPagePromises.has(key)) {
        return renderedPagePromises.get(key);
    }

    const promise = fbPdfDoc.getPage(pageNum).then(page => {
        const isMobile = isMobileView();
        const dpr = window.devicePixelRatio || 1;
        const buffer = isMobile ? 40 : 120;

        const availableW = isMobile
            ? (fbStage.clientWidth - buffer)
            : (fbStage.clientWidth / 2) - (buffer / 2) - 30;
        const availableH = fbStage.clientHeight - (isMobile ? 20 : 80);
        const native = page.getViewport({ scale: 1 });
        const scale = Math.min(availableW / native.width, availableH / native.height);

        if (updateLayout) {
            document.documentElement.style.setProperty('--fb-page-width', (native.width * scale) + 'px');
            document.documentElement.style.setProperty('--fb-page-height', (native.height * scale) + 'px');
        }

        // Rasterize at fit-scale × devicePixelRatio × zoom quality so the page
        // stays sharp when the CSS transform scales it up, capped by the
        // per-page pixel budget so huge scores can't exhaust canvas memory.
        let renderScale = scale * dpr * getZoomQuality();
        const budgetScale = Math.sqrt(MAX_PAGE_PIXELS / (native.width * native.height));
        renderScale = Math.min(renderScale, budgetScale);

        const vp = page.getViewport({ scale: renderScale });
        const bufferCanvas = createRenderCanvas(vp.width, vp.height);
        const ctx = bufferCanvas.getContext('2d');

        return page.render({
            canvasContext: ctx,
            viewport: vp
        }).promise.then(() => {
            const raster = {
                canvas: bufferCanvas,
                width: vp.width,
                height: vp.height,
                cssWidth: `${native.width * scale}px`,
                cssHeight: `${native.height * scale}px`,
            };

            if (renderCacheSignature === signature) {
                renderedPageCache.set(key, raster);
                trimPageCache();
            }

            return raster;
        });
    }).finally(() => {
        renderedPagePromises.delete(key);
    });

    renderedPagePromises.set(key, promise);
    return promise;
}

function paintRenderedPage(raster, canvas, numEl, pageNum) {
    if (!raster) return Promise.resolve();
    canvas.width = raster.width;
    canvas.height = raster.height;
    canvas.style.width = raster.cssWidth;
    canvas.style.height = raster.cssHeight;

    const ctx = canvas.getContext('2d');
    ctx.clearRect(0, 0, canvas.width, canvas.height);
    ctx.drawImage(raster.canvas, 0, 0);
    if (numEl && typeof pageNum !== 'undefined' && pageNum !== null) {
        numEl.textContent = pageNum;
    }
    return Promise.resolve();
}

/* ── OPEN ──────────────────────────────────────────────────────── */
function openTheater() {
    const hasScore = !!PATHS.score;
    if (!hasScore && !PATHS.lyrics) {
        alert('No music score or lyrics file is available for this hymn.');
        return;
    }

    const showWrapper = document.getElementById('show-page-wrapper');
    if (showWrapper) showWrapper.style.display = 'none';

    theater.style.display = 'flex';
    document.body.style.overflow = 'hidden';

    // Activate the first available audio track on open
    const firstTrack = PATHS.organ || PATHS.vocals || PATHS.preludes || '';
    if (firstTrack) {
        const trackName = PATHS.organ ? 'Organ' : (PATHS.vocals ? 'Vocals' : 'Preludes');
        const firstPill = document.querySelector('.fb-track-pill[data-src]');
        if (firstPill) {
            document.querySelectorAll('.fb-track-pill[data-src]').forEach(p => p.classList.remove('active'));
            firstPill.classList.add('active');
        }
        loadTrack(firstTrack, trackName);
    }

    if (hasScore) {
        if (scoreDoc) {
            // ✅ Already loaded — re-render instantly from cache, no network call
            fbPdfDoc = scoreDoc;
            fbTotal  = scoreDoc.numPages;
            fbSpread = 1;
            syncViewButtons('score');
            if (totalLbl) totalLbl.textContent = fbTotal;
            if (scrubber) scrubber.max = Math.max(1, fbTotal);
            scoreView.style.display  = 'flex';
            lyricsView.style.display = 'none';
            pageRow.style.display    = 'flex';
            renderSpread(1, false);
            applyZoomTransform(50, 50);
        } else {
            // First open — fetch from server
            loadPdf(PATHS.score);
        }
    } else if (PATHS.lyrics) {
        // No score — show lyrics view directly (highlight the lyrics button if available)
        syncViewButtons('lyrics');
        switchView('lyrics');
    }
}

/* ── EXIT (seamless fade → redirect) ───────────────────────────── */
/* The theater is never hidden on exit: the exit overlay fades in on top of
   it, then we navigate. The browser keeps the last painted frame on screen
   until the destination page renders, so the show page underneath never
   flashes through. */
let exitStarted = false;

function exitTheater() {
    if (exitStarted) return;
    exitStarted = true;

    cancelPagePrefetch();
    if (document.fullscreenElement) document.exitFullscreen().catch(()=>{});

    // Quick audio fade so playback doesn't cut off abruptly mid-transition
    const fadeStep = setInterval(() => {
        audio.volume = Math.max(0, audio.volume - 0.15);
        if (audio.volume <= 0.01) {
            clearInterval(fadeStep);
            audio.pause(); // fires 'pause' → updatePlayUI(false) handles icon + EQ
        }
    }, 40);

    theater.classList.add('fb-exiting');

    const overlay = document.getElementById('fb-exit-overlay');
    let navigated = false;
    const go = () => {
        if (navigated) return;
        navigated = true;
        window.location.assign(MUSIC_INDEX_URL);
    };
    if (overlay) overlay.addEventListener('transitionend', go, { once: true });
    setTimeout(go, 450); // safety net if transitionend never fires
}

closeBtn.addEventListener('click', exitTheater);

/* If the user returns via the browser Back button, the page is usually
   restored from the back/forward cache exactly as it was mid-fade —
   reset the exit state so the theater is usable again. */
window.addEventListener('pageshow', (e) => {
    if (!e.persisted) return;
    exitStarted = false;
    theater.classList.remove('fb-exiting');
    if (volSlider) audio.volume = Number(volSlider.value) || 1;
});

/* ── FULLSCREEN ────────────────────────────────────────────────── */
const fsBtnIcon = fsBtn.querySelector('i');
fsBtn.addEventListener('click', () => {
    if (!document.fullscreenElement) {
        theater.requestFullscreen().catch(()=>{});
        if (fsBtnIcon) fsBtnIcon.className = 'fas fa-compress';
    } else {
        document.exitFullscreen().catch(()=>{});
        if (fsBtnIcon) fsBtnIcon.className = 'fas fa-expand';
    }
});

/* ── THEME TOGGLE ──────────────────────────────────────────────── */
if (themeToggle) {
    themeToggle.addEventListener('click', () => {
        const isLight = theater.classList.toggle('fb-light-mode');
        themeToggle.innerHTML = isLight ? '<i class="fas fa-moon"></i>' : '<i class="fas fa-sun"></i>';
    });
}

/* ── TRACK SWITCHER ────────────────────────────────────────────── */
document.querySelectorAll('.fb-track-pill').forEach(pill => {
    pill.addEventListener('click', () => {
        const src   = normalizeMediaUrl(pill.dataset.src);
        const label = pill.dataset.label;
        if (!src) return;
        document.querySelectorAll('.fb-track-pill[data-src]').forEach(p => p.classList.remove('active'));
        pill.classList.add('active');
        loadTrack(src, label);
        // Update download mp3 link
        const mp3Link = document.getElementById('fb-dl-mp3');
        if (mp3Link) { mp3Link.href = src; }
    });
});

let userStartedExperience = false;
let currentTrackLoadId = 0;

function loadTrack(src, label) {
    src = normalizeMediaUrl(src);
    if (!src) return;
    const loadId = ++currentTrackLoadId;

    const startOverlay = document.getElementById('fb-start-overlay');

    function attemptPlay(hasInteraction) {
        if (loadId !== currentTrackLoadId) return;
        const playPromise = audio.play();
        if (playPromise !== undefined) {
            playPromise.then(() => {
                if (loadId !== currentTrackLoadId) return;
                userStartedExperience = true;
                if (startOverlay) startOverlay.classList.remove('show');
            }).catch(() => {
                if (loadId !== currentTrackLoadId) return;
                if (hasInteraction) {
                    if (startOverlay) startOverlay.classList.remove('show');
                    const trackStatus = document.getElementById('fb-track-status');
                    if (trackStatus) trackStatus.textContent = 'Playback unavailable';
                    return;
                }
                if (startOverlay && !userStartedExperience) {
                    startOverlay.classList.add('show');
                    startOverlay.onclick = () => {
                        attemptPlay(true);
                    };
                }
            });
        }
    }

    let loadTimedOut = false;
    const loadTimeout = setTimeout(() => {
        loadTimedOut = true;
        audio.removeEventListener('canplay', playWhenReady);
        audio.removeEventListener('error', onAudioError);
        const trackStatus = document.getElementById('fb-track-status');
        if (trackStatus) trackStatus.textContent = 'Audio load timeout';
    }, 15000); // 15s safety net

    const playWhenReady = () => {
        clearTimeout(loadTimeout);
        if (loadId !== currentTrackLoadId) return;
        audio.removeEventListener('canplay', playWhenReady);
        audio.removeEventListener('error', onAudioError);
        if (!loadTimedOut) attemptPlay(false);
    };
    const onAudioError = () => {
        clearTimeout(loadTimeout);
        if (loadId !== currentTrackLoadId) return;
        audio.removeEventListener('canplay', playWhenReady);
        audio.removeEventListener('error', onAudioError);
        loadTimedOut = true;
        const trackStatus = document.getElementById('fb-track-status');
        if (trackStatus) trackStatus.textContent = 'Audio unavailable';
        if (startOverlay && startOverlay.classList.contains('show')) {
            startOverlay.classList.remove('show');
        }
    };
    audio.addEventListener('canplay', playWhenReady);
    audio.addEventListener('error', onAudioError);

    audio.src = src;
    audio.load();

    /* Reset playback UI immediately on track switch */
    updatePlayUI(false);
    const visualizer = document.getElementById('fb-eq-visualizer');
    if (visualizer) visualizer.classList.remove('show');
    audioScrub.value = 0;
    audioFill.style.width = '0%';
    curTime.textContent = '0:00';
    durTime.textContent = '0:00';

    const trackLoadStatus = document.getElementById('fb-track-status');
    if (trackLoadStatus) trackLoadStatus.textContent = label || 'Loading...';
    if (trackLabel) trackLabel.textContent = label || 'Loading...';
}

function updatePlayUI(isPlaying) {
    if (!playIcon) return;
    playIcon.className = isPlaying ? 'fas fa-pause' : 'fas fa-play';
    const bars = document.querySelectorAll('.fb-eq-bar');
    const visualizer = document.getElementById('fb-eq-visualizer');
    const trackStatus = document.getElementById('fb-track-status');

    if (isPlaying) {
        if (visualizer) visualizer.classList.add('show');
        bars.forEach(b => b.classList.add('animating'));
        if (trackStatus && (trackStatus.textContent === 'Ready' || trackStatus.textContent === 'Paused')) {
            trackStatus.textContent = 'Playing';
        }
    } else {
        if (visualizer) visualizer.classList.remove('show');
        bars.forEach(b => b.classList.remove('animating'));
        if (trackStatus && trackStatus.textContent === 'Playing') {
            trackStatus.textContent = 'Paused';
        }
    }
}

window.loadTheaterTrack = loadTrack;

/* ── AUDIO PLAYER ──────────────────────────────────────────────── */
playBtn.addEventListener('click', () => {
    if (audio.paused) {
        audio.play().catch(()=>{});
    } else {
        audio.pause();
    }
});

/* Single source of truth: audio element events drive the icon */
audio.addEventListener('play',  () => updatePlayUI(true));
audio.addEventListener('pause', () => updatePlayUI(false));
audio.addEventListener('ended', () => updatePlayUI(false));

audio.addEventListener('timeupdate', () => {
    if (!audio.duration) return;
    const pct = (audio.currentTime / audio.duration) * 100;
    audioFill.style.width = pct + '%';
    audioScrub.value = pct;
    curTime.textContent = fmt(audio.currentTime);
    syncLyricsHighlight(audio.currentTime);
});

audio.addEventListener('loadedmetadata', () => {
    durTime.textContent = fmt(audio.duration);
    syncLyricsHighlight(audio.currentTime || 0, true);
});

audio.addEventListener('seeked', () => {
    syncLyricsHighlight(audio.currentTime || 0, true);
});

audioScrub.addEventListener('input', () => {
    if (!audio.duration) return;
    audio.currentTime = (audioScrub.value / 100) * audio.duration;
    syncLyricsHighlight(audio.currentTime || 0, true);
});

volSlider.addEventListener('input', () => { audio.volume = volSlider.value; });

function fmt(s) {
    if (isNaN(s)) return '0:00';
    const m = Math.floor(s / 60), sec = Math.floor(s % 60);
    return m + ':' + String(sec).padStart(2,'0');
}

/* ── VIEW TOGGLE ───────────────────────────────────────────────── */
const scoreBtnEl  = document.getElementById('fb-view-score');
const lyricsBtnEl = document.getElementById('fb-view-lyrics');
if (scoreBtnEl)  scoreBtnEl.addEventListener('click',  () => { if (scoreBtnEl.disabled) return; switchView('score'); });
if (lyricsBtnEl) lyricsBtnEl.addEventListener('click', () => { if (lyricsBtnEl.disabled) return; switchView('lyrics'); });

function syncViewButtons(mode) {
    currentView = mode;
    if (scoreBtnEl) scoreBtnEl.classList.toggle('active', mode === 'score');
    if (lyricsBtnEl) lyricsBtnEl.classList.toggle('active', mode === 'lyrics');
}

function switchView(mode) {
    // Don't switch to a view that has no file available
    if (mode === 'score' && !PATHS.score) return;
    if (mode === 'lyrics' && !PATHS.lyrics) return;

    syncViewButtons(mode);
    if (mode === 'score') {
        scoreView.style.display  = 'flex';
        lyricsView.style.display = 'none';
        pageRow.style.display    = 'flex';
        lyricsSyncNodes = [];
        activeLyricsSyncIndex = -1;
        if (scoreDoc) {
            fbPdfDoc = scoreDoc;
            fbTotal  = scoreDoc.numPages;
            fbSpread = 1;
            if (totalLbl) totalLbl.textContent = fbTotal;
            if (scrubber) scrubber.max = Math.max(1, fbTotal);
            renderSpread(fbSpread, false);
        } else if (PATHS.score) {
            loadPdf(PATHS.score);
        }
    } else {
        scoreView.style.display  = 'none';
        lyricsView.style.display = 'flex';
        pageRow.style.display    = 'none';
        applyZoomTransform(50, 50);

        if (lyricsLoaded) {
            if (lyricsDoc) {
                rerenderLyricsFromCache();
            }
            // Text lyrics are already in DOM — just showing the view is enough
            syncLyricsHighlight(audio.currentTime || 0, true);
        } else {
            loadLyrics(PATHS.lyrics);
        }
    }
}

/* Re-renders lyrics from the cached lyricsDoc without any network fetch */
function rerenderLyricsFromCache() {
    if (lyricsDoc) {
        renderLyricsPdfContent(lyricsDoc);
        return;
    }
    if (lyricsTextCache) {
        renderLyricsTextContent(lyricsTextCache);
    }
}

function loadLyrics(path) {
    path = normalizeMediaUrl(path);
    if (!path) {
        lyricsInner.innerHTML = '<div style="color:#ef4444;padding:2rem;text-align:center;">Failed to load lyrics.</div>';
        return;
    }
    lyricsView.style.display = 'flex';
    scoreView.style.display = 'none';
    pageRow.style.display = 'none';
    lyricsInner.innerHTML = '<div style="color:#64748b;padding:3rem;text-align:center;"><i class="fas fa-circle-notch fa-spin" style="font-size:2rem;display:block;margin-bottom:1rem;color:#3b82f6;"></i>Loading lyrics...</div>';
    hideLoadError();
    armLoadWatchdog();
    if (path.toLowerCase().endsWith('.pdf')) {
        loadLyricsPdf(path);
        return;
    }
    fetch(path)
        .then(r => r.ok ? r.text() : Promise.reject())
        .then(text => {
            disarmLoadWatchdog();
            lyricsTextCache = text;
            renderLyricsTextContent(text);
            lyricsLoaded = true;
        })
        .catch(() => {
            disarmLoadWatchdog();
            lyricsInner.innerHTML = '<div class="fb-lyrics-empty" style="color:#ef4444;">Failed to load lyrics.</div>';
        });
}

function loadLyricsPdf(path) {
    path = normalizeMediaUrl(path);
    if (!path) {
        disarmLoadWatchdog();
        lyricsInner.innerHTML = '<div class="fb-lyrics-empty" style="color:#ef4444;">Failed to load lyrics PDF.</div>';
        return;
    }
    const ensurePdfJs = (cb, onError) => {
        if (typeof pdfjsLib !== 'undefined') { cb(); return; }
        const s = document.createElement('script');
        s.src = 'https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.11.338/pdf.min.js';
        s.onload = cb;
        s.onerror = onError;
        document.head.appendChild(s);
    };
    const showError = () => {
        disarmLoadWatchdog();
        lyricsInner.innerHTML = '<div class="fb-lyrics-empty" style="color:#ef4444;">Failed to load lyrics PDF.</div>';
    };
    ensurePdfJs(() => {
        pdfjsLib.GlobalWorkerOptions.workerSrc = 'https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.11.338/pdf.worker.min.js';
        pdfjsLib.getDocument(path).promise
            .then(pdf => {
                disarmLoadWatchdog();
                lyricsDoc = pdf;
                lyricsLoaded = true;
                lyricsTextCache = '';
                renderLyricsPdfContent(pdf);
            })
            .catch(showError);
    }, showError);
}

/* ── PDF LOAD ──────────────────────────────────────────────────── */
/* Loading a hymn score involves two network round-trips outside our control
   (the pdf.js library from a CDN, then the PDF itself). Either can silently
   hang or fail — a blocked CDN, a dropped connection, a slow proxy — and
   without a visible fallback the theater just sits on its background color
   forever. LOAD_STALL_MS + the .catch()/onerror below turn that into a
   recoverable, visible error state instead of a dead screen. */
const LOAD_STALL_MS = 15000;
let loadWatchdog = null;
let lastScoreLoadPath = null;

function armLoadWatchdog() {
    clearTimeout(loadWatchdog);
    loadWatchdog = setTimeout(showLoadError, LOAD_STALL_MS);
}

function disarmLoadWatchdog() {
    clearTimeout(loadWatchdog);
    loadWatchdog = null;
    // A slow-but-successful load can complete just after the watchdog
    // already displayed the error state; clear it here too so success
    // never renders silently behind a stuck error overlay.
    hideLoadError();
}

function showLoadError() {
    disarmLoadWatchdog();
    const pctLabel = document.getElementById('fb-load-pct');
    if (pctLabel) pctLabel.style.display = 'none';
    if (loadErrorEl) loadErrorEl.hidden = false;
}

function hideLoadError() {
    if (loadErrorEl) loadErrorEl.hidden = true;
}

if (loadRetryBtn) {
    loadRetryBtn.addEventListener('click', () => {
        hideLoadError();
        if (lastScoreLoadPath) {
            loadPdf(lastScoreLoadPath);
        } else if (PATHS.score) {
            loadPdf(PATHS.score);
        } else if (PATHS.lyrics) {
            loadLyrics(PATHS.lyrics);
        }
    });
}

function loadPdf(path) {
    path = normalizeMediaUrl(path);
    if (!path) return;
    lastScoreLoadPath = path;
    hideLoadError();
    armLoadWatchdog();
    if (typeof pdfjsLib === 'undefined') {
        const s = document.createElement('script');
        s.src = 'https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.11.338/pdf.min.js';
        s.onload = () => doLoadPdf(path);
        s.onerror = showLoadError;
        document.head.appendChild(s);
    } else { doLoadPdf(path); }
}

function doLoadPdf(path) {
    const pctLabel = document.getElementById('fb-load-pct');
    if (pctLabel) { pctLabel.style.display = 'inline'; pctLabel.textContent = '0%'; }
    pdfjsLib.GlobalWorkerOptions.workerSrc = 'https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.11.338/pdf.worker.min.js';
    const loadingTask = pdfjsLib.getDocument(path);
    loadingTask.onProgress = (p) => { if (p.total > 0 && pctLabel) pctLabel.textContent = Math.round((p.loaded / p.total) * 100) + '%'; };
    loadingTask.promise.then(pdf => {
        disarmLoadWatchdog();
        if (pctLabel) pctLabel.style.display = 'none';
        scoreDoc = pdf; fbPdfDoc = pdf; fbTotal = pdf.numPages; fbSpread = 1;
        syncViewButtons('score');
        totalLbl.textContent = fbTotal; scrubber.max = Math.max(1, fbTotal); renderSpread(1, false);
    }).catch(err => {
        console.error('[flipbook] score PDF failed to load:', err);
        showLoadError();
    });
}

/* ── RENDER SPREAD ─────────────────────────────────────────────── */
function renderSpread(leftNum, animate) {
    fbSpread = leftNum;
    const isMobile = isMobileView();
    // Normalize for desktop: dual pages usually start at odd numbers
    if (!isMobile && fbSpread > 1 && fbSpread % 2 === 0) fbSpread--;
    
    updatePageUI();
    if (scoreView && scoreView.style.display !== 'none') {
        syncViewButtons('score');
    } else if (lyricsView && lyricsView.style.display !== 'none') {
        syncViewButtons('lyrics');
    }
    warmFlipTransition(fbSpread);
    schedulePagePrefetch(fbSpread);
    if (animate !== false && !isMobile) {
        flipAnim(fbSpread);
        return;
    }
    renderPage(fbSpread, canvasL, numL);
    if (!isMobile) {
        renderPage(fbSpread + 1, canvasR, numR);
    }
}

let _lastSpread = 1;
let _isAnimating = false;


/* One true content-based 3D flip for every viewport — desktop's two-page
   spread and mobile/tablet's single page use the exact same leaf, the same
   keyframes, and the same physics. The only difference is geometry: in
   single-page mode the turning leaf is the whole page (width:100%, see the
   .fb-book-wrap.fb-single-page CSS override) instead of just the half that's
   turning in a two-page spread. This is what makes the animation identical
   across devices instead of mobile falling back to a simpler CSS slide. */
async function flipAnim(targetSpread, onDone) {
    const turningPage = document.getElementById('fb-turning-page');
    const turnFront   = document.getElementById('fb-canvas-turn-front');
    const turnBack    = document.getElementById('fb-canvas-turn-back');
    const numL        = document.getElementById('fb-num-left');
    const numR        = document.getElementById('fb-num-right');

    if (!turningPage || _isAnimating) { if (onDone) onDone(); return; }

    const singlePage = isMobileView() || fbTotal <= 1;
    _isAnimating = true;
    const goingForward = targetSpread > _lastSpread;
    _lastSpread = targetSpread;
    const layoutSnapshot = freezeBookLayout();
    const fbBookEl = document.getElementById('fb-book');

    try {
        warmFlipTransition(targetSpread);

        // Keep the old page(s) visible while the leaf turns, then swap in the
        // destination content once the motion completes.
        let targetLeftPromise, targetRightPromise;
        if (singlePage) {
            // The leaf IS the page: front = what's currently shown, back =
            // the page being revealed. There's no right-hand page at all.
            copyCanvasContents(canvasL, turnFront);
            clearCanvasContents(turnBack);
            targetLeftPromise = getRenderedPage(targetSpread, { updateLayout: false });
            targetRightPromise = Promise.resolve(null);
            const backPageNum = targetSpread;
            getRenderedPage(backPageNum, { updateLayout: false }).then(raster => {
                if (raster && _isAnimating) paintRenderedPage(raster, turnBack, null, backPageNum).catch(() => {});
            }).catch(() => {});
        } else {
            copyCanvasContents(goingForward ? canvasR : canvasL, turnFront);
            clearCanvasContents(turnBack);
            targetLeftPromise = getRenderedPage(targetSpread, { updateLayout: false });
            targetRightPromise = getRenderedPage(targetSpread + 1, { updateLayout: false });
            const turnBackPageNum = goingForward ? targetSpread : targetSpread + 1;
            getRenderedPage(turnBackPageNum, { updateLayout: false }).then(raster => {
                if (raster && _isAnimating) paintRenderedPage(raster, turnBack, null, turnBackPageNum).catch(() => {});
            }).catch(() => {});
        }

        if (fbBookEl) fbBookEl.classList.add('is-flipping');

        turningPage.style.display = 'block';
        turningPage.classList.remove('fb-turning-right', 'fb-turning-left');
        void turningPage.offsetWidth;
        turningPage.classList.add(goingForward ? 'fb-turning-right' : 'fb-turning-left');

        await nextPaint();

        const finalizeFlip = async () => {
            const [leftRaster, rightRaster] = await Promise.all([targetLeftPromise, targetRightPromise]);
            if (leftRaster) {
                await paintRenderedPage(leftRaster, canvasL, numL, targetSpread);
            } else {
                clearPageContents(canvasL, numL);
            }
            if (!singlePage) {
                if (rightRaster) {
                    await paintRenderedPage(rightRaster, canvasR, numR, targetSpread + 1);
                } else {
                    clearPageContents(canvasR, numR);
                }
            }

            fbSpread = targetSpread;
            updatePageUI();
            schedulePagePrefetch(targetSpread);
            turningPage.style.display = 'none';
            turningPage.classList.remove('fb-turning-right', 'fb-turning-left');
            if (fbBookEl) fbBookEl.classList.remove('is-flipping');
            restoreBookLayout(layoutSnapshot);
            _isAnimating = false;
            if (onDone) onDone();
        };

        const expectedAnimation = goingForward ? 'fb-turn-forward' : 'fb-turn-backward';
        const onTurnEnd = (event) => {
            if (event.animationName !== expectedAnimation) return;
            turningPage.removeEventListener('animationend', onTurnEnd);
            finalizeFlip().catch(() => {
                turningPage.style.display = 'none';
                turningPage.classList.remove('fb-turning-right', 'fb-turning-left');
                if (fbBookEl) fbBookEl.classList.remove('is-flipping');
                restoreBookLayout(layoutSnapshot);
                _isAnimating = false;
                if (onDone) onDone();
            });
        };
        turningPage.addEventListener('animationend', onTurnEnd);
    } catch (error) {
        restoreBookLayout(layoutSnapshot);
        turningPage.style.display = 'none';
        turningPage.classList.remove('fb-turning-right', 'fb-turning-left');
        if (fbBookEl) fbBookEl.classList.remove('is-flipping');
        _isAnimating = false;
        if (onDone) onDone();
    }
}

function renderPage(pageNum, canvas, numEl, options = {}) {
    if (!fbPdfDoc || pageNum < 1 || pageNum > fbTotal) {
        canvas.width = canvas.width || 420; canvas.height = canvas.height || 590;
        clearPageContents(canvas, numEl);
        return Promise.resolve();
    }
    return getRenderedPage(pageNum, options).then(raster => {
        if (!raster) {
            clearPageContents(canvas, numEl);
            return null;
        }
        if (options.updateLayout !== false) {
            document.documentElement.style.setProperty('--fb-page-width', raster.cssWidth);
            document.documentElement.style.setProperty('--fb-page-height', raster.cssHeight);
        }
        return paintRenderedPage(raster, canvas, numEl, pageNum);
    });
}

/* ── NAV ───────────────────────────────────────────────────────── */
prevBtn.addEventListener('click', () => goSpread(-2));
nextBtn.addEventListener('click', () => goSpread(+2));
prevBtn.addEventListener('pointerdown', () => warmFlipTransition(isMobileView() ? Math.max(1, fbSpread - 1) : Math.max(1, fbSpread - 2)));
nextBtn.addEventListener('pointerdown', () => warmFlipTransition(isMobileView() ? Math.min(fbTotal, fbSpread + 1) : Math.min(fbTotal, fbSpread + 2)));
prevBtn.addEventListener('mouseenter', () => warmFlipTransition(isMobileView() ? Math.max(1, fbSpread - 1) : Math.max(1, fbSpread - 2)));
nextBtn.addEventListener('mouseenter', () => warmFlipTransition(isMobileView() ? Math.min(fbTotal, fbSpread + 1) : Math.min(fbTotal, fbSpread + 2)));
function goSpread(delta) {
    if (_isAnimating) return;
    const isMobile = isMobileView();
    // Delta adaptation: on mobile, +/-2 becomes +/-1 to flip single pages
    const move = isMobile ? (delta > 0 ? 1 : -1) : delta;
    let nextVal = fbSpread + move;
    
    if (nextVal < 1) nextVal = 1;
    if (nextVal > fbTotal) nextVal = fbTotal;
    if (nextVal === fbSpread) return;

    warmFlipTransition(nextVal);
    // Same true 3D flip on every viewport — flipAnim itself adapts the leaf
    // geometry for single-page vs. two-page spreads and updates fbSpread/UI
    // only once the animation actually completes.
    flipAnim(nextVal);
}

function updatePageUI() {
    const isMobile = isMobileView();
    const right = Math.min(fbSpread + 1, fbTotal);
    
    if (isMobile || fbTotal <= 1) {
        spreadLbl.textContent = `Page ${fbSpread} of ${fbTotal}`;
    } else {
        spreadLbl.textContent = (fbSpread >= fbTotal) || (fbTotal === 1) ? fbSpread : `${fbSpread}–${right}`;
    }
    
    prevBtn.disabled = fbSpread <= 1;
    nextBtn.disabled = isMobile ? (fbSpread >= fbTotal) : (fbSpread + 1 >= fbTotal);
    
    const pct = fbTotal > 1 ? ((fbSpread - 1) / (fbTotal - 1)) * 100 : 0;
    if (scrubFill) scrubFill.style.width = pct + '%';
    if (scrubber) {
        scrubber.max = fbTotal;
        scrubber.value = fbSpread;
    }

    const wrap = document.getElementById('fb-book-wrap');
    if (wrap) {
        if (isMobile || fbTotal <= 1) wrap.classList.add('fb-single-page');
        else wrap.classList.remove('fb-single-page');
    }
}

scrubFill.parentElement.addEventListener('click', (e) => {
    if (!audio.duration) return;
    const rect = e.currentTarget.getBoundingClientRect();
    const pct = (e.clientX - rect.left) / rect.width;
    audio.currentTime = pct * audio.duration;
});

scrubber.addEventListener('input', () => {
    if (_isAnimating) return; // don't repaint canvases mid-flip/drag
    let v = parseInt(scrubber.value);
    if (!isMobileView() && v > 1 && v % 2 === 0) v--;
    renderSpread(v, false);
});

/* ── TOUCH GESTURES ───────────────────────────────────────────── */
let touchStartX = 0;
let pinchStartDistance = 0;
let pinchStartZoom = fbZoom;
let pinchOrigin = { x: 50, y: 50 };
let pinchActive = false;
let touchPanLast = null;

function setGestureMode(active) {
    // Kill the transform transition during continuous gestures so pinch/pan
    // tracks the finger 1:1 instead of lagging 150ms behind.
    const target = getActiveZoomTarget();
    if (target) target.classList.toggle('fb-no-anim', active);
    if (fbStage) fbStage.classList.toggle('fb-panning', active && fbZoom > 1.01);
}

function getTouchDistance(t1, t2) {
    const dx = t2.clientX - t1.clientX;
    const dy = t2.clientY - t1.clientY;
    return Math.hypot(dx, dy);
}

function getTouchMidpoint(t1, t2) {
    return {
        x: (t1.clientX + t2.clientX) / 2,
        y: (t1.clientY + t2.clientY) / 2,
    };
}

fbStage.addEventListener('touchstart', (e) => {
    if (e.touches.length === 2) {
        pinchActive = true;
        touchPanLast = null;
        pinchStartDistance = getTouchDistance(e.touches[0], e.touches[1]);
        pinchStartZoom = fbZoom;
        const activeTarget = getActiveZoomTarget();
        const midpoint = getTouchMidpoint(e.touches[0], e.touches[1]);
        pinchOrigin = getZoomOriginFromPoint(activeTarget, midpoint.x, midpoint.y);
        setGestureMode(true);
        return;
    }

    if (e.touches.length === 1) {
        pinchActive = false;
        touchStartX = e.touches[0].screenX;
        touchPanLast = { x: e.touches[0].clientX, y: e.touches[0].clientY };
    }
}, { passive: false });

fbStage.addEventListener('touchmove', (e) => {
    if (pinchActive && e.touches.length === 2 && pinchStartDistance > 0) {
        e.preventDefault();
        const distance = getTouchDistance(e.touches[0], e.touches[1]);
        const nextZoom = pinchStartZoom * (distance / pinchStartDistance);
        setZoomLevel(nextZoom, pinchOrigin.x, pinchOrigin.y);
        return;
    }

    // Single-finger pan while zoomed in (score view only)
    if (!pinchActive && e.touches.length === 1 && touchPanLast
        && fbZoom > 1.01 && currentView === 'score') {
        e.preventDefault();
        const touch = e.touches[0];
        panX += touch.clientX - touchPanLast.x;
        panY += touch.clientY - touchPanLast.y;
        touchPanLast = { x: touch.clientX, y: touch.clientY };
        setGestureMode(true);
        applyZoomTransform(zoomOrigin.x, zoomOrigin.y);
    }
}, { passive: false });

fbStage.addEventListener('touchend', (e) => {
    if (pinchActive) {
        if (e.touches.length < 2) {
            pinchActive = false;
            pinchStartDistance = 0;
            setGestureMode(false);
        }
        return;
    }

    setGestureMode(false);
    touchPanLast = null;

    // While zoomed, swipes pan the page instead of flipping it
    if (fbZoom > 1.01) return;

    if (e.changedTouches.length === 1) {
        const touchEndX = e.changedTouches[0].screenX;
        const diff = touchStartX - touchEndX;
        if (Math.abs(diff) > 50) {
            if (diff > 0) goSpread(2); else goSpread(-2);
        }
    }
}, { passive: false });

fbStage.addEventListener('touchcancel', () => {
    pinchActive = false;
    pinchStartDistance = 0;
    touchPanLast = null;
    setGestureMode(false);
}, { passive: false });

/* ── MOUSE DRAG-TO-PAN (zoomed score view) ─────────────────────── */
let panPointerId = null;
let panStart = null;

fbStage.addEventListener('pointerdown', (e) => {
    if (e.pointerType !== 'mouse' || e.button !== 0) return;
    if (fbZoom <= 1.01 || currentView !== 'score') return;
    if (e.target.closest('.fb-nav-arrow')) return;
    panPointerId = e.pointerId;
    panStart = { x: e.clientX, y: e.clientY, panX, panY };
    setGestureMode(true);
    fbStage.setPointerCapture(e.pointerId);
});

fbStage.addEventListener('pointermove', (e) => {
    if (panPointerId === null || e.pointerId !== panPointerId || !panStart) return;
    panX = panStart.panX + (e.clientX - panStart.x);
    panY = panStart.panY + (e.clientY - panStart.y);
    applyZoomTransform(zoomOrigin.x, zoomOrigin.y);
});

function endMousePan(e) {
    if (panPointerId === null || (e && e.pointerId !== panPointerId)) return;
    panPointerId = null;
    panStart = null;
    setGestureMode(false);
}
fbStage.addEventListener('pointerup', endMousePan);
fbStage.addEventListener('pointercancel', endMousePan);

/* ── DOUBLE-CLICK QUICK ZOOM ───────────────────────────────────── */
fbStage.addEventListener('dblclick', (e) => {
    if (currentView !== 'score') return;
    if (e.target.closest('.fb-nav-arrow')) return;
    if (fbZoom > 1.01) {
        setZoomLevel(1, 50, 50);
    } else {
        const origin = getZoomOriginFromPoint(getActiveZoomTarget(), e.clientX, e.clientY);
        setZoomLevel(2, origin.x, origin.y);
    }
});

/* ── INTERACTIVE DRAG-TO-FLIP (Publuu-style page physics) ───────
   Grab the outer third of either page with the mouse and drag: the leaf
   follows the pointer 1:1 through a requestAnimationFrame loop, using the
   same bend path (translateX/rotateY/translateZ/scaleX) as the keyframe
   flips. Release past halfway — or flick with enough velocity — and the
   page settles forward; otherwise it springs back. Desktop two-page mode
   only; mobile keeps its swipe flip, zoomed mode keeps drag-to-pan. */
const dragFlip = {
    active: false, ready: false, engaged: false, settling: false,
    pointerId: null, forward: true, targetSpread: 1,
    startX: 0, lastX: 0, lastT: 0, velocity: 0, progress: 0,
    raf: null, layoutSnapshot: null,
};
const DRAG_ZONE = 0.34;        // outer fraction of each page that grabs
const DRAG_CLICK_SLOP = 8;     // px of movement before it counts as a drag
const FLICK_VELOCITY = 0.45;   // px/ms toward the flip direction

function dragLeafTransform(p) {
    // Same shape as the fb-turn-* keyframes so drag and button flips match
    const s = Math.sin(p * Math.PI);
    const angle = dragFlip.forward ? (-180 * p) : (180 * p);
    const tx = (dragFlip.forward ? -7 : 7) * s;
    return `translateX(${tx.toFixed(2)}%) rotateY(${angle.toFixed(2)}deg)` +
        ` translateZ(${(68 * s).toFixed(1)}px)` +
        ` scaleX(${(1 - 0.042 * s).toFixed(4)}) scaleY(${(1 + 0.012 * s).toFixed(4)})`;
}

function paintDragFrame() {
    const turningPage = document.getElementById('fb-turning-page');
    if (!turningPage) return;
    const s = Math.sin(dragFlip.progress * Math.PI);
    turningPage.style.transform = dragLeafTransform(dragFlip.progress);
    turningPage.style.filter = `brightness(${(1 - 0.13 * s).toFixed(3)}) saturate(${(1 - 0.016 * s).toFixed(3)})`;
    turningPage.style.setProperty('--fb-drag-shade', s.toFixed(3));
}

function scheduleDragFrame() {
    if (dragFlip.raf !== null) return;
    dragFlip.raf = requestAnimationFrame(() => {
        dragFlip.raf = null;
        if (dragFlip.active && dragFlip.ready) paintDragFrame();
    });
}

function finishDragCleanup(committed) {
    const turningPage = document.getElementById('fb-turning-page');
    if (committed) {
        fbSpread = dragFlip.targetSpread;
        _lastSpread = dragFlip.targetSpread;
        updatePageUI();
    }
    // Repaint both static pages for the (possibly restored) current spread
    // BEFORE hiding the leaf, so nothing flashes underneath.
    Promise.all([
        renderPage(fbSpread, canvasL, numL, { updateLayout: false }),
        renderPage(fbSpread + 1, canvasR, numR, { updateLayout: false }),
    ]).catch(() => {}).finally(() => {
        if (turningPage) {
            turningPage.style.display = 'none';
            turningPage.style.transform = '';
            turningPage.style.filter = '';
            turningPage.style.removeProperty('--fb-drag-shade');
            turningPage.classList.remove('fb-manual', 'fb-manual-fwd', 'fb-manual-back');
        }
        fbBook.classList.remove('is-flipping');
        fbStage.classList.remove('fb-drag-flipping');
        restoreBookLayout(dragFlip.layoutSnapshot);
        dragFlip.layoutSnapshot = null;
        dragFlip.active = false;
        dragFlip.ready = false;
        dragFlip.settling = false;
        dragFlip.pointerId = null;
        _isAnimating = false;
        if (committed) schedulePagePrefetch(fbSpread);
    });
}

function settleDragFlip(commit) {
    dragFlip.settling = true;
    const target = commit ? 1 : 0;
    const step = () => {
        const diff = target - dragFlip.progress;
        if (Math.abs(diff) < 0.01) {
            dragFlip.progress = target;
            paintDragFrame();
            finishDragCleanup(commit);
            return;
        }
        dragFlip.progress += diff * 0.2; // exponential ease-out, ~300ms
        paintDragFrame();
        requestAnimationFrame(step);
    };
    requestAnimationFrame(step);
}

async function beginDragFlip(e) {
    const book = fbBook.getBoundingClientRect();
    if (!book.width || e.clientY < book.top || e.clientY > book.bottom) return;
    const relX = (e.clientX - book.left) / book.width;

    let forward;
    if (relX >= 1 - DRAG_ZONE && fbSpread + 1 < fbTotal) forward = true;
    else if (relX <= DRAG_ZONE && fbSpread > 1) forward = false;
    else return;

    dragFlip.active = true;
    dragFlip.ready = false;
    dragFlip.engaged = false;
    dragFlip.settling = false;
    dragFlip.pointerId = e.pointerId;
    dragFlip.forward = forward;
    dragFlip.targetSpread = forward
        ? Math.min(fbTotal, fbSpread + 2)
        : Math.max(1, fbSpread - 2);
    dragFlip.startX = dragFlip.lastX = e.clientX;
    dragFlip.lastT = performance.now();
    dragFlip.velocity = 0;
    dragFlip.progress = 0;
    _isAnimating = true;
    dragFlip.layoutSnapshot = freezeBookLayout();
    fbStage.setPointerCapture(e.pointerId);

    const turningPage = document.getElementById('fb-turning-page');
    const turnFront = document.getElementById('fb-canvas-turn-front');
    const turnBack = document.getElementById('fb-canvas-turn-back');

    try {
        warmFlipTransition(dragFlip.targetSpread);
        // Leaf front = the page being grabbed (copied, so the static canvas
        // underneath can be swapped to the destination content right away —
        // the area revealed under the lifting leaf then shows the next page,
        // which is what a real book does).
        copyCanvasContents(forward ? canvasR : canvasL, turnFront);
        clearCanvasContents(turnBack);
        const backPageNum = forward ? dragFlip.targetSpread : dragFlip.targetSpread + 1;
        await Promise.all([
            getRenderedPage(backPageNum, { updateLayout: false }).then(raster => {
                if (raster) return paintRenderedPage(raster, turnBack, null, backPageNum);
            }),
            forward
                ? renderPage(dragFlip.targetSpread + 1, canvasR, numR, { updateLayout: false })
                : renderPage(dragFlip.targetSpread, canvasL, numL, { updateLayout: false }),
        ]);
    } catch (err) {
        finishDragCleanup(false);
        return;
    }

    if (!dragFlip.active) {
        // Pointer was released before the textures were ready
        finishDragCleanup(false);
        return;
    }

    fbBook.classList.add('is-flipping');
    fbStage.classList.add('fb-drag-flipping');
    turningPage.classList.remove('fb-turning-right', 'fb-turning-left');
    turningPage.classList.add('fb-manual', forward ? 'fb-manual-fwd' : 'fb-manual-back');
    turningPage.style.display = 'block';
    dragFlip.ready = true;
    paintDragFrame();
}

fbStage.addEventListener('pointerdown', (e) => {
    if (e.pointerType !== 'mouse' || e.button !== 0) return;
    if (dragFlip.active || _isAnimating) return;
    if (fbZoom > 1.01 || currentView !== 'score') return;
    if (isMobileView() || !fbPdfDoc || fbTotal <= 1) return;
    if (e.target.closest('.fb-nav-arrow')) return;
    beginDragFlip(e);
});

fbStage.addEventListener('pointermove', (e) => {
    if (!dragFlip.active || dragFlip.settling || e.pointerId !== dragFlip.pointerId) return;
    const now = performance.now();
    const dt = Math.max(1, now - dragFlip.lastT);
    dragFlip.velocity = dragFlip.velocity * 0.8 + ((e.clientX - dragFlip.lastX) / dt) * 0.2;
    dragFlip.lastX = e.clientX;
    dragFlip.lastT = now;

    if (!dragFlip.engaged && Math.abs(e.clientX - dragFlip.startX) > DRAG_CLICK_SLOP) {
        dragFlip.engaged = true;
    }
    if (!dragFlip.ready || !dragFlip.engaged) return;

    e.preventDefault();
    const book = fbBook.getBoundingClientRect();
    const travel = dragFlip.forward
        ? (dragFlip.startX - e.clientX)
        : (e.clientX - dragFlip.startX);
    dragFlip.progress = Math.min(1, Math.max(0, travel / Math.max(160, book.width * 0.85)));
    scheduleDragFrame();
});

function releaseDragFlip(e) {
    if (!dragFlip.active || dragFlip.settling || (e && e.pointerId !== dragFlip.pointerId)) return;
    if (!dragFlip.ready) {
        // Textures still rendering — mark inactive; beginDragFlip cleans up
        dragFlip.active = false;
        return;
    }
    if (!dragFlip.engaged) {
        // Plain click on the page edge, not a drag
        finishDragCleanup(false);
        return;
    }
    const towardFlip = dragFlip.forward ? -dragFlip.velocity : dragFlip.velocity;
    const commit = dragFlip.progress > 0.5 ||
        (dragFlip.progress > 0.12 && towardFlip > FLICK_VELOCITY);
    settleDragFlip(commit);
}
fbStage.addEventListener('pointerup', releaseDragFlip);
fbStage.addEventListener('pointercancel', releaseDragFlip);

/* ── WHEEL ZOOM ────────────────────────────────────────────────── */
function handleWheelZoom(e) {
    if (!e.ctrlKey) return;

    const activeTarget = getActiveZoomTarget();
    if (!activeTarget) return;

    const isScoreSurface = scoreView && scoreView.style.display !== 'none';
    if (isScoreSurface) {
        if (!e.target.closest('#fb-book-wrap')) return;
    } else if (!e.target.closest('#fb-lyrics-view')) {
        return;
    }

    e.preventDefault();
    const origin = getZoomOriginFromPoint(activeTarget, e.clientX, e.clientY);
    const nextZoom = fbZoom * (e.deltaY > 0 ? 0.92 : 1.08);
    setZoomLevel(nextZoom, origin.x, origin.y);
}

scoreView?.addEventListener('wheel', handleWheelZoom, { passive: false });
lyricsView?.addEventListener('wheel', handleWheelZoom, { passive: false });

/* ── ZOOM ──────────────────────────────────────────────────────── */
zoomIn.addEventListener('click',  () => changeZoom(+ZOOM_STEP));
zoomOut.addEventListener('click', () => changeZoom(-ZOOM_STEP));
zoomReset?.addEventListener('click', () => setZoomLevel(1, 50, 50));
function changeZoom(d) {
    setZoomLevel(fbZoom + d, 50, 50);
}

/* ── DOWNLOAD DROPDOWN ─────────────────────────────────────────── */
if (dlToggle) {
    dlToggle.addEventListener('click', e => { e.stopPropagation(); if (dlDropdown) dlDropdown.style.display = dlDropdown.style.display === 'none' ? 'block' : 'none'; });
    document.addEventListener('click', () => { if (dlDropdown) dlDropdown.style.display = 'none'; });
}

/* ── MOBILE "MORE" OVERFLOW MENU ────────────────────────────────── */
/* On mobile, Details/Playlist/Zoom/Download/Fullscreen live behind a
   single ⋮ trigger instead of crowding the top bar into several rows. */
const moreToggleBtn = document.getElementById('fb-more-toggle');
const morePanel = document.getElementById('fb-more-panel');
if (moreToggleBtn && morePanel) {
    moreToggleBtn.addEventListener('click', (e) => {
        e.stopPropagation();
        morePanel.classList.toggle('open');
    });
    document.addEventListener('click', (e) => {
        if (!morePanel.classList.contains('open')) return;
        if (morePanel.contains(e.target) || e.target === moreToggleBtn) return;
        morePanel.classList.remove('open');
    });
    // Single-action items close the sheet after use; zoom buttons and the
    // download toggle (which opens its own nested dropdown) do not, since
    // those are meant for repeated/follow-up taps.
    morePanel.querySelectorAll('.fb-track-pill, #fb-fullscreen').forEach(el => {
        el.addEventListener('click', () => morePanel.classList.remove('open'));
    });
}

/* ── EXTRA BUTTONS (Theater Modals) ────────────────────────────── */
const detailsBtn = document.getElementById('fb-details-btn');
const playlistBtn = document.getElementById('fb-playlist-btn');
const subOverlay = document.getElementById('fb-sub-overlay');
const detailsModal = document.getElementById('fb-details-modal');
const playlistModalLocal = document.getElementById('fb-playlist-modal');
const creatorSpotlight = document.getElementById('fb-creator-spotlight');
const creatorNameEl = document.getElementById('fb-creator-name');
const creatorRoleEl = document.getElementById('fb-creator-role');
const creatorImageEl = document.getElementById('fb-creator-image');
const creatorLocationEl = document.getElementById('fb-creator-location');
const creatorBirthdayEl = document.getElementById('fb-creator-birthday');
const creatorDutyEl = document.getElementById('fb-creator-duty');
const creatorBackgroundEl = document.getElementById('fb-creator-background');
const creatorProfileLinkEl = document.getElementById('fb-creator-profile-link');
const creatorCloseBtn = document.getElementById('fb-creator-close');
const creatorLinks = document.querySelectorAll('.fb-creator-link');
const creatorFallbackImage = "{{ asset('images/blank_image.png') }}";

function hideCreatorSpotlight() {
    if (creatorSpotlight) {
        creatorSpotlight.hidden = true;
    }
}

function showCreatorSpotlight(link) {
    if (!creatorSpotlight || !link) return;

    const name = link.getAttribute('data-name') || 'Unnamed creator';
    const role = link.getAttribute('data-role') || 'Creator';
    const local = link.getAttribute('data-local') || '';
    const district = link.getAttribute('data-district') || '';
    const birthday = link.getAttribute('data-birthday') || '';
    const duty = link.getAttribute('data-duty') || '';
    const image = link.getAttribute('data-image') || '';
    const background = link.getAttribute('data-background') || '';
    const profileUrl = link.getAttribute('data-profile-url') || '#';

    if (creatorNameEl) creatorNameEl.textContent = name;
    if (creatorRoleEl) creatorRoleEl.textContent = role;
    if (creatorLocationEl) {
        const locationText = [local, district].filter(Boolean).join(', ');
        creatorLocationEl.textContent = locationText || '-';
    }
    if (creatorBirthdayEl) creatorBirthdayEl.textContent = birthday || '-';
    if (creatorDutyEl) creatorDutyEl.textContent = duty || '-';
    if (creatorBackgroundEl) creatorBackgroundEl.textContent = background || 'No background information available.';
    if (creatorProfileLinkEl) creatorProfileLinkEl.href = profileUrl;
    if (creatorImageEl) {
        creatorImageEl.src = image || creatorFallbackImage;
        creatorImageEl.alt = `${name} portrait`;
    }

    creatorSpotlight.hidden = false;
}

function openSubModal(modalToOpen) {
    theater.classList.add('fb-right-drawer-open');
    subOverlay.classList.add('active');
    detailsModal.classList.remove('active');
    playlistModalLocal.classList.remove('active');
    modalToOpen.classList.add('active');
}

if (detailsBtn) {
    detailsBtn.addEventListener('click', () => {
        openSubModal(detailsModal);
    });
}
if (playlistBtn) {
    playlistBtn.addEventListener('click', () => {
        openSubModal(playlistModalLocal);
        loadTheaterPlaylist();
    });
}

creatorLinks.forEach(link => {
    link.setAttribute('tabindex', '0');
    link.addEventListener('click', (e) => {
        e.preventDefault();
        showCreatorSpotlight(link);
    });
    link.addEventListener('keydown', (e) => {
        if (e.key === 'Enter' || e.key === ' ') {
            e.preventDefault();
            showCreatorSpotlight(link);
        }
    });
});

creatorCloseBtn?.addEventListener('click', hideCreatorSpotlight);

function closeSubModals() {
    subOverlay.classList.remove('active');
    detailsModal.classList.remove('active');
    playlistModalLocal.classList.remove('active');
    theater.classList.remove('fb-right-drawer-open');
    hideCreatorSpotlight();
}
document.getElementById('fb-close-details')?.addEventListener('click', closeSubModals);
document.getElementById('fb-close-playlist')?.addEventListener('click', closeSubModals);

function loadTheaterPlaylist() {
    const content = document.getElementById('fb-playlist-content');
    const urlParams = new URLSearchParams(window.location.search);
    const playlistId = urlParams.get('playlist_id');
    
    if (!playlistId) {
        content.innerHTML = '<div style="text-align:center;padding:2rem;color:#64748b;">No active playlist.</div>';
        return;
    }

    fetch(`/playlists?playlist_id=${playlistId}`)
        .then(r => r.json())
        .then(data => {
            if (data.playlists && data.playlists.length > 0) {
                let html = '';
                data.playlists.forEach(pl => {
                    html += `<div class="fb-pl-section" style="margin-bottom:20px;">
                        <div style="font-size:0.7rem; font-weight:900; text-transform:uppercase; color:#94a3b8; letter-spacing:2px; margin-bottom:12px; display:flex; align-items:center; gap:8px;">
                            <i class="fas fa-list-ul" style="color:#3b82f6;"></i> ${pl.name}
                        </div>
                        <div class="fb-pl-list" style="display:flex; flex-direction:column; gap:10px;">`;
                    pl.musics.forEach(m => {
                        const isCurrent = m.id == {{ $music->id }};
                        html += `<div class="fb-pl-item ${isCurrent?'active':''}" onclick="window.location.href='/musics/${m.id}?playlist_id=${pl.id}&autoplay=true'" 
                                 style="padding:12px 16px; border-radius:18px; background:${isCurrent?'#2563eb':'#f1f5f9'}; color:${isCurrent?'#fff':'#1e293b'}; 
                                        cursor:pointer; display:flex; gap:14px; align-items:center; transition:all 0.3s cubic-bezier(0.4,0,0.2,1); border:1px solid ${isCurrent?'#3b82f6':'#e2e8f0'};"
                                 onmouseover="if(!this.classList.contains('active')){this.style.background='#e2e8f0'; this.style.transform='translateX(5px)'}"
                                 onmouseout="if(!this.classList.contains('active')){this.style.background='#f1f5f9'; this.style.transform='translateX(0)'}">
                            <div style="width:36px; height:36px; border-radius:12px; background:${isCurrent?'rgba(255,255,255,0.2)':'#fff'}; 
                                        display:flex; align-items:center; justify-content:center; font-weight:900; font-size:0.85rem; border:1px solid ${isCurrent?'transparent':'#cbd5e1'};">
                                ${m.song_number}
                            </div>
                            <div style="flex-grow:1;">
                                <div style="font-weight:800; font-size:0.95rem; line-height:1.2;">${m.title}</div>
                                <div style="font-size:0.65rem; font-weight:700; opacity:0.7; margin-top:2px;">${m.categories?.[0]?.name || 'Hymn'}</div>
                            </div>
                            ${isCurrent ? '<i class="fas fa-volume-up"></i>' : '<i class="fas fa-play" style="font-size:0.7rem; opacity:0.3;"></i>'}
                        </div>`;
                    });
                    html += `</div></div>`;
                });
                content.innerHTML = html;
            } else {
                content.innerHTML = '<div style="text-align:center;padding:2rem;color:#64748b;">Playlist not found.</div>';
            }
        });
}

window.openTheater = openTheater;

/* ── COLLAPSIBLE PLAYER HANDLE ─────────────────────────────────── */
const ccHandle    = document.getElementById('fb-cc-handle');
const ccToggleIcon = document.getElementById('fb-cc-toggle-icon');
const commandCenter = document.getElementById('fb-command-center');
let ccCollapsed = false;

if (ccHandle && commandCenter) {
    ccHandle.addEventListener('click', () => {
        ccCollapsed = !ccCollapsed;
        commandCenter.classList.toggle('fb-cc-collapsed', ccCollapsed);
        ccToggleIcon.className = ccCollapsed ? 'fas fa-chevron-up' : 'fas fa-chevron-down';
        // Recalculate book size after layout shift
        if (!ccCollapsed && fbPdfDoc) {
            setTimeout(() => renderSpread(fbSpread, false), 300);
        }
    });
}

/* ── AUTO-OPEN & RESIZE ────────────────────────────────────────── */
if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', openTheater, { once: true });
} else {
    openTheater();
}
let resizeTimer;
window.addEventListener('resize', () => {
    // Freeze all flip/zoom transitions while the window is actively being
    // resized — layout recalcs mid-animation are what cause the jitter.
    if (theater.style.display !== 'none') {
        theater.classList.add('fb-resizing');
    }
    clearTimeout(resizeTimer);
    resizeTimer = setTimeout(() => {
        // Unfreeze first so the final size change eases in smoothly
        theater.classList.remove('fb-resizing');
        if (theater.style.display === 'none') return;
        if (currentView === 'lyrics' && (lyricsDoc || lyricsTextCache)) {
            rerenderLyricsFromCache();
            return;
        }
        if (fbPdfDoc) {
            renderSpread(fbSpread, false);
        }
    }, 250);
});

})();
</script>
