<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    protected $fillable = ['voteAverage', 'releaseDate', 'runtime', 'backdropPath', 
    'budget', 'posterPath', 'status', 'homepage'];


    // Get the genres for the Movie
    public function genres()
    {
        return $this->hasMany(Genre::class);
    }

    // Get the videos for the Movie
    public function videos()
    {
        return $this->hasMany(Video::class);
    }

    public function favorite()
    {
        return $this->hasMany(Favourite::class);
    }

}
