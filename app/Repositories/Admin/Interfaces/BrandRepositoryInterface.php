<?php

namespace App\Repositories\Admin\Interfaces;

use Illuminate\Support\Collection;

interface BrandRepositoryInterface{
    public function getAll():Collection;
    public function getById(int $id);
    public function create(array $data);
    public function update(int $id, array $data);
    public function delete(int $id):bool;

}