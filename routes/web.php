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
    

    Route::resource('tags', 'TagController', [
        'except' => ['show']
    ]);

    Route::resource('suppliers', 'SupplierController');

    Route::resource('customers', 'CustomerController');

    // Route::resource('addresses', 'AddressController');

    Route::resource('products', 'ProductController');
   
	Route::resource('inventories', 'InventoryController');

	Route::resource('categories', 'CategoryController');

	Route::resource('orders', 'OrderController');

	Route::resource('payments', 'PaymentController', [
        'only' => ['index', 'create', 'destroy', 'store']
    ]);

	Route::get('dashboard', 'HomeController@index')->name('dashboard');

    Route::resource('stock-adjustments', 'StockAdjustmentController', [
        'only' => ['index', 'create', 'store']
    ]);

    Route::resource('users', 'UserController');

    Route::get('profile', 'ProfileController@index')->name('profile.show');
    Route::post('profile', 'ProfileController@store')->name('profile.update');

    Route::redirect('/', '/dashboard', 301);

    Route::resource('roles', 'RoleController', [
        'except' => ['show']
    ]);
});