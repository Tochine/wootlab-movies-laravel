<?php

namespace App\Http\Controllers;

use App\Movie;
use App\Genre;
use App\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class MovieController extends Controller
{

    // Populating the database with movie data from the API
    public function storeMovies() {
        $url = 'https://wootlab-moviedb.herokuapp.com/api/movie/list/all';
        $allMovies = http::get($url)->json();
        

        foreach ($allMovies as $movies) {
           $movie = Movie::create([
                'voteAverage' => $movies['voteAverage'],
                'releaseDate' => implode(" ",$movies['releaseDate']),
                'runtime' => $movies['runtime'],
                'backdropPath' => $movies['backdropPath'],
                'budget' => $movies['budget'],
                'posterPath' => $movies['posterPath'],
                'status' => $movies['status'],
                'homepage' => $movies['homepage'],
            ]);

        //return $movies['genres'];
            foreach ($movies['genres'] as $movieGenres) {
                Genre::create([
                    'name' => $movieGenres['name'],
                    'genre_id_num' => $movieGenres['id'],
                    'movie_id' => $movie->id,
                ]);
            }

        }

        return response()->json(['success' => 'Successfully saved'], 200);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Movie::all();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Movie  $movie
     * @return \Illuminate\Http\Response
     */
    public function show(Movie $movie)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Movie  $movie
     * @return \Illuminate\Http\Response
     */
    public function edit(Movie $movie)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Movie  $movie
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Movie $movie)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Movie  $movie
     * @return \Illuminate\Http\Response
     */
    public function destroy(Movie $movie)
    {
        //
    }
}
