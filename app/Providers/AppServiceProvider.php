<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Product;
use App\Category;
use App\PayMent;
use App\Status;
use App\Attribute;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        View::share('products',Product::paginate(9));
        View::share('categories',Category::all());
        View::share('payments',PayMent::all());
        View::share('statuses',Status::all());
        View::share('attributes',Attribute::all());
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
