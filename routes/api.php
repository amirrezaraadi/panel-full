<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});
Route::prefix('auth')->name('auth')->group(function () {
    Route::post('register', [\App\Http\Controllers\Auth\RegisteredUserController::class, 'store'])
        ->name('register');
    Route::post('login', [\App\Http\Controllers\Auth\AuthenticatedSessionController::class, 'store'])
        ->name('login');
    Route::middleware(['auth:sanctum'])
        ->post('logout', [\App\Http\Controllers\Auth\AuthenticatedSessionController::class, 'destroy'])
        ->name('logout');
});


Route::middleware(['auth:sanctum'])->prefix('manager')->name('manager')->group(function () {
    Route::apiResource('users', \App\Http\Controllers\Manager\UserContoller::class);
    Route::apiResource('category', \App\Http\Controllers\Manager\CategoryController::class);
    Route::apiResource('tags', \App\Http\Controllers\Manager\TagController::class);
});


Route::middleware(['auth:sanctum'])->prefix('status')->name('status')->group(function () {
    Route::put('users/ban/{user}', [\App\Http\Controllers\Manager\UserContoller::class, 'ban'])
        ->name('ban');
    Route::put('users/success/{user}', [\App\Http\Controllers\Manager\UserContoller::class, 'success'])
        ->name('success');
    Route::put('users/reject/{user}', [\App\Http\Controllers\Manager\UserContoller::class, 'reject'])
        ->name('reject');
    Route::put('users/pending/{user}', [\App\Http\Controllers\Manager\UserContoller::class, 'pending'])
        ->name('pending');
    Route::put('users/active/{user}', [\App\Http\Controllers\Manager\UserContoller::class, 'active'])
        ->name('active');


    Route::put('category/success/{category}', [\App\Http\Controllers\Manager\CategoryController::class, 'success'])
        ->name('success');
    Route::put('category/reject/{category}', [\App\Http\Controllers\Manager\CategoryController::class, 'reject'])
        ->name('reject');
    Route::put('category/pending/{category}', [\App\Http\Controllers\Manager\CategoryController::class, 'pending'])
        ->name('pending');

    Route::put('tag/success/{tag}', [\App\Http\Controllers\Manager\TagController::class, 'success'])
        ->name('success');
    Route::put('tag/reject/{tag}', [\App\Http\Controllers\Manager\TagController::class, 'reject'])
        ->name('reject');
    Route::put('tag/pending/{tag}', [\App\Http\Controllers\Manager\TagController::class, 'pending'])
        ->name('pending');
});
