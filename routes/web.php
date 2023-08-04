<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostListController;

Route::get('/',[PostController::class,'index']);
Route::get('posts/{post}',[PostController::class,'show'])
    ->name('post.show')
    ->whereNumber('post');
