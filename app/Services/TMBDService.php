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

    public  function discoverMovies ()
    {
        $response = Http::withHeaders([
            'Authorization' => 'Bearer '.$this->token,
            'accept' => 'application/json',
        ])->get($this->url.'discover/movie?language=es&page=1');

        return $response->object()->results;
    }

    public  function discoverMoviesPage (Int $page)
    {
        $response = Http::withHeaders([
            'Authorization' => 'Bearer '.$this->token,
            'accept' => 'application/json',
        ])->get($this->url."discover/movie?language=es&page=&page={$page}");

        return $response->object()->results;
    }
}
