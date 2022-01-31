<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
@include('include_routes/api.php');     
@include('include_routes/web.php');
/*
Route::get('/', function () 
{
    return view('Auth/login');
});
*/
Route::get('/','HomeController@login');
Route::get('/logout','HomeController@logout');

Route::get('/clear-cache', function() {
    $exitCode = Artisan::call('cache:clear');
    $exitCode = Artisan::call('view:clear');
    $exitCode = Artisan::call('config:clear');
    return "Cache is cleared";
});


Auth::routes(['verify' => true]);

Route::group(['middleware'=>'auth'],function () {
	Route::get('/home', 'HomeController@index')->middleware('auth');
	
	
});

Route::resource('products', ProductController::class);



 