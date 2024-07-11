<!-- resources/views/permissions/index.blade.php -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
<!-- Include Bootstrap CSS -->
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

<!-- Include jQuery before Bootstrap -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<!-- resources/views/playlist_management/index.blade.php -->
<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center my-8">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Playlist Management') }}
            </h2>
            <div>
                <a href="{{ route('admin.settings') }}" class="btn btn-secondary">Back</a>
                 <button id="addPlaylistButton"  class="btn btn-primary ml-1" data-toggle="modal" data-target="#addHymnModal">
                    <i class="fas fa-plus"></i> Playlist
                </button>
            </div>
        </div>
    </x-slot>

    <div class="py-12 mt-3">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    @if(session('success'))
                        <div class="alert alert-success mt-3">
                            {{ session('success') }}
                        </div>
                    @endif

                    <table class="table">
                        <thead>
                            <tr>
                                <th style="width: 10%;">#</th>
                                <th style="width: 60%;">Name</th>
                                <th style="width: 20%;">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(!empty($playlists) && count($playlists) > 0)
                                @foreach($playlists as $key => $playlist)
                                    <tr>
                                        <td style="width: 10%;">{{ $key + 1 }}</td>
                                        <td style="width: 60%">
                                            <a href="#" class="playlist-name" data-url="{{ route('getMusicList', ['playlistId' => $playlist->id]) }}" data-id="{{ $playlist->id }}">{{ $playlist->name }}</a>
                                        </td>
                                        <td style="width: 20%;">
                                            <button class="btn btn-secondary editPlaylistButton" 
                                                    data-toggle="modal"
                                                    data-target="#editPlaylistModal{{ $playlist->id }}">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <button class="btn btn-secondary deletePlaylistButton" data-id="{{ $playlist->id }}">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    <tr class="music-list" style="display: none;">
                                        <td colspan="3">
                                            <table class="table table-bordered mt-3">
                                                <thead>
                                                    <tr>
                                                        <th style="width: 10%;">#</th>
                                                        <th style="width: 50%;">Title</th>
                                                        <th style="width: 20%;">Hymn Number</th>
                                                        <th style="width: 20%;">Actions</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="music-list-{{ $playlist->id }}"></tbody>
                                            </table>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td class="text-center" colspan="3">No playlists found.</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>

                    <!-- Add Playlist Modal -->
                    <div class="modal" id="addPlaylistModal" tabindex="-1" role="dialog">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Add Playlist</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ route('playlists_management.store') }}" method="POST">
                                        @csrf
                                        <div class="form-group">
                                            <label for="playlistName">Name</label>
                                            <input type="text" class="form-control" id="playlistName" name="name" required>
                                        </div>
                                        <button type="submit" class="btn btn-primary">Add</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Edit Playlist Modal -->
                    @foreach($playlists as $playlist)
                        <div class="modal" id="editPlaylistModal{{ $playlist->id }}" tabindex="-1" role="dialog">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Edit Playlist</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{ route('playlists_management.update', $playlist->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <input type="hidden" id="editPlaylistId" name="id" value="{{ $playlist->id }}">
                                            <div class="form-group">
                                                <label for="editPlaylistName">Name</label>
                                                <input type="text" class="form-control" name="name" id="edit_name_{{ $playlist->id }}" value="{{ old('name', $playlist->name) }}"  required>
                                            </div>
                                            <button type="submit" class="btn btn-primary">Save Changes</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Delete Playlist Confirmation -->
                        <div class="modal" id="deletePlaylistModal{{ $playlist->id }}" tabindex="-1" role="dialog">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Delete Playlist</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <p>Are you sure you want to delete this playlist?</p>
                                        <form action="{{ route('playlists_management.destroy', $playlist->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">Delete</button>
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach

                </div>
            </div>
        </div>
    </div>
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
            $('#deletePlaylistId').val(playlistId);
        });

        $('.playlist-name').click(function(event) {
            event.preventDefault();
            var playlistId = $(this).data('id');
            var musicList = $('#music-list-' + playlistId);
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
                                    '<td>' + (index + 1) + '</td>' +
                                    '<td>' + music.title + '</td>' +
                                    '<td>' + (music.hymn_number || music.song_number || '-') + '</td>' +
                                    '<td>' +
                                    '<form id="deleteForm' + music.id + '" method="POST" action="' + music.delete_url + '" style="display:inline;">' +
                                '@csrf' +
                                '@method("DELETE")' +
                                '<input type="hidden" name="playlist_id" value="' + playlistId + '">' +
                                '<input type="hidden" name="music_id" value="' + music.id + '">' +
                                '<button type="button" onclick="confirmDelete(' + playlistId + ', ' + music.id + ')" class="btn btn-secondary">' +
                                    '<i class="fas fa-trash"></i>' +
                                '</button>' +
                            '</form>' +
                                    '</td>' +
                                '</tr>'
                            );
                        });
                        musicList.closest('tr.music-list').slideDown();

           
                    },
                    error: function(xhr, status, error) {
                        console.log('Error:', error);
                    }
                });
            } else {
                musicList.closest('tr.music-list').slideToggle();
            }
        });
    });

    function confirmDelete(playlistId, musicId) {
    if (confirm('Are you sure you want to delete this music?')) {
        var form = document.getElementById('deleteForm' + musicId);
        var formData = new FormData(form);
        formData.append('playlist_id', playlistId);
        formData.append('music_id', musicId);

        var xhr = new XMLHttpRequest();
        xhr.open('POST', form.action, true);
        xhr.onload = function() {
            if (xhr.status === 200) {
                console.log('Music deleted successfully!');
            }
        };
        xhr.send(formData);
    }
}
</script>
