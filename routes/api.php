<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\API\ProductController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\PostController;

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

Route::group(['prefix' => 'auth'], function () {
    Route::post('/reset-password',[AuthController::class,'reset_password']);
    Route::post('/register',[AuthController::class,'register']);
    Route::post('/login',[AuthController::class,'login']);        
        Route::group(['middleware' => ['jwt.verify']], function () {
            Route::get('/profile',[AuthController::class,'profile']);
            Route::post('/logout',[AuthController::class,'logout']);
        });
});


Route::group(['middleware' => ['jwt.verify']], function () {        
    Route::group(['prefix' => 'products'], function () {
        // Route::resource('products', ProductController::class);
        Route::get('/',[ProductController::class,'index'])->name('All Products List');
        Route::get('show/{id}',[ProductController::class,'show'])->name('Show by id');
        Route::post('store',[ProductController::class,'store'])->name('Insert Product');
        Route::put('update/{id}',[ProductController::class,'update'])->name('Update Product');
        Route::delete('delete/{id}',[ProductController::class,'destroy'])->name('Delete by id');
    });
});




