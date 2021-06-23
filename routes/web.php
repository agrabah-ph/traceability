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

Route::get('farmer-qr', 'FarmerController@farmerQr')->name('farmer-qr');
Route::get('trace-shipped', 'PublicController@traceShipped')->name('trace-shipped');
Route::get('trace-tracking/{code}', 'PublicController@traceTracking')->name('trace-tracking');
Route::get('trace-update-status', 'PublicController@traceUpdate')->name('trace-update-status');
Route::get('trace-info/{code}', 'TraceController@traceInfo')->name('trace-info');

//Auth::routes();
Auth::routes(['verify' => true]);

Route::middleware(['auth', 'verified'])->group(function () {

    Route::get('/home', 'HomeController@index')->name('home');


    Route::resource('community-leader', 'MasterFarmerController');

    Route::resource('farmer', 'FarmerController');
    Route::get('farmer-qr-print/{account}', 'FarmerController@farmerQrPrint')->name('farmer-qr-print');
    Route::get('farmers/login', 'FarmerController@farmerLogin')->name('farmer-login');
    Route::post('farmers/login-form', 'FarmerController@farmerLoginForm')->name('farmer-login-form');
    Route::get('farmers-info/{account}', 'FarmerController@farmerInfo')->name('farmers-info');
    Route::get('farmers/inventory-listing/{account}', 'FarmerController@farmerInventory')->name('farmer-inventory-listing');
    Route::get('farmers/inventory/{account}', 'FarmerController@farmerInventory')->name('farmer-inventory');

    Route::resource('product', 'ProductController');
    Route::get('product-list', 'ProductController@productList')->name('product-list');
    Route::get('product-unit-list', 'ProductController@productUnitList')->name('product-unit-list');
    Route::post('product-store', 'ProductController@productStore')->name('product-store');

    Route::resource('inventory', 'InventoryController');
    Route::get('farmer-inventory-list', 'InventoryController@farmerInventoryList')->name('farmer-inventory-list');
    Route::get('farmer-inventory-list-item', 'InventoryController@farmerInventoryListItem')->name('farmer-inventory-list-item');
    Route::get('inv-listing/{account}', 'InventoryController@farmerInventoryListing')->name('inv-listing');
    Route::post('inv-listing-store', 'InventoryController@inventoryListingStore')->name('inv-listing-store');
    Route::get('inv-listing-delete', 'InventoryController@inventoryListingDelete')->name('inv-listing-delete');

    Route::resource('trace', 'TraceController');
    Route::post('trace-store', 'TraceController@traceStore')->name('trace-store');
    Route::get('trace-qr-print/{reference}', 'TraceController@traceQrPrint')->name('trace-qr-print');
//    Route::get('trace-shipped/{reference}', 'TraceController@traceShipped')->name('trace-shipped');

    Route::resource('user', 'UserController');
//        Route::get('user-list', 'UserController@userList')->name('user-list');
    Route::get('user-list', 'UserController@userList')->name('user-list');
    Route::get('personnel-info', 'UserController@personnelInfo')->name('personnel-info');
    Route::post('create-user', 'UserController@createUser')->name('create-user');


    Route::get('role', 'RoleController@index')->name('role');
    Route::get('role-show/{id}', 'RoleController@show')->name('role-show');
    Route::post('role-update/{id}', 'RoleController@update')->name('role-update');
    Route::post('add-role', 'RoleController@addRole')->name('add-role');

});

