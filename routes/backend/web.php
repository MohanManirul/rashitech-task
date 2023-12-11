<?php

use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\LoginController;
use App\Http\Controllers\Backend\PostController;
use Illuminate\Support\Facades\Route;

Route::controller(LoginController::class)->prefix('/adminpanel')->group(function(){

    Route::get('/', 'index')->name('login.index');
    Route::post('/login-check', 'loginCheck')->name('super_admin.login.check');
    Route::post('/logout', 'superAdminLogout')->name('super_admin.logout');

});


Route::group(['prefix' => '/superadmindashboard', 'middleware' =>['super_admin']], function(){
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    Route::controller(PostController::class)->group(function(){
        Route::get('/all-post',  'index')->name('post.all');
        Route::get('/posts-create',  'create')->name('post.create.page');
        Route::post('/posts-create',  'store')->name('post.store');
        Route::get('/posts-edit/{id}',  'edit')->name('post.edit');
        Route::post('/posts-update/{id}',  'update')->name('post.update');
        Route::post('/posts-update/{id}',  'update')->name('post.update');
        Route::get('/posts-delete/{id}',  'delete')->name('post.delete');
        Route::get('/search',  'search')->name('post.search');
    });

}); 





?>