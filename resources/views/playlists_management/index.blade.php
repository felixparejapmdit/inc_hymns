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
    }

    body {
        background: var(--primary-gradient) !important;
        background-attachment: fixed !important;
        min-height: 100vh;
        font-family: 'Outfit', sans-serif;
    }

    .glass-container {
        padding: 20px 0;
    }

    .dashboard-card {
        background: var(--card-bg);
        border-radius: 30px;
        border: 1px solid rgba(255, 255, 255, 0.4);
        box-shadow: 0 15px 45px rgba(0, 0, 0, 0.1);
        padding: 2.5rem;
        position: relative;
    }

    .table-modern {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0 10px;
    }

    .table-modern th {
        padding: 1.2rem;
        font-size: 0.8rem;
        text-transform: uppercase;
        color: #64748b;
        font-weight: 800;
        letter-spacing: 1px;
        border: none;
    }

    .table-modern td {
        padding: 1.2rem;
        background: white;
        border: none;
        vertical-align: middle;
        font-size: 1rem;
        color: #1e293b;
        font-weight: 700;
    }

    .table-modern tr td:first-child { border-radius: 15px 0 0 15px; }
    .table-modern tr td:last-child { border-radius: 0 15px 15px 0; }

    .table-modern tr:hover td {
        background: #f1f7ff;
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(0,0,0,0.03);
    }

    .btn-create {
        background: white;
        color: var(--accent-blue);
        border-radius: 50px;
        padding: 12px 25px;
        font-weight: 950;
        text-transform: uppercase;
        letter-spacing: 1px;
        border: none;
        transition: all 0.3s;
        display: flex;
        align-items: center;
        gap: 10px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    }

    .btn-create:hover {
        background: var(--accent-gold);
        color: #1e293b;
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(255, 215, 0, 0.3);
    }

    .btn-icon {
        width: 42px;
        height: 42px;
        border-radius: 12px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        background: #f8fafc;
        color: #64748b;
        border: 1px solid #e2e8f0;
        transition: all 0.2s;
        margin-left: 5px;
        cursor: pointer;
    }

    .btn-icon:hover {
        background: var(--accent-blue);
        color: white;
        border-color: var(--accent-blue);
        transform: scale(1.1);
    }

    .btn-delete:hover {
        background: #ef4444;
        border-color: #ef4444;
    }

    /* Inner Table Styling */
    .inner-table-container {
        padding: 1rem 2rem;
        background: rgba(241, 245, 249, 0.5);
        border-radius: 20px;
        margin-top: -10px;
        margin-bottom: 10px;
    }

    .table-inner {
        width: 100%;
        background: transparent;
    }

    .table-inner th {
        font-size: 0.75rem;
        text-transform: uppercase;
        color: #94a3b8;
        font-weight: 800;
        border-bottom: 2px solid #e2e8f0;
        padding-bottom: 10px;
    }

    .table-inner td {
        background: transparent !important;
        border: none !important;
        padding: 12px 0;
        font-size: 0.9rem;
        color: #475569;
        font-weight: 600;
        border-bottom: 1px solid #f1f5f9 !important;
    }

    /* Modal Styling */
    .modal-content {
        border-radius: 30px;
        border: none;
        box-shadow: 0 25px 50px rgba(0,0,0,0.2);
    }

    .modal-header {
        border-bottom: 1px solid #f1f5f9;
        padding: 2rem;
    }

    .modal-title {
        font-weight: 900;
        text-transform: uppercase;
        letter-spacing: -0.5px;
        color: #1e293b;
    }

    .rounded-pill-custom {
        border-radius: 50px !important;
        padding: 12px 20px !important;
        border: 2px solid #e2e8f0 !important;
        font-weight: 600;
    }

    .rounded-pill-custom:focus {
        border-color: var(--accent-blue) !important;
        box-shadow: 0 0 0 4px rgba(62, 109, 156, 0.1) !important;
    }

    .playlist-name {
        text-decoration: none !important;
        color: #1e293b;
        transition: color 0.2s;
    }

    .playlist-name:hover {
        color: var(--accent-blue);
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
        transition: transform 0.2s ease, box-shadow 0.2s ease, background 0.2s ease, color 0.2s ease;
        text-decoration: none !important;
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
        color: var(--accent-blue);
        border: 1px solid rgba(255, 255, 255, 0.7);
        box-shadow: 0 14px 30px rgba(0, 0, 0, 0.1);
    }

    .page-action-btn-primary:hover {
        color: #22486c;
        background: #f8fbff;
    }

    .search-card {
        padding: 1.2rem 1.35rem !important;
        margin-bottom: 1.35rem;
    }

    .search-shell {
        display: flex;
        align-items: stretch;
        width: 100%;
        min-height: 52px;
        border-radius: 18px;
        overflow: hidden;
        background: rgba(255, 255, 255, 0.9);
        border: 1px solid rgba(62, 109, 156, 0.12);
        box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.75);
    }

    .search-shell-icon {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 54px;
        color: #7c8aa0;
        flex: 0 0 54px;
        border-right: 1px solid rgba(148, 163, 184, 0.18);
    }

    .search-shell-input {
        flex: 1;
        border: none !important;
        box-shadow: none !important;
        background: transparent !important;
        height: 52px;
        padding: 0 1rem;
        font-weight: 700;
        color: #17324f;
    }

    .search-shell-input::placeholder {
        color: #8aa0b8;
        font-weight: 600;
    }

    .search-shell-button {
        min-width: 132px;
        padding: 0 1.1rem;
        border: none;
        background: var(--accent-blue);
        color: #fff;
        font-weight: 900;
        letter-spacing: 0.03em;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
        transition: background 0.2s ease, transform 0.2s ease;
        border-left: 1px solid rgba(255, 255, 255, 0.18);
    }

    .search-shell-button:hover {
        background: #2f5780;
        transform: translateY(-1px);
    }

    .playlist-list-card {
        overflow: hidden;
    }

    .playlist-hint {
        font-size: 0.82rem;
        color: #64748b;
        font-weight: 600;
    }

    .drag-handle {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 34px;
        height: 34px;
        border-radius: 10px;
        background: #f8fafc;
        color: #94a3b8;
        border: 1px solid #e2e8f0;
        cursor: grab;
    }

    .drag-handle:active {
        cursor: grabbing;
    }

    .sortable-row {
        user-select: none;
    }

    .sortable-row.dragging td {
        opacity: 0.55;
        background: #eef6ff;
    }

    .sortable-row.drop-before td {
        border-top: 2px solid var(--accent-blue);
    }

    .sortable-row.drop-after td {
        border-bottom: 2px solid var(--accent-blue);
    }

    .playlist-inner-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 1rem;
        flex-wrap: wrap;
        margin-bottom: 1rem;
    }

    .playlist-inner-title {
        font-size: 0.9rem;
        font-weight: 900;
        letter-spacing: 0.12em;
        text-transform: uppercase;
        color: #3e4b61;
        margin: 0;
    }

    .playlist-inner-save {
        min-height: 40px;
        border-radius: 999px;
        border: none;
        background: var(--accent-blue);
        color: white;
        font-weight: 900;
        letter-spacing: 0.04em;
        padding: 0 1rem;
        box-shadow: 0 12px 24px rgba(62, 109, 156, 0.18);
    }

    .playlist-inner-save:disabled {
        opacity: 0.65;
        cursor: not-allowed;
    }

    .playlist-inner-save:hover:not(:disabled) {
        background: #2f5780;
    }

    .inner-table-container {
        padding: 1rem 1.25rem;
        background: rgba(241, 245, 249, 0.5);
        border-radius: 20px;
        margin-top: -10px;
        margin-bottom: 10px;
    }

    .table-inner {
        width: 100%;
        background: transparent;
    }

    .table-inner th {
        font-size: 0.75rem;
        text-transform: uppercase;
        color: #94a3b8;
        font-weight: 800;
        border-bottom: 2px solid #e2e8f0;
        padding-bottom: 10px;
    }

    .table-inner td {
        background: transparent !important;
        border: none !important;
        padding: 12px 0;
        font-size: 0.9rem;
        color: #475569;
        font-weight: 600;
        border-bottom: 1px solid #f1f5f9 !important;
    }

</style>

<x-app-layout>
    <div class="glass-container">
        <div class="container-fluid px-5 px-xl-5 page-shell">
            @php
                $playlistSearch = request('search');
            @endphp

            <div class="page-header-shell">
                <div>
                    <div class="page-kicker">
                        <i class="fas fa-list-ul"></i>
                        Playlist Library
                    </div>
                    <h1 class="page-title">Playlist Management</h1>
                    <p class="page-subtitle">Curate and organize hymn collections with search, pagination, and drag-sort ordering.</p>
                </div>
                <div class="toolbar-stack">
                    <a href="{{ route('admin.settings') }}" class="page-action-btn page-action-btn-secondary">
                        <i class="fas fa-arrow-left"></i>
                        <span>Settings</span>
                    </a>
                    @if (\App\Helpers\AccessRightsHelper::checkPermission('dashboard.playlist.add') == 'inline')
                        <button id="addPlaylistButton" class="page-action-btn page-action-btn-primary" type="button">
                            <i class="fas fa-plus-circle"></i>
                            <span>New Playlist</span>
                        </button>
                    @endif
                </div>
            </div>

            <div class="dashboard-card search-card">
                <form method="GET" action="{{ route('playlists_management.index') }}">
                    <div class="search-shell">
                        <span class="search-shell-icon">
                            <i class="fas fa-search"></i>
                        </span>
                        <input
                            type="text"
                            name="search"
                            value="{{ $playlistSearch }}"
                            class="form-control search-shell-input"
                            placeholder="Search playlist names..."
                            autocomplete="off"
                        >
                        <button type="submit" class="search-shell-button">
                            <i class="fas fa-search"></i>
                            <span>Search</span>
                        </button>
                    </div>
                </form>
            </div>

            <div class="dashboard-card playlist-list-card">
                @if(session('success'))
                    <div class="alert alert-success rounded-xl font-bold mb-4 border-none shadow-sm">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="table-responsive">
                    <table class="table-modern">
                        <thead>
                            <tr>
                                <th style="width: 10%;" class="text-center">#</th>
                                <th style="width: 70%;">Playlist Name</th>
                                <th style="width: 20%;" class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($playlists as $key => $playlist)
                                    <tr>
                                        <td class="text-center font-bold text-muted" style="font-size: 0.85rem;">{{ ($playlists->currentPage() - 1) * $playlists->perPage() + $loop->iteration }}</td>
                                        <td>
                                            <a href="#" class="playlist-name font-black tracking-tight" data-url="{{ route('getMusicList', ['playlistId' => $playlist->id]) }}" data-id="{{ $playlist->id }}">
                                                <i class="fas fa-list-ul mr-2 text-slate-400"></i> {{ $playlist->name }}
                                            </a>
                                        </td>
                                        <td class="text-center">
                                            <div class="d-flex justify-content-center">
                                                <button class="btn-icon editPlaylistButton shadow-sm" data-id="{{ $playlist->id }}">
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                                <button class="btn-icon btn-delete deletePlaylistButton shadow-sm" data-id="{{ $playlist->id }}">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr class="music-list-row" id="music-row-{{ $playlist->id }}" style="display: none;">
                                        <td colspan="3">
                                            <div class="inner-table-container shadow-inner">
                                                <div class="playlist-inner-header">
                                                    <div>
                                                        <p class="playlist-inner-title mb-1">{{ $playlist->name }} hymns</p>
                                                        <div class="playlist-hint">
                                                            Drag the rows to change the sequence. The order saves automatically.
                                                        </div>
                                                    </div>
                                                    <button type="button" class="playlist-inner-save" data-save-order="{{ $playlist->id }}">
                                                        <i class="fas fa-save mr-2"></i> Save Order
                                                    </button>
                                                </div>
                                                <table class="table-inner">
                                                    <thead>
                                                        <tr>
                                                            <th style="width: 10%;">#</th>
                                                            <th style="width: 8%;"></th>
                                                            <th style="width: 42%;">Hymn Title</th>
                                                            <th style="width: 20%;">Number</th>
                                                            <th style="width: 20%; text-align: center;">Actions</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="music-list-{{ $playlist->id }}" class="playlist-sorting-list" data-playlist-id="{{ $playlist->id }}"></tbody>
                                                </table>
                                            </div>
                                        </td>
                                    </tr>
                            @empty
                                <tr>
                                    <td class="text-center p-5" colspan="3">
                                        <div class="text-slate-400 font-bold">No playlists found.</div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="mt-5 d-flex justify-content-center pagination-centered">
                    {{ $playlists->withQueryString()->links() }}
                </div>
            </div>
        </div>
    </div>

    <!-- Modals -->
    <!-- Add Playlist Modal -->
    <div class="modal fade" id="addPlaylistModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">New Playlist</h5>
                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                </div>
                <div class="modal-body p-4">
                    <form action="{{ route('playlists_management.store') }}" method="POST">
                        @csrf
                        <div class="form-group mb-4">
                            <label class="font-bold small uppercase text-slate-500 mb-2">Playlist Name</label>
                            <input type="text" class="form-control rounded-pill-custom" name="name" required placeholder="e.g. Choir Favorites">
                        </div>
                        <div class="text-right">
                            <button type="submit" class="btn btn-primary rounded-pill px-5 font-black uppercase shadow-lg">Create Playlist</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @foreach($playlists as $playlist)
        <!-- Edit Modal -->
        <div class="modal fade" id="editPlaylistModal{{ $playlist->id }}" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Playlist</h5>
                        <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                    </div>
                    <div class="modal-body p-4">
                        <form action="{{ route('playlists_management.update', $playlist->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="form-group mb-4">
                                <label class="font-bold small uppercase text-slate-500 mb-2">Playlist Name</label>
                                <input type="text" class="form-control rounded-pill-custom" name="name" value="{{ old('name', $playlist->name) }}" required>
                            </div>
                            <div class="text-right">
                                <button type="submit" class="btn btn-primary rounded-pill px-5 font-black uppercase shadow-lg">Save Changes</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Delete Modal -->
        <div class="modal fade" id="deletePlaylistModal{{ $playlist->id }}" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="p-5 text-center">
                        <i class="fas fa-exclamation-circle text-danger mb-4" style="font-size: 4rem;"></i>
                        <h3 class="font-black uppercase text-slate-800">Are you sure?</h3>
                        <p class="text-muted font-bold">Delete <b>{{ $playlist->name }}</b>? All hymns will stay but the playlist is gone.</p>
                        <div class="d-flex justify-content-center gap-3 mt-5">
                            <form action="{{ route('playlists_management.destroy', $playlist->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger rounded-pill px-5 font-black uppercase shadow-lg">Delete</button>
                            </form>
                            <button type="button" class="btn btn-light rounded-pill px-5 font-black uppercase border" data-dismiss="modal">Cancel</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

</x-app-layout>

<script>
    $(document).ready(function() {
        const updateOrderUrl = @json(route('playlists.updateOrder'));
        const csrfToken = $('meta[name="csrf-token"]').attr('content') || @json(csrf_token());
        let draggingRow = null;

        function escapeHtml(value) {
            return String(value ?? '')
                .replace(/&/g, '&amp;')
                .replace(/</g, '&lt;')
                .replace(/>/g, '&gt;')
                .replace(/"/g, '&quot;')
                .replace(/'/g, '&#039;');
        }

        function getMusicOrder($list) {
            return $list.find('tr.sortable-row').map(function() {
                return $(this).data('music-id');
            }).get();
        }

        function renumberRows($list) {
            $list.find('tr.sortable-row').each(function(index) {
                $(this).find('.music-order').text(index + 1);
            });
        }

        function saveOrder(playlistId, $list) {
            const order = getMusicOrder($list);

            if (!playlistId || order.length === 0) {
                return;
            }

            $.ajax({
                type: 'POST',
                url: updateOrderUrl,
                data: {
                    playlist_id: playlistId,
                    order: order,
                    _token: csrfToken
                },
                success: function() {
                    renumberRows($list);
                },
                error: function(xhr) {
                    console.error('Unable to save playlist order', xhr.responseText || xhr.statusText);
                }
            });
        }

        function getDragAfterElement(container, y) {
            const draggableElements = [...container.querySelectorAll('tr.sortable-row:not(.dragging)')];

            return draggableElements.reduce((closest, child) => {
                const box = child.getBoundingClientRect();
                const offset = y - box.top - box.height / 2;

                if (offset < 0 && offset > closest.offset) {
                    return { offset: offset, element: child };
                }

                return closest;
            }, { offset: Number.NEGATIVE_INFINITY, element: null }).element;
        }

        function bindSortable($list) {
            const listElement = $list.get(0);
            if (!listElement || listElement.dataset.sortableReady === 'true') {
                return;
            }

            listElement.dataset.sortableReady = 'true';

            $list.on('dragstart', 'tr.sortable-row', function(e) {
                draggingRow = this;
                $(this).addClass('dragging');
                if (e.originalEvent && e.originalEvent.dataTransfer) {
                    e.originalEvent.dataTransfer.setData('text/plain', String($(this).data('music-id')));
                    e.originalEvent.dataTransfer.effectAllowed = 'move';
                }
            });

            $list.on('dragend', 'tr.sortable-row', function() {
                $(this).removeClass('dragging');
                draggingRow = null;
                renumberRows($list);
                saveOrder($list.data('playlist-id'), $list);
            });

            $list.on('dragover', function(e) {
                if (!draggingRow) {
                    return;
                }

                e.preventDefault();
                const afterElement = getDragAfterElement(listElement, e.originalEvent.clientY);

                if (afterElement == null) {
                    listElement.appendChild(draggingRow);
                } else {
                    listElement.insertBefore(draggingRow, afterElement);
                }

                renumberRows($list);
            });
        }

        function buildMusicRow(music, index, playlistId) {
            return `
                <tr class="sortable-row" draggable="true" data-music-id="${music.id}">
                    <td class="text-center font-bold text-muted music-order" style="font-size: 0.85rem;">${index + 1}</td>
                    <td class="text-center">
                        <span class="drag-handle" title="Drag to reorder">
                            <i class="fas fa-grip-vertical"></i>
                        </span>
                    </td>
                    <td class="font-bold text-slate-700">${escapeHtml(music.title)}</td>
                    <td class="font-black text-slate-500">${escapeHtml(music.song_number || '-')}</td>
                    <td style="text-align: center;">
                        <form id="deleteForm${music.id}" method="POST" action="${music.delete_url}" style="display:inline;">
                            @csrf
                            @method("DELETE")
                            <input type="hidden" name="playlist_id" value="${playlistId}">
                            <input type="hidden" name="music_id" value="${music.id}">
                            <button type="button" onclick="confirmDelete(${playlistId}, ${music.id})" class="btn btn-link py-0 text-danger">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        </form>
                    </td>
                </tr>
            `;
        }

        $('#addPlaylistButton').click(function() {
            $('#addPlaylistModal').modal('show');
        });

        $('.editPlaylistButton').click(function() {
            var playlistId = $(this).data('id');
            $('#editPlaylistModal' + playlistId).modal('show');
        });

        $('.deletePlaylistButton').click(function() {
            var playlistId = $(this).data('id');
            $('#deletePlaylistModal' + playlistId).modal('show');
        });

        $('.playlist-name').click(function(event) {
            event.preventDefault();
            var playlistId = $(this).data('id');
            var musicList = $('#music-list-' + playlistId);
            var musicRow = $('#music-row-' + playlistId);
            var url = $(this).data('url');

            if (musicList.children().length === 0) {
                $.ajax({
                    type: 'GET',
                    url: url,
                    success: function(data) {
                        musicList.empty();

                        if (!data || data.length === 0) {
                            musicList.append(
                                '<tr><td colspan="5" class="text-center py-4 text-slate-400 font-bold">No hymns in this playlist yet.</td></tr>'
                            );
                        } else {
                            $.each(data, function(index, music) {
                                musicList.append(buildMusicRow(music, index, playlistId));
                            });
                            bindSortable(musicList);
                            renumberRows(musicList);
                        }

                        musicRow.slideDown();
                    },
                    error: function(xhr, status, error) {
                        console.log('Error:', error);
                    }
                });
            } else {
                musicRow.slideToggle();
            }
        });

        $(document).on('click', '[data-save-order]', function() {
            const playlistId = $(this).data('save-order');
            const $list = $('#music-list-' + playlistId);
            saveOrder(playlistId, $list);
        });
    });

    function confirmDelete(playlistId, musicId) {
        if (confirm('Are you sure you want to remove this hymn from the playlist?')) {
            var form = document.getElementById('deleteForm' + musicId);
            var formData = new FormData(form);

            var xhr = new XMLHttpRequest();
            xhr.open('POST', form.action, true);
            xhr.onload = function() {
                if (xhr.status === 200) {
                    location.reload();
                }
            };
            xhr.send(formData);
        }
    }
</script>
