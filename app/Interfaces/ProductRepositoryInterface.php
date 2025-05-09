<?php

namespace App\Interfaces;

interface ProductRepositoryInterface
{
    
    public function all();
    public function find(int $id);
    public function create(array $data);

    public function getAllType(); 
    public function update(int $id, array $data);
    public function delete(int $id);

}
