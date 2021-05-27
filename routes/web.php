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

//Auth::routes();
Auth::routes(['verify' => true]);

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('master-farmer', 'MasterFarmerController');

Route::resource('farmer', 'FarmerController');

Route::resource('product', 'ProductController');

Route::resource('inventory', 'InventoryController');
Route::get('farmer-inventory', 'InventoryController@farmerInventory')->name('farmer-inventory');

Route::resource('trace', 'TraceController');

Route::resource('user', 'UserController');
//        Route::get('user-list', 'UserController@userList')->name('user-list');
Route::get('user-list', 'UserController@userList')->name('user-list');
Route::get('personnel-info', 'UserController@personnelInfo')->name('personnel-info');
Route::post('create-user', 'UserController@createUser')->name('create-user');


Route::get('role', 'RoleController@index')->name('role');
Route::get('role-show/{id}', 'RoleController@show')->name('role-show');
Route::post('role-update/{id}', 'RoleController@update')->name('role-update');
Route::post('add-role', 'RoleController@addRole')->name('add-role');
