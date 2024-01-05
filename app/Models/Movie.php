<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    use HasFactory;

    protected $fillable = ['id', 'title', 'release_date', 'image', 'qualification'];
    public $incrementing = false;

    public function users ()
    {
        return $this->belongsToMany(User::class, 'movies_favorite_users');
    }
}
