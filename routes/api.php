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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// docs
Route::get('/docs', 'DocumentationController@index');

// Login & Register Buyer, Seller
Route::post('/login', 'UserController@login');
Route::post('/register', 'UserController@register');


Route::group(['middleware' => ['jwt.verify']], function () {
    // User
    Route::get('/getAuthenticatedUser', 'UserController@getAuthenticatedUser');
    Route::get('/user/{id}', 'UserDetailController@getUserDetails');
    Route::post('/user/detail', 'UserDetailController@setUserDetails');
    Route::post('/user/update/{id}', 'UserDetailController@updateUser');
    Route::post('/user/delete', 'UserController@destroy');
    Route::patch('/user/password/{id}', 'UserController@changePassword');
    Route::get('/logout', 'UserController@logout');

    // Shop
    Route::post('/shop', 'ShopController@setShop');
    Route::get('/myshop/{user_id}', 'ShopController@myShop');

    // Product
    Route::post('/product', 'ProductController@store');
    Route::patch('/product/{id}', 'ProductController@update');
    Route::delete('/product/{id}', 'ProductController@destroy');

    // Cart
    Route::get('/user/cart/{user_id}', 'CartController@show');
    Route::post('/user/cart', 'CartController@store');
    Route::delete('/user/cart/{id}', 'CartController@destroy');
    Route::patch('/user/cart/{id}', 'CartController@update');
});

// Shop public
Route::get('/shop', 'ShopController@getShops');
Route::get('/shop/{id}', 'ShopController@getShop');
Route::get('/shop/{id}/products', 'ShopController@getProducts');

// Product public
Route::get('/product', 'ProductController@index');
Route::get('/product/{id}', 'ProductController@show');