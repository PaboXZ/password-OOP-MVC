<?php

declare(strict_types=1);

namespace Framework;

class Router{
    private array $routes = [];
    private array $middlewares = [];

    public function dispatch(string $path, string $method, ?Container $container = null){

        foreach($this->routes as $route){

            if($route['path'] != $path || $route['method'] != $method)
                continue;

            [$controller, $function] = $route['controller'];

            $controllerInstance = $container ? $container->resolve($controller) : new $controller;

            $action = fn () => $controllerInstance->$function();

            foreach($this->middlewares as $middleware){
                $middlewareInstance = $container ? $container->resolve($middleware) : new $middleware;
                $action = fn () => $middlewareInstance->process($action);
            }

            $action();
        }
    }

    public function add(string $path, string $method, array $controller){
        $this->routes[] = ['path' => $path, 'method' => $method, 'controller' => $controller];
    }

    public function addMiddleware(string $middleware){
        $this->middlewares[] = $middleware;
    }
}