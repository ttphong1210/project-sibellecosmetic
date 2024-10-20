<?php
namespace App\Repositories\Admin\Interfaces;

use Illuminate\Support\Collection;

interface CategoryRepositoryInterface{
    public function showAll():Collection;
    public function create(array $attributes);
    public function findById($id);
    public function update(int $id, array $attributes);
    public function delete(int $id);
}