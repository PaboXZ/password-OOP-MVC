<?php

declare(strict_types=1);

namespace Framework;

class Router{
    private array $routes;

    public function dispatch(string $path, string $method, ?Container $container = null){

        foreach($this->routes as $route){

            if($route['path'] != $path || $route['method'] != $method)
                continue;

            [$controller, $function] = $route['controller'];

            $controllerInstance = $container ? $container->resolve($controller) : new $controller;

            $controllerInstance->$function();
        }
    }

    public function add(string $path, string $method, array $controller){
        $this->routes[] = ['path' => $path, 'method' => $method, 'controller' => $controller];
    }
}