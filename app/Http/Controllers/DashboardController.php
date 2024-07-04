<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ChurchHymn;
use App\Models\MusicLyricist;
use App\Models\MusicComposer;
use App\Models\MusicArranger;
use App\Models\Category;
use App\Models\MusicCategory; // Adjusted import
use App\Models\Instrumentation;
use App\Models\EnsembleType;
use App\Models\MusicCreator;
use App\Models\ActivityLog;
use App\Models\User;
use App\Models\Language;
use App\Models\Playlist;
use Illuminate\Support\Facades\DB;


class DashboardController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
{
    // Fetch data for display on the dashboard
    $totalLyricists = MusicLyricist::count();
    $totalComposers = MusicComposer::count();
    $totalArrangers = MusicArranger::count();
    
    $totalChurchHymns = ChurchHymn::withCount('musics')->get();
    $totalUsers = User::count(); // Assuming User is your model for users

    // Fetch recent activities
    //$recentActivities = ActivityLog::latest()->take(10)->get();

    // Fetch top 5 categories, instrumentations, ensemble types, and credits
    $categories = Category::paginate(10);

    $instrumentations = Instrumentation::paginate(5);
    $ensembleTypes = EnsembleType::paginate(5);
    $credits = MusicCreator::paginate(10);


    $categoryCounts = Category::selectRaw('categories.id, categories.name as category_name, COUNT(music_category.music_id) as musics_count')
        ->leftJoin('music_category', 'categories.id', '=', 'music_category.category_id')
        ->leftJoin('musics', 'music_category.music_id', '=', 'musics.id')
        ->groupBy('categories.id', 'categories.name')
        ->get();



    $logs = ActivityLog::with('user')->latest()->paginate(5);


    // Fetch counts of hymns per language
    $languageCounts = Language::withCount('musics')->get();
    
    // Fetch most viewed hymns with views count and song number
    $mostViewedHymns = ActivityLog::where('changes', 'view hymn')
        ->join('musics', 'activity_logs.model_id', '=', 'musics.id')
        ->select('musics.id', 'musics.title', 'musics.song_number', DB::raw('COUNT(activity_logs.id) as views_count'))
        ->groupBy('musics.id', 'musics.title', 'musics.song_number')
        ->orderByDesc('views_count')
        ->paginate(4);

        $playlists = Playlist::select('name')->get();

        $musicPlaylist = DB::table('playlists as pyl')
            ->select('pyl.name', 'm.title', 'm.song_number')
            ->join('music_playlist as mp', 'mp.playlist_id', '=', 'pyl.id')
            ->join('musics as m', 'm.id', '=', 'mp.music_id')
            ->get();

    return view('dashboard', [
        'totalChurchHymns' => $totalChurchHymns,
        'totalLyricists' => $totalLyricists,
        'totalComposers' => $totalComposers,
        'totalArrangers' => $totalArrangers,
        'totalUsers' => $totalUsers,
        'categories' => $categories,
        'instrumentations' => $instrumentations,
        'ensembleTypes' => $ensembleTypes,
        'credits' => $credits,
        'categoryCounts' => $categoryCounts,
        'logs' => $logs,
        'languageCounts' => $languageCounts, // Pass language counts to the view
        'mostViewedHymns' => $mostViewedHymns, // Pass most viewed hymns to the view
        'playlists' => $playlists, // Pass playlists to the view
        'musicPlaylist'=>$musicPlaylist,
    ]);
}
}
