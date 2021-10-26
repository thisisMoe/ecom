<?php

use App\Http\Controllers\Admin;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
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

Route::get('', [HomeController::class, 'index'])->name('home');
Route::get('/faq', [HomeController::class, 'faq'])->name('faq');
Route::get('/qui-sommes-nous', [HomeController::class, 'about_us'])->name('about_us');
Route::get('searchProduct', [SearchProductController::class, 'searchProduct'])->name('searchProduct');

//For scraper tests
Route::get('scraper-test', [SearchProductController::class, 'scraper_test'])->name('scraper_test');

Auth::routes();

//Admin
Route::prefix('admin')->middleware(['checkAdmin', 'auth'])->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('admin.index');
    Route::get('/orders', [AdminController::class, 'orders'])->name('admin.orders');
    Route::get('/orders/{id}', [AdminController::class, 'order_view'])->name('admin.order.view');
    Route::get('/orders/pending-payments', [AdminController::class, 'pendingPayments'])->name('pending-payments');

    Route::delete('/orders/{id}/delete', [AdminController::class, 'order_delete'])->name('admin.orders.delete');
    Route::patch('/orders/{id}/confirm', [AdminController::class, 'order_confirmed'])->name('admin.orders.confirmed');
    Route::patch('/orders/{id}/shipped', [AdminController::class, 'order_shipped'])->name('admin.orders.shipped');
    Route::patch('/orders/{id}/delivered', [AdminController::class, 'order_delivered'])->name('admin.orders.delivered');

    Route::get('/order-items/{id}', [AdminController::class, 'orderItem_view'])->name('admin.orderItem');
    Route::patch('/order-items/{id}/update', [OrderItemController::class, 'update'])->name('admin.orderItem.update');

    Route::get('/users', [AdminController::class, 'users'])->name('admin.users');
    Route::get('/user/{id}', [AdminController::class, 'user_edit'])->name('admin.user.edit');
    Route::patch('/user/{id}/update', [AdminController::class, 'user_update'])->name('admin.user.update');

    //Scraping tests for admin only
    Route::get('scraper', [ScraperController::class, 'scraper'])->name('scraper');
    Route::get('newScraper', [ScraperController::class, 'newScraper'])->name('newScraper');
});

//Users
Route::prefix('/account')->middleware(['auth'])->group(function () {
    Route::get('/', [HomeController::class, 'account'])->middleware('auth')->name('account');
    Route::get('/tracking', [HomeController::class, 'tracking'])->name('tracking');
    Route::get('/edit/{id}', [UserController::class, 'edit'])->name('user.edit');
    //Posting confirmation_image
    Route::post('/confirm/{id}', [ShoppingSessionController::class, 'storeImage'])->name('image.upload.order');
    Route::patch('/{id}/update', [UserController::class, 'update'])->name('user.update');

    Route::delete('orders/{id}/delete', [ShoppingSessionController::class, 'delete'])->name('user.orders.delete');
});
