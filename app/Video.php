<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    protected $fillable = ['movie_id', 'site', 'name', 'video_id_num', 'type', 'key'];


    // Get the videos for the Movie
    public function movie()
    {
        return $this->hasOne('App\Movie::class');
    }

}



