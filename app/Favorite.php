<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    protected $fillable = ['movie_id'];

    public function movie()
    {
    	return $this->belongsTo(Movie::class, 'movie_id');
    }

}
