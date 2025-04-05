<?php

namespace App\Http\Controllers;

use App\Models\BlogPost;
use App\Models\Slider;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Comment;
use Illuminate\Support\Facades\DB;
use App\Models\Brand;
use App\Models\Order;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Session;

class FrontEndController extends Controller
{
    public function getHome()
    {
        $data['sliders'] = Slider::orderBy('id', 'DESC')->where('status', '1')->take(4)->get();
        $data['cartInfo'] = Cart::content();
        $data['categories'] = Category::all();
        $data['featured'] = Product::where('prod_featured', 1)->orderBy('prod_id', 'desc')->get();
        $data['new'] = Product::orderBy('prod_id', 'desc')->take(4)->get();
        $data['suggested'] = Product::inRandomOrder()->take(8)->get();
        $data['blogs'] = BlogPost::all();
        return view('frontend.home', $data);
    }
    public function getProduct()
    {
        $data['category'] = Category::all();
        $data['brand'] = Brand::all();

        if (isset($_GET['sort_by'])) {
            $sort_by = $_GET['sort_by'];
            if ($sort_by == 'gia_tang_dan') {
                $data['product'] = DB::table('products')->orderBy('prod_price', 'ASC')->paginate(9)->appends(request()->query());
            } elseif ($sort_by == 'gia_giam_dan') {
                $data['product'] = DB::table('products')->orderBy('prod_price', 'DESC')->paginate(9)->appends(request()->query());
            };
        } else {
            $data['product'] = Product::orderBy('prod_id', 'desc')->paginate(9);
        };
        return view('frontend.product', $data);
    }
    public function getDetail($id)
    {
        $data['item'] = Product::find($id);
        $data['cateName'] = Product::where('prod_id', $id)
            ->join('categories', 'products.prod_cate', '=', 'categories.cate_id')
            ->get();
        $data['product'] = Product::inRandomOrder()->get();
        $data['comments'] = Comment::where('comment_product_id', $id)->orderBy('created_at', 'desc')->get();

        return view('frontend.productdetail', $data);
    }

    public function getCategory($id)
    {
        $data['cateName'] = Category::find($id);

        if (isset($_GET['sort_by'])) {
            $sort_by = $_GET['sort_by'];

            if ($sort_by == 'gia_tang_dan') {
                $data['items'] = Product::where('prod_cate', $id)->orderBy('prod_price', 'ASC')->paginate(9)->appends(request()->query());
            } elseif ($sort_by == 'gia_giam_dan') {
                $data['items'] = Product::where('prod_cate', $id)->orderBy('prod_price', 'DESC')->paginate(9)->appends(request()->query());
            }
        } else {
            $data['items'] = Product::where('prod_cate', $id)->orderBy('prod_id', 'desc')->paginate(9);
        }
        return view('frontend.category', $data);
    }
    public function getBrand($id)
    {
        $data['brandName'] = Brand::find($id);
        if (isset($_GET['sort_by'])) {
            $sort_by = $_GET['sort_by'];

            if ($sort_by == 'gia_tang_dan') {
                $data['items'] = Product::where('prod_brand', $id)->orderBy('prod_price', 'ASC')->paginate(9)->appends(request()->query());
            } elseif ($sort_by == 'gia_giam_dan') {
                $data['items'] = Product::where('prod_brand', $id)->orderBy('prod_price', 'DESC')->paginate(9)->appends(request()->query());
            }
        } else {
            $data['items'] = Product::where('prod_brand', $id)->orderBy('prod_id', 'desc')->paginate(9);
        }
        return view('frontend.brand', $data);
    }
    public function getSearch(Request $request)
    {
        $result = $request->result;
        $data['keyword'] = $result;
        $result = str_replace(' ', '%', $result);
        $data['items'] = Product::where('prod_name', 'like', '%' . $result . '%')->paginate(9);

        return view('frontend.search', $data);
    }

    public function getFavorite()
    {
        return view('frontend.favorite');
    }
    public function postAddProductFavorite(Request $request)
    {
        //regex sql 
        $data = $request->all();
        $product_id = $data['product_favorite_id'];
        $product_favorite = Session::get('favorite');

        if (isset($product_favorite)) {
            if (empty($product_favorite[$product_id])) {
                $product_favorite[$product_id] = array(
                    'product_id' => $data['product_favorite_id'],
                    'product_name' => $data['product_favorite_name'],
                    'product_image' => $data['product_favorite_image'],
                    'product_price' => $data['product_favorite_price'],
                );
                Session::put('favorite', $product_favorite);
                return response()->json(['action' => 'add', 'message' => 'Thêm sản phẩm vào yêu thích !']);
            } else {
                unset($product_favorite[$product_id]);
                Session::put('favorite', $product_favorite);
                return response()->json(['action' => 'remove', 'message' => 'Xoá sản phẩm khỏi yêu thích !']);
            }
            Session::save();
            die();
        } else {
            $product_favorite[$product_id] = array(
                'product_id' => $data['product_favorite_id'],
                'product_name' => $data['product_favorite_name'],
                'product_image' => $data['product_favorite_image'],
                'product_price' => $data['product_favorite_price'],
            );
            Session::put('favorite', $product_favorite);
            return response()->json(['action' => 'add', 'message' => 'Thêm sản phẩm vào yêu thích !']);
            Session::save();
        }
    }

    public function getBlog()
    {
        return view('frontend.blog');
    }
    public function getDetailBlog(){
        return view('frontend.single_blog');
    }
    public function getTrackOrder(){
        return view('frontend.track_order');
    }
    public function postTrackOrder(Request $request){
        $order_code = $request->order_code;
        $order = Order::where('order_code', $order_code)->first();
        if (!$order) {
            return response()->json([
                'messageError' => 'Không tìm thấy đơn hàng!',
            ], 404);
        }
        return response()->json([
            'order_code' => $order->order_code,
            'messageSuccess' =>  'Ok, chờ xíu nhé !',
        ]);
    }
    public function getDetailTrackingOrder(Request $request){
        $order_code = $request->query('order_code');
        $order = Order::where('order_code', $order_code)->with('orderDetails','customer')->first();
        return view('frontend.details_tracking_order', compact('order'));
    }

    public function postAddComments(Request $request){
        // $product_id = $request->input('product_id');
        $comment_content = $request->input('comment_content');

        // $data = $request->all();
        dd($comment_content);
        return response()->json([
            'message' => 'Nhận xét đã được gửi thành công.',
        ]);
    }
    public function getLoadComments(Request $request){
        $product_id = $request->query('product_id');
        $comment = Comment::where('comment_product_id', $product_id)->get();

    }
    
}
