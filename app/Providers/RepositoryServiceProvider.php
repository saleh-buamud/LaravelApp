<?php

namespace App\Providers;

use App\Repositories\Contracts\CategoryRepositoryInterface;
use App\Repositories\Contracts\OrderRepositoryInterface;
use App\Repositories\Contracts\ProductRepositoryInterface;
use App\Repositories\Contracts\SubCategoryRepositoryInterface;
use App\Repositories\CategoryRepository;
use App\Repositories\OrderRepository;
use App\Repositories\ProductRepository;
use App\Repositories\SubCategoryRepository;
use App\Services\Contracts\CategoryServiceInterface;
use App\Services\Contracts\OrderServiceInterface;
use App\Services\Contracts\ProductServiceInterface;
use App\Services\Contracts\SubCategoryServiceInterface;
use App\Services\CategoryService;
use App\Services\OrderService;
use App\Services\ProductService;
use App\Services\SubCategoryService;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        // Repository bindings
        $this->app->bind(ProductRepositoryInterface::class, ProductRepository::class);
        $this->app->bind(OrderRepositoryInterface::class, OrderRepository::class);
        $this->app->bind(CategoryRepositoryInterface::class, CategoryRepository::class);
        $this->app->bind(SubCategoryRepositoryInterface::class, SubCategoryRepository::class);

        // Service bindings
        $this->app->bind(ProductServiceInterface::class, ProductService::class);
        $this->app->bind(OrderServiceInterface::class, OrderService::class);
        $this->app->bind(CategoryServiceInterface::class, CategoryService::class);
        $this->app->bind(SubCategoryServiceInterface::class, SubCategoryService::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
