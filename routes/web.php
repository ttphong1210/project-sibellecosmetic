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

use App\Http\Controllers\Api\CheckOutControllerApi;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;

Route::get('welcome', function () {
    return view('frontend.welcome');
});
Route::get('/clear-cache', function () {
    Artisan::call('cache:clear');
    return 'Application cache has been cleared';
});

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
Route::get('favorite', 'FrontEndController@getFavorite');
Route::post('add-product-favorite', 'FrontEndController@postAddProductFavorite');
Route::get('tracking-order', 'FrontEndController@getTrackOrder');
Route::post('tracking-order', 'FrontEndController@postTrackOrder');
Route::get('detail-tracking-order', 'FrontEndController@getDetailTrackingOrder');

Route::get('email', 'FrontEndController@getEmail');
Route::get('load-comments', 'FrontEndController@getLoadComments');
Route::post('add-comments', 'FrontEndController@postAddComments');


Route::group(['prefix' => 'blog'], function () {
    Route::get('/', 'FrontendController@getBlog');
    // Route::get('blog/{id}/{slug}.html', 'FrontendController@getDetailBlog');
    Route::get('blog-id', 'FrontendController@getDetailBlog');


    // Route::get('kien-thuc', 'FrontendController@getBlogKThuc');
});

// Route Cart
Route::group(['prefix' => 'cart'], function () {
    Route::get('add/{id}', 'CartController@getAddCart');
    Route::get('show', 'CartController@getShowCart');
    Route::delete('delete/{id}', 'CartController@getDeleteCart');
    Route::get('update', 'CartController@getUpdateCart');
});
Route::get('complete', 'CartController@getComplete');
Route::get('checkout', 'CheckOutController@getCheckout');
Route::post('checkout', 'CheckOutController@postCheckout')->name('checkout.post');
Route::post('select-shipping-infomation', 'CheckOutController@postSelectShippingInfomation');
Route::post('charge-shipping', 'CheckOutController@postChargeShipping');
Route::get('delete-feeship', 'CheckOutController@getDeleteFeeship');


// Account Customer
Route::group(['prefix' => 'account'], function () {
    Route::get('register-customer', 'AccountCustomerController@getRegisterCustomer');
    Route::post('register-customer', 'AccountCustomerController@postRegisterCustomer');
    Route::get('login-customer', 'AccountCustomerController@getLoginCustomer');
    Route::post('login-customer', 'AccountCustomerController@postLoginCustomer');
    Route::get('forgot-password', 'AccountCustomerController@getForgotPassword');
    Route::post('reset-password', 'AccountCustomerController@postResetPassword');
    Route::get('update-new-password', 'AccountCustomerController@getUpdateNewPassword');
    Route::post('update-new-password', 'AccountCustomerController@postUpdateNewPassword');


    Route::get('logout-customer', 'AccountCustomerController@getLogOutCustomer');
});

// Route Admin
Route::group(['namespace' => 'Admin'], function () {
    Route::group(['prefix' => 'admin', 'middleware' => 'CheckLogedOut'], function () {
        // Route::get('home', 'HomeController@getHome');
        Route::get('/home', 'DashboardController@index');
        Route::get('profile-user', 'DashboardController@getProfileUser');

        Route::group(['prefix' => 'user', 'middleware' => 'roles'], function () {
            Route::get('all-user', 'UserController@getAllUser');
            Route::post('assign-role', 'UserController@postAssignRole');
            Route::get('delete-user/{id}', 'UserController@getDeleteUser');
        });
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

        Route::group(['prefix' => 'product', 'middleware' => 'roles'], function () {
            Route::get('/', 'ProductController@getProduct');

            Route::get('add', 'ProductController@getAddProduct');
            Route::post('add', 'ProductController@postAddProduct');

            Route::get('edit/{id}', 'ProductController@getEditProduct');
            Route::post('edit/{id}', 'ProductController@postEditProduct');

            Route::get('delete/{id}', 'ProductController@getDeleteProduct');

            Route::get('search', 'ProductController@getSearch');
        });

        Route::group(['prefix' => 'order'], function () {
            Route::get('/', 'OrderController@getOrder');

            Route::get('edit/{id}', 'OrderController@getEditOrder');
            Route::post('edit/{id}', 'OrderController@postEditOrder');

            Route::get('delete-order/{id}', 'OrderController@getDeleteOrder');
            // Customer

            Route::get('customer', 'OrderController@getCustomer');
            Route::get('customer/delete-customer/{id}', 'OrderController@getDeleteCustomer');
        });
        Route::group(['prefix' => 'delivery'], function () {
            Route::get('/', 'DeliveryController@getDelivery');
            Route::post('select-delivery', 'DeliveryController@postSelectDelivery');
            Route::post('add-delivery', 'DeliveryController@postAddDelivery');
            Route::post('update-delivery', 'DeliveryController@postEditDelivery');
        });

        // Route slider banner
        Route::group(['prefix' => 'slider'], function () {
            Route::get('/', 'SliderController@getSlider');
            Route::get('add-slider', 'SliderController@getAddSlider');
            Route::post('add-slider', 'SliderController@postAddSlider');
            Route::post('update-status-slider', 'SliderController@postUpdateStatusSlider');
        });

        //Route blog post
        Route::group(['prefix' => 'blog'], function () {
            Route::get('/', 'BlogPostController@getAllBlog');
            Route::get('add-blog', 'BlogPostController@getAddBlog');
            Route::post('add-blog', 'BlogPostController@postAddBlog');
            Route::get('edit-blog/{id}', 'BlogPostController@getEditBlog');
            Route::post('edit-blog/{id}', 'BlogPostController@postEditBlog');
            Route::get('delete/{id}', 'BlogPostController@getDeleteBlog');
        });
    });
});

//Authentication Route
Route::get('register-auth', 'AccountController@getRegisterAuth');
Route::post('register-auth', 'AccountController@postRegisterAuth');
Route::get('login-auth', 'AccountController@getLoginAuth');
Route::post('login-auth', 'AccountController@postLoginAuth');
Route::get('logout-auth', 'AccountController@getLogOutAuth');
Route::get('forgot-password-auth', 'AccountController@getForgotPassword');
Route::post('forgot-password-auth', 'AccountController@postResetPassword');
Route::get('update-password-auth', 'AccountController@getUpdateNewPassword');
Route::post('update-password-auth', 'AccountController@postUpdateNewPassword');
