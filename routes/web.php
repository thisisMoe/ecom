<?php

use App\Http\Controllers\Admin;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ScraperController;
use App\Http\Controllers\ShoppingSessionController;
use App\Models\ShoppingSession;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('scraper', [ScraperController::class, 'scraper'])->name('scraper');
Route::get('newScraper', [ScraperController::class, 'newScraper'])->name('newScraper');
Route::get('show', [ScraperController::class, 'show'])->name('show');
Route::get('search', [ScraperController::class, 'search'])->name('search');
Route::get('searchProduct', [ScraperController::class, 'searchProduct'])->name('searchProduct');


Route::prefix('admin')->middleware(['checkAdmin', 'auth'])->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('index');
    Route::get('/orders', [AdminController::class, 'orders'])->name('orders');
    Route::get('/orders/pending-payments', [AdminController::class, 'pendingPayments'])->name('pending-payments');
});


Route::get('/account', [HomeController::class, 'account'])->middleware('auth')->name('account');
//Posting confirmation_image
Route::post('account/confirm/{id}', [ ShoppingSessionController::class, 'storeImage' ])->name('image.upload.order');