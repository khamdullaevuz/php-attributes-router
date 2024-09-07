<?php

use controllers\PostController;
use framework\Route;

Route::get('/posts', [PostController::class, 'index']);
Route::get('/posts/create', [PostController::class, 'create']);
