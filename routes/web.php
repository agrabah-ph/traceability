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

// GLOBAL ROUTES START
Route::get('/', function () {
    return view('welcome');
});

Route::get('/registration', function () {
    return view(subdomain_name().'.auth.register');
});

//Auth::routes();
Auth::routes(['verify' => true]);

Route::middleware(['auth', 'verified', 'has_profile'])->group(function () {

    Route::get('/home', 'HomeController@index')->name('home');

    Route::resource('farmer', 'FarmerController');

    Route::resource('community-leader', 'CommunityLeaderController');

    Route::resource('product', 'ProductController');
    Route::get('product-list', 'ProductController@productList')->name('product-list');
    Route::get('product-unit-list', 'ProductController@productUnitList')->name('product-unit-list');
    Route::post('product-store', 'ProductController@productStore')->name('product-store');

    Route::resource('user', 'UserController');
    // Route::get('user-list', 'UserController@userList')->name('user-list');
    Route::get('user-list', 'UserController@userList')->name('user-list');
    Route::get('personnel-info', 'UserController@personnelInfo')->name('personnel-info');
    Route::post('create-user', 'UserController@createUser')->name('create-user');

    Route::get('role', 'RoleController@index')->name('role');
    Route::get('role-show/{id}', 'RoleController@show')->name('role-show');
    Route::post('role-update/{id}', 'RoleController@update')->name('role-update');
    Route::post('add-role', 'RoleController@addRole')->name('add-role');

    Route::resource('settings', 'SettingController');

});
// GLOBAL ROUTES END



// ROUTES FOR WHARF
Route::domain('wharf.'.config('dev.domain_ext'))->group(function () {
    Route::middleware(['auth', 'verified'])->group(function () {
        Route::resource('purchase-order', 'PurchaseOrderController');
    });
});

// ROUTES FOR LOAN
Route::domain('loan.'.config('dev.domain_ext'))->group(function () {

    Route::get('loan-registration', 'PublicController@loanRegistration')->name('loan-registration');
    Route::post('loan-user-registration-store', 'PublicController@loanUserRegistrationStore')->name('loan-user-registration-store');

    Route::middleware(['auth', 'verified', 'has_profile'])->group(function () {

        Route::get('loan-provider/profile/create', 'PublicController@loneProviderProfileCreate')->name('loan-provider-profile-create');
        Route::post('loan-provider/profile/store', 'LoanProviderController@profileStore')->name('loan-provider-profile-store');

        Route::get('farmer/profile/create', 'PublicController@farmerProfileCreate')->name('farmer-profile-create');
        Route::post('farmer/profile/store', 'FarmerController@profileStore')->name('farmer-profile-store');

        Route::resource('products', 'LoanProductController');

        Route::get('loan/product/list', 'FarmerController@loanProductList')->name('loan-product-list');
        Route::get('loan-product-list-get', 'FarmerController@loanProductListGet')->name('loan-product-list-get');
        Route::get('loan-apply', 'FarmerController@loanApply')->name('loan-apply');

        Route::get('my-loans/', 'LoanController@index')->name('my-loans');

        Route::get('loan/applicants', 'LoanProviderController@loanApplicant')->name('loan-applicant');
        Route::get('loan-update-status', 'LoanProviderController@loanUpdateStatus')->name('loan-update-status');

    });



});

// ROUTES FOR TRACE
Route::domain('trace.'.config('dev.domain_ext'))->group(function () {

    Route::get('farmer-qr', 'PublicController@farmerQr')->name('farmer-qr');
    Route::get('trace-shipped', 'PublicController@traceShipped')->name('trace-shipped');
    Route::get('trace-tracking/{code}', 'PublicController@traceTracking')->name('trace-tracking');
    Route::get('trace-update-status', 'PublicController@traceUpdate')->name('trace-update-status');
    Route::get('trace-info/{code}', 'PublicController@traceInfo')->name('trace-info');

    Route::middleware(['auth', 'verified'])->group(function () {

        // FARMER START
        Route::get('farmer-qr-print/{account}', 'FarmerController@farmerQrPrint')->name('farmer-qr-print');
        Route::get('farmers/login', 'FarmerController@farmerLogin')->name('farmer-login');
        Route::post('farmers/login-form', 'FarmerController@farmerLoginForm')->name('farmer-login-form');
        Route::get('farmers-info/{account}', 'FarmerController@farmerInfo')->name('farmers-info');
        Route::get('farmers/inventory-listing/{account}', 'FarmerController@farmerInventory')->name('farmer-inventory-listing');
        Route::get('farmers/inventory/{account}', 'FarmerController@farmerInventory')->name('farmer-inventory');
        // FARMER END

        // FARMER START
        Route::resource('inventory', 'InventoryController');
        Route::get('farmer-inventory-list', 'InventoryController@farmerInventoryList')->name('farmer-inventory-list');
        Route::get('farmer-inventory-list-item', 'InventoryController@farmerInventoryListItem')->name('farmer-inventory-list-item');
        Route::get('inv-listing/{account}', 'InventoryController@farmerInventoryListing')->name('inv-listing');
        Route::post('inv-listing-store', 'InventoryController@inventoryListingStore')->name('inv-listing-store');
        Route::get('inv-listing-delete', 'InventoryController@inventoryListingDelete')->name('inv-listing-delete');
        // FARMER START

        // FARMER START
        Route::resource('trace', 'Trace\TraceController');
        Route::post('trace-store', 'Trace\TraceController@traceStore')->name('trace-store');
        Route::get('trace-qr-print/{reference}', 'Trace\TraceController@traceQrPrint')->name('trace-qr-print');
        // Route::get('trace-shipped/{reference}', 'TraceController@traceShipped')->name('trace-shipped');
        // FARMER START





    });
});





