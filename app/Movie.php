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


}
