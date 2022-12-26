<?php

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

Route::get('/', function () {
    return view('welcome');
});



route::get('dashboard/home', 'Admin\DashboardController@home');

//caregories
route::get('dashboard/categories', 'Admin\CategoryController@index')->name('categories');
route::get('dashboard/category/new', 'Admin\CategoryController@create')->name('category.new');
route::post('dashboard/category/new', 'Admin\CategoryController@store')->name('category.store');
route::get('dashboard/categories/{id}', 'Admin\CategoryController@show')->name('category');
route::get('dashboard/categories/edit/{id}', 'Admin\CategoryController@edit')->name('category.edit');
route::post('dashboard/categories/edit/{id}', 'Admin\CategoryController@update')->name('category.update');
route::get('dashboard/categories/delete/{id}', 'Admin\CategoryController@destroy')->name('category.destroy');


//book
route::get('dashboard/project/new', 'Admin\BookController@create')->name('project.new');
route::post('dashboard/project/new', 'Admin\BookController@store')->name('project.store');
route::get('dashboard/projects', 'Admin\BookController@index')->name('projects');
route::get('dashboard/projects/{id}', 'Admin\BookController@show')->name('project');
route::get('dashboard/projects/edit/{id}', 'Admin\BookController@edit')->name('project.edit');
route::post('dashboard/projects/update/{id}', 'Admin\BookController@update')->name('project.update');
route::get('dashboard/projects/delete/{id}', 'Admin\BookController@destroy')->name('project.destroy');

//subscription
route::get('dashboard/subscriptions/new', 'Admin\SubscriptionController@create')->name('subscription.new');
route::post('dashboard/subscriptions/new', 'Admin\SubscriptionController@store')->name('subscription.store');
route::get('dashboard/subscriptions', 'Admin\SubscriptionController@index')->name('subscriptions');
route::get('dashboard/subscriptions/{id}', 'Admin\SubscriptionController@show')->name('subscription');
route::get('dashboard/subscriptions/edit/{id}', 'Admin\SubscriptionController@edit')->name('subscription.edit');
route::post('dashboard/subscriptions/update/{id}', 'Admin\SubscriptionController@update')->name('subscription.update');
route::get('dashboard/subscriptions/delete/{id}', 'Admin\SubscriptionController@destroy')->name('subscription.destroy');


route::get('dashboard/orders', 'OrderController@getOrders')->name('orders');
route::get('dashboard/orders/edit/{id}', 'OrderController@edit')->name('order.edit');
route::post('dashboard/orders/update/{id}', 'OrderController@update')->name('order.update');
route::get('dashboard/orders/delete/{id}', 'OrderController@destroy')->name('order.destroy');

route::get('dashboard/subscriptions', 'UserSubscriptionController@getSubscriptions')->name('UserSubscriptions');