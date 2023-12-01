<?php

use App\Http\Controllers\FavoriteMovieUserController;
use App\Http\Controllers\RecommendationController;
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
Route::get('/recommendation', [RecommendationController::class, 'index'])->name('recommendation');
Route::get('/list-movies', [RecommendationController::class, 'listMovies'])->name('list-movies');
Route::post('/update-favorite', [RecommendationController::class, 'updateFavorite'])->name('update-favorite');
Route::get('/favorite', [FavoriteMovieUserController::class, 'index'])->name('favorite');


Route::get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');
