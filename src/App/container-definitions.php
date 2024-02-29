<?php

declare(strict_types=1);

use Framework\{TemplateEngine, Container};
use App\Config\Paths;
use App\Services\UserService;
use Framework\Database;

return [
    TemplateEngine::class => fn () => new TemplateEngine(Paths::VIEW),
    Database::class => fn () => new Database(
        $_ENV['DB_DRIVER'],
        ['host' => $_ENV['DB_HOST'], 'port' => $_ENV['DB_PORT']],
        $_ENV['DB_USER'],
        $_ENV['DB_PASSWORD']
    ),
    UserService::class => function (Container $container) {
        $database = $container->get(Database::class);
        return new UserService($database);
    }
];