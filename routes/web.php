<?php

use App\Http\Controllers\ScraperController;
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
    return view('dashboard');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('scraper', [ScraperController::class, 'scraper'])->name('scraper');
Route::get('show', [ScraperController::class, 'show'])->name('show');
Route::get('search', [ScraperController::class, 'search'])->name('search');
Route::get('searchProduct', [ScraperController::class, 'searchProduct'])->name('searchProduct');