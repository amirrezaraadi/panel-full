<?php

use App\Http\Controllers\Auth\GoogleController;
use App\Http\Controllers\Front\LandingArticleController;
use App\Http\Controllers\Front\NewLandingController;
use App\Http\Controllers\Manager\UserContoller;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RolePermission\PermissionController;
use App\Http\Controllers\RolePermission\RoleController;
use App\Http\Controllers\Seo\SeoController;
use App\Http\Controllers\User\ProfileController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// start seo
Route::prefix('seo')->name('seo')->group(function () {
    Route::get('/sitemap', [SeoController::class, 'sitemap'])->name('sitemap');
});
// end seo

// start authentication
Route::prefix('auth')->name('auth.')->group(callback: function () {
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

    Route::middleware(['auth:sanctum'])->get('/user/', [ProfileController::class, 'me'])
        ->name('user');
    Route::get('google' , [GoogleController::class , 'google'])->name('google');
    Route::get('google/callback' , [GoogleController::class , 'google_callback'])->name('google-callback');
});
// end authentication
// start panel manager
Route::middleware(['auth:sanctum'])->prefix('manager')->name('manager')->group(callback: function () {
    Route::apiResource('users', UserContoller::class);
    Route::apiResource('category', \App\Http\Controllers\Manager\CategoryController::class);
    Route::apiResource('tags', \App\Http\Controllers\Manager\TagController::class);
    Route::apiResource('articles', \App\Http\Controllers\Manager\ArticleController::class);
    Route::apiResource('news', \App\Http\Controllers\Manager\NewsController::class);
    Route::apiResource('features', \App\Http\Controllers\Manager\FeatureController::class);
    Route::apiResource('likes', \App\Http\Controllers\Attribute\LikeController::class);
    Route::apiResource('bookmarks', \App\Http\Controllers\Attribute\BookmarkController::class);
    Route::apiResource('comments', \App\Http\Controllers\Attribute\CommentController::class);
    Route::apiResource('products',ProductController::class);
    Route::prefix('role_permission')->name('role_permission')->group(function () {
        Route::apiResource('roles' , RoleController::class);
        Route::apiResource('permissions' , PermissionController::class);
    });

});
// end panel manager
// status
Route::middleware(['auth:sanctum'])->prefix('status')->name('status')->group(function () {
    // * users * ///
    Route::put('users/ban/{user}', [UserContoller::class, 'ban'])
        ->name('user-ban');
    Route::put('users/success/{user}', [UserContoller::class, 'success'])
        ->name('user-success');
    Route::put('users/reject/{user}', [UserContoller::class, 'reject'])
        ->name('user-reject');
    Route::put('users/pending/{user}', [UserContoller::class, 'pending'])
        ->name('user-pending');
    Route::put('users/active/{user}', [UserContoller::class, 'active'])
        ->name('user-active');
    //end user
    /* start category */
    Route::put('category/success/{category}', [\App\Http\Controllers\Manager\CategoryController::class, 'success'])
        ->name('category-success');
    Route::put('category/reject/{category}', [\App\Http\Controllers\Manager\CategoryController::class, 'reject'])
        ->name('category-reject');
    Route::put('category/pending/{category}', [\App\Http\Controllers\Manager\CategoryController::class, 'pending'])
        ->name('category-pending');
    /* end category */
    /* start feature */
    Route::put('feature/success/{feature}', [\App\Http\Controllers\Manager\FeatureController::class, 'success'])
        ->name('feature-success');
    Route::put('feature/reject/{feature}', [\App\Http\Controllers\Manager\FeatureController::class, 'reject'])
        ->name('feature-reject');
    Route::put('feature/pending/{feature}', [\App\Http\Controllers\Manager\FeatureController::class, 'pending'])
        ->name('feature-pending');
    /* end feature */
    /* start tags */
    Route::put('tag/success/{tag}', [\App\Http\Controllers\Manager\TagController::class, 'success'])
        ->name('tag-success');
    Route::put('tag/reject/{tag}', [\App\Http\Controllers\Manager\TagController::class, 'reject'])
        ->name('tag-reject');
    Route::put('tag/pending/{tag}', [\App\Http\Controllers\Manager\TagController::class, 'pending'])
        ->name('tag-pending');
    /* end  tags */
    /* start article */
    Route::put('article/success/{article}', [\App\Http\Controllers\Manager\ArticleController::class, 'success'])
        ->name('article-success');
    Route::put('article/reject/{article}', [\App\Http\Controllers\Manager\ArticleController::class, 'reject'])
        ->name('article-reject');
    Route::put('article/pending/{article}', [\App\Http\Controllers\Manager\ArticleController::class, 'pending'])
        ->name('article-pending');
    /* end  article */
    /* start news */
    Route::put('news/success/{news}', [\App\Http\Controllers\Manager\NewsController::class, 'success'])
        ->name('news-success');
    Route::put('news/reject/{news}', [\App\Http\Controllers\Manager\NewsController::class, 'reject'])
        ->name('news-reject');
    Route::put('news/pending/{news}', [\App\Http\Controllers\Manager\NewsController::class, 'pending'])
        ->name('news-pending');
    /* end  news */
    /* start products */
    Route::put('product/success/{product}', [ProductController::class, 'success'])
        ->name('product-success');
    Route::put('product/reject/{product}', [ProductController::class, 'reject'])
        ->name('product-reject');
    Route::put('product/pending/{product}', [ProductController::class, 'pending'])
        ->name('product-pending');
    /* end  products */
});
// end status
// start front
Route::prefix('/front')->name('front')->group(function () {
    Route::get('/', \App\Http\Controllers\LandingController::class)->name('landing');
    Route::get('/landing_articles', [LandingArticleController::class, 'index'])
        ->name('articles');
    Route::middleware(['auth:sanctum'])->
        get('/articles-user/{article}', [LandingArticleController::class, 'articles_user'])
        ->name('articles-user');
//    Route::middleware(['auth:sanctum'])->
//    get('/articles-user-bookmark/{bookmark}', [LandingArticleController::class, 'articles_user_bookmark'])
//        ->name('articles-user-bookmark');
    Route::get('single_article/{slug}', [LandingArticleController::class, 'single'])
        ->name('single');
    Route::get('/landing_news', [NewLandingController::class, 'index'])
        ->name('articles');
    Route::get('single_news/{slug}', [NewLandingController::class, 'single'])
        ->name('single');
});
// end front
