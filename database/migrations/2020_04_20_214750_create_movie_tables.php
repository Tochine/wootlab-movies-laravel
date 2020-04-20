<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMovieTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('movies', function (Blueprint $table) {
            $table->id();
            $table->double("voteAverage");
            $table->string("releaseDate");
            $table->integer("runtime");
            $table->string("backdropPath");
            $table->integer("budget");
            $table->string("posterPath");
            $table->string("status");
            $table->string("homepage");
            $table->timestamps();
        });

        Schema::create('videos', function (Blueprint $table) {
            $table->id();
            $table->integer("movie_id");
            $table->string("site");
            $table->string("name");
            $table->string("video_id_num");
            $table->string("type");
            $table->string("key");
            $table->timestamps();
        });

        Schema::create('genres', function (Blueprint $table) {
            $table->id();
            $table->integer("movie_id");
            $table->string("name");
            $table->integer("genre_id_num");
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists(['movies', 'videos', 'genres']) ;
    }
}
