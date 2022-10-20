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
use Symfony\Component\VarDumper\Cloner\Data;

class FrontEndController extends Controller
{
    public function getHome(){
        $data['cartInfo'] = Cart::content();
        // $data['categories'] = Category::orderBy('cate_id','desc')->get();
        $data['categories'] = Category::all();
        $data['featured'] = Product::where('prod_featured',1)->orderBy('prod_id','desc')->get();
        $data['new'] = Product::orderBy('prod_id','desc')->take(4)->get();
        $data['suggested'] = Product::all()->take(8);
        //dd($data);
        return view('frontend.home',$data);    
    }

    public function getProduct(){
        
        $data['category'] = Category::all();
        $data['brand'] = Brand::all();
   
        if(isset($_GET['sort_by'])){
           $sort_by = $_GET['sort_by'];

           if($sort_by == 'gia_tang_dan'){

            $data['product'] = DB::table('products')->orderBy('prod_price','ASC')->paginate(9)->appends(request()->query());
           
        }elseif($sort_by == 'gia_giam_dan'){
            $data['product'] = DB::table('products')->orderBy('prod_price','DESC')->paginate(9)->appends(request()->query());
        
        };

        }else{
            $data['product'] = Product::paginate(9);
        };

        return view('frontend.product',$data);
    }

    public function getDetail($id){        
        $data['item'] = Product::find($id);
    
        $data['cateName'] = Product::where('prod_id',$id)
                                    ->join('categories','products.prod_cate','=','categories.cate_id')
                                    ->get();
        $data['product'] = Product::all();

      // dd($data);
    
        return view('frontend.productdetail',$data);
    }

    public function getCategory($id){
        // $data['brand'] = Brand::all();
        $data['cateName'] = Category::find($id);

        if(isset($_GET['sort_by'])){
            $sort_by = $_GET['sort_by'];
            
            if($sort_by == 'gia_tang_dan'){
                $data['items'] = Product::where('prod_cate',$id)->orderBy('prod_price','ASC')->paginate(9)->appends(request()->query());
            
            }elseif($sort_by == 'gia_giam_dan'){
                $data['items'] = Product::where('prod_cate',$id)->orderBy('prod_price','DESC')->paginate(9)->appends(request()->query());
            }

        }else{
            $data['items'] = Product::where('prod_cate',$id)->orderBy('prod_id','desc')->paginate(9);
        }


        return view('frontend.category',$data);
    }

    public function getBrand($id){
        $data['brandName'] = Brand::find($id);

        if(isset($_GET['sort_by'])){
            $sort_by = $_GET['sort_by'];
            
            if($sort_by == 'gia_tang_dan'){
                $data['items'] = Product::where('prod_brand',$id)->orderBy('prod_price','ASC')->paginate(9)->appends(request()->query());
            }elseif($sort_by == 'gia_giam_dan'){
                $data['items'] = Product::where('prod_brand',$id)->orderBy('prod_price','DESC')->paginate(9)->appends(request()->query());
            }
        }else{
            $data['items'] = Product::where('prod_brand',$id)->orderBy('prod_id','desc')->paginate(9);
        }

        return view('frontend.brand',$data);
    }

    public function getSearch(Request $request){
        $result = $request->result;
        $data['keyword'] = $result;
        $result = str_replace(' ','%', $result);
        $data['items'] = Product::where('prod_name','like','%'.$result.'%')->paginate(9);
        
        return view('frontend.search',$data);
    }

    
}
