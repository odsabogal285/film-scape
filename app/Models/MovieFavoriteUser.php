<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MovieFavoriteUser extends Model
{
    use HasFactory;

    protected $table = 'movies_favorite_users';
    public $timestamps = false;

    protected $fillable = ['movie_id', 'user_id'];


}
