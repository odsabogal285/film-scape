<?php

namespace App\Services;

use App\Models\Movie;
use App\Repositories\MovieFavoriteUserRepository;
use App\Repositories\MovieRepository;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class SerieService
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

    public function validateMoviesList($movies)
    {
        try {

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

            return $movies;

        } catch (\Exception $exception) {
            Log::error("Error ValidateMoviesList MS: {$exception->getMessage()} File: {$exception->getFile()} Line: {$exception->getLine()}");
        }
    }
}
