<?php

namespace App\Repositories;

use App\DTO\MovieDTO;
use App\Interfaces\UserRepositoryInterface;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;

class UserRepository extends BaseRepository implements UserRepositoryInterface
{
    public function __construct(User $model)
    {
        parent::__construct($model);
    }
    public function attach_movies (User $user, $id_movies)
    {
        return $user->movies()->attach($id_movies);
    }

    public function detach_movies (User $user, $id_movies)
    {
        return $user->movies()->detach($id_movies);

    }
    public function getMovies(User $user): Collection
    {
        $movies = $user->movies()->get();

        $movies_collect = collect();

        foreach ($movies as $movie) {
            $movie_dto = new MovieDTO($movie->id, $movie->title, $movie->release_date, $movie->image, $movie->qualification);
            $movies_collect->push($movie_dto);
        }

        return $movies_collect;
    }
}
