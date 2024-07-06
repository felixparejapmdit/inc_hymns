<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Playlist;
use App\Models\Music;

class PlaylistController extends Controller
{
    public function store(Request $request)
    {
        $playlist = Playlist::create([
            'name' => $request->name,
        ]);

        if ($request->music_id) {
            $playlist->musics()->attach($request->music_id);
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

    public function index()
    {
        // $playlists = Playlist::with('musics')->get(); // Include the musics relation if needed
        // return response()->json(['playlists' => $playlists]);

        $playlists = Playlist::with('musics')->get();
        return view('playlists_management.index', compact('playlists'));
    }

    public function getMusicList($playlistId)
    {
     
        dd($playlistId);
        $playlists = Playlist::with('musics')
        
        ->when($playlistId, function ($query, $playlistId) {
            return $query->where('id', $playlistId);
        })
        ->get();
        
    return response()->json(['playlists' => $playlists]);
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


   public function updateOrder(Request $request)
    {
        $playlistId = $request->playlist_id;
        $order = $request->order;

        foreach ($order as $position => $musicId) {
            $playlist = Playlist::find($playlistId);
            $playlist->musics()->updateExistingPivot($musicId, ['position' => $position]);
        }

        return response()->json(['success' => true]);
    }

    public function addMusic(Request $request, Playlist $playlist)
    {
        $playlist->musics()->attach($request->music_id);
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
    $playlist->musics()->attach($musicId);

    return response()->json(['success' => true, 'essage' => 'Music added to new playlist']);
}
}
