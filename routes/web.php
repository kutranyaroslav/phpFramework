<?php

use App\Controllers\HomeController;
use User\Framework\Routing\Route;

return [
    Route::get('/', [HomeController::class, 'index']),
];
