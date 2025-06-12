<?php

namespace App\Services;

use App\Interfaces\MotorCategoryRepositoryInterface;
use App\Repositories\MotorCategoryRepository;

class MotorCategoryService
{
    protected MotorCategoryRepositoryInterface $motorCategoryRepository;
        
    /**
     * Create a new class instance.
     */
    public function __construct(MotorCategoryRepositoryInterface $motorCategoryRepository)
    {
        $this->motorCategoryRepository = $motorCategoryRepository;
    }

    public function getAllCategory()
    {
        return $this->motorCategoryRepository->all();
    }
}
