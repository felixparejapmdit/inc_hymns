<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Playlist extends Model
{
    protected $fillable = ['name'];

    public function musics()
    {
        return $this->belongsToMany(Music::class, 'music_playlist');
    }
    public function hymns()
    {
        return $this->belongsToMany(Music::class, 'music_playlist');
    }
}
