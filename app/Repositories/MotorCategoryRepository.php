<?php

namespace App\Repositories;

use App\Interfaces\MotorCategoryRepositoryInterface;
use Illuminate\Support\Facades\DB;

class MotorCategoryRepository implements MotorCategoryRepositoryInterface
{
    public function all() 
    {
        return DB::table('motor_category')->get()->toArray();
    }   
}
