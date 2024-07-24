<?php
namespace App\Repositories\Eloquent;

use App\Models\OrderDetail;
use App\Repositories\Interfaces\OrderDetailRepositoryInterface;

class OrderDetailRepository implements OrderDetailRepositoryInterface{
    public function create(array $data){
        return OrderDetail::create($data);
    } 
}