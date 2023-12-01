<?php

namespace App\Http\Controllers;

use App\Repositories\MovieFavoriteUserRepository;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class FavoriteMovieUserController extends Controller
{
    private MovieFavoriteUserRepository $movieFavoriteUserRepository;
    private UserRepository $userRepository;
    public function __construct(MovieFavoriteUserRepository $movieFavoriteUserRepository, UserRepository $userRepository)
    {
        $this->movieFavoriteUserRepository = $movieFavoriteUserRepository;
        $this->userRepository = $userRepository;

    }

    public function index ()
    {
        try {

            $movies = $this->userRepository->getMovies(Auth::user());

            foreach ($movies as $movie) {
                $movie->checked = true;
            }

            return view('favorite.index', compact('movies'));

        } catch (\Exception $exception) {
            Log::error("Error index FMU: {$exception->getMessage()} File: {$exception->getFile()} Line: {$exception->getLine()}");
        }
    }
}
