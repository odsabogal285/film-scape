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

            return view('films.movies.show', compact('movie'));

        } catch (\Exception $exception) {
            Log::error("Error show RC: {$exception->getMessage()} File: {$exception->getFile()} Line: {$exception->getLine()}");

        }
    }
}
