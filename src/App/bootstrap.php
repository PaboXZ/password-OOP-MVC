<?php

declare(strict_types=1);

use Framework\App;
use App\Controllers\HomeController;

include __DIR__ . '/../Framework/App.php';
include __DIR__ . '/../../vendor/autoload.php';
include 'functions.php';

$app = new App();

$app->get('/', [HomeController::class, 'home']);

$app->run();

return $app;