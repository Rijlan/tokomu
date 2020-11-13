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

//route category
Route::get('/category', 'CategoryController@index');
Route::get('category/create', 'CategoryController@create');
Route::get('/category/{slug}', 'CategoryController@show');
Route::post('/category', 'CategoryController@store');
Route::get('/category/{id}/edit', 'CategoryController@edit');
Route::put('/category/{id}', 'CategoryController@update');
Route::delete('/category/{id}', 'CategoryController@destroy');

//route user
Route::get('/user', 'UserController@getUser');
Route::get('/user/create', 'UserController@createUser');
Route::get('/user/{slug}', 'UserController@showUser');
Route::post('/user', 'UserController@storeUser');
Route::get('/user/{id}/edit', 'UserController@editUser');   
Route::put('/user/{id}', 'UserController@updateUser');
Route::delete('/user/{id}', 'UserController@destroyUser');

//route shop
Route::get('/shop', 'ShopController@getShop');
Route::delete('/shop', 'ShopController@destroyShop');

//route product

Route::get('/home', 'HomeController@index')->name('home');
