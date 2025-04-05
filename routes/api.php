<?php

use App\Http\Controllers\Api\BrandControllerApi;
use App\Http\Controllers\Api\CartControllerApi;
use App\Http\Controllers\Api\CategoryControllerApi;
use App\Http\Controllers\Api\CheckOutControllerApi;
use App\Http\Controllers\Api\ProductControllerApi;
use App\Http\Controllers\Api\SliderControllerApi;
use App\Http\Controllers\Api\TrackingOrderControllerApi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// Route::middleware('cors')->group(function(){
    Route::middleware('cors')->group(function(){

    //Product page user
    Route::get('product', [ProductControllerApi::class, 'getAllProduct']);
    Route::get('productfeatured', [ProductControllerApi::class, 'getProductFeatured']);
    Route::get('productnew', [ProductControllerApi::class, 'getNewProduct']);
    Route::get('productsuggested', [ProductControllerApi::class, 'getSuggestedProduct']);
    Route::get('detail/{id}', [ProductControllerApi::class, 'getProductDetail']);
    Route::get('products/category/{id}', [ProductControllerApi::class, 'getProductWithCategory']);
    Route::get('products/brand/{id}', [ProductControllerApi::class, 'getProductWithBrand']);
    Route::get('search', [ProductControllerApi::class, 'getSearchProduct']);

    //Category
    Route::get('category', [CategoryControllerApi::class, 'getCategory']);
    Route::post('category', [CategoryControllerApi::class, 'postCategory']);
    Route::get('category/{id}', [CategoryControllerApi::class, 'getEditCategory']);

    //Brand
    Route::get('brand', [BrandControllerApi::class, 'getBrand']);

    //Slider
    Route::get('slider', [SliderControllerApi::class, 'getSlider']);

    // Cart
    Route::group(['prefix' => 'cart'], function () {
        Route::get('/', [CartControllerApi::class, 'getCart']);
        Route::get('add/{id}', [CartControllerApi::class, 'addToCart']);
    });
    
    // CheckOut
    Route::get('city', [CheckOutControllerApi::class, 'getCityApi']);
    Route::post('select-shipping-information', [CheckOutControllerApi::class, 'postSelectShippingInformationApi']);
    Route::options('select-shipping-information', function () {
        return response()->json([], 200);
    });
    Route::post('charge-shipping', [CheckOutControllerApi::class, 'calculateShipping']);
    Route::options('charge-shipping', function(){
        return response()->json([], 200);
    });
    Route::post('checkout', [CheckOutControllerApi::class, 'actionPostCheckOut']);
    Route::options('checkout', function(){
        return response()->json([], 200);
    });

    //Tracking Order
    Route::post('tracking-order', [TrackingOrderControllerApi::class, 'postTrackingOrder']);
    Route::get('detail-tracking-order', [TrackingOrderControllerApi::class, 'detailTrackingOrder']);

});


