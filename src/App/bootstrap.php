<?php

declare(strict_types=1);

use Framework\App;
use function App\Config\registerRoutes;

include __DIR__ . '/../../vendor/autoload.php';
include 'functions.php';

$app = new App();

registerRoutes($app);

$app->run();

return $app;