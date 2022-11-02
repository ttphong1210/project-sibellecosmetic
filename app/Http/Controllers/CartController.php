<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
// use Cart;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Mail;

class CartController extends Controller
{
    
    public function getAddCart($id){
         $product = Product::find($id);
         Cart::add(['id' => $product->prod_id, 'name' => $product->prod_name, 'qty' => 1, 'price' => $product->prod_price, 'weight' => 0 ,'options' => ['img' => $product->prod_img]]);

        return redirect()-> back()->with('success','Thêm sản phẩm vào giỏ hàng thành công !');
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
    }

    public function getComplete(){
        return view('frontend.success');

    }
}
