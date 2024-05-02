<?php

use App\Http\Controllers\API\V_1\AuthController;
use App\Http\Controllers\API\V_1\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('products', function(){
    return 'Hello world';
});

//-------------------AUTH ROUTES--------------------------------------
Route::controller(AuthController::class)
->prefix('user')
->group(function(){
    Route::post('register', 'register');
});

//-------------------PRODUCT ROUTES--------------------------------------
Route::controller(ProductController::class)
->prefix('products')
->group(function(){
    Route::get('/', 'getProducts');
    Route::get('/{product_id}', 'getProduct');
    Route::post('delete/{product_id}', 'delete');
});
