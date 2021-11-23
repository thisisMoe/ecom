<?php

namespace App\Providers;

use App\Models\MainCategory;
use App\Models\Products;
use App\Models\ShoppingSession;
use App\Models\User;
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
            $hotPtoducts = Products::orderBy('hits','desc')->take(33)->get();
            $fpu1000 = Products::where('maxPrice', '<', 1000)->orderBy('hits','desc')->take(33)->get();
            $fpu5000 = Products::where('maxPrice', '<', 5000)->orderBy('hits','desc')->take(33)->get();
            $userCount = User::count();
            $confirmedOrders = ShoppingSession::where('orderStatus', '!=' ,'pending')->count();
            $view->with('hotProducts', $hotPtoducts)->with('userCount', $userCount)->with('confirmedOrders', $confirmedOrders)->with('fpu1000', $fpu1000)->with('fpu5000', $fpu5000);
        });

        View::composer('c', function ($view) {
            $hotPtoducts = Products::orderBy('hits','desc')->take(33)->get();
            $view->with('hotProducts', $hotPtoducts);
        });

        View::composer('products', function ($view) {
            $mainCategories = MainCategory::all();
            $featuredProducts = Products::orderBy('hits', 'desc')->take(33)->get();
            $view->with('mainCategories', $mainCategories)->with('featuredProducts', $featuredProducts);
        });
    }
}
