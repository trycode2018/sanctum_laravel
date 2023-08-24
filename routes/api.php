<?php

use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('auth')->group(function(){

    Route::post('login',[UserController::class,'login']);
    Route::post('logout',[UserController::class,'logout']);

    Route::post('register',[UserController::class,'store']);
    Route::get('users',[UserController::class,'index']);
});



