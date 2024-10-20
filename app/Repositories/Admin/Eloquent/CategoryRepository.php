<?php
namespace App\Repositories\Admin\Eloquent;

use App\Models\Category;
use App\Repositories\Admin\Interfaces\CategoryRepositoryInterface;
use App\Repositories\EloquentRepository;
use Illuminate\Support\Collection;

class CategoryRepository implements CategoryRepositoryInterface{
    protected $_model;
    public function __construct(Category $_model){
        $this->_model = $_model;
    }
    public function showAll(): Collection{
        return $this->_model->all();
    }
    public function create(array $attributes){
        return $this->_model->create($attributes);
    }
    public function findById($id){
        return $this->_model->findOrFail($id);
    }
    public function update(int $id, array $attributes){
        $category = $this->findById($id);
        if($category){
            return $category->update($attributes);
        }
        return false;
    }
    public function delete(int $id){
        return $this->_model->destroy($id);
    }
}