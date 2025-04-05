<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Response;
use Products;

class ProductControllerApi extends Controller
{
    public function __construct()
    {
        $this->middleware('cors');
    }

    public function getAllProduct()
    {
        $product = Product::orderBy('prod_id', 'desc')->paginate(9);
        return response()->json($product, Response::HTTP_OK);
    }
    public function getProductFeatured()
    {
        $featured = Product::where('prod_featured', 1)->orderBy('prod_id', 'desc')->get();
        return response()->json($featured, Response::HTTP_OK);
    }

    public function getNewProduct()
    {
        $new = Product::orderBy('prod_id', 'desc')->take(4)->get();
        return response()->json($new, Response::HTTP_OK);
    }

    public function getSuggestedProduct()
    {
        $suggested = Product::inRandomOrder()->take(8)->get();
        return response()->json($suggested, Response::HTTP_OK);
    }

    public function getProductDetail($id)
    {
        $product = Product::find($id)
            ->where('prod_id', $id)
            ->join('categories', 'products.prod_cate', '=', 'categories.cate_id')
            ->first();
        $product->prod_gallery = explode('|', $product->prod_gallery);
        $randomProduct = Product::inRandomOrder()->limit(10)->get();

        return response()->json([
            'product' => $product,
            'randomProduct' => $randomProduct,
        ]);
    }

    public function getProductWithCategory(Request $request, $id){
        $category  = Category::where('cate_id',$id)->first();
        $categoryName = $category ? $category->cate_name : "";
        $query = Product::where('prod_cate', $id);

        if ($request->has('sort_by')) {
            $sort_by = $request->sort_by;
            if ($sort_by == 'gia_tang_dan') {
                $query->orderBy('prod_price', 'ASC');
            } elseif ($sort_by == 'gia_giam_dan') {
                $query->orderBy('prod_price', 'DESC');
            }
        } else {
            $query->orderBy('prod_id', 'DESC');
        }

        $productWithCategory = $query->paginate(9);

        return response()->json([
            'categoryName' => $categoryName,
            'productWithCategory' => $productWithCategory,
        ]);
    }

    public function getProductWithBrand( Request $request, $id){
        $brand  = Brand::where('brand_id',$id)->first();
        $brandName = $brand ? $brand->brand_name : "";
        $query = Product::where('prod_brand', $id);

        if ($request->has('sort_by')) {
            $sort_by = $request->sort_by;
            if ($sort_by == 'gia_tang_dan') {
                $query->orderBy('prod_price', 'ASC');
            } elseif ($sort_by == 'gia_giam_dan') {
                $query->orderBy('prod_price', 'DESC');
            }
        } else {
            $query->orderBy('prod_id', 'DESC');
        }

        $productWithBrand = $query->paginate(9);

        return response()->json([
            'brandName' => $brandName,
            'productWithBrand' => $productWithBrand,
        ]);
    }

    public function getSearchProduct(Request $request){
        $result = $request->input('result');
        $result = str_replace(' ', '%', $result);
        $item = Product::where('prod_name', 'like', '%' . $result . '%')->paginate(9);

        return response()->json([
            'item' => $item,
        ]);
    }
}
