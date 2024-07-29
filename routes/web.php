<?php

use App\Controllers\HomeController;
use App\Controllers\PostController;
use User\Framework\Routing\Route;

return [
    Route::get('/', [HomeController::class, 'index']),
    Route::get('/posts/{id:\d+}', [PostController::class, 'show']),
    Route::get('/post/{name}', function (string $name) {
        return new \User\Framework\http\Response("HELLO, $name");
    }),
];
