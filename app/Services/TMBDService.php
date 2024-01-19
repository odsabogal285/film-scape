<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class TMBDService
{
    private String $url, $token;
    public function __construct()
    {
        $this->url = config('apis.tmdb.TMDB_URL');
        $this->token = config('apis.tmdb.TMDB_TOKEN');
    }

    public function trendingAll (string $time_window_day = 'day')
    {
        $response = Http::withHeaders([
            'Authorization' => 'Bearer '.$this->token,
            'accept' => 'application/json',
        ])->get($this->url."trending/all/{$time_window_day}?language=es");

        return $response->object()->results;
    }

    public function discoverMovies ()
    {
        $response = Http::withHeaders([
            'Authorization' => 'Bearer '.$this->token,
            'accept' => 'application/json',
        ])->get($this->url.'discover/movie?language=es&page=1');

        return $response->object()->results;
    }

    public function discoverMoviesPage (Int $page)
    {
        $response = Http::withHeaders([
            'Authorization' => 'Bearer '.$this->token,
            'accept' => 'application/json',
        ])->get($this->url."discover/movie?language=es&page={$page}");

        return $response->object()->results;
    }

    public function movieDetails(Int $movie_id)
    {
        $response = Http::withHeaders([
            'Authorization' => 'Bearer '.$this->token,
            'accept' => 'application/json',
        ])->get($this->url."movie/{$movie_id}?language=es");

        return $response->object();
    }

    public function creditsMovie(Int $movie_id)
    {
        $response = Http::withHeaders([
            'Authorization' => 'Bearer '.$this->token,
            'accept' => 'application/json',
        ])->get($this->url."movie/{$movie_id}/credits?language=es");

        return $response->object();
    }

    public function discoverSeries ()
    {
        $response = Http::withHeaders([
            'Authorization' => 'Bearer '.$this->token,
            'accept' => 'application/json',
        ])->get($this->url.'discover/tv?language=es&page=1');

        return $response->object()->results;
    }

    public function discoverSeriesPage (Int $page)
    {
        $response = Http::withHeaders([
            'Authorization' => 'Bearer '.$this->token,
            'accept' => 'application/json',
        ])->get($this->url."discover/tv?language=es&page={$page}");

        return $response->object()->results;
    }
}
