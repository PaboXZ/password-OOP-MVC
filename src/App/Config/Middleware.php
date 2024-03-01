<?php

declare(strict_types=1);

namespace App\Config;

use App\Middlewares\{SessionMiddleware, ValidatorExceptionMiddleware};
use Framework\App;

function registerMiddleware(App $app){
    $app->addMiddleware(ValidatorExceptionMiddleware::class);
    $app->addMiddleware(SessionMiddleware::class);
}