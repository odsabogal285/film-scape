<?php

namespace App\Repositories;

use App\Models\MovieFavoriteUser;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class MovieFavoriteUserRepository extends BaseRepository
{

    public function __construct(MovieFavoriteUser $model)
    {
        parent::__construct($model);
    }
    public function getMoviesForUser(User $user)
    {
        return $user->movies();
    }
}
