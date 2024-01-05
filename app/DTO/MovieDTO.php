<?php

namespace App\DTO;

use Brick\Math\BigInteger;
use function Symfony\Component\Translation\t;

class MovieDTO
{
    public int $id;
    public string $title;
    public string $release_date;
    public string $image;
    public float $qualification;
    function __construct(int $id, string $title, string $release_date, string $image, float $qualification)
    {
        $this->id = $id;
        $this->title = $title;
        $this->release_date = $release_date;
        $this->image = $image;
        $this->qualification = $qualification;
    }
}

