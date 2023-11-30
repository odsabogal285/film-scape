<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

class UserRepository extends BaseRepository
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
}
