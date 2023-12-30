<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Models\MovieFavoriteUser;
use App\Models\User;
use App\Repositories\MovieFavoriteUserRepository;
use App\Repositories\MovieRepository;
use App\Repositories\UserRepository;
use App\Services\MovieService;
use App\Services\TMBDService;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class RecommendationController extends Controller
{
    private MovieRepository $movieRepository;
    private MovieFavoriteUserRepository $movieFavoriteUserRepository;
    private UserRepository $userRepository;
    private MovieService $movieService;
    private TMBDService $tmbdService;
    public function __construct(UserRepository $userRepository, MovieService $movieService, TMBDService $tmbdService)
    {
        $this->userRepository = $userRepository;
        $this->movieService = $movieService;
        $this->tmbdService = $tmbdService;
    }

    public function index (Request $request)
    {
        try {

            $recommendations = $this->tmbdService->trendingAll();
            //$movies = $this->movieService->validateMoviesList($movies);

            return view('films.recommendation.index', compact('recommendations'));

        } catch (\Exception $exception) {
            Log::error("Error index RC: {$exception->getMessage()} File: {$exception->getFile()} Line: {$exception->getLine()}");
        }
    }

    public function listRecommendation (Request $request)
    {
        try {

            $movies = $this->tmbdService->discoverMoviesPage($request->input('page'));
            $movies = $this->movieService->validateMoviesList($movies);

            return view('films.recommendation.movies', compact('movies'));

        } catch (\Exception $exception) {
            Log::error("Error listMovies RC: {$exception->getMessage()} File: {$exception->getFile()} Line: {$exception->getLine()}");
        }
    }

    public function updateFavorite (Request $request)
    {
        try {

            if ($request->ajax()) {
                $user_repository = $this->userRepository->get(Auth::id());
                if ($request->input('active') == '1') {
                    $this->userRepository->attach_movies($user_repository, $request->input('id'));
                } else {
                    $this->userRepository->detach_movies($user_repository, $request->input('id'));
                }
            }

        } catch (\Exception $exception) {
            Log::error("Error updateFavorite RC: {$exception->getMessage()} File: {$exception->getFile()} Line: {$exception->getLine()}");
        }
    }
}
