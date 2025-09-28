<?php

namespace App\Interfaces;

use App\DTO\ReviewFilter;

interface ReviewRepositoryInterface
{
    public function all(ReviewFilter $filter);
    public function countReviews();
}
