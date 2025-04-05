<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Gloudemans\Shoppingcart\Facades\Cart;
use App\Repositories\Admin\Interfaces\ProductRepositoryInterface;
use App\Repositories\Interfaces\CartRepositoryInterface;
class CartControllerApi extends Controller
{
    protected $cartRepository;
    protected $productRepository;
    public function __construct(CartRepositoryInterface $cartRepository, ProductRepositoryInterface $productRepository)
    {
        $this->cartRepository = $cartRepository;
        $this->productRepository = $productRepository;
    }

    public function getCart(){
        // $items = Cart::content() ->map(function($item){
        //     return [
        //         'id' => $item->rowId,
        //         'name'  => $item->name,
        //         'qty' => $item->qty,
        //         'subtotal' => $item->subtotal,
        //         'image' => $item->options->img ?? 'default.jpg',
        //     ];
        // });
        $items = Cart::content();        
        return response()->json([
            'cartItems' => $items,
            'total' => Cart::subtotal(0, ',', '.'),
            'count' => Cart::count()
        ]);
    }
    public function addToCart($id)
    {
        $product = $this->productRepository->findById($id);
        $this->cartRepository->add($product);
        $data['count'] = Cart::count();
        $data['subtotal'] = Cart::subtotal(0, ',', '.');
        return response()->json([
            'cart_count' => $data['count'],
            'cart_total' => $data['subtotal'],
            'code' => 200,
            'message' => 'Thêm sản phẩm vào giỏ hàng thành công !',
        ], 200);
    }
}
