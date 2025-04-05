<?php

namespace App\Repositories\Admin\Eloquent;

use App\Models\Product;
use App\Repositories\Admin\Interfaces\ProductRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

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

    public function getAll(): LengthAwarePaginator
    {
        return DB::table('products')
            ->join('categories', 'products.prod_cate', '=', 'categories.cate_id')
            ->join('brands', 'products.prod_brand', '=', 'brands.brand_id')
            ->orderBy('prod_id', 'desc')
            ->paginate(10);
    }
    public function findById(int $id): ?Product
    {
        return $this->_model->find($id);
    }
    public function findByStr(?string $str){
        $product = $this->_model::query()
        ->join('categories', 'products.prod_cate', '=', 'categories.cate_id')
        ->join('brands', 'products.prod_brand', '=', 'brands.brand_id');
        if(!is_null($str) && $str !== ''){
            $product->where('prod_name', 'LIKE', '%'.$str.'%');
        }
        return $product->get();
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
