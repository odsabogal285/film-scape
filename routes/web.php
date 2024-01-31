<?php

use App\Http\Controllers\FavoriteMovieUserController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\RecommendationController;
use App\Http\Controllers\SerieController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::post('/update-favorite', [RecommendationController::class, 'updateFavorite'])->name('update-favorite');
Route::get('/favorite', [FavoriteMovieUserController::class, 'index'])->name('favorite');

//Movies
Route::get('/movies', [MovieController::class, 'index'])->name('movies');
Route::get('/list-movies', [MovieController::class, 'listMovies'])->name('list-movies');
Route::get('/movies/{movie}', [MovieController::class, 'show'])->name('movie.show');

//Recommendation
Route::get('/recommendation', [RecommendationController::class, 'index'])->name('recommendation');
Route::get('/list-recommendation', [RecommendationController::class, 'listRecommendation'])->name('list-recommendation');

//Series
Route::get('/series', [SerieController::class, 'index'])->name('series');
Route::get('/list-series', [SerieController::class, 'listMovies'])->name('list-series');


Route::get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');
