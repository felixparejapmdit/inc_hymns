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

</style>

<x-app-layout>
    <div class="glass-container">
        <div class="container" style="max-width: 1000px;">
            <div class="d-flex justify-content-between align-items-center mb-5 mt-2">
                <div>
                    <h1 class="font-black text-4xl text-white tracking-tighter mb-0 uppercase">Playlist Management</h1>
                    <p class="text-white opacity-80 font-bold uppercase tracking-wider small mt-1">Curate & Organize Hymn Collections</p>
                </div>
                <div class="d-flex gap-3">
                    <a href="{{ route('admin.settings') }}" class="btn btn-light rounded-pill px-4 font-bold shadow-sm">
                        <i class="fas fa-arrow-left mr-2"></i> Settings
                    </a>
                    @if (\App\Helpers\AccessRightsHelper::checkPermission('dashboard.playlist.add') == 'inline')
                        <button id="addPlaylistButton" class="btn-create">
                            <i class="fas fa-plus-circle"></i> New Playlist
                        </button>
                    @endif
                </div>
            </div>

            <div class="dashboard-card">
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
                            @if(!empty($playlists) && count($playlists) > 0)
                                @foreach($playlists as $key => $playlist)
                                    <tr>
                                        <td class="text-center font-bold text-muted" style="font-size: 0.85rem;">{{ $key + 1 }}</td>
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
                                                <table class="table-inner">
                                                    <thead>
                                                        <tr>
                                                            <th style="width: 10%;">#</th>
                                                            <th style="width: 50%;">Hymn Title</th>
                                                            <th style="width: 20%;">Number</th>
                                                            <th style="width: 20%; text-align: center;">Actions</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="music-list-{{ $playlist->id }}"></tbody>
                                                </table>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td class="text-center p-5" colspan="3">
                                        <div class="text-slate-400 font-bold">No playlists found.</div>
                                    </td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
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
                        $.each(data, function(index, music) {
                            musicList.append(
                                '<tr>' +
                                    '<td style="text-align: center;">' + (index + 1) + '</td>' +
                                    '<td class="font-bold text-slate-700">' + music.title + '</td>' +
                                    '<td class="font-black text-slate-500">' + (music.hymn_number || music.song_number || '-') + '</td>' +
                                    '<td style="text-align: center;">' +
                                        '<form id="deleteForm' + music.id + '" method="POST" action="' + music.delete_url + '" style="display:inline;">' +
                                            '@csrf' +
                                            '@method("DELETE")' +
                                            '<input type="hidden" name="playlist_id" value="' + playlistId + '">' +
                                            '<input type="hidden" name="music_id" value="' + music.id + '">' +
                                            '<button type="button" onclick="confirmDelete(' + playlistId + ', ' + music.id + ')" class="btn btn-link py-0 text-danger">' +
                                                '<i class="fas fa-trash-alt"></i>' +
                                            '</button>' +
                                        '</form>' +
                                    '</td>' +
                                '</tr>'
                            );
                        });
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
    });

    function confirmDelete(playlistId, musicId) {
        if (confirm('Are you sure you want to remove this hymn from the playlist?')) {
            var form = document.getElementById('deleteForm' + musicId);
            var formData = new FormData(form);
            formData.append('playlist_id', playlistId);
            formData.append('music_id', musicId);

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
