<?php

namespace App\Http\Controllers;

use App\Movie;
use App\Genre;
use App\Video;
use App\Favorite;
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

        
            foreach ($movies['genres'] as $movieGenres) {
                Genre::create([
                    'name' => $movieGenres['name'],
                    'genre_id_num' => $movieGenres['id'],
                    'movie_id' => $movie->id,
                ]);
                
            }
            foreach ($movies['vidoes'] as $movieVideos) {
                Video::create([
                    'movie_id' => $movie->id,
                    'site' => $movieVideos['site'],
                    'name' => $movieVideos['name'],
                    'video_id_num' => $movieVideos['id'],
                    'type' => $movieVideos['type'],
                    'key' => $movieVideos['key'],
                ]);

            }
            
        }
        //return $allMovies;
        return response()->json([
            'success' => 'Successfully saved',
            $allMovies], 201);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Movie::paginate(10);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response 
     */


    // Store Favorite movies
    public function storeFavorite(Request $request)
    {
        $movie_id = $request->movie_id;
        $movieId = Movie::where('id', $movie_id)->first();
        Favorite::create([
            'movie_id' => $movieId->id,
        ]);

        return response()->json(['success' => 'Movie saved', $movieId], 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Movie  $movie
     * @return \Illuminate\Http\Response
     */
    public function removeFavorite($id)
    {
        $movieFavorite = Favorite::findOrFail($id);
        $movieFavorite->delete();
        return response()->json(['success' => 'Movie removed'], 204);
    }
}
