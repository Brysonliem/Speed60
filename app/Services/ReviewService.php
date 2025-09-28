<?php

namespace App\Services;

use App\Interfaces\ReviewRepositoryInterface;

class ReviewService
{
    /**
     * Create a new class instance.
     */
    public function __construct(
        protected ReviewRepositoryInterface $reviewRepository
    ){}

    public function countReviews()
    {
        return $this->reviewRepository->countReviews();
    }

    // public function getAllReviews(?array $filters = null)
    // {
    //     return $this->reviewRepository->all($filters);
    // }
}
