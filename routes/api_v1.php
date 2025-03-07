<?php

use App\Http\Controllers\Api\V1\CategoryController;
use App\Http\Controllers\Api\V1\CommentController;
use App\Http\Controllers\Api\V1\PostController;
use App\Http\Controllers\Api\V1\ProfileController;
use App\Http\Controllers\Api\V1\UserController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->group(function () {

    Route::middleware('is_admin:admin')->group(function () {
        Route::apiResource('categories', CategoryController::class);
        Route::patch('categories/restore/{id}', [CategoryController::class, 'restore'])->name('categories.restore');

        Route::apiResource('users', UserController::class);
        Route::patch('users/restore/{id}', [UserController::class, 'restore'])->name('users.restore');
    });

    Route::get('profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::patch('profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::apiResource('posts', PostController::class);

    Route::post('posts/{post}/comments', [CommentController::class, 'store'])->name('posts.comments.store');
    Route::patch('posts/{post}/comments/{comment}', [CommentController::class, 'update'])->name('posts.comments.update');
    Route::delete('posts/{post}/comments/{comment}', [CommentController::class, 'destroy'])->name('posts.comments.destroy');

});
