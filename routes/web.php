<?php

use App\Http\Controllers\Admin;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\OrderItemController;
use App\Http\Controllers\ScraperController;
use App\Http\Controllers\SearchProductController;
use App\Http\Controllers\ShoppingSessionController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Localization route
Route::get('language/{locale}', function ($locale) {
    app()->setLocale($locale);
    session()->put('locale', $locale);

    return redirect()->back();
})->name('change_lang');

// Route::get('/test', [HomeController::class, 'test'])->name('test');
// Route::get('/products', [HomeController::class, 'products'])->name('products');
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/faq', [HomeController::class, 'faq'])->name('faq');
Route::get('/contact', [HomeController::class, 'contact'])->name('contact');
Route::post('/contact/sendMessage', [MessageController::class, 'send_message'])->name('contact.send');

Route::get('/signin', [HomeController::class, 'signin'])->name('signin');
Route::get('/signup', [HomeController::class, 'signup'])->name('signup');
Route::get('/qui-sommes-nous', [HomeController::class, 'about_us'])->name('about_us');
Route::get('searchProduct', [SearchProductController::class, 'searchProduct'])->name('searchProduct');

//For scraper tests
Route::get('scraper-test', [SearchProductController::class, 'scraper_test'])->name('scraper_test');

Auth::routes(['reset' => false]);

//Admin
Route::prefix('admin')->middleware(['checkAdmin', 'auth'])->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('admin.index');
    Route::get('/orders', [AdminController::class, 'orders'])->name('admin.orders');
    Route::get('/orders/{id}', [AdminController::class, 'order_view'])->name('admin.order.view');
    Route::get('/orders/pending-payments', [AdminController::class, 'pendingPayments'])->name('pending-payments');

    Route::delete('/orders/{id}/delete', [AdminController::class, 'order_delete'])->name('admin.orders.delete');
    Route::patch('/orders/{id}/updateTracking', [AdminController::class, 'order_update_tracking'])->name('admin.orders.update.tracking');
    Route::patch('/orders/{id}/confirm', [AdminController::class, 'order_confirmed'])->name('admin.orders.confirmed');
    Route::patch('/orders/{id}/shipped', [AdminController::class, 'order_shipped'])->name('admin.orders.shipped');
    Route::patch('/orders/{id}/delivered', [AdminController::class, 'order_delivered'])->name('admin.orders.delivered');

    Route::get('/order-items/{id}', [AdminController::class, 'orderItem_view'])->name('admin.orderItem');
    Route::patch('/order-items/{id}/update', [OrderItemController::class, 'update'])->name('admin.orderItem.update');

    Route::patch('/order-items/{id}/updateShippingCost', [OrderItemController::class, 'update_shippingCost'])->name('admin.orderItems.update.shippingCost');

    Route::get('/users', [AdminController::class, 'users'])->name('admin.users');
    Route::get('/user/{id}', [AdminController::class, 'user_edit'])->name('admin.user.edit');
    Route::patch('/user/{id}/update', [AdminController::class, 'user_update'])->name('admin.user.update');
    Route::delete('/user/{id}/delete', [AdminController::class, 'user_delete'])->name('admin.user.delete');

    Route::get('/messages', [MessageController::class, 'fetch_messages'])->name('admin.messages');
    Route::delete('/messages/{id}/delete', [MessageController::class, 'delete_message'])->name('admin.messages.delete');

    Route::get('/searches', [AdminController::class, 'searches'])->name('admin.searches');
    Route::delete('/searches/{id}/delete', [AdminController::class, 'searches_delete'])->name('admin.searches.delete');

    //Scraping tests for admin only
    Route::get('scraper', [ScraperController::class, 'scraper'])->name('scraper');
    Route::get('newScraper', [ScraperController::class, 'newScraper'])->name('newScraper');
});

//Users
Route::prefix('/account')->middleware(['auth'])->group(function () {
    Route::get('/', [HomeController::class, 'account'])->middleware('auth')->name('account');
    Route::get('/tracking', [HomeController::class, 'tracking'])->name('tracking');
    Route::get('/panier', [HomeController::class, 'panier'])->name('panier');
    Route::delete('/panier/{id}/delete', [HomeController::class, 'delete_orderItem'])->name('panier.delete');
    Route::post('/panier/addOrder', [HomeController::class, 'addOrder'])->name('panier.addOrder');
    Route::get('/edit/{id}', [UserController::class, 'edit'])->name('user.edit');
    //Posting confirmation_image
    Route::post('/confirm/{id}', [ShoppingSessionController::class, 'storeImage'])->name('image.upload.order');
    Route::patch('/{id}/update', [UserController::class, 'update'])->name('user.update');

    Route::delete('orders/{id}/delete', [ShoppingSessionController::class, 'delete'])->name('user.orders.delete');
});
