<?php
use Illuminate\Http\Request;
use App\Http\Controllers\WebController;
use App\Http\Controllers\ApiController;
use App\Http\Controllers\ProductController;


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

Route::get('clear', function() {
    Artisan::call('cache:clear');
    Artisan::call('config:clear');
    Artisan::call('config:cache');
    Artisan::call('view:clear');
    return "Cleared!";
});




/*====================Products module  ==================*/

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





Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

