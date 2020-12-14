<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\PostsController;
use App\Http\Livewire\PostComponent;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::group(['middleware' => 'auth'], function () {
    Route::resource('users', UserController::class);
    //Route::resource('posts', PostsController::class);
    Route::get('posts', PostComponent::class)->name('posts');
});
