<?php

namespace App\Providers;

use Carbon\Carbon;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;

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
        Carbon::setLocale('fr');
        Paginator::useBootstrap();

        view()->composer('partials.language_switcher', function ($view) {
        $view->with('current_locale', app()->getLocale());
        $view->with('available_locales', config('app.available_locales'));
    });
    }
}
