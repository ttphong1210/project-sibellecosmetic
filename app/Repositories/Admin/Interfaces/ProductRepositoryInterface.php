<?php
namespace App\Repositories\Admin\Interfaces;

use App\Models\Product;
use Illuminate\Support\Collection;

interface ProductRepositoryInterface{
    public function getAll(): Collection;
    public function findById(int $id): ?Product;
    public function create(array $attributes): Product;
    public function update(int $id, array $attributes): bool;
    public function delete(int $id): bool;
}