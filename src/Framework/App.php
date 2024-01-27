<?php

declare(strict_types=1);

namespace Framework;

use Framework\Router;
use Framework\Container;



class App{

    private Container $container;
    private Router $router;

    public function __construct(string $containerDefinitionsPath = null){
        $this->container = new Container;
        $this->router = new Router;

        if($containerDefinitionsPath)
        {
            $containerDefinitions = include $containerDefinitionsPath;
            $this->container->add($containerDefinitions);
        }
    }

    public function get(string $path, array $controller){
        $this->router->add('GET', $path, $controller);
    }

    public function post(string $path, array $controller){
        $this->router->add('POST', $path, $controller);
    }

    public function run(){
        $path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $method = $_SERVER['REQUEST_METHOD'];
        
        $this->router->dispatch($method, $path, $this->container);
    }

    public function status() {
        echo 'Running Mose Password Generator';
    }

    public function addMiddleware(string $middleware){
        $this->router->addMiddleware($middleware);
    }
}