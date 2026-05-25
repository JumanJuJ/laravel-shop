<?php

use App\Http\Controllers\Api\AuthTokenController;
use App\Http\Controllers\Api\ProductsController;
use App\Http\Controllers\Api\UserProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/register', [AuthTokenController::class, 'register'])
    ->name('api.register');

Route::post('/login', [AuthTokenController::class, 'login'])
    ->name('api.login');

Route::post('/tokens', [AuthTokenController::class, 'login'])
    ->name('api.tokens.store');

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    })->name('api.user');

    Route::post('/logout', [AuthTokenController::class, 'logout'])
        ->name('api.logout');

    Route::get('/my/products', [UserProductController::class, 'mine'])
        ->middleware('can:products:read')
        ->name('api.my.products');

    Route::get('/products', [ProductsController::class, 'getProducts'])
        ->middleware('can:products:read')
        ->name('api.products.index');

    Route::get('/users/{user}/products', [UserProductController::class, 'index'])
        ->middleware('can:view-user-products,user')
        ->name('api.users.products');

});
