<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\IndexController;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\Admin\TagController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', [\App\Http\Controllers\Front\IndexController::class, 'index'])->name('index_page');
Route::get('/links-page', [\App\Http\Controllers\Front\IndexController::class, 'getLinksPage'])->name('links_page');
Route::get('/contact', [\App\Http\Controllers\Front\ContactController::class, 'contact'])->name('contact_page');
Route::post('send-email', [\App\Http\Controllers\Front\ContactController::class, 'sendEmail'])->name('send_email');
Route::get('/reset-forgotten-password', [\App\Http\Controllers\Auth\ResetPasswordController::class, 'forgottenPassword'])->name('forgotten_password');
Route::post('/reset-password', [\App\Http\Controllers\Auth\ResetPasswordController::class, 'resetForgottenPassword'])->name('reset_forgotten_password');

Route::prefix('/project')->name('projects_')->group(function () {
    Route::get('/', [\App\Http\Controllers\Front\ProjectController::class, 'projects'])->name('page');
    Route::get('/category/{id}/{slug}', [\App\Http\Controllers\Front\ProjectController::class, 'projectCategory'])->name('category_page');
    Route::get('/project/{id}/{slug}', [\App\Http\Controllers\Front\ProjectController::class, 'project'])->name('project_page');
    Route::get('/search', [\App\Http\Controllers\Front\ProjectController::class, 'projectSearch'])->name('search_page');
    Route::get('/tag/{id}/{slug}', [\App\Http\Controllers\Front\ProjectController::class, 'projectTag'])->name('tag_page');
});
Route::middleware('auth')->prefix('admin')->name('admin.')->group(function () {
    Route::resource('index', IndexController::class)->only('index');
    Route::resource('categories', CategoryController::class)->except(['show', 'edit']);
    Route::prefix('/categories')->name('categories.')->group(function () {
        Route::post('/ajax-category-datatable', [\App\Http\Controllers\Admin\CategoryController::class, 'datatable'])->name('datatable');
    });
    Route::prefix('/users')->name('users.')->group(function () {
        Route::get('/profile', [\App\Http\Controllers\Admin\UserController::class, 'userProfile'])->name('profile');
        Route::post('/ajax-user-datatable', [\App\Http\Controllers\Admin\UserController::class, 'datatable'])->name('datatable');
        Route::post('/enable-user', [\App\Http\Controllers\Admin\UserController::class, 'enableUser'])->name('enable.user');
        Route::post('/disable-user', [\App\Http\Controllers\Admin\UserController::class, 'disableUser'])->name('disable.user');
        Route::prefix('/edit-user')->name('edit.user.')->group(function () {
            Route::get('/', [\App\Http\Controllers\Admin\UserController::class, 'edit'])->name('page');
            Route::get('/password', [\App\Http\Controllers\Admin\UserController::class, 'editUserPassword'])->name('password.page');
            Route::post('/store-edited-user-password', [\App\Http\Controllers\Admin\UserController::class, 'storeEditedUserPassword'])->name('password');
            Route::get('/reset-forgotten-password', [\App\Http\Controllers\Admin\UserController::class, 'resetPasswordPage'])->name('reset.password.page');
            Route::post('/reset-password', [\App\Http\Controllers\Admin\UserController::class, 'resetUserPassword'])->name('reset.user.password');
        });
    });
    Route::resource('users', UserController::class)->except(['show', 'edit' . 'destroy']);

    Route::resource('tags', TagController::class)->except(['show', 'edit', 'update']);
    Route::prefix('/tags')->name('tags.')->group(function () {
        Route::post('/ajax-tag-datatable', [\App\Http\Controllers\Admin\TagController::class, 'datatable'])->name('datatable');
    });
    Route::resource('projects', ProjectController::class)->except(['show', 'edit']);
    Route::prefix('/projects')->name('projects.')->group(function () {
        Route::post('/ajax-project-datatable', [\App\Http\Controllers\Admin\ProjectController::class, 'datatable'])->name('datatable');
        Route::get('/edit-project/{id}/{slug}', [\App\Http\Controllers\Admin\ProjectController::class, 'edit'])->name('edit');
        Route::post('/enable-project', [\App\Http\Controllers\Admin\ProjectController::class, 'enableProject'])->name('enable.project');
        Route::post('/disable-project', [\App\Http\Controllers\Admin\ProjectController::class, 'disableProject'])->name('disable.project');
    });
});
Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'auth']], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});

Auth::routes();
