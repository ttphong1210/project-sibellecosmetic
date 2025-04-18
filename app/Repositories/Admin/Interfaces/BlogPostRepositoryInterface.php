<?php
namespace App\Repositories\Admin\Interfaces;

interface BlogPostRepositoryInterface{
    public function getAll();
    public function findById(int $id);
    public function create(array $data);
    public function update(int $id, array $data):bool;
    public function delete(int $id):bool;
}