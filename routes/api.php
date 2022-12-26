<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\CartController;
use Laravel\Sanctum\Sanctum;
use App\Http\Controllers\UserSubscriptionController;
use App\Http\Controllers\LikeController;



/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});*/


route::get('books', 'HomeController@getBooks');
route::get('books/{id}', 'HomeController@getBookById');
route::get('categories', 'HomeController@getCategories');
route::get('category/{id}', 'HomeController@getBookByCategory');
Route::post('search', 'SearchController@search');
route::get('subscription', 'Admin\SubscriptionController@getSubs'); 
  

Route::prefix('v1')->group(function () {
    Route::post('login', [AuthController::class, 'login']);
    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('register', [AuthController::class, 'register']);

    Route::middleware('auth:sanctum')->group(function () {
        route::get('likes', 'LikeController@getLikes');        
        Route::post('like/{id}', 'LikeController@like');
        route::get('like/isLike/{id}', 'LikeController@isLike');
        
        route::get('cart', 'CartController@getCart');        
        Route::post('cart/{id}', 'CartController@addToCart');
        route::get('cart/delete/{id}', 'CartController@destroy');
        route::get('cart/deleteAll/{id}', 'CartController@removeAll');
        
        route::post('orders', 'OrderController@order');

        Route::post('subscription/{id}', 'UserSubscriptionController@addSubs');      
        
        route::get('/profile', 'ProfileController@getUser');
        route::post('/profile/edit/{id}', 'ProfileController@userUpdate');

        route::get('library', 'OrderController@getUserOrders');

    });
});