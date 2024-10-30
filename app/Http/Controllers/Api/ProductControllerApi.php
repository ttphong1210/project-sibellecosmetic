<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Response;

class ProductControllerApi extends Controller
{
    // Trong controller hoặc middleware của Laravel
    public function __construct()
    {
        $this->middleware('cors');
    }

    public function getAllProduct()
    {
        $product = Product::all();
        return response()->json($product, Response::HTTP_OK);
    }
    public function getProductFeatured(){
        $featured = Product::where('prod_featured', 1)->orderBy('prod_id', 'desc')->get();
        return response()->json($featured, Response::HTTP_OK);
    }
    
    public function getEditProduct($id)
    {
        $edit_product = Product::find($id);
        if ($edit_product) {
            return $edit_product;
        }
        return response([
            'status_code' => 404,
            'message' => 'Product Not Found'
        ]);
    }
}
