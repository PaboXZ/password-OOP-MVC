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

            $allMiddlewares = [...$route['middlewares'], ...$this->middlewares];

            foreach($allMiddlewares as $middleware){
                $middlewareInstance = $container ? $container->resolve($middleware) : new $middleware;
                $action = fn () => $middlewareInstance->process($action);
            }

            $action();
        }
    }

    public function add(string $path, string $method, array $controller, array $middlewares = []){
        $this->routes[] = [
            'path' => $path,
            'method' => $method,
            'controller' => $controller,
            'middlewares' => $middlewares
        ];
        return $this;
    }

    public function addMiddleware(string $middleware){
        $this->middlewares[] = $middleware;
    }

    public function addRouteMiddleware(string $middleware){
        $lastRouteKey = array_key_last($this->routes);
        $this->routes[$lastRouteKey]['middlewares'][] = $middleware;
    }
}