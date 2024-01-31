<?php

declare(strict_types=1);

namespace Framework;

class Router {
    private array $routes = [];

    private function normalizePath(string $path) : string {
        $path = trim($path, "/");
        $path = "/{$path}/";
        $path = preg_replace("#[/]{2,}#", "/", $path);

        return $path;
    }
    
    public function add(string $method, string $path, array $controller) {        
        $path = $this->normalizePath($path);

        $this->routes[] = [
            "path" => $path,
            "method" => strtoupper($method),
            "controller" => $controller
        ];
    }

    public function dispatch(string $path, string $method) {
        $path = $this->normalizePath($path);
        $method = strtoupper($method);

        foreach($this->routes as $route) {
            if(!preg_match("#^{$route['path']}$#", $path) || $route['method'] !== $method) {
                echo 'Route not Found';
                continue;
            }
            [$class, $function] = $route['controller'];
            
            // echo $class . "<br>" . $function;

            $controllerInstance = new $class;
            $controllerInstance->$function();
        }
    }
}
