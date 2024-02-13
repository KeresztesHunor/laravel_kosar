<?php

use App\Http\Controllers\BasketController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware(['auth.basic'])->group(function () {
    Route::apiResource('products', BasketController::class);
    Route::get('basket', [BasketController::class, 'basket']);
});

Route::get('baskets', [BasketController::class, 'index']);
Route::get('baskets/{user_id}/{item_id}', [BasketController::class, 'show']);
Route::get('baskets/productTypeInBasket/{user_id}/{product_name}', [BasketController::class, 'productTypeInBasket']);
Route::post('baskets', [BasketController::class, 'store']);
Route::delete('baskets/{user_id}/{item_id}', [BasketController::class, 'destroy']);
Route::delete('delete2dayOld', [BasketController::class, 'delete2dayOld']);
