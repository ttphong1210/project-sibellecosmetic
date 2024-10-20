<?php

namespace App\Providers;

use App\Models\Brand;
use App\Models\Category;
use App\Repositories\AccountCustomer\AccountCustomerRepository;
use App\Repositories\AccountCustomer\AccountCustomerRepositoryInterface;
use App\Repositories\Admin\Eloquent\AccountAdminRepository;
use App\Repositories\Admin\Eloquent\BlogPostRepository;
use App\Repositories\Admin\Eloquent\BrandRepository;
use App\Repositories\Admin\Eloquent\CategoryRepository;
use App\Repositories\Admin\Eloquent\ProductRepository;
use App\Repositories\Admin\Interfaces\AccountAdminRepositoryInterface;
use App\Repositories\Admin\Interfaces\BlogPostRepositoryInterface;
use App\Repositories\Admin\Interfaces\BrandRepositoryInterface;
use App\Repositories\Admin\Interfaces\CategoryRepositoryInterface;
use App\Repositories\Admin\Interfaces\ProductRepositoryInterface;
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
        $this->app->bind(BrandRepositoryInterface::class, BrandRepository::class);
        $this->app->bind(BlogPostRepositoryInterface::class, BlogPostRepository::class);
        $this->app->bind(CategoryRepositoryInterface::class, CategoryRepository::class);
        $this->app->bind(ProductRepositoryInterface::class, ProductRepository::class);
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
