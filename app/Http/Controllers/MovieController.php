<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Repositories\UserRepository;
use App\Services\MovieService;
use App\Services\TMBDService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class MovieController extends Controller
{

    private UserRepository $userRepository;
    private MovieService $movieService;
    private TMBDService $tmbdService;
    public function __construct(UserRepository $userRepository, MovieService $movieService, TMBDService $tmbdService)
    {
        $this->userRepository = $userRepository;
        $this->movieService = $movieService;
        $this->tmbdService = $tmbdService;
    }

    public function index ()
    {
        try {

            $movies = $this->tmbdService->discoverMovies();
            $movies = $this->movieService->validateMoviesList($movies);

            return view('films.movies.index', compact('movies'));

        } catch (\Exception $exception) {
            Log::error("Error index MC: {$exception->getMessage()} File: {$exception->getFile()} Line: {$exception->getLine()}");
        }
    }

    public function listMovies (Request $request)
    {
        try {

            $movies = $this->tmbdService->discoverMoviesPage($request->input('page'));
            $movies = $this->movieService->validateMoviesList($movies);

            return view('films.movies.movies', compact('movies'));

        } catch (\Exception $exception) {
            Log::error("Error listMovies RC: {$exception->getMessage()} File: {$exception->getFile()} Line: {$exception->getLine()}");
        }
    }

    public function show (Request $request, Movie $movie)
    {
        try {

            $movie = $this->tmbdService->movieDetails($movie->id);
            $credits = $this->tmbdService->creditsMovie($movie->id);

            $credits_director = collect($credits->crew)->where('job', 'Director')->values();
            $credits_screenplay = collect($credits->crew)->where('job', 'Screenplay')->values();
            $casts = collect($credits->cast)->take(9);

            foreach ($credits_director as $director) {
                foreach ($credits_screenplay as $key => $screenplay) {
                    if($director->id == $screenplay->id) {
                        $director->job = $director->job.', '.$screenplay->job;
                        $credits_screenplay->forget($key);
                    }
                }
            }

            $credits_screenplay = $credits_screenplay->values();

            $genres = collect();
            foreach ($movie->genres as $genre) {
                $genres->push($genre->name);
            }
            $genres_name = implode(", ",$genres->toArray());
            $horas = floor($movie->runtime/60);
            $minutes= $movie->runtime%60;
            $duration = $horas.'h '.($minutes>0?$minutes.'m':'');

            return view('films.movies.show', compact('movie', 'genres_name', 'duration', 'credits_director', 'credits_screenplay',
            'casts'));

        } catch (\Exception $exception) {
            Log::error("Error show RC: {$exception->getMessage()} File: {$exception->getFile()} Line: {$exception->getLine()}");

        }
    }
}
