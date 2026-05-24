<?php

use App\Http\Controllers\Api\AuthTokenController;
use App\Http\Controllers\Api\ProductsController;
use App\Http\Controllers\Api\UserProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Esempi API con Sanctum
|--------------------------------------------------------------------------
| 1. POST /api/register crea un nuovo utente e restituisce un token.
| 2. POST /api/login crea un token partendo da email/password.
| 2. Le rotte con auth:sanctum richiedono l'header:
|    Authorization: Bearer TUO_TOKEN
| 3. ability / abilities controllano i permessi assegnati al token.
*/

Route::post('/register', [AuthTokenController::class, 'register'])
    ->name('api.register');

Route::post('/login', [AuthTokenController::class, 'login'])
    ->name('api.login');

Route::post('/tokens', [AuthTokenController::class, 'login'])
    ->name('api.tokens.store');

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', function (Request $request) {
        return response()->json([
            'user' => $request->user(),
            'token_abilities' => $request->user()->currentAccessToken()?->abilities ?? ['session-authenticated'],
        ]);
    })->name('api.user');

    Route::post('/logout', [AuthTokenController::class, 'logout'])
        ->name('api.logout');

    Route::get('/my/products', [UserProductController::class, 'mine'])
        ->middleware('ability:products:read')
        ->name('api.my.products');

    Route::get('/products', [ProductsController::class, 'getProducts'])
        ->middleware('ability:products:read')
        ->name('api.products.index');

    Route::get('/users/{user}/products', [UserProductController::class, 'index'])
        ->middleware('ability:products:read')
        ->name('api.users.products');

});
