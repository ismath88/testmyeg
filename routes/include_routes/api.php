<?php
/**************************************************************products******************************************************************/
//get all products data
Route::get('products', [\App\Http\Controllers\ProductController::class, 'index']);
//get products data with id
Route::get('products/{id}', [\App\Http\Controllers\ProductController::class, 'show']);
//post all products data insert to database table
Route::post('products', [\App\Http\Controllers\ProductController::class, 'store']);
//update products data of specific id  in database table
Route::put('products/{id}', [\App\Http\Controllers\ProductController::class, 'update']);
//delete products data of specific id  in database table
Route::delete('products/{id}', [\App\Http\Controllers\ProductController::class, 'delete']);


