<?php

namespace App\Repositories;

use App\Models\Movie;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class MovieRepository extends BaseRepository
{
    public function __construct(Movie $model)
    {
        parent::__construct($model);
    }

    public function getMoviesIds (Collection $ids)
    {
        return $this->model->whereIn('id',$ids)->get();
    }

}
