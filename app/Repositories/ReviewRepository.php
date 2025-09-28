<?php

namespace App\Repositories;

use App\DTO\ReviewFilter;
use App\Interfaces\ReviewRepositoryInterface;
use App\Models\Reviews;

class ReviewRepository implements ReviewRepositoryInterface
{
    public function all(ReviewFilter $filter)
    {
        return [];
    }

    public function countReviews()
    {
        return Reviews::all()->count();
    }
}
