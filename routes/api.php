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

    // Shop
    Route::post('/shop', 'ShopController@setShop');
});

// Shop public
Route::get('/shop', 'ShopController@getShops');
Route::get('/shop/{id}', 'ShopController@getShop');
