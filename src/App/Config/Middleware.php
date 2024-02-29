<?php

declare(strict_types=1);

namespace App\Config;

use App\Middlewares\SessionMiddleware;
use Framework\App;

function registerMiddleware(App $app){
    $app->addMiddleware(SessionMiddleware::class);
}