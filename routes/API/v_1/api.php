<?php

use App\Http\Controllers\API\V_1\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('products', function(){
    return 'Hello world';
});


Route::controller(ProductController::class)
->prefix('products')
->group(function(){
    Route::get('/', 'getProducts');
    Route::get('/{product_id}', 'getProduct');
});
