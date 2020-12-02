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

//route categories	A001762872541B
Route::get('/category', 'CategoryController@index');
Route::get('category/create', 'CategoryController@create');
Route::get('/category/{slug}', 'CategoryController@show');
Route::post('/category', 'CategoryController@store');
Route::get('/category/{id}/edit', 'CategoryController@edit');
Route::put('/category/{id}', 'CategoryController@update');
Route::delete('/category/{id}', 'CategoryController@destroy');

//route users
Route::post('/user', 'HomeController@storeUser');
Route::get('/user', 'HomeController@getUser');
Route::get('/user/create', 'HomeController@createUser');
Route::get('/user/{slug}', 'HomeController@showUser');
Route::get('/user/{id}/edit', 'HomeController@editUser');   
Route::put('/user/{id}', 'HomeController@updateUser');
Route::delete('/user/{id}', 'HomeController@destroyUser');

//route shops
Route::get('/shop', 'HomeController@getShop');
Route::delete('/shop/{id}', 'HomeController@destroyShop');

//route products
Route::get('/product', 'HomeController@getProduct');
Route::get('/product/{id}', 'HomeController@detailProduct');
Route::delete('/product/{id}', 'HomeController@destroyProduct');

//route transactions
Route::get('/transaction', 'HomeController@getTransaction');
Route::delete('/transaction/{id}', 'HomeController@destroyTransaction');

//route carts
Route::get('/cart', 'HomeController@getCart');
Route::delete('/cart', 'HomeController@destroyCart');

//route shopdetails
Route::get('/shopDetail', 'HomeController@getShopDetail');
Route::delete('/shopDetail', 'HomeController@destroyShopDetail');

//route paymentproofs
Route::get('/paymentProof', 'HomeController@getPaymentProof');
Route::delete('/paymentProof', 'HomeController@destroyPaymentProof');

//route Invoice
Route::get('/invoice', 'HomeController@getInvoice');
Route::delete('/invoice', 'HomeController@destroyInvoice');

Route::get('/home', 'HomeController@index')->name('home');
