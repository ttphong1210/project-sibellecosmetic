<?php

namespace App\Providers;

use App\Models\Brand;
use App\Models\Category;
use App\Repositories\AccountCustomer\AccountCustomerRepository;
use App\Repositories\AccountCustomer\AccountCustomerRepositoryInterface;
use App\Repositories\Admin\Eloquent\AccountAdminRepository;
use App\Repositories\Admin\Interfaces\AccountAdminRepositoryInterface;
use App\Repositories\Eloquent\CartRepository;
use App\Repositories\Eloquent\CustomerRepository;
use App\Repositories\Eloquent\FeeShipRepository;
use App\Repositories\Eloquent\OrderDetailRepository;
use App\Repositories\Eloquent\OrderRepository;
use App\Repositories\Interfaces\CartRepositoryInterface;
use App\Repositories\Interfaces\CustomerRepositoryInterface;
use App\Repositories\Interfaces\FeeShipRepositoryInterface;
use App\Repositories\Interfaces\OrderDetailRepositoryInterface;
use App\Repositories\Interfaces\OrderRepositoryInterface;
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
        $this->app->bind(AccountAdminRepositoryInterface::class, AccountAdminRepository::class);
        $this->app->bind(AccountCustomerRepositoryInterface::class, AccountCustomerRepository::class);
        $this->app->bind(CartRepositoryInterface::class, CartRepository::class);
        $this->app->bind(CustomerRepositoryInterface::class, CustomerRepository::class);
        $this->app->bind(OrderRepositoryInterface::class, OrderRepository::class);
        $this->app->bind(OrderDetailRepositoryInterface::class, OrderDetailRepository::class);
        $this->app->bind(FeeShipRepositoryInterface::class, FeeShipRepository::class);
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
        
    }
}
