<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{
    protected $fillable = [''];


    // Get the genres for the Movie
    public function movie()
    {
        return $this->hasOne('App\Movie::class');
    }
}
