<?php

namespace App\Repositories\Interfaces;

interface CartRepositoryInterface{
    public function add($product);
    public function show();
    public function delete($rowId);
    public function update($rowId, $qty);
    public function count();
    public function subtotal();
    public function total();
    public function content();
}