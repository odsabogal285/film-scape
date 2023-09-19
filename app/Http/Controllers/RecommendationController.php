<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class RecommendationController extends Controller
{
    public static function index ()
    {
        try {

            $response = Http::withHeaders([
                'Authorization' => 'Bearer '.config('apis.tmdb.TMDB_TOKEN'),
                'accept' => 'application/json',
            ])->get(config('apis.tmdb.TMDB_URL').'authentication');
            
            dd($response->status());

        } catch (\Exception $exception) {
            dd($exception);
        }
    }
}
