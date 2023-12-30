<?php

namespace App\Http\Controllers;

use App\Repositories\UserRepository;
use App\Services\MovieService;
use App\Services\TMBDService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class SerieController extends Controller
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

            $series = $this->tmbdService->discoverSeries();
            //$series = $this->movieService->validateMoviesList($series);

            return view('films.series.index', compact('series'));

        } catch (\Exception $exception) {
            Log::error("Error index MC: {$exception->getMessage()} File: {$exception->getFile()} Line: {$exception->getLine()}");
        }
    }

    public function listSeries (Request $request)
    {
        try {

            $series = $this->tmbdService->discoverSeriesPage($request->input('page'));
            //$series = $this->movieService->validateMoviesList($series);

            return view('films.series.series', compact('series'));

        } catch (\Exception $exception) {
            Log::error("Error listMovies RC: {$exception->getMessage()} File: {$exception->getFile()} Line: {$exception->getLine()}");
        }
    }
}
