<?php

use App\Http\Controllers\Api\CategoryControllerApi;
use App\Http\Controllers\Api\ProductControllerApi;
use App\Models\Product;
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
// Route::middleware('cors')->group(function () {
//     // Các route cần CORS
//     Route::get('product', [ProductControllerApi::class, 'getAllProduct']);
// });
Route::middleware('cors')->group(function(){
    //Product
    Route::get('product', [ProductControllerApi::class, 'getAllProduct']);
    Route::get('product/{id}', [ProductControllerApi::class, 'getEditProduct']);
    //Category
    Route::get('category', [CategoryControllerApi::class, 'getCategory']);
    Route::post('category', [CategoryControllerApi::class, 'postCategory']);
    Route::get('category/{id}', [CategoryControllerApi::class, 'getEditCategory']);



});


