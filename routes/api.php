<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/info', 'ScraperController@getInfo')->name('getInfo');

Route::get('/fetchOrderItems/{userId}', 'ShoppingSessionController@fetchOrderItems')->name('fetchOrderItems');

Route::post('/addToCart/{userId}', 'ShoppingSessionController@addToCart')->name('addOrderItem');
Route::post('/addToCart/{userId}', 'ShoppingSessionController@addToCart')->name('addOrderItem');
Route::post('/addOrder/{userId}', 'OrdersController@addOrder')->name('addOrder');


Route::delete('/deleteOrderItem/{id}', 'OrderItemController@deleteOrderItem')->name('deleteOrderItem');