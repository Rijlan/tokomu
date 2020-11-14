<?php

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes([
    'register' => false
]);

//route categories
Route::get('/category', 'CategoryController@index');
Route::get('category/create', 'CategoryController@create');
Route::get('/category/{slug}', 'CategoryController@show');
Route::post('/category', 'CategoryController@store');
Route::get('/category/{id}/edit', 'CategoryController@edit');
Route::put('/category/{id}', 'CategoryController@update');
Route::delete('/category/{id}', 'CategoryController@destroy');

//route users
Route::get('/user', 'UserController@getUser');
Route::get('/user/create', 'UserController@createUser');
Route::get('/user/{slug}', 'UserController@showUser');
Route::post('/user', 'UserController@storeUser');
Route::get('/user/{id}/edit', 'UserController@editUser');   
Route::put('/user/{id}', 'UserController@updateUser');
Route::delete('/user/{id}', 'UserController@destroyUser');

//route shops
Route::get('/shop', 'ShopController@getShop');
Route::delete('/shop/{id}', 'ShopController@destroyShop');

//route products
Route::get('/product', 'ProductController@getProduct');
Route::delete('/product/{id}', 'ProductController@destroyProduct');

//route transactions
Route::get('/transaction', 'TransactionController@getTransaction');
Route::delete('/transaction/{id}', 'TransactionController@destroyTransaction');

//route carts
Route::get('/cart', 'CartController@getCart');
Route::delete('/cart', 'CartController@destroyCart');

Route::get('/home', 'HomeController@index')->name('home');
