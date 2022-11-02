<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use Illuminate\Support\Facades\Route;

Route::get('contact', function () {
    return view('frontend.contact');
})->name('contact');

// Route Front end

Route::get('/', 'FrontEndController@getHome')->name('home');
Route::get('product', 'FrontEndController@getProduct')->name('product');
Route::get('detail/{id}/{slug}.html', 'FrontEndController@getDetail');
Route::get('category/{id}/{slug}.html', 'FrontEndController@getCategory');
Route::get('brand/{id}/{slug}.html', 'FrontEndController@getBrand');
Route::get('search', 'FrontEndController@getSearch');

// Route Cart
Route::group(['prefix' => 'cart'], function () {
    Route::get('add/{id}', 'CartController@getAddCart');

    Route::get('show', 'CartController@getShowCart');
    Route::get('delete/{id}', 'CartController@getDeleteCart');
    Route::get('update', 'CartController@getUpdateCart');
    // Route::post('show','CartController@postComplete');
});
Route::get('complete', 'CartController@getComplete');
Route::get('checkout', 'CheckOutController@getCheckout');
Route::post('checkout', 'CheckOutController@postCheckout');
Route::post('select-shipping-infomation','CheckOutController@select_shipping_infomation');
Route::post('charge-shipping','CheckOutController@charge_shipping');
Route::get('delete-feeship','CheckOutController@delete_feeship');


// Account Customer
Route::group(['prefix' => 'account'], function () {
    Route::get('login_customer', 'AccountCustomerController@getLoginCus');
    Route::post('login_customer', 'AccountCustomerController@postLoginCus');
    Route::get('register', 'AccountCustomerController@getAddAcc');
    Route::post('register', 'AccountCustomerController@postAddAcc');
    Route::get('logout_customer', 'AccountCustomerController@getLogOutCus');
});

// Route Admin
Route::group(['namespace' => 'Admin'], function () {
    Route::group(['prefix' => 'login', 'middleware' => 'CheckLogedIn'], function () {
        Route::get('/', 'LoginController@getLogin');
        Route::post('/', 'LoginController@postLogin')->name('login');
    });
    Route::get('logout', 'HomeController@getLogout');

    Route::group(['prefix' => 'admin', 'middleware' => 'CheckLogedOut'], function () {
        Route::get('home', 'HomeController@getHome');
        Route::group(['prefix' => 'category'], function () {
            Route::get('/', 'CategoryController@getCate');

            Route::get('add', 'CategoryController@getAddCate');
            Route::post('add', 'CategoryController@postAddCate');

            Route::get('edit/{id}', 'CategoryController@getEditCate');
            Route::post('edit/{id}', 'CategoryController@postEditCate');

            Route::get('delete/{id}', 'CategoryController@getDeleteCate');
        });

        Route::group(['prefix' => 'brand'], function () {
            Route::get('/', 'BrandController@getBrand');

            Route::get('add', 'BrandController@getAddBrand');
            Route::post('add', 'BrandController@postAddBrand');

            Route::get('edit/{id}', 'BrandController@getEditBrand');
            Route::post('edit/{id}', 'BrandController@postEditBrand');

            Route::get('delete/{id}', 'BrandController@getDeleteBrand');
        });

        Route::group(['prefix' => 'product'], function () {
            Route::get('/', 'ProductController@getProduct');

            Route::get('add', 'ProductController@getAddProduct');
            Route::post('add', 'ProductController@postAddProduct');

            Route::get('edit/{id}', 'ProductController@getEditProduct');
            Route::post('edit/{id}', 'ProductController@postEditProduct');

            Route::get('delete/{id}', 'ProductController@getDeleteProduct');
        });

        Route::group(['prefix' => 'order'], function () {
            Route::get('/', 'OrderController@getOrder');

            Route::get('edit/{id}', 'OrderController@getEditOrder');
            Route::post('edit/{id}', 'OrderController@postEditOrder');

            Route::get('delete-order/{id}', 'OrderController@getDeleteOrder');
            // Customer

            Route::get('customer', 'OrderController@getCustomer');
            Route::get('delete-customer/{id}', 'OrderController@getDeleteCustomer');
        });
        Route::group(['prefix' => 'delivery'], function () {
            Route::get('/', 'DeliveryController@getDelivery');
            Route::post('select-delivery', 'DeliveryController@postSelectDelivery');
            Route::post('add-delivery', 'DeliveryController@postAddDelivery');
            Route::post('update-delivery', 'DeliveryController@postEditDelivery');
        });
    });
});
