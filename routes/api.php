<?php

use App\Http\Controllers\Seo\SeoController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// start seo
Route::prefix('seo')->name('seo')->group(function () {
    Route::get('/sitemap', [SeoController::class, 'sitemap'])->name('sitemap');
});
// end seo
Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});
// start authentication
Route::prefix('auth')->name('auth')->group(function () {
    Route::post('register', [\App\Http\Controllers\Auth\RegisteredUserController::class, 'store'])
        ->middleware('guest')
        ->name('register');
    Route::post('login', [\App\Http\Controllers\Auth\AuthenticatedSessionController::class, 'store'])
        ->middleware('guest')
        ->name('login');
    Route::middleware(['auth:sanctum'])
        ->post('logout', [\App\Http\Controllers\Auth\AuthenticatedSessionController::class, 'destroy'])
        ->name('logout');
    Route::post('/forgot-password', [\App\Http\Controllers\Auth\PasswordResetLinkController::class, 'store'])
        ->middleware('guest')
        ->name('password.email');
    Route::post('/check-forgot-password/{email}', [\App\Http\Controllers\Auth\PasswordResetLinkController::class, 'checkPassword'])
        ->middleware('guest')
        ->name('check-forgot-password');
    Route::middleware(['auth:sanctum'])->post('/change-password/', [\App\Http\Controllers\Auth\NewPasswordController::class, 'store'])
//        ->middleware('guest')
        ->name('change-password');
});
// end authentication
// start panel manager
Route::middleware(['auth:sanctum'])->prefix('manager')->name('manager')->group(function () {
    Route::apiResource('users', \App\Http\Controllers\Manager\UserContoller::class);
    Route::apiResource('category', \App\Http\Controllers\Manager\CategoryController::class);
    Route::apiResource('tags', \App\Http\Controllers\Manager\TagController::class);
    Route::apiResource('articles', \App\Http\Controllers\Manager\ArticleController::class);
    Route::apiResource('news', \App\Http\Controllers\Manager\NewsController::class);
    Route::apiResource('features', \App\Http\Controllers\Manager\FeatureController::class);
    Route::apiResource('likes', \App\Http\Controllers\Attribute\LikeController::class);
    Route::apiResource('bookmarks', \App\Http\Controllers\Attribute\BookmarkController::class);
    Route::apiResource('comments', \App\Http\Controllers\Attribute\CommentController::class);
    Route::prefix('role_permission')->name('role_permission')->group(function () {
        Route::get('roles' , [\App\Http\Controllers\RolePermission\RoleController::class , 'index'])
        ->name('roles.index');
        Route::post('roles' , [\App\Http\Controllers\RolePermission\RoleController::class , 'store'])
            ->name('roles.store');
        Route::get('permission' , [\App\Http\Controllers\RolePermission\PermissionController::class , 'index'])
            ->name('permission.index');
    })  ;
});
// end panel manager
// status
Route::middleware(['auth:sanctum'])->prefix('status')->name('status')->group(function () {
    // * users * ///
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
    //end user
    /* start category */
    Route::put('category/success/{category}', [\App\Http\Controllers\Manager\CategoryController::class, 'success'])
        ->name('success');
    Route::put('category/reject/{category}', [\App\Http\Controllers\Manager\CategoryController::class, 'reject'])
        ->name('reject');
    Route::put('category/pending/{category}', [\App\Http\Controllers\Manager\CategoryController::class, 'pending'])
        ->name('pending');
    /* end category */
    /* start feature */
    Route::put('feature/success/{feature}', [\App\Http\Controllers\Manager\FeatureController::class, 'success'])
        ->name('success');
    Route::put('feature/reject/{feature}', [\App\Http\Controllers\Manager\FeatureController::class, 'reject'])
        ->name('reject');
    Route::put('feature/pending/{feature}', [\App\Http\Controllers\Manager\FeatureController::class, 'pending'])
        ->name('pending');
    /* end feature */
    /* start tags */
    Route::put('tag/success/{tag}', [\App\Http\Controllers\Manager\TagController::class, 'success'])
        ->name('success');
    Route::put('tag/reject/{tag}', [\App\Http\Controllers\Manager\TagController::class, 'reject'])
        ->name('reject');
    Route::put('tag/pending/{tag}', [\App\Http\Controllers\Manager\TagController::class, 'pending'])
        ->name('pending');
    /* end  tags */
    /* start article */
    Route::put('article/success/{article}', [\App\Http\Controllers\Manager\ArticleController::class, 'success'])
        ->name('success');
    Route::put('article/reject/{article}', [\App\Http\Controllers\Manager\ArticleController::class, 'reject'])
        ->name('reject');
    Route::put('article/pending/{article}', [\App\Http\Controllers\Manager\ArticleController::class, 'pending'])
        ->name('pending');
    /* end  article */
    /* start news */
    Route::put('news/success/{news}', [\App\Http\Controllers\Manager\NewsController::class, 'success'])
        ->name('success');
    Route::put('news/reject/{news}', [\App\Http\Controllers\Manager\NewsController::class, 'reject'])
        ->name('reject');
    Route::put('news/pending/{news}', [\App\Http\Controllers\Manager\NewsController::class, 'pending'])
        ->name('pending');
    /* end  news */
});
// end status
// start front
Route::prefix('/front')->name('front')->group(function () {
    Route::get('/', \App\Http\Controllers\LandingController::class)->name('landing');
    Route::get('/landing_articles', [\App\Http\Controllers\Front\LandingArticleController::class, 'index'])
        ->name('articles');
    Route::get('single_article/{slug}', [\App\Http\Controllers\Front\LandingArticleController::class, 'single'])
        ->name('single');
    Route::get('/landing_news', [\App\Http\Controllers\Front\NewLandingController::class, 'index'])
        ->name('articles');
    Route::get('single_news/{slug}', [\App\Http\Controllers\Front\NewLandingController::class, 'single'])
        ->name('single');
});
// end front
