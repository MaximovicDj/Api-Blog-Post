<?php

use App\Http\Controllers\Api\V1\CategoryController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->group(function () {

    Route::middleware('is_admin:admin')->group(function () {
        Route::apiResource('categories', CategoryController::class);
        Route::patch('categories/restore/{id}', [CategoryController::class, 'restore'])->name('categories.restore');
    });

});
