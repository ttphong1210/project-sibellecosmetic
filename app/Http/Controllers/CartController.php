<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
// use Cart;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{

    public function getAddCart($id){

        $product = Product::find($id);        
        Cart::add(['id' => $product->prod_id, 'name' => $product->prod_name, 'qty' => 1, 'price' => $product->prod_price, 'weight' => 0 ,'options' => ['img' => $product->prod_img]]);
        $data['count'] = Cart::count();
        $miniCart = view('frontend.component.mini_cart', $data)->render();
        return response()->json([
            'count' => $data['count'],
            'mini_cart' => $miniCart,
            'code' => 200,
            'message' => 'Thêm sản phẩm vào giỏ hàng thành công !',
            'error' => 'Lỗi thêm sản phẩm vào giỏ hàng không thành công !'
        ], 200 );

       
    }

    public function getShowCart(){
        $data['total'] = Cart::subtotal(0,',','.');
        $data['items'] = Cart::content();

        return view('frontend.shoppingcart', $data);
    }

    public function getDeleteCart($id){
        Cart::remove($id);
        return back();

    }
    public function getUpdateCart(Request $request){
        Cart::update($request->rowId, $request->qty);
        $data['items'] = Cart::content();
        $data['total'] = Cart::total();
        $data['count'] = Cart::count();
        $cartComponent = view('frontend.component.shopping_cart_component', $data)->render();
        $miniCart = view('frontend.component.mini_cart', $data)->render();
        return response()->json([
            'cart_component' => $cartComponent,
            'mini_cart' => $miniCart,
            'code' => 200,
            'message' => 'Cập nhật số lượng thành công !',
            'error' => 'Lỗi cập nhật số lượng không thành công !'
        ], 200);
    }

    public function getComplete(){
        return view('frontend.success');

    }
}