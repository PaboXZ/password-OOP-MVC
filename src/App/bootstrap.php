<?php

declare(strict_types=1);

use Framework\App;
use App\Config\Paths;
use function App\Config\{registerRoutes, registerMiddleware};

include __DIR__ . '/../../vendor/autoload.php';
include 'functions.php';

$app = new App(Paths::CONTAINER_DEFINITIONS);

registerRoutes($app);
registerMiddleware($app);

$app->run();

return $app;