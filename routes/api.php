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
    Route::get('/shop/{shop_id}/transaction', 'ShopController@getMyTransaction');
    Route::get('/shop/{shop_id}/payment', 'PaymentProofController@getPaymentProofShop');
    Route::get('/myshop/{user_id}', 'ShopController@myShop');
    Route::post('/shop/{shop_id}/transaction/status', 'TransactionController@getTransactionByStatus');

    // Product
    Route::post('/product', 'ProductController@store');
    Route::patch('/product/{id}', 'ProductController@update');
    Route::delete('/product/{id}', 'ProductController@destroy');

    // Cart
    Route::get('/user/cart/{user_id}', 'CartController@show');
    Route::post('/user/cart', 'CartController@store');
    Route::delete('/user/cart/{id}', 'CartController@destroy');
    Route::patch('/user/cart/{id}', 'CartController@update');

    // Transactions
    Route::get('/user/{id}/transaction', 'TransactionController@getUserTransactions');
    Route::get('/transaction/{id}', 'TransactionController@getTransaction');
    Route::post('/transaction', 'TransactionController@addTransaction');
    Route::patch('/transaction/{id}', 'TransactionController@setStatusTransaction');
    Route::post('/transaction/approve', 'TransactionController@approveTransaction');
    Route::delete('/transaction/{id}', 'TransactionController@destroy');

    // Payment
    Route::get('/payment/{id}', 'PaymentProofController@getPaymentProof');
    Route::get('/payment/transaction/{id}', 'PaymentProofController@getPaymentProofTransaction');
    Route::post('/payment', 'PaymentProofController@addPaymentProof');

    // Invoice
    Route::get('/invoice/{id}', 'InvoiceController@getInvoice');
    Route::get('/invoice/transaction/{id}', 'InvoiceController@getTransactionInvoice');
    Route::patch('/invoice/{id}', 'InvoiceController@update');
    Route::delete('/invoice/{id}', 'InvoiceController@delete');

    // Account
    Route::get('/account/{id}', 'ShopDetailController@getAccount');
    Route::get('/shop/account/{shop_id}', 'ShopDetailController@getShopAccount');
    Route::post('/shop/account', 'ShopDetailController@addAccount');
    Route::patch('/account/{id}', 'ShopDetailController@updateAccount');
    Route::delete('/account/{id}', 'ShopDetailController@deleteAccount');

    // Chat
    Route::get('/user/{user_id}/chat', 'ChatController@index');
    Route::post('/chat/user/{user_id}', 'ChatController@getMessage');
    Route::post('/chat/send/{user_id}', 'ChatController@sendMessage');
    Route::delete('/chat/{id}', 'ChatController@destroyMessage');
    Route::post('/chat/user', 'ChatController@destroyUserMessage');
});

// Shop public
Route::get('/shop', 'ShopController@getShops');
Route::get('/shop/{id}', 'ShopController@getShop');
Route::get('/shop/{id}/products', 'ShopController@getProducts');
Route::post('/shop/{id}/category', 'ShopController@getProductsByCategory');

// Product public
Route::get('/product', 'ProductController@index');
Route::get('/product/{id}', 'ProductController@show');
Route::get('/product/category/{id}', 'ProductController@getProductByCategory');

// Category public
Route::get('/categories', 'CategoryController@getCategories');

// Search
Route::post('/search', 'MainController@search');