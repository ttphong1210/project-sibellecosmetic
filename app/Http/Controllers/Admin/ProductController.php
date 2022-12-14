<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use App\Http\Requests\AddProductRequest;
use App\Models\Brand;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    
    public function getProduct(){
        $data['productlist'] = DB::table('products')
                ->join('categories','products.prod_cate','=','categories.cate_id')
                ->join('brands','products.prod_brand', '=','brands.brand_id')
                ->orderBy('prod_id','desc')
                ->get();
                
        return view('admin.layout.product.listproduct',$data);
    }

    public function getAddProduct(){
        $data['catelist'] = Category::all();
        $data['brandlist'] = Brand::all();
        return view('admin.layout.product.addproduct',$data);
    }

    public function postAddProduct(AddProductRequest $request){
        $filename = $request->file('img')->getClientOriginalName();
        $destination_path = 'public/avatar';
        $fileupload = $request->file('img')->getClientOriginalName();
        $multiple_path = 'public/gallery';
       
        $product = new Product;
        $product->prod_name = $request->name;
        $product->prod_slug = Str::slug($request->name);
        $product->prod_price = $request->price;
        $product->prod_img = $filename;
        $product->prod_status = $request->status;
        $product->prod_summary= $request->summary;
        $product->prod_des = $request->description;
        $product->prod_promotion = $request->promotion;
        $product->prod_cate = $request->cate;
        $product->prod_brand = $request->brand;
        $product->prod_featured = $request->featured;
        $product->save();
        $path = $request->file('img')->storeAs($destination_path, $filename);
        return back()->with('status','Add Product Successfull');
    }

    public function getEditProduct($id){
        $data['product'] = Product::find($id);
        $data['listcate'] = Category::all();
        $data['listbrand'] = Brand::all();

        return view('admin.layout.product.editproduct',$data);
    }

    public function postEditProduct(Request $request,$id){
        $product = Product::find($id);

        $product->prod_name = $request->name; 
        $product->prod_slug = Str::slug($request->name);
        $product->prod_price = $request->price;  
        $product->prod_status = $request->status;
        $product->prod_summary = $request->edit_summary;
        $product->prod_des = $request->edit_description;
        $product->prod_promotion = $request->promotion;
        $product->prod_cate = $request->cate;   
        $product->prod_brand = $request->brand;
        $product->prod_featured = $request->featured;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = $image->getClientOriginalName();
            $path = $image->storeAs('public/avatar',$filename);
            $product->prod_img = $request->file('image')->getClientOriginalName();
            // $destination_path = 'public/avatar';
            // $path = $request->file('img')->storeAs($destination_path,$img);
        }  
        // dd($product);
        $product->update();
        return redirect('admin/product');
        // $product::where('prod_id',$id)->update($product);
        // return redirect('admin/product');
    }

    public function getDeleteProduct($id){
       Product::destroy($id);
       return back();
    }
}
