<?php
namespace App\Repositories\Admin\Interfaces;

use App\Models\Product;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

interface ProductRepositoryInterface{
    // public function getAll(): Collection;
    public function getAll() : LengthAwarePaginator;
    public function findById(int $id): ?Product;
    public function findByStr(?string $str);
    public function create(array $attributes): Product;
    public function update(int $id, array $attributes): bool;
    public function delete(int $id): bool;
}