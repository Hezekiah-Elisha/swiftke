-- Active: 1714909922482@@127.0.0.1@3306@swiftke
<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ShopController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::apiResource('/products', ProductController::class);

Route::group(['prefix' => 'auth'], function () {
    Route::post('sign-up', [AuthController::class, 'signUp']);
    Route::post('sign-in', [AuthController::class, 'signIn']);
    Route::delete('sign-out', [AuthController::class, 'signOut'])->middleware('auth:sanctum');
    Route::get('refresh', [AuthController::class, 'refresh'])->middleware('auth:sanctum');
    Route::get('me', [AuthController::class, 'me'])->middleware('auth:sanctum');
});

Route::group(['prefix' => 'shops'], function () {
    Route::get('/', [ShopController::class, 'index']);
    Route::post('/', [ShopController::class, 'store'])->middleware('auth:sanctum');
    Route::get('/{shop}', [ShopController::class, 'show']);
    Route::put('/{shop}', [ShopController::class, 'update']);
    Route::delete('/{shop}', [ShopController::class, 'destroy']);
});
