<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MusicFile extends Model
{
    protected $table = 'music_files';
    protected $fillable = [
        'music_id',
        'title',
        'music_score_path',
        'lyrics_path',
        'vocals_mp3_path',
        'organ_mp3_path',
        'preludes_mp3_path',
        'created_by',
        'updated_by'
    ];

    public function music()
    {
        return $this->belongsTo(Music::class);
    }
}
