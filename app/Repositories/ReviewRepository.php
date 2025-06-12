<?php

namespace App\Repositories;

use App\DTO\ReviewFilter;
use App\Interfaces\ReviewRepositoryInterface;

class ReviewRepository implements ReviewRepositoryInterface
{
    public function all(ReviewFilter $filter)
    {
        return [];
    }
}
