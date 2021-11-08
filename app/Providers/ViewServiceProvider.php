<?php

namespace App\Providers;

use App\Models\Products;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register()
    {
    }

    /**
     * Bootstrap services.
     */
    public function boot()
    {
        View::composer('index', function ($view) {
            $hotPtoducts = Products::orderBy('hits','desc')->take(26)->get();
            $view->with('hotProducts', $hotPtoducts);
        });
    }
}
