<?php

namespace App\Repositories\Admin\Eloquent;

use App\Models\Product;
use App\Repositories\Admin\Interfaces\ProductRepositoryInterface;
use App\Repositories\EloquentRepository;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class ProductRepository implements ProductRepositoryInterface
{
    /**
     * Get the model class.
     * 
     * @return string
     */
    protected $_model;
    public function __construct(Product $_model)
    {
        $this->_model = $_model;
    }

    public function getAll(): Collection
    {
        return DB::table('products')
            ->join('categories', 'products.prod_cate', '=', 'categories.cate_id')
            ->join('brands', 'products.prod_brand', '=', 'brands.brand_id')
            ->orderBy('prod_id', 'desc')
            ->get();
    }
    public function findById(int $id): ?Product
    {
        return $this->_model->find($id);
    }
    public function create(array $attributes): Product
    {
        return $this->_model->create($attributes);
    }
    public function update(int $id, array $attributes): bool
    {
        $product = $this->findById($id);
        if ($product) {
            return $product->update($attributes);
        }
        return false;
    }
    public function delete(int $id): bool
    {
        $product = $this->findById($id);
        if ($product) {
            return $product->delete();
        }
        return false;
    }
}
