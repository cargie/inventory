<?php

use Illuminate\Http\Request;

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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });






Route::resource('categories', 'CategoryAPIController');

Route::resource('categories', 'CategoryAPIController');

Route::resource('customers', 'CustomerAPIController');

Route::resource('inventories', 'InventoryAPIController');

Route::resource('products', 'ProductAPIController');

Route::resource('suppliers', 'SupplierAPIController');

Route::resource('tags', 'TagAPIController');

Route::resource('inventory-products', 'InventoryProductAPIController');

Route::resource('orders', 'OrderAPIController');

Route::resource('payments', 'PaymentAPIController');

Route::resource('order-products', 'OrderProductAPIController');

Route::resource('stock-adjustments', 'StockAdjustmentAPIController');

Route::resource('users', 'UserAPIController');

Route::resource('roles', 'RoleAPIController');

Route::resource('settings', 'SettingAPIController', [
	'only' => ['store']
]);