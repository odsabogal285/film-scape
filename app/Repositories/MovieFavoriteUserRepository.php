<?php

namespace App\Repositories;

use App\Models\MovieFavoriteUser;
use Illuminate\Database\Eloquent\Model;

class MovieFavoriteUserRepository extends BaseRepository
{

    public function __construct(MovieFavoriteUser $model)
    {
        parent::__construct($model);
    }



}
