<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrderController;

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

Auth::routes(['verify' => true]);

Route::get('/', [App\Http\Controllers\HomeController::class, 'root'])->name('root')->middleware('auth');

// orders group route
Route::group(['prefix' => 'orders', 'as' => 'orders.', 'middleware' => 'auth'], function () {
    Route::get('/', [OrderController::class, 'index'])->name('index');
    Route::get('/create', [OrderController::class, 'create'])->name('create');
    Route::post('/store', [OrderController::class, 'store'])->name('store');
    Route::get('/show/{id}', [OrderController::class, 'show'])->name('show');
    Route::get('/edit/{id}', [OrderController::class, 'edit'])->name('edit');
    Route::post('/update/{id}', [OrderController::class, 'update'])->name('update');
    Route::get('/delete/{id}', [OrderController::class, 'destroy'])->name('delete');
    Route::patch('/orders/{id}/update-status', [OrderController::class, 'updateStatus'])->name('update-status');
    Route::patch('/orders/{id}/cancel', [OrderController::class, 'cancelOrder'])->name('cancel');

    Route::get('/receipt/{id}', [OrderController::class, 'printReceipt'])->name('printReceipt');
});

// customers route
Route::get('/customers', [App\Http\Controllers\CustomerController::class, 'index'])->name('customers.list');

//Update User Details
Route::post('/update-profile/{id}', [App\Http\Controllers\HomeController::class, 'updateProfile'])->name('updateProfile');
Route::post('/update-password/{id}', [App\Http\Controllers\HomeController::class, 'updatePassword'])->name('updatePassword');

Route::get('{any}', [App\Http\Controllers\HomeController::class, 'index'])->name('index');

//Language Translation
Route::get('index/{locale}', [App\Http\Controllers\HomeController::class, 'lang']);
