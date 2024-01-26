<?php

declare(strict_types=1);

namespace Framework;


class Router {
    private array $routes = [];
    private array $middlewares = [];

    public function normalizePath(string $path): string{
        $path = "/{$path}/";
        $path = preg_replace("#[/]{2,}#", "/", $path);

        return $path;
    }

    public function add(string $method, string $path, array $controller): void {
        $this->routes[] = [
            'method' => strtoupper($method),
            'path' => $this->normalizePath($path),
            'controller' => $controller
        ];
    }

    public function addMiddleware(string $middleware){
        $this->middlewares[] = $middleware;
    }

    public function dispatch(string $method, string $path, Container $container = null){
        $path = $this->normalizePath($path);
        $method = strtoupper($method);

        foreach($this->routes as $route){
            if($method !== $route['method'] || !preg_match("#^{$route['path']}$#", $path))
                continue;
            [$class, $function] = $route['controller'];

            $controllerInstance = $container ? $container->resolve($class) : new $class;
            $action = fn() => $controllerInstance->$function();

            foreach($this->middlewares as $middleware){
                $middlewareInstance = $container ? $container->resolve($middleware) : new $middleware;

                $action = $middlewareInstance->process($action);
            }

            return;
        }

    }

    
}