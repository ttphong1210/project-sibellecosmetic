<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Product;
// use DB;
use Illuminate\Support\Facades\DB;
use App\Models\Brand;
use CKSource\CKFinder\Command\Proxy;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;
use Symfony\Component\VarDumper\Cloner\Data;

use function Psy\debug;

class FrontEndController extends Controller
{
    public function getHome()
    {
        $data['cartInfo'] = Cart::content();
        // $data['categories'] = Category::orderBy('cate_id','desc')->get();
        $data['categories'] = Category::all();
        $data['featured'] = Product::where('prod_featured', 1)->orderBy('prod_id', 'desc')->get();
        $data['new'] = Product::orderBy('prod_id', 'desc')->take(4)->get();
        $data['suggested'] = Product::inRandomOrder()->take(8)->get();
        //dd($data);
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
        $data['product'] = Product::all();

        return view('frontend.productdetail', $data);
    }

    public function getCategory($id)
    {
        // $data['brand'] = Brand::all();
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
    public function add_product_favorite(Request $request)
    {
        $data = $request->all();
        $product_id = $data['product_favorite_id'];
        $product_favorite = @Session::get('favorite');
        
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
        }
        else{
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
}
