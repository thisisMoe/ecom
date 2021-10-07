<?php

use App\Http\Controllers\Admin;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ScraperController;
use App\Http\Controllers\ShoppingSessionController;
use App\Http\Controllers\UserController;
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


Route::get('', [HomeController::class, 'index'])->name('home');
Route::get('searchProduct', [ScraperController::class, 'searchProduct'])->name('searchProduct');

Auth::routes();

//Admin
Route::prefix('admin')->middleware(['checkAdmin', 'auth'])->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('admin.index');
    Route::get('/orders', [AdminController::class, 'orders'])->name('admin.orders');
    Route::get('/orders/pending-payments', [AdminController::class, 'pendingPayments'])->name('pending-payments');
    Route::get('/users', [AdminController::class, 'users'])->name('admin.users');
    
    //Scraping tests for admin only
    Route::get('scraper', [ScraperController::class, 'scraper'])->name('scraper');
    Route::get('newScraper', [ScraperController::class, 'newScraper'])->name('newScraper');
});

//Users
Route::prefix('/account')->middleware(['auth'])->group(function () {
    Route::get('/', [HomeController::class, 'account'])->middleware('auth')->name('account');
    Route::get('/edit/{id}', [UserController::class, 'edit'])->name('user.edit');
    //Posting confirmation_image
    Route::post('/confirm/{id}', [ ShoppingSessionController::class, 'storeImage' ])->name('image.upload.order');
    Route::patch('/{id}/update', [UserController::class, 'update'])->name('user.update');      
    
});