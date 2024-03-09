<?php

declare(strict_types=1);

namespace App\Config;

use Framework\App;
use App\Controllers\{AuthController, PanelController, PasswordsController};

use App\Middlewares\{GuestOnlyMiddleware, UserOnlyMiddleware};

function registerRoutes(App $app){
    $app->get('/', [PanelController::class, 'view'])->addRouteMiddleware(UserOnlyMiddleware::class);

    $app->get('/register', [AuthController::class, 'registerView'])->addRouteMiddleware(GuestOnlyMiddleware::class);
    $app->post('/register', [AuthController::class, 'register'])->addRouteMiddleware(GuestOnlyMiddleware::class);

    $app->get('/login', [AuthController::class, 'loginView'])->addRouteMiddleware(GuestOnlyMiddleware::class);
    $app->post('/login', [AuthController::class, 'login'])->addRouteMiddleware(GuestOnlyMiddleware::class);

    $app->get('/logout', [AuthController::class, 'logout'])->addRouteMiddleware(UserOnlyMiddleware::class);

    $app->post('/add-password', [PasswordsController::class, 'addPassword'])->addRouteMiddleware(UserOnlyMiddleware::class);
    $app->delete('/delete-password/{passwordID}', [PasswordsController::class, 'deletePassword'])->addRouteMiddleware(UserOnlyMiddleware::class);
    
    $app->post('/regenerate-password/{passwordID}', [PasswordsController::class, 'regeneratePassword'])->addRouteMiddleware(UserOnlyMiddleware::class);
    $app->post('/edit-password/{passwordID}', [PasswordsController::class, 'editPassword'])->addRouteMiddleware(UserOnlyMiddleware::class);
}