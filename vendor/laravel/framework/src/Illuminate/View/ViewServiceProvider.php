<?php

namespace Illuminate\View;

use App\Models\Message;
use App\Models\ShoppingSession;
use App\Models\User;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Illuminate\View\Compilers\BladeCompiler;
use Illuminate\View\Engines\CompilerEngine;
use Illuminate\View\Engines\EngineResolver;
use Illuminate\View\Engines\FileEngine;
use Illuminate\View\Engines\PhpEngine;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     */
    public function boot()
    {
        View::composer('layouts.admin', function ($view) {
            $messagesCount = Message::where('seen', false)->count();
            $pendingCount = ShoppingSession::where('seen', false)->where('orderStatus', 'pending')->where('status', 'Inactive')->count();

            $messages = Message::where('seen', false)->take(5)->get();
            $pendingOrders = ShoppingSession::where('seen', false)->where('orderStatus', 'pending')->where('status', 'Inactive')->take(5)->get();

            $view->with('messagesCount', $messagesCount)->with('pendingCount', $pendingCount)->with('latestMessages', $messages)->with('pendingOrders', $pendingOrders);
        });

        View::composer('admin.index', function ($view) {
            $orders = ShoppingSession::where('status', 'Inactive')->get();
            
            $pendingOrders = ShoppingSession::where('status', 'Inactive')->where('orderStatus', 'pending')->count();

            $pendingOrdersWithPayments = ShoppingSession::where('withPayment', true)->where('orderStatus', 'pending')->count();
            
            $confirmedOrders = ShoppingSession::where('status', 'Inactive')->where('orderStatus', 'confirmed')->count();
            
            $shippedOrders = ShoppingSession::where('status', 'Inactive')->where('orderStatus', 'shipped')->count();
            
            $deliveredOrders = ShoppingSession::where('status', 'Inactive')->where('orderStatus', 'delivered')->count();

            $users = User::all()->count();

            $fullTotal = 0;
            $totalFee = 0;
            foreach ($orders as $order) {
                $fullTotal += ($order->total + $order->totalShipping);
                $totalFee += ($order->totalFee);
            }
            $view->with('fullTotal', $fullTotal)->with('totalFee', $totalFee)->with('pendingOrders', $pendingOrders)->with('confirmedOrders', $confirmedOrders)->with('shippedOrders', $shippedOrders)->with('deliveredOrders', $deliveredOrders)->with('pendingOrdersWithPayments', $pendingOrdersWithPayments)->with('users', $users);
        });
    }

    /**
     * Register the service provider.
     */
    public function register()
    {
        $this->registerFactory();
        $this->registerViewFinder();
        $this->registerBladeCompiler();
        $this->registerEngineResolver();
    }

    /**
     * Register the view environment.
     */
    public function registerFactory()
    {
        $this->app->singleton('view', function ($app) {
            // Next we need to grab the engine resolver instance that will be used by the
            // environment. The resolver will be used by an environment to get each of
            // the various engine implementations such as plain PHP or Blade engine.
            $resolver = $app['view.engine.resolver'];

            $finder = $app['view.finder'];

            $factory = $this->createFactory($resolver, $finder, $app['events']);

            // We will also set the container instance on this view environment since the
            // view composers may be classes registered in the container, which allows
            // for great testable, flexible composers for the application developer.
            $factory->setContainer($app);

            $factory->share('app', $app);

            return $factory;
        });
    }

    /**
     * Register the view finder implementation.
     */
    public function registerViewFinder()
    {
        $this->app->bind('view.finder', function ($app) {
            return new FileViewFinder($app['files'], $app['config']['view.paths']);
        });
    }

    /**
     * Register the Blade compiler implementation.
     */
    public function registerBladeCompiler()
    {
        $this->app->singleton('blade.compiler', function ($app) {
            return tap(new BladeCompiler($app['files'], $app['config']['view.compiled']), function ($blade) {
                $blade->component('dynamic-component', DynamicComponent::class);
            });
        });
    }

    /**
     * Register the engine resolver instance.
     */
    public function registerEngineResolver()
    {
        $this->app->singleton('view.engine.resolver', function () {
            $resolver = new EngineResolver();

            // Next, we will register the various view engines with the resolver so that the
            // environment will resolve the engines needed for various views based on the
            // extension of view file. We call a method for each of the view's engines.
            foreach (['file', 'php', 'blade'] as $engine) {
                $this->{'register'.ucfirst($engine).'Engine'}($resolver);
            }

            return $resolver;
        });
    }

    /**
     * Register the file engine implementation.
     *
     * @param \Illuminate\View\Engines\EngineResolver $resolver
     */
    public function registerFileEngine($resolver)
    {
        $resolver->register('file', function () {
            return new FileEngine($this->app['files']);
        });
    }

    /**
     * Register the PHP engine implementation.
     *
     * @param \Illuminate\View\Engines\EngineResolver $resolver
     */
    public function registerPhpEngine($resolver)
    {
        $resolver->register('php', function () {
            return new PhpEngine($this->app['files']);
        });
    }

    /**
     * Register the Blade engine implementation.
     *
     * @param \Illuminate\View\Engines\EngineResolver $resolver
     */
    public function registerBladeEngine($resolver)
    {
        $resolver->register('blade', function () {
            return new CompilerEngine($this->app['blade.compiler'], $this->app['files']);
        });
    }

    /**
     * Create a new Factory Instance.
     *
     * @param \Illuminate\View\Engines\EngineResolver $resolver
     * @param \Illuminate\View\ViewFinderInterface    $finder
     * @param \Illuminate\Contracts\Events\Dispatcher $events
     *
     * @return \Illuminate\View\Factory
     */
    protected function createFactory($resolver, $finder, $events)
    {
        return new Factory($resolver, $finder, $events);
    }
}
