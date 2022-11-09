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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
 });

Route::prefix("auth")->group(function(){
    Route::post('/reset-password',[AuthController::class,'reset_password']);
    Route::post('/register',[AuthController::class,'register']);
    Route::post('/login',[AuthController::class,'login']);
 });

Route::group(['middleware' => 'jwt.verify' , 'prefix' => 'auth'],function($router){
    Route::resource('products', ProductController::class);
    Route::get('/profile',[AuthController::class,'profile']);
    Route::post('/logout',[AuthController::class,'logout']);
 });

// Route::prefix("contact")->group(function(){ // Deisgn Pattern Contact
    Route::resource('contact',ContactController::class);  
    Route::get('/{id}',[ContactController::class,'find_id']);
   //  Route::delete('/{id}',[ContactController::class,'destroy']);
//  });

 Route::prefix("post")->group(function(){ // Deisgn Pattern + Services
    Route::resource('',PostController::class);   // Deisgn Pattern + Services
    // Route::get('/post/create',[PostController::class,'store']);
 });

