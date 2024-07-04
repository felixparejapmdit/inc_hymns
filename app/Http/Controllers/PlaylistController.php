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

        return response()->json(['success' => true, 'playlist' => $playlist]);
    }

    public function index()
    {
        $playlists = Playlist::all();
        return response()->json(['playlists' => $playlists]);
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
