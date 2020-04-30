<?php

namespace App\Http\Controllers;

use App\Movie;
use App\Genre;
use App\Video;
use App\Favorite;
use App\User;
use Auth;
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
                'title' => $movie['title'],
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
        $movies = Movie::with(['genres', 'videos'])->paginate(10);
        return response()->json($movies);
    }

    public function getAMovie($id)
    {
        $movie = Movie::findOrFail($id);
        return response()->json($movie);
    }


    // Store Favorite movies
    public function storeFavorite(Request $request, $id)
    {

            $user = User::where('id', $id)->first();
            $user->favoriteMovies()->attach($request->movie_id);
        return response()->json(['success' => 'Movie saved', $user->favoriteMovies], 201);
    }

    // Display list of favorite movie
    public function listFavoriteMovies($id)
    {
        $user = User::with('favoriteMovies')->where('id', $id)->first();
        // dd($user->favoriteMovies);
        foreach ($user->favoriteMovies as $favMovie) {
            return response()->json(['success' => $favMovie], 200);
        } 
        //return response()->json(['success' => $user->favoriteMovies], 200);
    }

    /**
     * Remove the specified movie from favorite list.
     */
    public function removeFavorite($id)
    {
        $user = User::with('favoriteMovies')->where('id', $id)->first();
        //$movieId = Movie::where('id', $id)->first();
        $user->favoriteMovies()->detach($movieId);
        return response()->json(['success' => 'Movie removed'], 200);
    }
}
