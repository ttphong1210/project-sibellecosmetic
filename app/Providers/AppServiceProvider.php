<?php

namespace App\Providers;

use App\Models\Brand;
use App\Models\Category;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        // Schema::defaultStringLength(191);
        $data['categories'] = Category::all();
        view()->share($data);

        $data['brands'] = Brand::all();
        view()->share($data);
        
        // $data['cartInfo'] = Cart::content();
        // view()->share($data);
    }
}
