<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PhoneAppController;

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

Route::get('/get-welcome',  [PhoneAppController::class, "Welcome"]);

Route::get('/get-phone',  [PhoneAppController::class, "getPhoneData"])->name("show-phone");

Route::get('/checkout/{id}',  [PhoneAppController::class, "getPhoneId"])->name('checkoutId');

Route::post('/get-invoice',  [PhoneAppController::class, "GetInvoice"])->name('get-invoice');




Route::get("/", function () {
    return view('welcome');
})->name('index');


Route::get("/twiq", function () {
    return view("twiq");
})->name('twiq');

Route::get("/getInv", function () {
    return view('invoice');
})->name('invoice');

// Auth::routes();
