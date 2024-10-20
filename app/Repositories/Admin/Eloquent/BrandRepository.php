<?php
namespace App\Repositories\Admin\Eloquent;

use App\Models\Brand;
use App\Repositories\Admin\Interfaces\BrandRepositoryInterface;
use Illuminate\Support\Collection;

class BrandRepository implements BrandRepositoryInterface{
    protected $_model;
    public function __construct(Brand $_model){
        $this->_model = $_model;
    }
    public function getAll(): Collection
    {
        return $this->_model->all();
    }
    public function getById(int $id){
        return Brand::findOrFail($id);
    }
    public function create(array $data){
        return Brand::create($data);
    }
    public function update(int $id, array $data){
        $brand = Brand::findOrFail($id);
        $brand->update($data);
        return $brand; 
    }
    public function delete(int $id):bool{
        return Brand::destroy($id);
    }

}