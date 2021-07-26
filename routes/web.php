<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('home');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['prefix'=>'admin', 'middleware'=>['auth']], function(){

    Route::get('/profile', [App\Http\Controllers\UsersController::class, 'profile'])->name('profile');
    Route::get('/delete-image/{id}',[App\Http\Controllers\SalesController::class, 'deleteImage'])->name('deleteImage');
    Route::get('/delete-image-rent/{id}',[App\Http\Controllers\RentsController::class, 'deleteImageRent'])->name('deleteImageRent');
    Route::put('/update_profile',[App\Http\Controllers\UsersController::class, 'update_profile'])->name('update_profile');
    Route::put('/update_password',[App\Http\Controllers\UsersController::class, 'update_password'])->name('update_password');

    Route::resources([
        'cities'=>App\Http\Controllers\CitiesController::class,
        'users'=>App\Http\Controllers\UsersController::class,
        'sales'=>App\Http\Controllers\SalesController::class,
        'rents'=>App\Http\Controllers\RentsController::class
    ]);
});

