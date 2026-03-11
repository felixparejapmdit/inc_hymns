{{-- ════════════════════════════════════════════════════════════════════ --}}
{{-- FLIPBOOK THEATER — Integrated Multimedia Player Interface            --}}
{{-- ════════════════════════════════════════════════════════════════════ --}}
<div id="flipbook-theater" style="display:none;">

    {{-- ── TOP BAR ──────────────────────────────────────────────────── --}}
    <div class="fb-top-bar">
        <div class="fb-top-left" style="display:flex; align-items:center; gap:8px;">
            <span class="fb-badge" style="background:rgba(59,130,246,.15); color:#60a5fa; padding:4px 10px; border-radius:6px; font-size:.6rem; font-weight:800; letter-spacing:1px; border:1px solid rgba(59,130,246,.3);">
                INC Hymns <span id="fb-load-pct" style="margin-left:4px; display:none;">0%</span>
            </span>
            <button id="fb-theme-toggle" class="fb-ctrl-btn" title="Toggle Light/Dark Mode" style="width:30px;height:30px;font-size:0.8rem;">
                <i class="fas fa-sun"></i>
            </button>
        </div>

        <div class="fb-top-center" style="display:flex; align-items:center; gap:8px;">
            {{-- Vocals: disabled if no file --}}
            <button class="fb-track-pill {{ empty($music->vocals_mp3_path) ? 'fb-pill-disabled' : '' }}"
                {{ !empty($music->vocals_mp3_path) ? 'data-src="'.asset('storage/'.$music->vocals_mp3_path).'" data-label="Vocals"' : 'disabled title="No Vocals file available"' }}>
                <i class="fas fa-microphone"></i><span>Vocals</span>
            </button>
            {{-- Organ: disabled if no file --}}
            <button class="fb-track-pill {{ empty($music->organ_mp3_path) ? 'fb-pill-disabled' : '' }}"
                {{ !empty($music->organ_mp3_path) ? 'data-src="'.asset('storage/'.$music->organ_mp3_path).'" data-label="Organ"' : 'disabled title="No Organ file available"' }}>
                <i class="fas fa-keyboard"></i><span>Organ</span>
            </button>
            {{-- Preludes: disabled if no file --}}
            <button class="fb-track-pill {{ empty($music->preludes_mp3_path) ? 'fb-pill-disabled' : '' }}"
                {{ !empty($music->preludes_mp3_path) ? 'data-src="'.asset('storage/'.$music->preludes_mp3_path).'" data-label="Preludes"' : 'disabled title="No Preludes file available"' }}>
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

            <div class="fb-extra-ctrls" style="margin-right:12px; display:flex; gap:6px;">
                <button id="fb-details-btn" class="fb-track-pill" title="Hymn Details"><i class="fas fa-info-circle"></i><span>Details</span></button>
                <button id="fb-playlist-btn" class="fb-track-pill" title="Playlist"><i class="fas fa-list-ul"></i><span>Playlist</span></button>
            </div>

            <div class="fb-zoom-ctrl" style="margin-right:12px;">
                <button id="fb-zoom-out" class="fb-ctrl-btn"><i class="fas fa-minus"></i></button>
                <span id="fb-zoom-label">100%</span>
                <button id="fb-zoom-in" class="fb-ctrl-btn"><i class="fas fa-plus"></i></button>
            </div>
            <button id="fb-dl-toggle" class="fb-ctrl-btn" style="margin-right:12px;" title="Download"><i class="fas fa-download"></i></button>
            <button id="fb-fullscreen" class="fb-ctrl-btn" style="margin-right:12px;" title="Fullscreen"><i class="fas fa-expand"></i></button>
            <button id="fb-close" class="fb-ctrl-btn fb-close-btn" title="Close"><i class="fas fa-times"></i></button>
        </div>
    </div>

    {{-- ── STAGE ─────────────────────────────────────────────────────── --}}
    <div class="fb-stage" id="fb-stage">

        {{-- SCORE VIEW (Flipbook) --}}
        <div id="fb-score-view" style="display:flex;width:100%;height:100%;align-items:center;justify-content:center;">
            <button class="fb-nav-arrow" id="fb-prev" disabled>
                <i class="fas fa-chevron-left"></i>
            </button>
            <div class="fb-book-wrap" id="fb-book-wrap">
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
                    {{-- 3D Page Turn overlay --}}
                    <div id="fb-turning-page" class="fb-turning-page">
                        <div class="fb-tp-front"></div>
                        <div class="fb-tp-back"></div>
                    </div>
                </div>
            </div>
            <button class="fb-nav-arrow" id="fb-next">
                <i class="fas fa-chevron-right"></i>
            </button>
        </div>

        {{-- LYRICS VIEW --}}
        <div id="fb-lyrics-view" style="display:none;width:100%;height:100%;overflow-y:auto;padding:2rem 3rem;">
            <div id="fb-lyrics-inner" style="max-width:680px;margin:0 auto;font-family:'Playfair Display',serif;font-size:1.3rem;line-height:2.2;color:#e2e8f0;text-align:center;white-space:pre-wrap;"></div>
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

    {{-- Hidden audio element --}}
    <audio id="fb-audio" preload="auto"></audio>

    {{-- ── BOTTOM COMMAND CENTER ───────────────────────── --}}
    <div class="fb-command-center">

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
                            <div class="fb-credit-item"><i class="fas fa-feather"></i> <strong>Lyricist:</strong> {{ $music->lyricists->pluck('name')->join(', ') ?: 'N/A' }}</div>
                            <div class="fb-credit-item"><i class="fas fa-music"></i> <strong>Composer:</strong> {{ $music->composers->pluck('name')->join(', ') ?: 'N/A' }}</div>
                            <div class="fb-credit-item"><i class="fas fa-headphones"></i> <strong>Arranger:</strong> {{ $music->arrangers->pluck('name')->join(', ') ?: 'N/A' }}</div>
                        </div>
                    </div>

                    <div class="fb-detail-card full">
                        <span class="fb-detail-label"><i class="fas fa-book-bible"></i> Scriptural Basis</span>
                        <p class="fb-verse-text">{{ $music->verses_used ?: 'No specific scriptural references documented.' }}</p>
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
/* ─── LAUNCH BUTTON ─────────────────────────────────────── */
#fb-open-btn {
    width:60px; height:60px; border-radius:50%;
    background:linear-gradient(135deg,#1e3a5f,#0f172a);
    border:none; color:#fff; font-size:1.15rem;
    display:flex; align-items:center; justify-content:center;
    transition:all .4s cubic-bezier(.175,.885,.32,1.275);
    position:relative; box-shadow:0 10px 30px rgba(0,0,0,.3); cursor:pointer;
}
#fb-open-btn:hover { transform:scale(1.1); background:#2563eb; box-shadow:0 15px 35px rgba(37,99,235,.35); }
#fb-open-btn .btn-tooltip { position:absolute; left:75px; background:#1e293b; color:#fff; padding:6px 12px; border-radius:8px; font-size:.75rem; font-weight:800; text-transform:uppercase; opacity:0; pointer-events:none; transform:translateX(-10px); transition:all .3s; white-space:nowrap; }
#fb-open-btn:hover .btn-tooltip { opacity:1; transform:translateX(0); }
@media(max-width:768px){ #fb-open-btn{width:50px;height:50px;font-size:1rem;} }

/* ─── THEATER OVERLAY ──────────────────────────────────── */
#flipbook-theater {
    position:fixed; 
    inset: 0; /* Full view without margins */
    z-index: 9999;
    background: radial-gradient(circle at 30% 20%, #1e293b 0%, #0f172a 100%);
    display: flex; 
    flex-direction: column; 
    overflow: hidden;
    border-radius: 0;
    box-shadow: 0 0 0 1px rgba(255,255,255,0.05), 0 50px 100px -20px rgba(0,0,0,0.8);
    border: 1px solid rgba(255,255,255,0.1);
}
#flipbook-theater::before {
    content:''; position:absolute; inset:0; pointer-events:none; z-index:0;
    background: 
        radial-gradient(ellipse at 50% 0%, rgba(37,99,235,0.15) 0%, transparent 60%),
        radial-gradient(ellipse at 100% 100%, rgba(29,78,216,0.08) 0%, transparent 50%);
}

/* ─── TOP BAR ──────────────────────────────────────────── */
.fb-top-bar {
    position:relative; z-index:10; flex-shrink:0;
    display:flex; align-items:center; justify-content:space-between; gap:16px;
    padding:10px 24px;
    background:rgba(15,23,42,0.95);
    border-bottom:1px solid rgba(255,255,255,0.08);
}

/* Track pills */
.fb-track-group { display:flex; align-items:center; gap:6px; flex-shrink:0; }
.fb-track-pill {
    display:flex; align-items:center; gap:8px;
    padding:6px 14px; border-radius:0; border:1px solid rgba(255,255,255,.1);
    background:rgba(255,255,255,.05); color:#94a3b8;
    font-size:.68rem; font-weight:800; text-transform:uppercase; letter-spacing:.5px;
    cursor:pointer; transition:all .25s; white-space:nowrap;
}
.fb-track-pill i { font-size:.75rem; }
.fb-track-pill:hover { background:rgba(59,130,246,.15); border-color:rgba(59,130,246,.3); color:#93c5fd; }
.fb-track-pill.active {
    background:linear-gradient(135deg,#2563eb,#1d4ed8);
    border-color:#3b82f6; color:#fff;
    box-shadow:0 4px 16px rgba(37,99,235,.35);
}
.fb-track-pill.active i { color:#bfdbfe; }

/* Disabled pill state */
.fb-pill-disabled {
    opacity: 0.35 !important;
    cursor: not-allowed !important;
    pointer-events: none;
    border-color: rgba(255,255,255,0.05) !important;
    background: rgba(255,255,255,0.02) !important;
    color: #475569 !important;
    box-shadow: none !important;
}
.fb-pill-disabled i { color: #334155 !important; }

/* Title center */
.fb-title-center { flex:1; text-align:center; min-width:0; }
.fb-hymn-title {
    font-family:'Playfair Display',serif;
    font-size:1rem; font-weight:800; color:#f1f5f9; margin:0; line-height:1.2;
    white-space:nowrap; overflow:hidden; text-overflow:ellipsis;
}
.fb-hymn-sub { font-size:.6rem; color:#475569; font-weight:600; letter-spacing:.4px; }

/* Right group - Fixed alignment */
.fb-top-right { 
    display:flex; 
    align-items:center; 
    gap:10px; 
    flex-shrink:0; 
}
.fb-vdivider { width:1px; height:24px; background:rgba(255,255,255,.08); margin:0 4px; }
.fb-ctrl-btn {
    width:36px; height:36px; border-radius:10px; border:none;
    background:rgba(255,255,255,.05); color:#94a3b8;
    font-size:.85rem; display:flex; align-items:center; justify-content:center;
    cursor:pointer; transition:all .2s; flex-shrink:0;
}
.fb-ctrl-btn i {
    display: flex;
    align-items: center;
    justify-content: center;
}
.fb-ctrl-btn:hover { background:rgba(59,130,246,.18); color:#60a5fa; }
.fb-close-btn:hover { background:rgba(239,68,68,.18); color:#f87171; }
.fb-zoom-label { font-size:.7rem; color:#64748b; font-weight:700; min-width:38px; text-align:center; font-family:'Outfit',sans-serif; }

/* View toggle - Fixed alignment */
.fb-view-toggle, .fb-extra-ctrls {
    display:flex; align-items:center; gap:6px;
    background:rgba(15,23,42,0.4); padding:4px; border-radius:0;
    border:1px solid rgba(255,255,255,0.05);
}

/* Zoom control row */
.fb-zoom-ctrl {
    display:flex; align-items:center; gap:4px;
    background:rgba(15,23,42,0.4); padding:4px; border-radius:0;
    border:1px solid rgba(255,255,255,0.05);
}
.fb-zoom-ctrl .fb-ctrl-btn { width:32px; height:32px; background:transparent; font-size:0.75rem; }
.fb-zoom-ctrl .fb-ctrl-btn:hover { background:rgba(255,255,255,0.05); }

/* Download */
.fb-dl-wrap { position:relative; }
.fb-dropdown {
    display:none; position:absolute; top:calc(100% + 8px); right:0;
    background:rgba(15,23,42,.98);
    border:1px solid rgba(255,255,255,.12); border-radius:14px;
    padding:6px; min-width:160px; z-index:100;
    box-shadow:0 20px 50px rgba(0,0,0,.5);
}
.fb-dl-item {
    display:flex; align-items:center; gap:8px;
    padding:8px 12px; border-radius:9px; color:#94a3b8;
    font-size:.72rem; font-weight:700; text-decoration:none; transition:all .15s;
    white-space:nowrap;
}
.fb-dl-item:hover { background:rgba(59,130,246,.15); color:#93c5fd; }
.fb-dl-item i { width:14px; text-align:center; color:#3b82f6; }

/* ─── STAGE ─────────────────────────────────────────────── */
.fb-stage {
    flex:1; position:relative; z-index:5;
    display:flex; align-items:center; justify-content:center;
    overflow:hidden; padding:25px; /* Consistent internal margins */
}

/* ─── BOOK ───────────────────────────────────────────────── */
/* perspective on wrap; preserve-3d on book so children inherit 3D context */
.fb-book-wrap {
    display:flex; align-items:center; justify-content:center;
    width: 100%; height: 100%;
    perspective: 1400px;
    perspective-origin: 50% 50%;
}
.fb-book {
    display:flex; align-items:stretch;
    box-shadow:0 70px 140px rgba(0,0,0,.9),0 25px 60px rgba(0,0,0,.7);
    border: 6px double #ffffff;
    overflow: visible;           /* must be visible for turning page to show */
    position: relative;
    transform-style: preserve-3d; /* passes 3D context to #fb-turning-page */
}
.fb-page { background:#fff; overflow:hidden; position:relative; flex-shrink:0; }
.fb-page-left  { border-radius:4px 0 0 4px; }
.fb-page-right { border-radius:0 4px 4px 0; }
.fb-page-inner { width:100%; height:100%; position:relative; overflow:hidden; }
.fb-canvas { display:block; width:100% !important; height:auto !important; }

/* Single page overrides (when fbTotal === 1) */
.fb-book-wrap.fb-single-page .fb-page-right,
.fb-book-wrap.fb-single-page .fb-spine,
.fb-book-wrap.fb-single-page .fb-turning-page {
    display: none !important;
}
.fb-book-wrap.fb-single-page .fb-page-left {
    border-radius: 4px !important;
}
.fb-page-num { position:absolute; bottom:10px; left:50%; transform:translateX(-50%); font-size:.6rem; font-weight:700; color:#9ca3af; font-family:'Outfit',sans-serif; }
.fb-page-curl { position:absolute; width:44px; height:44px; pointer-events:none; z-index:10; }
.fb-curl-tl { top:0; left:0; background:linear-gradient(135deg,#c8cdd5 0%,rgba(255,255,255,0) 65%); border-radius:0 0 100% 0; box-shadow:3px 3px 8px rgba(0,0,0,.1); }
.fb-curl-br { bottom:0; right:0; background:linear-gradient(315deg,#c8cdd5 0%,rgba(255,255,255,0) 65%); border-radius:100% 0 0 0; box-shadow:-3px -3px 8px rgba(0,0,0,.1); }
.fb-spine { width:14px; flex-shrink:0; background:linear-gradient(to right,#94a3b8,#e2e8f0,#cbd5e1); display:flex; align-items:center; justify-content:center; box-shadow:inset -3px 0 6px rgba(0,0,0,.12),inset 3px 0 6px rgba(0,0,0,.06); }
.fb-spine-line { width:2px; height:90%; background:rgba(0,0,0,.07); border-radius:2px; }

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
    will-change: transform;
}

/* Front face: the page you see while it lifts */
.fb-tp-front, .fb-tp-back {
    position: absolute; inset: 0;
    backface-visibility: hidden;
    -webkit-backface-visibility: hidden;
}
.fb-tp-front {
    background: #ffffff;
    /* Left-edge shadow: deepens as the page rises, fades as it lands */
    box-shadow: inset -8px 0 20px rgba(0,0,0,0.08);
}
.fb-tp-back {
    /* Reverse page face — warm paper tone, flipped */
    background: #f5f5f0;
    transform: rotateY(180deg);
    box-shadow: inset 8px 0 20px rgba(0,0,0,0.06);
}

/*
 * Forward flip: right page (pivot = left/spine edge) rotates -180° to cover left page.
 * The arc peaks at -90° (page is edge-on at the spine) — that's the "lift" moment.
 * ease-in-out makes it accelerate away from and decelerate into the resting positions.
 */
@keyframes fb-turn-forward {
    0%   {
        transform: rotateY(0deg);
        box-shadow: -2px 0 10px rgba(0,0,0,0.2);
    }
    40%  {
        box-shadow: -25px 0 50px rgba(0,0,0,0.45);
    }
    100% {
        transform: rotateY(-179deg); /* stop just before 180 to avoid z-fighting */
        box-shadow: -2px 0 8px rgba(0,0,0,0.1);
    }
}

/* Backward flip: mirror of forward */
@keyframes fb-turn-backward {
    0%   {
        transform: rotateY(-179deg);
        box-shadow: 2px 0 8px rgba(0,0,0,0.1);
    }
    60%  {
        box-shadow: 25px 0 50px rgba(0,0,0,0.45);
    }
    100% {
        transform: rotateY(0deg);
        box-shadow: 2px 0 10px rgba(0,0,0,0.2);
    }
}

.fb-turning-right {
    right: 0; left: auto;
    transform-origin: left center;   /* pivot = spine */
    animation: fb-turn-forward 0.65s ease-in-out forwards;
}
.fb-turning-left {
    left: 0; right: auto;
    transform-origin: right center;  /* pivot = spine */
    animation: fb-turn-backward 0.65s ease-in-out forwards;
}

/* Nav arrows */
.fb-nav-arrow {
    width:48px; height:48px; border-radius:0; flex-shrink:0; margin:0 18px;
    background:rgba(255,255,255,.06); border:1px solid rgba(255,255,255,.09);
    color:#64748b; font-size:1rem;
    display:flex; align-items:center; justify-content:center;
    cursor:pointer; transition:all .25s;
}
.fb-nav-arrow:hover:not(:disabled) { background:rgba(37,99,235,.25); border-color:#3b82f6; color:#60a5fa; transform:scale(1.08); box-shadow:0 0 24px rgba(37,99,235,.2); }
.fb-nav-arrow:disabled { opacity:.2; cursor:not-allowed; }

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

/* ─── BOTTOM COMMAND CENTER ────────────────────────────── */
.fb-command-center {
    position:relative; z-index:10; flex-shrink:0;
    padding-bottom: 20px;
    background:rgba(15,23,42,0.95);
    border-top:1px solid rgba(255,255,255,0.08);
}

/* Title Strip — centered hymn title at the top of the command center */
.fb-title-strip {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 10px;
    padding: 10px 24px 6px;
    border-bottom: 1px solid rgba(255,255,255,0.05);
}
.fb-hymn-title-bottom {
    margin: 0;
    font-family: 'Playfair Display', serif;
    font-size: 1.05rem;
    font-weight: 800;
    color: #f1f5f9;
    text-align: center;
    letter-spacing: 0.3px;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
    max-width: 60vw;
    /* Subtle gradient shimmer */
    background: linear-gradient(90deg, #c7d2fe, #f1f5f9, #bfdbfe);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}
.fb-track-status-bottom {
    font-size: .6rem;
    font-weight: 700;
    color: #475569;
    text-transform: uppercase;
    letter-spacing: 1.5px;
    white-space: nowrap;
    flex-shrink: 0;
}

/* Audio Row */
.fb-audio-row {
    display:flex; align-items:center; gap:12px;
    padding:10px 20px 6px;
}
.fb-play-sphere {
    width:42px; height:42px; border-radius:0; flex-shrink:0;
    background:linear-gradient(135deg,#2563eb,#1d4ed8);
    border:none; color:#fff; font-size:1rem;
    display:flex; align-items:center; justify-content:center;
    cursor:pointer; transition:all .3s;
    box-shadow:0 8px 20px rgba(37,99,235,.35);
}
.fb-play-sphere:hover { transform:scale(1.1); box-shadow:0 12px 28px rgba(37,99,235,.45); }
.fb-now-playing {
    padding:6px 14px; background:rgba(255,255,255,0.05); border-radius:12px;
    border:1px solid rgba(255,255,255,0.05); min-width:120px; text-align:center;
}
.fb-timestamp { font-size:.65rem; font-weight:800; color:#475569; font-family:'Outfit',monospace; white-space:nowrap; }
.fb-audio-track-wrap {
    flex:1; position:relative; height:5px;
    background:rgba(255,255,255,.08); border-radius:8px;
    display:flex; align-items:center; min-width:80px;
}
.fb-audio-scrubber {
    position:absolute; width:100%; height:100%;
    -webkit-appearance:none; background:transparent; cursor:pointer; z-index:5;
}
.fb-audio-scrubber::-webkit-slider-thumb {
    -webkit-appearance:none; width:14px; height:14px; border-radius:50%;
    background:#3b82f6; border:2px solid #fff;
    box-shadow:0 0 10px rgba(59,130,246,.5); cursor:pointer; transition:transform .2s;
}
.fb-audio-scrubber::-webkit-slider-thumb:hover { transform:scale(1.3); }
.fb-audio-fill { position:absolute; height:100%; background:linear-gradient(to right,#3b82f6,#60a5fa); border-radius:8px; pointer-events:none; width:0%; }
.fb-vol-wrap { display:flex; align-items:center; gap:6px; flex-shrink:0; }
.fb-vol-icon { color:#475569; font-size:.7rem; }
.fb-vol-slider { width:70px; height:3px; -webkit-appearance:none; background:rgba(255,255,255,.1); border-radius:4px; cursor:pointer; }
.fb-vol-slider::-webkit-slider-thumb { -webkit-appearance:none; width:12px; height:12px; border-radius:50%; background:#3b82f6; cursor:pointer; }
.fb-now-playing { display:flex; align-items:center; gap:8px; padding:4px 12px; background:rgba(255,255,255,.04); border-radius:20px; border:1px solid rgba(255,255,255,.07); flex-shrink:0; }
.fb-eq-dot {
    width:8px; height:8px; border-radius:50%;
    background:#3b82f6; flex-shrink:0;
    box-shadow:0 0 0 0 rgba(59,130,246,.5);
}
.fb-eq-dot.playing { animation:fb-eq-pulse 1.4s ease infinite; }
@keyframes fb-eq-pulse { 0%{box-shadow:0 0 0 0 rgba(59,130,246,.5)} 70%{box-shadow:0 0 0 7px rgba(59,130,246,0)} 100%{box-shadow:0 0 0 0 rgba(59,130,246,0)} }

/* Page scrubber row */
.fb-page-row {
    display:flex; align-items:center; gap:14px;
    padding:4px 20px 10px;
}
.fb-page-counter,.fb-hint { font-size:.63rem; font-weight:700; color:#334155; white-space:nowrap; }
.fb-page-counter strong { color:#64748b; }
.fb-scrub-wrap { flex:1; position:relative; height:4px; background:rgba(255,255,255,.06); border-radius:8px; display:flex; align-items:center; }
.fb-scrubber { position:absolute; width:100%; height:100%; -webkit-appearance:none; background:transparent; cursor:pointer; z-index:5; }
.fb-scrubber::-webkit-slider-thumb { -webkit-appearance:none; width:14px; height:14px; border-radius:50%; background:#3b82f6; border:2px solid #0f172a; cursor:pointer; box-shadow:0 0 8px rgba(59,130,246,.4); transition:transform .2s; }
.fb-scrubber::-webkit-slider-thumb:hover { transform:scale(1.3); }
.fb-scrub-fill { position:absolute; height:100%; background:rgba(59,130,246,.5); border-radius:8px; pointer-events:none; width:0%; }

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
    .fb-hymn-title { font-size:0.8rem !important; }
    .fb-nav-arrow { width:34px; height:34px; margin:0 4px; font-size:.7rem; }
    .fb-stage { padding: 10px !important; }
    .fb-vol-wrap,.fb-hint { display:none; }
    .fb-now-playing { display:none; }
    .fb-ctrl-btn { width:32px; height:32px; border-radius:8px; }
    .fb-view-btn { width:32px; height:32px; }
    .fb-zoom-label { min-width:30px; font-size:0.6rem; }
    #flipbook-theater { inset: 0; }
}

/* ── INTERAL MODAL STYLES ── */
.fb-sub-overlay {
    position: absolute; inset: 0; z-index: 200;
    background: rgba(15,23,42,0.7); /* Dark semi-transparent without blur */
    display: none; align-items: center; justify-content: center;
    padding: 2rem;
}
.fb-sub-overlay.active { display: flex; animation: fb-fade-in 0.3s ease; }

.fb-sub-modal {
    display: none; background: #ffffff; width: 100%; max-width: 550px;
    border-radius: 0; box-shadow: 0 40px 80px rgba(0,0,0,0.4);
    overflow: hidden; flex-direction: column; max-height: 85%;
}
.fb-sub-modal.active { display: flex; animation: fb-slide-up 0.4s cubic-bezier(0.16, 1, 0.3, 1); }

.fb-modal-header {
    background: #f8fafc; padding: 1.25rem 1.5rem; border-bottom: 1px solid #e2e8f0;
    display: flex; align-items: center; justify-content: space-between;
}
.fb-modal-header h3 { font-family: 'Outfit', sans-serif; font-weight: 800; color: #1e293b; margin: 0; font-size: 1.1rem; }
.fb-modal-close { width: 32px; height: 32px; border-radius: 50%; border: none; background: #fee2e2; color: #ef4444; cursor: pointer; }

.fb-modal-content { flex: 1; overflow-y: auto; padding: 1.5rem; }

/* Details UI */
.fb-details-grid { display: flex; flex-direction: column; gap: 1.25rem; }
.fb-detail-card { background: #f8fafc; padding: 1.25rem; border-radius: 0; border: 1px solid #f1f5f9; }
.fb-detail-card.main { background: #0f172a; color: white; border: none; text-align: center; }
.fb-detail-label { display: block; font-size: 0.65rem; font-weight: 900; color: #94a3b8; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 0.5rem; }
.fb-detail-title { font-family: 'Playfair Display', serif; font-size: 1.75rem; font-weight: 900; margin-bottom: 0.5rem; }
.fb-detail-number { font-size: 0.8rem; font-weight: 800; font-family: 'Outfit', sans-serif; }
.fb-detail-tags { display: flex; flex-wrap: wrap; gap: 6px; }
.fb-tag { background: white; padding: 4px 10px; border-radius: 0; font-size: 0.75rem; font-weight: 700; color: #475569; }
.fb-tag.ensemble { background: #eff6ff; color: #2563eb; }
.fb-credits-list { display: flex; flex-direction: column; gap: 0.5rem; font-size: 0.85rem; color: #334155; }
.fb-verse-text { font-family: 'Playfair Display', serif; font-style: italic; font-size: 1rem; color: #0c4a6e; line-height: 1.6; }

@keyframes fb-slide-up { from{opacity:0; transform:translateY(30px)} to{opacity:1; transform:translateY(0)} }

/* ─── LIGHT MODE OVERRIDES ────────────────────────────── */
#flipbook-theater.fb-light-mode {
    background: radial-gradient(circle at 30% 20%, #f1f5f9 0%, #cbd5e1 100%);
    box-shadow: 0 0 0 1px rgba(0,0,0,0.1), 0 50px 100px -20px rgba(0,0,0,0.3);
    border: 1px solid rgba(0,0,0,0.1);
}
#flipbook-theater.fb-light-mode::before {
    background: 
        radial-gradient(ellipse at 50% 0%, rgba(37,99,235,0.06) 0%, transparent 60%),
        radial-gradient(ellipse at 100% 100%, rgba(29,78,216,0.04) 0%, transparent 50%);
}
#flipbook-theater.fb-light-mode .fb-top-bar,
#flipbook-theater.fb-light-mode .fb-command-center {
    background: rgba(255,255,255,0.95);
    border-color: rgba(0,0,0,0.08);
}
#flipbook-theater.fb-light-mode .fb-badge {
    color: #2563eb !important; border-color: rgba(37,99,235,0.4) !important; background: rgba(37,99,235,0.1) !important;
}
#flipbook-theater.fb-light-mode .fb-track-pill {
    background: rgba(0,0,0,0.03); border-color: rgba(0,0,0,0.08); color: #475569;
}
#flipbook-theater.fb-light-mode .fb-track-pill:hover:not(:disabled) {
    background: rgba(255,255,255,0.8); border-color: rgba(0,0,0,0.15); color: #0f172a;
}
#flipbook-theater.fb-light-mode .fb-track-pill.active {
    background: #3b82f6; color: #ffffff; border-color: #2563eb;
}
#flipbook-theater.fb-light-mode .fb-pill-disabled {
    background: rgba(0,0,0,0.02) !important; border-color: rgba(0,0,0,0.04) !important; color: #94a3b8 !important;
}
#flipbook-theater.fb-light-mode .fb-pill-disabled i { color: #cbd5e1 !important; }
#flipbook-theater.fb-light-mode .fb-view-toggle,
#flipbook-theater.fb-light-mode .fb-extra-ctrls {
    background: rgba(241,245,249,0.5); border-color: rgba(0,0,0,0.05);
}
#flipbook-theater.fb-light-mode .fb-ctrl-btn {
    background: rgba(0,0,0,0.04); border-color: transparent; color: #64748b;
}
#flipbook-theater.fb-light-mode .fb-ctrl-btn:hover { background: rgba(37,99,235,0.1); color: #2563eb; }
#flipbook-theater.fb-light-mode .fb-close-btn:hover { background: rgba(239,68,68,0.1); color: #dc2626; }
#flipbook-theater.fb-light-mode .fb-title-strip { border-color: rgba(0,0,0,0.05); }
#flipbook-theater.fb-light-mode .fb-hymn-title-bottom {
    background: linear-gradient(90deg, #1e3a8a, #0f172a, #1e40af);
    -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;
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
#flipbook-theater.fb-light-mode .fb-scrub-wrap { background: rgba(0,0,0,0.08); }
#flipbook-theater.fb-light-mode .fb-vol-slider { background: rgba(0,0,0,0.12); }
#flipbook-theater.fb-light-mode .fb-now-playing { background: rgba(0,0,0,0.03); border-color: rgba(0,0,0,0.05); }
#flipbook-theater.fb-light-mode #fb-track-label { color: #475569 !important; }
#flipbook-theater.fb-light-mode .fb-nav-arrow {
    background: rgba(255,255,255,0.7); border-color: rgba(0,0,0,0.1); color: #64748b; box-shadow: 0 4px 12px rgba(0,0,0,0.05);
}
#flipbook-theater.fb-light-mode .fb-nav-arrow:hover:not(:disabled) {
    background: #ffffff; color: #2563eb; border-color: rgba(37,99,235,0.3); box-shadow: 0 4px 15px rgba(37,99,235,0.15);
}
#flipbook-theater.fb-light-mode .fb-nav-arrow:disabled { background: transparent; opacity: 0.5; color: #cbd5e1; border-color: transparent; box-shadow: none; }
#flipbook-theater.fb-light-mode .fb-book {
    border-color: #cbd5e1; box-shadow: 0 40px 80px rgba(0,0,0,0.15), 0 15px 35px rgba(0,0,0,0.1);
}
#flipbook-theater.fb-light-mode .fb-spine {
    background: linear-gradient(to right, #e2e8f0, #ffffff, #f1f5f9);
    box-shadow: inset -3px 0 6px rgba(0,0,0,.08), inset 3px 0 6px rgba(0,0,0,.04);
}
</style>

<script>
(function() {
'use strict';

/* ── Asset Paths (from Blade) ──────────────────────────────────── */
const PATHS = {
    score:   '{{ $music->music_score_path   ? asset("storage/".$music->music_score_path)   : "" }}',
    lyrics:  '{{ $music->lyrics_path        ? asset("storage/".$music->lyrics_path)        : "" }}',
    vocals:  '{{ $music->vocals_mp3_path    ? asset("storage/".$music->vocals_mp3_path)    : "" }}',
    organ:   '{{ $music->organ_mp3_path     ? asset("storage/".$music->organ_mp3_path)     : "" }}',
    preludes:'{{ $music->preludes_mp3_path  ? asset("storage/".$music->preludes_mp3_path)  : "" }}',
};

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
const dlToggle    = document.getElementById('fb-dl-toggle');
const dlDropdown  = document.getElementById('fb-dropdown');
const fbStage     = document.getElementById('fb-stage');
const themeToggle = document.getElementById('fb-theme-toggle');

/* ── State ─────────────────────────────────────────────────────── */
let fbPdfDoc = null, fbTotal = 0, fbSpread = 1, fbZoom = 1.0;
let scoreDoc = null, lyricsDoc = null; // Store both separately
let currentView = 'score';   // 'score' | 'lyrics'
let lyricsLoaded = false;

/* ── Launch Button (inject into existing floating group) ── */
const floatingGroup = document.querySelector('.floating-action-group');
if (floatingGroup) {
    const btn = document.createElement('button');
    btn.id = 'fb-open-btn';
    btn.title = 'Open Flipbook Theater';
    btn.innerHTML = '<i class="fas fa-book-open"></i><span class="btn-tooltip">Flipbook</span>';
    floatingGroup.appendChild(btn);
    btn.addEventListener('click', openTheater);
}

/* ── OPEN ──────────────────────────────────────────────────────── */
function openTheater() {
    const hasScore = !!PATHS.score;
    if (!hasScore && !PATHS.lyrics) {
        alert('No music score or lyrics file is available for this hymn.');
        return;
    }

    theater.style.display = 'flex';
    document.body.style.overflow = 'hidden';

    // Always activate the first audio track pill on open
    const firstTrack = PATHS.organ || PATHS.vocals || PATHS.preludes || '';
    if (firstTrack) {
        const trackName = PATHS.organ ? 'Organ' : (PATHS.vocals ? 'Vocals' : 'Preludes');
        loadTrack(firstTrack, trackName);
        const firstPill = document.querySelector('.fb-track-pill[data-src]');
        if (firstPill) {
            document.querySelectorAll('.fb-track-pill').forEach(p => p.classList.remove('active'));
            firstPill.classList.add('active');
        }
    }

    if (hasScore) {
        if (scoreDoc) {
            // ✅ Already loaded — re-render instantly from cache, no network call
            fbPdfDoc = scoreDoc;
            fbTotal  = scoreDoc.numPages;
            fbSpread = 1;
            if (totalLbl) totalLbl.textContent = fbTotal;
            if (scrubber) scrubber.max = Math.max(1, fbTotal);
            scoreView.style.display  = 'flex';
            lyricsView.style.display = 'none';
            pageRow.style.display    = 'flex';
            renderSpread(1, false);
        } else {
            // First open — fetch from server
            loadPdf(PATHS.score);
        }
    } else if (PATHS.lyrics) {
        switchView('lyrics');
    }
}

/* ── CLOSE ─────────────────────────────────────────────────────── */
closeBtn.addEventListener('click', () => {
    theater.style.display = 'none';
    document.body.style.overflow = '';
    // Pause audio but keep src & state so reopening is instant
    audio.pause();
    const dots = document.querySelectorAll('.fb-eq-bar');
    dots.forEach(d => d.classList.remove('animating'));
    playIcon.className = 'fas fa-play';
    // NOTE: we do NOT reset fbPdfDoc, scoreDoc, lyricsDoc, or lyricsLoaded here.
    // These are preserved in memory so reopening re-renders instantly from cache.
    if (document.fullscreenElement) document.exitFullscreen().catch(()=>{});
});

/* ── FULLSCREEN ────────────────────────────────────────────────── */
fsBtn.addEventListener('click', () => {
    if (!document.fullscreenElement) {
        theater.requestFullscreen().catch(()=>{});
        fsBtn.innerHTML = '<i class="fas fa-compress"></i>';
    } else {
        document.exitFullscreen().catch(()=>{});
        fsBtn.innerHTML = '<i class="fas fa-expand"></i>';
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
        const src   = pill.dataset.src;
        const label = pill.dataset.label;
        if (!src) return;
        document.querySelectorAll('.fb-track-pill').forEach(p => p.classList.remove('active'));
        pill.classList.add('active');
        loadTrack(src, label);
        // Update download mp3 link
        const mp3Link = document.getElementById('fb-dl-mp3');
        if (mp3Link) { mp3Link.href = src; }
    });
});

function loadTrack(src, label) {
    audio.src = src;
    audio.load();
    const playPromise = audio.play();
    if (playPromise !== undefined) {
        playPromise.catch(() => {
            const startOverlay = document.getElementById('fb-start-overlay');
            if (startOverlay) {
               startOverlay.classList.add('show');
               startOverlay.onclick = () => {
                   audio.play();
                   startOverlay.classList.remove('show');
               };
            }
        });
    }
    const bars = document.querySelectorAll('.fb-eq-bar');
    const visualizer = document.getElementById('fb-eq-visualizer');
    if (visualizer) visualizer.classList.add('show');
    bars.forEach(b => b.classList.add('animating'));

    const trackStatus = document.getElementById('fb-track-status');
    if (trackStatus) trackStatus.textContent = label || 'Playing';
    
    trackLabel.textContent = label || 'Playing';
    audioScrub.value = 0;
    audioFill.style.width = '0%';
}

function updatePlayUI(isPlaying) {
    playIcon.className = isPlaying ? 'fas fa-pause' : 'fas fa-play';
    const bars = document.querySelectorAll('.fb-eq-bar');
    const visualizer = document.getElementById('fb-eq-visualizer');
    
    if (isPlaying) {
        if (visualizer) visualizer.classList.add('show');
        bars.forEach(b => b.classList.add('animating'));
    } else {
        bars.forEach(b => b.classList.remove('animating'));
    }
}

window.loadTheaterTrack = loadTrack;

/* ── AUDIO PLAYER ──────────────────────────────────────────────── */
playBtn.addEventListener('click', () => {
    if (audio.paused) {
        audio.play().catch(()=>{});
        updatePlayUI(true);
    } else {
        audio.pause();
        updatePlayUI(false);
    }
});

audio.addEventListener('timeupdate', () => {
    if (!audio.duration) return;
    const pct = (audio.currentTime / audio.duration) * 100;
    audioFill.style.width = pct + '%';
    audioScrub.value = pct;
    curTime.textContent = fmt(audio.currentTime);
});

audio.addEventListener('loadedmetadata', () => {
    durTime.textContent = fmt(audio.duration);
});

audio.addEventListener('ended', () => {
    updatePlayUI(false);
});

audioScrub.addEventListener('input', () => {
    if (!audio.duration) return;
    audio.currentTime = (audioScrub.value / 100) * audio.duration;
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
if (scoreBtnEl)  scoreBtnEl.addEventListener('click',  () => switchView('score'));
if (lyricsBtnEl) lyricsBtnEl.addEventListener('click', () => switchView('lyrics'));

function switchView(mode) {
    currentView = mode;
    if (mode === 'score') {
        scoreView.style.display  = 'flex';
        lyricsView.style.display = 'none';
        pageRow.style.display    = 'flex';
        if (scoreBtnEl)  scoreBtnEl.classList.add('active');
        if (lyricsBtnEl) lyricsBtnEl.classList.remove('active');
        // Restore Score PDF from cache
        if (scoreDoc) {
            fbPdfDoc = scoreDoc;
            fbTotal  = scoreDoc.numPages;
            fbSpread = 1;
            if (totalLbl) totalLbl.textContent = fbTotal;
            if (scrubber) scrubber.max = Math.max(1, fbTotal);
            renderSpread(fbSpread, false);
        }
    } else {
        scoreView.style.display  = 'none';
        lyricsView.style.display = 'block';
        pageRow.style.display    = 'none';
        if (lyricsBtnEl) lyricsBtnEl.classList.add('active');
        if (scoreBtnEl)  scoreBtnEl.classList.remove('active');

        if (lyricsLoaded && lyricsDoc) {
            // ✅ Already loaded — re-render from cache instantly
            rerenderLyricsFromCache();
        } else if (!lyricsLoaded && PATHS.lyrics) {
            loadLyrics(PATHS.lyrics);
        }
    }
}

/* Re-renders lyrics from the cached lyricsDoc without any network fetch */
function rerenderLyricsFromCache() {
    if (!lyricsDoc) return;
    if (lyricsDoc.numPages > 1) {
        // Multi-page lyrics PDF — uses score view layout
        fbPdfDoc = lyricsDoc;
        fbTotal  = lyricsDoc.numPages;
        fbSpread = 1;
        scoreView.style.display  = 'flex';
        lyricsView.style.display = 'none';
        pageRow.style.display    = 'flex';
        if (totalLbl) totalLbl.textContent = fbTotal;
        if (scrubber) scrubber.max = Math.max(1, fbTotal);
        renderSpread(1, false);
    } else {
        // Single-page PDF — re-render canvas into lyricsInner
        lyricsInner.style.cssText = 'display:flex;flex-direction:column;align-items:center;gap:2rem;width:100%;';
        lyricsInner.innerHTML = '';
        lyricsDoc.getPage(1).then(page => {
            const dpr = window.devicePixelRatio || 1;
            const scale = Math.min((lyricsView.clientWidth - 80) / page.getViewport({scale:1}).width, 1.4) * fbZoom;
            const vp = page.getViewport({ scale: scale * dpr });
            const canvas = document.createElement('canvas');
            canvas.width = vp.width; canvas.height = vp.height;
            canvas.style.width  = (vp.width / dpr) + 'px';
            canvas.style.height = (vp.height / dpr) + 'px';
            canvas.style.cssText += 'max-width:100%;border-radius:0;box-shadow:0 20px 50px rgba(0,0,0,.6);border:1px solid rgba(255,255,255,0.1);';
            page.render({ canvasContext: canvas.getContext('2d'), viewport: vp });
            lyricsInner.appendChild(canvas);
        });
    }
}

function loadLyrics(path) {
    lyricsInner.innerHTML = '<div style="color:#64748b;padding:3rem;text-align:center;"><i class="fas fa-circle-notch fa-spin" style="font-size:2rem;display:block;margin-bottom:1rem;color:#3b82f6;"></i>Loading lyrics...</div>';
    if (path.toLowerCase().endsWith('.pdf')) {
        loadLyricsPdf(path);
        return;
    }
    fetch(path)
        .then(r => r.ok ? r.text() : Promise.reject())
        .then(text => {
            const clean = text.replace(/\[\d{2,}:\d{2}(\.\d+)?\]/g, '').replace(/\r/g, '').trim();
            if (!clean) { lyricsInner.innerHTML = '<div style="color:#475569;padding:3rem;text-align:center;">No lyrics found.</div>'; return; }
            const lines = clean.split('\n');
            lyricsInner.innerHTML = lines.map(line => {
                const l = line.trim();
                if (!l) return '<div style="height:1.2em"></div>';
                return `<p style="margin:0 0 .4rem;opacity:${l.startsWith('[') ? '.45' : '1'}">${l}</p>`;
            }).join('');
            lyricsLoaded = true;
        })
        .catch(() => { lyricsInner.innerHTML = '<div style="color:#ef4444;padding:2rem;text-align:center;">Failed to load lyrics.</div>'; });
}

function loadLyricsPdf(path) {
    const ensurePdfJs = (cb) => {
        if (typeof pdfjsLib !== 'undefined') { cb(); return; }
        const s = document.createElement('script');
        s.src = 'https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.11.338/pdf.min.js';
        s.onload = cb;
        document.head.appendChild(s);
    };
    ensurePdfJs(() => {
        pdfjsLib.GlobalWorkerOptions.workerSrc = 'https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.11.338/pdf.worker.min.js';
        pdfjsLib.getDocument(path).promise.then(pdf => {
            lyricsDoc = pdf;
            if (pdf.numPages > 1) {
                fbPdfDoc = pdf; fbTotal = pdf.numPages; fbSpread = 1;
                scoreView.style.display = 'flex'; lyricsView.style.display = 'none'; pageRow.style.display = 'flex';
                if (totalLbl) totalLbl.textContent = fbTotal;
                if (scrubber) scrubber.max = Math.max(1, fbTotal);
                renderSpread(1, false);
                lyricsLoaded = true;
            } else {
                lyricsInner.style.cssText = 'display:flex;flex-direction:column;align-items:center;gap:2rem;width:100%;';
                lyricsInner.innerHTML = '';
                pdf.getPage(1).then(page => {
                    const dpr = window.devicePixelRatio || 1;
                    const scale = Math.min((lyricsView.clientWidth - 80) / page.getViewport({scale:1}).width, 1.4) * fbZoom;
                    const vp = page.getViewport({ scale: scale * dpr });
                    const canvas = document.createElement('canvas');
                    canvas.width = vp.width; canvas.height = vp.height;
                    canvas.style.width = (vp.width / dpr) + 'px';
                    canvas.style.height = (vp.height / dpr) + 'px';
                    canvas.style.cssText += 'max-width:100%;border-radius:0;box-shadow:0 20px 50px rgba(0,0,0,.6);border:1px solid rgba(255,255,255,0.1);';
                    page.render({ canvasContext: canvas.getContext('2d'), viewport: vp });
                    lyricsInner.appendChild(canvas);
                });
                lyricsLoaded = true;
            }
        });
    });
}

/* ── PDF LOAD ──────────────────────────────────────────────────── */
function loadPdf(path) {
    if (typeof pdfjsLib === 'undefined') {
        const s = document.createElement('script');
        s.src = 'https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.11.338/pdf.min.js';
        s.onload = () => doLoadPdf(path);
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
        if (pctLabel) pctLabel.style.display = 'none';
        scoreDoc = pdf; fbPdfDoc = pdf; fbTotal = pdf.numPages; fbSpread = 1;
        totalLbl.textContent = fbTotal; scrubber.max = Math.max(1, fbTotal); renderSpread(1, false);
    });
}

/* ── RENDER SPREAD ─────────────────────────────────────────────── */
function renderSpread(leftNum, animate) {
    fbSpread = leftNum;
    updatePageUI();
    renderPage(leftNum,     canvasL, numL);
    renderPage(leftNum + 1, canvasR, numR);
    if (animate !== false) flipAnim(leftNum);
}

let _lastSpread = 1;
let _isAnimating = false;

function flipAnim(leftNum, onDone) {
    const turningPage = document.getElementById('fb-turning-page');
    if (!turningPage || _isAnimating) { if (onDone) onDone(); return; }

    const goingForward = leftNum > _lastSpread;
    _lastSpread = leftNum;
    _isAnimating = true;

    // Always reset inline positioning so CSS class takes over
    turningPage.style.left  = '';
    turningPage.style.right = '';
    turningPage.style.transform = '';
    turningPage.style.display = 'none';
    turningPage.classList.remove('fb-turning-right', 'fb-turning-left');

    // Force reflow to ensure clean state before re-animating
    void turningPage.offsetWidth;

    // Show and animate — CSS class sets the correct position & origin
    turningPage.style.display = 'block';
    turningPage.classList.add(goingForward ? 'fb-turning-right' : 'fb-turning-left');

    const cleanup = () => {
        turningPage.style.display = 'none';
        turningPage.classList.remove('fb-turning-right', 'fb-turning-left');
        _isAnimating = false;
        turningPage.removeEventListener('animationend', cleanup);
        if (onDone) onDone();
    };
    turningPage.addEventListener('animationend', cleanup, { once: true });
}

function renderPage(pageNum, canvas, numEl) {
    if (!fbPdfDoc || pageNum < 1 || pageNum > fbTotal) {
        const ctx = canvas.getContext('2d');
        canvas.width = canvas.width || 420; canvas.height = canvas.height || 590;
        ctx.fillStyle = '#f9fafb'; ctx.fillRect(0, 0, canvas.width, canvas.height);
        numEl.textContent = ''; return;
    }
    fbPdfDoc.getPage(pageNum).then(page => {
        const dpr = window.devicePixelRatio || 1;
        const padding = window.innerWidth < 768 ? 20 : 60;
        const halfW = (fbStage.clientWidth / 2) - (padding / 2) - 20;
        const maxH  = fbStage.clientHeight - padding;
        const native = page.getViewport({ scale: 1 });
        let scale = (halfW / native.width) * fbZoom;
        if (native.height * scale > maxH) scale = (maxH / native.height) * fbZoom;
        
        const vp = page.getViewport({ scale: scale * dpr });
        canvas.width = vp.width; canvas.height = vp.height;
        // The canvas dimensions are set to physical pixels, but CSS keeps it display size
        canvas.style.width = (vp.width / dpr) + "px";
        canvas.style.height = (vp.height / dpr) + "px";

        page.render({ canvasContext: canvas.getContext('2d'), viewport: vp });
        numEl.textContent = pageNum;
    });
}

/* ── NAV ───────────────────────────────────────────────────────── */
prevBtn.addEventListener('click', () => goSpread(-2));
nextBtn.addEventListener('click', () => goSpread(+2));
function goSpread(delta) {
    if (_isAnimating) return; // Block rapid double-clicks during animation
    const n = fbSpread + delta;
    if (n < 1 || n > fbTotal) return;
    
    // Direction for animation
    const nextSpread = n;
    
    // Run the flip animation, then render new pages when it's halfway (most dramatic)
    const goingForward = delta > 0;
    _lastSpread = fbSpread;  // Save before update
    fbSpread = nextSpread;
    updatePageUI();
    
    if (goingForward) {
        // Show animation first, then render new pages
        flipAnim(nextSpread, null);
        // Render new pages slightly into the animation for seamless reveal
        setTimeout(() => {
            renderPage(nextSpread,     canvasL, numL);
            renderPage(nextSpread + 1, canvasR, numR);
        }, 200);
    } else {
        renderPage(nextSpread,     canvasL, numL);
        renderPage(nextSpread + 1, canvasR, numR);
        flipAnim(nextSpread, null);
    }
}

function updatePageUI() {
    const right = Math.min(fbSpread + 1, fbTotal);
    spreadLbl.textContent = (fbSpread === right) || (fbTotal === 1) ? fbSpread : `${fbSpread}–${right}`;
    prevBtn.disabled = fbSpread <= 1;
    nextBtn.disabled = (fbSpread + 2) > fbTotal;
    const pct = fbTotal > 1 ? ((fbSpread - 1) / (fbTotal - 1)) * 100 : 0;
    scrubFill.style.width = pct + '%';
    scrubber.value = fbSpread;

    // Single-page mode logic
    const wrap = document.getElementById('fb-book-wrap');
    if (wrap) {
        if (fbTotal <= 1) wrap.classList.add('fb-single-page');
        else wrap.classList.remove('fb-single-page');
    }
}

scrubFill.parentElement.addEventListener('click', (e) => {
    // Optional: allow clicking on the bar to jump
});

scrubber.addEventListener('input', () => {
    let v = parseInt(scrubber.value);
    if (v % 2 === 0) v = Math.max(1, v - 1);
    renderSpread(v);
});

/* ── SWIPE SUPPORT ─────────────────────────────────────────────── */
let touchStartX = 0;
fbStage.addEventListener('touchstart', (e) => { touchStartX = e.changedTouches[0].screenX; }, {passive: true});
fbStage.addEventListener('touchend',   (e) => {
    const touchEndX = e.changedTouches[0].screenX;
    const diff = touchStartX - touchEndX;
    if (Math.abs(diff) > 50) {
        if (diff > 0) goSpread(2); else goSpread(-2);
    }
}, {passive: true});

/* ── ZOOM ──────────────────────────────────────────────────────── */
zoomIn.addEventListener('click',  () => changeZoom(+0.15));
zoomOut.addEventListener('click', () => changeZoom(-0.15));
function changeZoom(d) {
    fbZoom = Math.min(2.5, Math.max(0.5, fbZoom + d));
    zoomLabel.textContent = Math.round(fbZoom * 100) + '%';
    if (fbPdfDoc) renderSpread(fbSpread, false);
}

/* ── DOWNLOAD DROPDOWN ─────────────────────────────────────────── */
if (dlToggle) {
    dlToggle.addEventListener('click', e => { e.stopPropagation(); dlDropdown.style.display = dlDropdown.style.display === 'none' ? 'block' : 'none'; });
    document.addEventListener('click', () => { if (dlDropdown) dlDropdown.style.display = 'none'; });
}

/* ── EXTRA BUTTONS (Theater Modals) ────────────────────────────── */
const detailsBtn = document.getElementById('fb-details-btn');
const playlistBtn = document.getElementById('fb-playlist-btn');
const subOverlay = document.getElementById('fb-sub-overlay');
const detailsModal = document.getElementById('fb-details-modal');
const playlistModalLocal = document.getElementById('fb-playlist-modal');

if (detailsBtn) {
    detailsBtn.addEventListener('click', () => {
        subOverlay.classList.add('active');
        detailsModal.classList.add('active');
        playlistModalLocal.classList.remove('active');
    });
}
if (playlistBtn) {
    playlistBtn.addEventListener('click', () => {
        subOverlay.classList.add('active');
        playlistModalLocal.classList.add('active');
        detailsModal.classList.remove('active');
        loadTheaterPlaylist();
    });
}

function closeSubModals() {
    subOverlay.classList.remove('active');
    detailsModal.classList.remove('active');
    playlistModalLocal.classList.remove('active');
}
document.getElementById('fb-close-details')?.addEventListener('click', closeSubModals);
document.getElementById('fb-close-playlist')?.addEventListener('click', closeSubModals);
subOverlay?.addEventListener('click', (e) => { if(e.target === subOverlay) closeSubModals(); });

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

/* ── AUTO-OPEN & RESIZE ────────────────────────────────────────── */
document.addEventListener('DOMContentLoaded', () => { setTimeout(openTheater, 400); });
let resizeTimer;
window.addEventListener('resize', () => {
    clearTimeout(resizeTimer);
    resizeTimer = setTimeout(() => { if (theater.style.display !== 'none' && fbPdfDoc) renderSpread(fbSpread, false); }, 250);
});

})();
</script>
