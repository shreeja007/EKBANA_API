<?php

use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\CompanyController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::middleware('check.api.key')->group(function(){
    Route::get('/category', [CategoryController::class, 'index']);
    Route::get('/category/{category}', [CategoryController::class, 'show']);
    Route::post('/category', [CategoryController::class, 'store']);
    Route::put('/category/{category}', [CategoryController::class, 'update']);
    Route::delete('/category/{category}', [CategoryController::class, 'destroy']);

    Route::get('/company', [CompanyController::class, 'index']);
    Route::get('/company/{company}', [CompanyController::class, 'show']);
    Route::post('/company', [CompanyController::class, 'store']);
    Route::put('/company/{company}', [CompanyController::class, 'update']);
    Route::delete('/company/{company}', [CompanyController::class, 'destroy']);
});

