<?php

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

Auth::routes();

Route::group(['middleware' => ['auth']], function () {
    

    Route::resource('tags', 'TagController');

    Route::resource('suppliers', 'SupplierController');

    Route::resource('customers', 'CustomerController');

    Route::resource('addresses', 'AddressController');

    Route::resource('products', 'ProductController');
   
	Route::resource('inventories', 'InventoryController');

	Route::resource('categories', 'CategoryController');

	Route::resource('orders', 'OrderController');

	Route::resource('payments', 'PaymentController');

	Route::get('dashboard', 'HomeController@index');

    Route::resource('stock-adjustments', 'StockAdjustmentController');

    Route::resource('users', 'UserController');

    Route::get('profile', 'ProfileController@index');
    Route::post('profile', 'ProfileController@store');

    Route::get('/', function () {
        return redirect('dashboard');
    });
});