<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

<style>
    :root {
        --primary-gradient: linear-gradient(135deg, #64B5D6 0%, #3E6D9C 100%);
        --glass-bg: rgba(255, 255, 255, 0.9);
        --accent-gold: #FFD700;
        --accent-blue: #3E6D9C;
    }

    body {
        background: var(--primary-gradient) !important;
        background-attachment: fixed !important;
        min-height: 100vh;
        font-family: 'Outfit', sans-serif;
    }

    .profile-card {
        background: var(--glass-bg);
        border-radius: 30px;
        border: 1px solid rgba(255, 255, 255, 0.4);
        box-shadow: 0 20px 50px rgba(0, 0, 0, 0.15);
        padding: 3rem;
        margin: 2rem auto;
        max-width: 1000px;
        position: relative;
        overflow: hidden;
    }

    .profile-header {
        display: flex;
        gap: 3rem;
        align-items: center;
        margin-bottom: 3rem;
        border-bottom: 1px solid rgba(0,0,0,0.05);
        padding-bottom: 3rem;
    }

    @media (max-width: 768px) {
        .profile-header {
            flex-direction: column;
            text-align: center;
        }
    }

    .profile-image {
        width: 220px;
        height: 220px;
        border-radius: 25%;
        object-fit: cover;
        box-shadow: 0 15px 35px rgba(0,0,0,0.2);
        border: 5px solid white;
    }

    .profile-info h1 {
        font-size: 3rem;
        font-weight: 900;
        color: var(--accent-blue);
        margin-bottom: 0.5rem;
        letter-spacing: -1px;
    }

    .designation-badge {
        display: inline-block;
        padding: 6px 15px;
        background: #e0f2fe;
        color: #0369a1;
        border-radius: 10px;
        font-size: 0.8rem;
        font-weight: 800;
        text-transform: uppercase;
        margin-right: 8px;
        margin-bottom: 8px;
    }

    .section-title {
        font-size: 1.25rem;
        font-weight: 800;
        color: #1e293b;
        margin-bottom: 1.5rem;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .section-title i {
        color: var(--accent-blue);
    }

    .meta-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 1.5rem;
        margin-bottom: 3rem;
    }

    .meta-item {
        background: rgba(255,255,255,0.5);
        padding: 1.25rem;
        border-radius: 18px;
        border: 1px solid rgba(0,0,0,0.03);
    }

    .meta-label {
        font-size: 0.75rem;
        font-weight: 950;
        color: #64748b;
        text-transform: uppercase;
        margin-bottom: 5px;
    }

    .meta-value {
        font-size: 1.1rem;
        font-weight: 700;
        color: #334155;
    }

    .background-box {
        background: #f8fafc;
        padding: 2rem;
        border-radius: 20px;
        border-left: 5px solid var(--accent-blue);
        line-height: 1.8;
        color: #475569;
        font-style: italic;
    }

    .hymn-list {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
        gap: 1rem;
    }

    .hymn-item {
        background: white;
        padding: 1.25rem;
        border-radius: 15px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        transition: all 0.3s;
        text-decoration: none !important;
        border: 1px solid #f1f5f9;
    }

    .hymn-item:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.05);
        border-color: var(--accent-blue);
    }

    .hymn-title {
        font-weight: 700;
        color: #1e293b;
    }

    .hymn-number {
        font-size: 0.8rem;
        font-weight: 800;
        color: #94a3b8;
        background: #f8fafc;
        padding: 4px 10px;
        border-radius: 6px;
    }

    .back-btn {
        position: absolute;
        top: 3rem;
        right: 3rem;
        background: white;
        width: 45px;
        height: 45px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--accent-blue);
        box-shadow: 0 10px 20px rgba(0,0,0,0.1);
        transition: all 0.3s;
    }

    .back-btn:hover {
        background: var(--accent-blue);
        color: white;
        transform: scale(1.1);
    }

    .edit-btn {
        background: white;
        width: 40px;
        height: 40px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #64748b;
        border: 1px solid #e2e8f0;
        transition: all 0.3s;
        text-decoration: none !important;
    }

    .edit-btn:hover {
        background: var(--accent-blue);
        color: white;
        border-color: var(--accent-blue);
        transform: translateY(-2px);
    }

</style>

<x-app-layout>
    <div class="container py-5">
        <div class="profile-card">
            <a href="{{ url()->previous() }}" class="back-btn" title="Go Back">
                <i class="fas fa-arrow-left"></i>
            </a>

            <div class="profile-header">
                <img src="{{ $creator->image ? asset('storage/' . $creator->image) : asset('images/blank_image.png') }}" alt="{{ $creator->name }}" class="profile-image">
                <div class="profile-info">
                    <div class="d-flex align-items-center gap-3 mb-2 flex-wrap">
                        <h1 class="mb-0">{{ $creator->name }}</h1>
                    </div>
                    <div class="mb-3">
                        @foreach($creator->designations as $designation)
                            <span class="designation-badge">{{ $designation->name }}</span>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="meta-grid">
                <div class="meta-item">
                    <div class="meta-label">Local Congregation</div>
                    <div class="meta-value">{{ $creator->local ?: 'N/A' }}</div>
                </div>
                <div class="meta-item">
                    <div class="meta-label">Ecclesiastical District</div>
                    <div class="meta-value">{{ $creator->district ?: 'N/A' }}</div>
                </div>
                <div class="meta-item">
                    <div class="meta-label">Current Duty</div>
                    <div class="meta-value">{{ $creator->duty ?: 'Contributor' }}</div>
                </div>
                <div class="meta-item">
                    <div class="meta-label">Birth Month/Year</div>
                    <div class="meta-value">
                        {{ $creator->birthday && $creator->birthday !== '0000-00-00 00:00:00' 
                            ? \Carbon\Carbon::parse($creator->birthday)->format('F Y') 
                            : 'Unknown' }}
                    </div>
                </div>
            </div>

            <div class="mb-5">
                <h3 class="section-title"><i class="fas fa-scroll"></i> Music Background</h3>
                <div class="background-box">
                    "{{ $creator->music_background ?: 'No background information provided for this music creator.' }}"
                </div>
            </div>

            <!-- Contributions Section -->
            @php
                $allMusics = $creator->lyricistMusics->merge($creator->composerMusics)->merge($creator->arrangerMusics)->unique('id');
            @endphp

            @if($allMusics->count() > 0)
                <div>
                    <h3 class="section-title"><i class="fas fa-music"></i> Notable Contributions ({{ $allMusics->count() }})</h3>
                    <div class="hymn-list">
                        @foreach($allMusics as $music)
                            <a href="{{ route('musics.show', $music->id) }}" class="hymn-item">
                                <span class="hymn-title">{{ $music->title }}</span>
                                <span class="hymn-number">#{{ $music->song_number }}</span>
                            </a>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
