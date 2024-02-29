<?php

declare(strict_types=1);

namespace App\Config;

use Framework\App;
use App\Controllers\{AuthController, PanelController};
use App\Middlewares\SessionMiddleware;

function registerRoutes(App $app){
    $app->get('/', [PanelController::class, 'view']);
    $app->get('/register', [AuthController::class, 'registerView']);
}