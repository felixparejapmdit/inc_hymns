<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Designation extends Model
{
    
    protected $table = 'designations';
    protected $fillable = [
        'name',
    ];

    // Define relationship: ChurchHymn has many musics
    public function musicCreators()
    {
        return $this->belongsToMany(MusicCreator::class, 'creator_designation');
    }
}
