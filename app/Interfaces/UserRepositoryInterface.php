<?php

namespace App\Interfaces;

use App\Models\User;
use Illuminate\Support\Collection;


interface UserRepositoryInterface
{
    public function getMovies(User $user): Collection;
}
