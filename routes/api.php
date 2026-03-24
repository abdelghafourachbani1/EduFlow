<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CourseController;
use App\Http\Controllers\Api\RecommendationController;
use App\Http\Controllers\Api\WishlistController;

Route::post('/register',[AuthController::class,'register']);
Route::post('/login',[AuthController::class,'login']);

Route::middleware('auth:api')->group(function(){
    Route::post('/logout',[AuthController::class,'logout']);

    Route::get('/courses',[CourseController::class,'index']);
    Route::get('/courses/{id}',[CourseController::class,'show']);
    Route::post('/courses',[CourseController::class,'store']);
    Route::put('/courses/{id}',[CourseController::class,'update']);
    Route::delete('/courses/{id}',[CourseController::class,'destroy']);

    Route::get('/recommended-courses',[RecommendationController::class,'index']);

    Route::middleware('auth:api')->group(function(){
        Route::get('/',[WishlistController::class,'index']);
        Route::post('/{courseId}',[WishlistController::class,'add']);
        Route::delete('/{courseId}',[WishlistController::class,'remove']);

    });
    
});
