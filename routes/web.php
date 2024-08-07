<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MusicController;
use App\Http\Controllers\UserController;

use App\Http\Controllers\LanguageController;
use App\Http\Controllers\ChurchHymnController;

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\InstrumentationController;
use App\Http\Controllers\EnsembleTypeController;
use App\Http\Controllers\MusicCreatorController;

use App\Http\Controllers\GroupController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\PermissionCategoryController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\ApiDocumentationController;
use App\Http\Controllers\ActivityLogController;
use App\Http\Controllers\PlaylistController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('auth/login');
});

Route::get('/login', 'Auth\LoginController@showLoginForm')->name('login');


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Route::get('/phpinfo', function () {
//     return view('phpinfo');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);
});

require __DIR__.'/auth.php';

// Define a route for the dashboard
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

// Music Routes
Route::get('/musics', [MusicController::class, 'index'])->name('musics.index');
//Route::get('/musics/{churchHymnId}', [MusicController::class, 'index'])->name('musics.index');

Route::get('/musics/create', [MusicController::class, 'create'])->name('musics.create');

Route::post('/musics', [MusicController::class, 'store'])->name('musics.store');

Route::get('/musics/{id}/edit', [MusicController::class, 'edit'])->name('musics.edit');
Route::put('/musics/{music}', [MusicController::class, 'update'])->name('musics.update');
// Route::delete('/musics/{id}', [MusicController::class, 'destroy'])->name('musics.destroy');
// Route::resource('musics', MusicController::class)->except('destroy');
Route::delete('/musics/{music}', [MusicController::class, 'destroy'])->name('musics.destroy');

// Route for showing a single music details
Route::get('/musics/{id}', [MusicController::class, 'show'])->name('musics.show');

Route::get('musics/fetchByLanguage/{languageId?}', [MusicController::class, 'fetchMusicsByLanguage'])->name('musics.fetchByLanguage');

Route::get('musics/{id}/{languageId?}', [MusicController::class, 'show'])->name('musics.show');

Route::get('/musicplayer/{id}', [MusicController::class, 'musicPlayer'])->name('musics.musicPlayer');

Route::get('mplayer/{id}', [MusicController::class, 'musicPlayer'])->name('musics.mplayer');

Route::get('/musics/search', [MusicController::class, 'search'])->name('musics.search');

Route::get('/creators/{creatorId}', [MusicCreatorController::class, 'showinfo'])->name('creators.showinfo');

Route::get('/musics/{musicId}/creators/{creatorId}', [MusicCreatorController::class, 'showinfo'])->name('musics.showinfo');

Route::get('/users', [UserController::class, 'index'])->name('users.index');

Route::resource('users', UserController::class);

Route::resource('groups', GroupController::class);

Route::get('groups/{group}/users', [GroupController::class, 'showUsers'])->name('groups.users');

Route::resource('languages', LanguageController::class);
Route::resource('church_hymns', ChurchHymnController::class);

Route::resource('permission_categories', PermissionCategoryController::class);

Route::resource('permissions', PermissionController::class);
Route::get('permissions/show', [PermissionController::class, 'showPermissions'])->name('permissions.show');

Route::get('api_documentations', [ApiDocumentationController::class, 'index'])->name('api_documentations.index');
Route::get('api_documentations/create', [ApiDocumentationController::class, 'create'])->name('api_documentations.create');
Route::post('api_documentations', [ApiDocumentationController::class, 'store'])->name('api_documentations.store');
Route::get('api_documentations/{api_documentation}/edit', [ApiDocumentationController::class, 'edit'])->name('api_documentations.edit');
Route::put('api_documentations/{api_documentation}', [ApiDocumentationController::class, 'update'])->name('api_documentations.update');
Route::delete('api_documentations/{api_documentation}', [ApiDocumentationController::class, 'destroy'])->name('api_documentations.destroy');

Route::get('/register', [RegisteredUserController::class, 'create'])
    ->name('register'); // No middleware to allow access for both guests and authenticated users
Route::post('/register', [RegisteredUserController::class, 'store']);

Route::get('music_management/categories', [CategoryController::class, 'index'])->name('categories.index');
Route::post('music_management/categories', [CategoryController::class, 'store'])->name('categories.store'); // Updated route for storing a new category
Route::get('music_management/categories/{categories}/edit', [CategoryController::class, 'edit'])->name('categories.edit');
Route::put('music_management/categories/{category}', [CategoryController::class, 'update'])->name('categories.update');

Route::delete('music_management/categories/{category}', [CategoryController::class, 'destroy'])->name('categories.destroy');

Route::get('music_management/instrumentations', [InstrumentationController::class, 'index'])->name('instrumentations.index');
Route::post('music_management/instrumentations', [InstrumentationController::class, 'store'])->name('instrumentations.store'); // Updated route for storing a new instrumentation
Route::get('music_management/instrumentations/{instrumentations}/edit', [InstrumentationController::class, 'edit'])->name('instrumentations.edit');
Route::put('music_management/instrumentations/{instrumentation}', [InstrumentationController::class, 'update'])->name('instrumentations.update');

Route::delete('music_management/instrumentations/{instrumentation}', [InstrumentationController::class, 'destroy'])->name('instrumentations.destroy');

Route::get('music_management/ensemble_types', [EnsembleTypeController::class, 'index'])->name('ensemble_types.index');
Route::post('music_management/ensemble_types', [EnsembleTypeController::class, 'store'])->name('ensemble_types.store'); // Updated route for storing a new ensemble_type
Route::get('music_management/ensemble_types/{ensemble_types}/edit', [EnsembleTypeController::class, 'edit'])->name('ensemble_types.edit');
Route::put('music_management/ensemble_types/{ensemble_type}', [EnsembleTypeController::class, 'update'])->name('ensemble_types.update');

Route::delete('music_management/ensemble_types/{ensemble_type}', [EnsembleTypeController::class, 'destroy'])->name('ensemble_types.destroy');

Route::get('music_management/credits', [MusicCreatorController::class, 'index'])->name('credits.index');
Route::post('music_management/credits', [MusicCreatorController::class, 'store'])->name('credits.store'); // Updated route for storing a new ensemble_type
Route::get('music_management/credits/{credits}/edit', [MusicCreatorController::class, 'edit'])->name('credits.edit');
Route::put('music_management/credits/{credit}', [MusicCreatorController::class, 'update'])->name('credits.update');

Route::delete('music_management/credits/{credit}', [MusicCreatorController::class, 'destroy'])->name('credits.destroy');

Route::get('/admin/settings', [AdminController::class, 'settings'])->name('admin.settings');

Route::get('activity-logs', [ActivityLogController::class, 'index'])->name('activity_logs.index');
Route::get('activity-logs/{id}', [ActivityLogController::class, 'show'])->name('activity_logs.show');

Route::post('/playlists', [PlaylistController::class, 'store'])->name('playlists.store');
Route::get('/playlists', [PlaylistController::class, 'index'])->name('playlists.index');

Route::post('/playlists/{playlist}/add', [PlaylistController::class, 'addMusic'])->name('playlists.addMusic');
Route::post('/playlists', [PlaylistController::class, 'create'])->name('playlists.create');

Route::get('/playlists', [PlaylistController::class, 'showPlaylist'])->name('playlists.showPlaylist');

Route::get('/playlists/{playlist}/validate/{musicId}', [PlaylistController::class, 'validateMusicPlaylist'])->name('playlists.validateMusicPlaylist');
Route::post('/playlists/{playlist}/validate/{musicId}', [PlaylistController::class, 'validateMusicPlaylist'])->name('playlists.validateMusicPlaylist');


Route::post('/playlist/remove-music/{playlistId}/{musicId}', [PlaylistController::class, 'removeMusicFromPlaylist'])->name('playlist.removeMusic');

Route::resource('playlists_management', PlaylistController::class);
Route::post('playlists_management/playlist', [PlaylistController::class, 'store'])->name('playlists.store');
Route::put('playlists_management/{playlist}', [PlaylistController::class, 'update'])->name('playlists.update');
Route::delete('playlists_management/{playlist}', [PlaylistController::class, 'destroy'])->name('playlists.destroy');

//Route::get('get-music-list/{playlistId}', [PlaylistController::class, 'getMusicList'])->name('getMusicList');
Route::get('/get-music-list/{playlistId}', [PlaylistController::class, 'getMusicList'])->name('getMusicList');



// routes/web.php
//Route::post('playlists_management/update-order', [PlaylistController::class, 'updateOrder'])->name('playlists.updateOrder');
