<?php

namespace App\Repositories\Admin\Eloquent;

use App\Models\BlogPost;
use App\Repositories\Admin\Interfaces\BlogPostRepositoryInterface;

class BlogPostRepository implements BlogPostRepositoryInterface
{
    protected $_model;
    public function __construct(BlogPost $_model)
    {
        $this->_model = $_model;
    }
    public function getAll()
    {
        return $this->_model->with('author')->get();
    }
    public function create(array $data)
    {
        return $this->_model->create($data);
    }
    public function findById(int $id)
    {
        return $this->_model->find($id);
    }
    public function update(int $id, array $data): bool
    {
        $blog = $this->findById($id);
        if ($blog) {
            return $blog->update($data);
        }
        return false;
    }
    public function delete(int $id): bool
    {
        $blog = $this->findById($id);
        if ($blog) {
            return $blog->delete();
        }
        return false;
    }
}
