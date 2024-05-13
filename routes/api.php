<?php

use App\Http\Controllers\Api\ApiController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CartController;
use App\Http\Controllers\Api\OrderController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Api
Route::get('/company',[ApiController::class,'company']);
Route::get('/categories',[ApiController::class,'categories']);
Route::get('/products',[ApiController::class,'products']);
Route::get('/product/{id}',[ApiController::class,'product']);


// Auth
Route::post('/register',[AuthController::class,'register']);
Route::post('/login',[AuthController::class,'login']);


// Sanctum
Route::middleware('auth:sanctum')->group(function(){
    Route::get('/logout',[AuthController::class,'logout']);

    Route::post('/order',[OrderController::class,'post_order']);
    Route::post('/order-history',[OrderController::class,'order_history']);

    Route::get('/get_cart',[CartController::class,'get_cart']);
    Route::post('/add_cart',[CartController::class,'add_cart']);
    Route::get('/delete_cart/{id}',[CartController::class,'delete_cart']);

});
