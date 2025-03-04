<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\CategoryController;
use App\Http\Controllers\Api\V1\ProductController;
// use App\Http\Controllers\Api\V1\CartController;
use App\Http\Controllers\Api\V1\HomeController;
use App\Http\Controllers\Api\V1\OrderController;
use App\Http\Controllers\Api\V1\AuthController;
use App\Http\Controllers\Api\V1\AddressController;
use App\Http\Controllers\Api\V1\StripeWebhookController;

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
    Route::get('home', [HomeController::class, 'index']);
    Route::get('home/refresh', [HomeController::class, 'refreshCache']);

    Route::post('orders', [OrderController::class, 'store'])->middleware('optional.auth');

    // Auth routes
    Route::post('register', [AuthController::class, 'register']);
    Route::post('login', [AuthController::class, 'login']);
    
    // Protected routes
    Route::middleware('auth:sanctum')->group(function () {
        Route::get('user/addresses', [AddressController::class, 'index']);
        Route::post('user/addresses', [AddressController::class, 'store']);

        Route::get('user/orders', [OrderController::class, 'getUsersOrders']);

        // Route::post('cart/items', [CartController::class, 'addItem']);
        // Route::get('cart', [CartController::class, 'show']);

        // Auth routes
        Route::post('logout', [AuthController::class, 'logout']);
        Route::get('user', [AuthController::class, 'user']);
        Route::post('email/resend', [AuthController::class, 'resendVerification']);
    });

    Route::post('stripe/webhook', [StripeWebhookController::class, 'handleWebhook']);
});