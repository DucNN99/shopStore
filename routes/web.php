<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

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
    return view('login');
});

Route::post("/login",   [UserController::class,'login'])->name("login");
Route::get("/logout",   [UserController::class,'logout'])->name("logout");

Route::group(['middleware' => 'login'], function () {

    Route::get('/getdata','ComponentController@show')->name('getdata');

    Route::post('change-password', [UserController::class,'changepassword']);

    Route::get("/dashboard", function(){
        return view('dashboard');
    })->name("dashboard");

    Route::resource('group-product', 'GroupProductController');

    Route::resource('product', 'ProductController');

    Route::resource('customer', 'CustomerController');
    Route::get('generate-customer', 'CustomerController@generateCustomer');

    Route::resource('purchase-order', 'PurchaseOrderController');

    //================admin================
    Route::group(['middleware' => 'admin'], function () {
        Route::resource('user', 'UserController');
        Route::post('user/reset-password/{id}', [UserController::class,'resetpassword']);
    });
});
