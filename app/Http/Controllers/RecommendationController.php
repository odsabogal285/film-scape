<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Models\MovieFavoriteUser;
use App\Models\User;
use App\Repositories\MovieFavoriteUserRepository;
use App\Repositories\MovieRepository;
use App\Repositories\UserRepository;
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
    public function __construct(MovieRepository $movieRepository, MovieFavoriteUserRepository $movieFavoriteUserRepository, UserRepository $userRepository)
    {
        $this->movieRepository = $movieRepository;
        $this->movieFavoriteUserRepository = $movieFavoriteUserRepository;
        $this->userRepository = $userRepository;
    }

    public function index (Request $request)
    {
        try {

            $tmdb =  new TMBDService;
            $movies = $tmdb->discoverMovies();

            // todo pasar esto a un servicio
            $movies_query =  $this->movieRepository->getMoviesIds(collect($movies)->pluck('id'));
            $movies_user=  $this->userRepository->getMovies(Auth::user());

            foreach ($movies as $movie) {
                $movies_query->where('id', $movie->id)->first();
                if (!$movies_query->where('id', $movie->id)->first()) {
                    $movie_repository = new Movie([
                        'id' => $movie->id,
                        'name' => $movie->title,
                        'release_date' => $movie->release_date,
                        'image' => $movie->poster_path,
                        'qualification' => $movie->vote_average
                    ]);
                    $this->movieRepository->save($movie_repository);
                }
            }

            if ($movies_user->count() > 0) {
                foreach ($movies as $movie) {
                    if ($movies_user->where('id', $movie->id)->first()) {
                        $movie->checked = true;
                    }
                }
            }

            return view('films.recommendation.index', compact('movies'));

        } catch (\Exception $exception) {
            Log::error("Error index RC: {$exception->getMessage()} File: {$exception->getFile()} Line: {$exception->getLine()}");
        }
    }

    public  function listMovies (Request $request)
    {
        try {
            $tmdb =  new TMBDService;
            $movies = $tmdb->discoverMoviesPage($request->input('page'));

            // todo pasar esto a un servicio
            $movies_query = $this->movieRepository->getMoviesIds(collect($movies)->pluck('id'));

            foreach ($movies as $movie) {
                $movies_query->where('id', $movie->id)->first();
                if (!$movies_query->where('id', $movie->id)->first()) {
                    $movie_repository = new Movie([
                        'id' => $movie->id,
                        'name' => $movie->title,
                        'release_date' => $movie->release_date,
                        'image' => $movie->poster_path,
                        'qualification' => $movie->vote_average
                    ]);
                    $this->movieRepository->save($movie_repository);
                }
            }

            return view('films.recommendation.movies', compact('movies'));

        } catch (\Exception $exception) {
            Log::error("Error listMovies RC: {$exception->getMessage()} File: {$exception->getFile()} Line: {$exception->getLine()}");
        }
    }

    public  function updateFavorite (Request $request)
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
