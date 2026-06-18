<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Playlist;
use App\Models\Music;
use Illuminate\Support\Facades\DB;

class PlaylistController extends Controller
{
    private function nextPlaylistPosition(int $playlistId): int
    {
        $maxPosition = DB::table('music_playlist')
            ->where('playlist_id', $playlistId)
            ->max('position');

        return ((int) $maxPosition) + 1;
    }

    public function store(Request $request)
    {
        $playlist = Playlist::create([
            'name' => $request->name,
        ]);

        if ($request->music_id) {
            $playlist->musics()->attach($request->music_id, [
                'position' => $this->nextPlaylistPosition($playlist->id),
            ]);
        }

        if ($request->input('source') === 'dashboard') {
            return redirect()->route('dashboard')->with('success', 'Playlist created successfully');
        }

        return redirect()->route('playlists_management.index')->with('success', 'Playlist created successfully');
    }

    public function update(Request $request, $id)
    {
        //dd($request);
        $playlist = Playlist::findOrFail($id);
        $playlist->update(['name' => $request->name]);
       // return response()->json(['success' => true, 'playlist' => $playlist]);
        
       return redirect()->route('playlists_management.index')->with('success', 'Playlist updated successfully');
    }

    public function destroy($id)
    {
        
        $playlist = Playlist::findOrFail($id);
        $playlist->delete();
        return redirect()->route('playlists_management.index')->with('success', 'Playlist deleted successfully');
    }

    public function index(Request $request)
    {
        $search = trim((string) $request->input('search', ''));

        $playlists = Playlist::query()
            ->with('musics')
            ->when($search !== '', function ($query) use ($search) {
                $query->where('name', 'like', "%{$search}%");
            })
            ->orderBy('name')
            ->paginate(10)
            ->withQueryString();

        return view('playlists_management.index', compact('playlists'));
    }

    // public function getMusicList($playlistId)
    // {
    //     //dd($playlistId);
    //     $playlists = Playlist::with('musics')
        
    //     ->when($playlistId, function ($query, $playlistId) {
    //         return $query->where('id', $playlistId);
    //     })
    //     ->get();
    // return response()->json(['playlists' => $playlists]);
    // }

    public function getMusicList($playlistId)
    {
        $musics = DB::table('music_playlist')
                    ->join('musics', 'music_playlist.music_id', '=', 'musics.id')
                    ->where('music_playlist.playlist_id', $playlistId)
                    ->orderByRaw('COALESCE(music_playlist.position, music_playlist.id) ASC')
                    ->select('musics.id', 'musics.title', 'musics.song_number', 'music_playlist.position')
                    ->get()
                    ->map(function($music) use ($playlistId) { // Add use ($playlistId) here
                        return [
                            'id' => $music->id,
                            'title' => $music->title,
                            'song_number' => $music->song_number,
                            'position' => $music->position,
                            'delete_url' => route('playlist.removeMusic', [$playlistId, $music->id])
                        ];
                    });
    
        return response()->json($musics);
    }

    
    public function removeMusicFromPlaylist(Request $request, $playlistId, $musicId)
    {
        
        DB::table('music_playlist')
            ->where('playlist_id', $playlistId)
            ->where('music_id', $musicId)
            ->delete();
    
        return response()->json(['success' => true]);
    }

    public function showPlaylist(Request $request)
    {
        $playlistId = $request->query('playlist_id');

        $playlists = Playlist::with('musics')
            ->when($playlistId, function ($query, $playlistId) {
                return $query->where('id', $playlistId);
            })
            ->get();

        return response()->json(['playlists' => $playlists]);
    }

public function validateMusicPlaylist(Request $request, $playlistId, $musicId)
{
    $exists = DB::table('music_playlist')
                ->where('music_id', $musicId)
                ->where('playlist_id', $playlistId)
                ->exists();

    return response()->json(['exists' => $exists]);
}

    public function addMusicToPlaylist(Request $request, $playlistId)
    {
        $musicId = $request->input('music_id');

        // Check if the entry already exists
        $exists = DB::table('music_playlist')
                    ->where('music_id', $musicId)
                    ->where('playlist_id', $playlistId)
                    ->exists();

        if ($exists) {
            return response()->json(['success' => false, 'message' => 'Hymn already added to playlist']);
        }

        // Add music to playlist
        DB::table('music_playlist')->insert([
            'music_id' => $musicId,
            'playlist_id' => $playlistId,
            'position' => $this->nextPlaylistPosition((int) $playlistId),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return response()->json(['success' => true]);
    }


   public function updateOrder(Request $request)
    {
        $validated = $request->validate([
            'playlist_id' => ['required', 'integer', 'exists:playlists,id'],
            'order' => ['required', 'array'],
            'order.*' => ['integer', 'exists:musics,id'],
        ]);

        $playlistId = (int) $validated['playlist_id'];
        $order = $validated['order'];

        foreach ($order as $position => $musicId) {
            DB::table('music_playlist')
                ->where('playlist_id', $playlistId)
                ->where('music_id', $musicId)
                ->update([
                    'position' => $position + 1,
                    'updated_at' => now(),
                ]);
        }

        return response()->json(['success' => true]);
    }

    public function addMusic(Request $request, Playlist $playlist)
    {
        $playlist->musics()->attach($request->music_id, [
            'position' => $this->nextPlaylistPosition($playlist->id),
        ]);
        return response()->json(['success' => true]);
    }

    public function create(Request $request)
{
    $playlistName = $request->input('name');
    $musicId = $request->input('music_id');

    // Create a new playlist
    $playlist = new Playlist();
    $playlist->name = $playlistName;
    $playlist->save();

    // Add the music to the playlist
    if ($musicId) {
        $playlist->musics()->attach($musicId, [
            'position' => $this->nextPlaylistPosition($playlist->id),
        ]);
    }

    return response()->json(['success' => true, 'essage' => 'Music added to new playlist']);
}
}
