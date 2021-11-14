<?php

namespace App\Providers;

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
            $hotPtoducts = Products::orderBy('hits','desc')->take(26)->get();
            $userCount = User::count();
            $confirmedOrders = ShoppingSession::where('orderStatus', 'confirmed')->count();
            $view->with('hotProducts', $hotPtoducts)->with('userCount', $userCount)->with('confirmedOrders', $confirmedOrders);
        });

        View::composer('test', function ($view) {
            $hotPtoducts = Products::orderBy('hits','desc')->take(26)->get();
            $view->with('hotProducts', $hotPtoducts);
        });
        View::composer('c', function ($view) {
            $hotPtoducts = Products::orderBy('hits','desc')->take(33)->get();
            $view->with('hotProducts', $hotPtoducts);
        });
    }
}
