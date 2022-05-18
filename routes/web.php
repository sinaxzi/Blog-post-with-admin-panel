<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/post/{post}', [App\Http\Controllers\PostController::class, 'show'])->name('post');

Route::middleware('auth')->group(function(){

    Route::get('/admin', [App\Http\Controllers\AdminsController::class, 'index'])->name('admin.index');

    Route::get('/admin/posts',[App\Http\Controllers\PostController::class,'index'])->name('posts.index');
    Route::get('/admin/posts/create',[App\Http\Controllers\PostController::class,'create'])->name('posts.create');
    Route::post('/admin/posts',[App\Http\Controllers\PostController::class,'store'])->name('post.store');
    Route::get('/admin/posts/{post}/edit',[App\Http\Controllers\PostController::class,'edit'])->name('post.edit');
    Route::patch('/admin/posts/{post}/update',[App\Http\Controllers\PostController::class,'update'])->name('post.update');
    Route::delete('/admin/posts/{post}/delete',[App\Http\Controllers\PostController::class,'destroy'])->name('post.destroy');

    
    Route::put('/admin/users/{user}/update',[App\Http\Controllers\UserController::class,'update'])->name('users.profile.update');
    
    Route::delete('/admin/users/{user}/delete',[App\Http\Controllers\UserController::class,'destroy'])->name('user.destroy');



});

Route::middleware(['role:Admin','auth'])->group(function(){

    Route::get('/admin/users',[App\Http\Controllers\UserController::class,'index'])->name('user.index');
    Route::put('/admin/users/{user}/attach',[App\Http\Controllers\UserController::class,'attach'])->name('user.role.attach');
    Route::put('/admin/users/{user}/detach',[App\Http\Controllers\UserController::class,'detach'])->name('user.role.detach');


    Route::get('/admin/roles',[App\Http\Controllers\RoleController::class,'index'])->name('role.index');
    Route::post('/admin/roles',[App\Http\Controllers\RoleController::class,'store'])->name('role.store');
    Route::get('/admin/roles/{role}/edit',[App\Http\Controllers\RoleController::class,'edit'])->name('role.edit');
    Route::put('/admin/roles/{role}/update',[App\Http\Controllers\RoleController::class,'update'])->name('role.update');
    Route::delete('/admin/roles/{role}/delete',[App\Http\Controllers\RoleController::class,'destroy'])->name('role.destroy');
    Route::put('/admin/roles/{role}/attach',[App\Http\Controllers\RoleController::class,'attach'])->name('role.permission.attach');
    Route::put('/admin/roles/{role}/detach',[App\Http\Controllers\RoleController::class,'detach'])->name('role.permission.detach');




    Route::get('/admin/permissions',[App\Http\Controllers\PermissionController::class,'index'])->name('permission.index');
    Route::post('/admin/permissions',[App\Http\Controllers\PermissionController::class,'store'])->name('permission.store');
    Route::get('/admin/permissions/{permission}/edit',[App\Http\Controllers\PermissionController::class,'edit'])->name('permission.edit');
    Route::patch('/admin/permissions/{permission}/update',[App\Http\Controllers\PermissionController::class,'update'])->name('permission.update');
    Route::delete('/admin/permissions/{permission}/delete',[App\Http\Controllers\PermissionController::class,'destroy'])->name('permission.destroy');

});


Route::middleware(['can:view,user','auth'])->group(function(){
    Route::get('/admin/users/{user}/profile',[App\Http\Controllers\UserController::class,'show'])->name('users.profile.show');

});






