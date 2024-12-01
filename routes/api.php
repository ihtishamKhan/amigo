<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\CategoryController;
use App\Http\Controllers\Api\V1\ProductController;
use App\Http\Controllers\Api\V1\CartController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::prefix('v1')->group(function () {
    // Public routes
    Route::get('categories', [CategoryController::class, 'index']);
    Route::get('products', [ProductController::class, 'index']);
    Route::get('featured-products', [ProductController::class, 'featured']);
    Route::get('meal-deals', [ProductController::class, 'mealDeals']);
    
    // Protected routes
    Route::middleware('auth:sanctum')->group(function () {
        Route::get('user/addresses', [AddressController::class, 'index']);
        Route::post('cart/items', [CartController::class, 'addItem']);
        Route::get('cart', [CartController::class, 'show']);
    });
});