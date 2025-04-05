<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Repositories\Admin\Interfaces\ProductRepositoryInterface;
use App\Repositories\Interfaces\CartRepositoryInterface;
use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;


class CartController extends Controller
{
    protected $cartRepository;
    protected $productRepository;
    public function __construct(CartRepositoryInterface $cartRepository, ProductRepositoryInterface $productRepository)
    {
        $this->cartRepository = $cartRepository;
        $this->productRepository = $productRepository;
    }

    public function getAddCart($id)
    {
        $product = $this->productRepository->findById($id);
        $this->cartRepository->add($product);
        $data['count'] = Cart::count();
        $data['subtotal'] = Cart::subtotal(0, ',', '.');
        $miniCart = view('frontend.component.mini_cart', $data)->render();
        return response()->json([
            'count' => $data['count'],
            'mini_cart' => $miniCart,
            'code' => 200,
            'message' => 'Thêm sản phẩm vào giỏ hàng thành công !',
            'error' => 'Lỗi thêm sản phẩm vào giỏ hàng không thành công !'
        ], 200);
    }
    public function getShowCart()
    {
        $data = $this->cartRepository->show();
        return view('frontend.shoppingcart', $data);
    }

    public function getUpdateCart(Request $request)
    {
        $this->cartRepository->update($request->rowId, $request->qty);
        $data['items'] = $this->cartRepository->content();
        $data['total'] = $this->cartRepository->total();
        $data['count'] = $this->cartRepository->count();
        $cartComponent = view('frontend.component.shopping_cart_component', $data)->render();
        $miniCart = view('frontend.component.mini_cart', $data)->render();

        return response()->json([
            'cart_component' => $cartComponent,
            'mini_cart' => $miniCart,
            'count_item_cart' => $data['count'],
            'code' => 200,
            'message' => 'Cập nhật số lượng thành công !',
            'error' => 'Lỗi cập nhật số lượng không thành công !'
        ], 200);
    }

    public function getDeleteCart($id)
    {
        $this->cartRepository->delete($id);
        $data['count'] = $this->cartRepository->count();
        $data['items'] = $this->cartRepository->content();
        $data['total'] = $this->cartRepository->total();
        $cartComponent = view('frontend.component.shopping_cart_component', $data)->render();
        $miniCart = view('frontend.component.mini_cart', $data)->render();
        return response()->json([
            'code' => 200,
            'message' => 'Sản phẩm đã được xoá khỏi giỏ hàng.',
            'cart_component' => $cartComponent,
            'mini_cart' => $miniCart,
            'count_item_cart' => $data['count'],
        ], 200);
    }
    public function getComplete()
    {
        return view('frontend.success');
    }
}
