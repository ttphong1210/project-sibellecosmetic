<?php 
namespace App\Repositories\Eloquent;

use App\Repositories\EloquentRepository;
use App\Repositories\Interfaces\CartRepositoryInterface;
use Gloudemans\Shoppingcart\Facades\Cart;

class CartRepository implements CartRepositoryInterface{
    
    public function add($product){
        return Cart::add([
            'id' => $product->prod_id,
            'name' => $product->prod_name,
            'qty' => 1,
            'price' => $product->prod_price,
            'weight' => 0,
            'options' => ['img' => $product->prod_img]
        ]);
    }
    public function show(){
        return [
            'total' => Cart::total(0,',','.'),
            'items' => Cart::content()
        ];
    }
    public function delete($rowId){
        return Cart::remove($rowId);
    }
    public function update($rowId, $qty){
        return Cart::update($rowId, $qty);
    }
    public function count(){
        return Cart::count();
    }
    public function subtotal(){
        return Cart::subtotal(0,',','.');
    }
    public function total(){
        return Cart::total(0,',','.');
    }
    public function content(){
        return Cart::content();
    }
    

}