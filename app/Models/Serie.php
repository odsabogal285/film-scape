<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Serie extends Model
{
    use HasFactory;

    protected $fillable = ['id', 'name', 'first_air_date', 'image', 'qualification'];
    public $incrementing = false;
}
