<?php

namespace Api\Http;

class Router
{
    private $routes = [];

    public function get($path, $handler)
    {
        $this->routes['GET'][$path] = $handler;
    }

    public function dispatch()
    {
        $url = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');
        $url = $url === '' ? '/' : $url;
        $method = $_SERVER['REQUEST_METHOD'];
        foreach ($this->routes[$method] as $route => $handler) {
            $pattern = preg_replace('/\{([a-z]+)\}/', '(?P<$1>[^/]+)', $route);
            $pattern = "@^$pattern$@";
            if (preg_match($pattern, $url, $matches)) {
                $params = array_filter($matches, 'is_string', ARRAY_FILTER_USE_KEY);
                [$controllerClass, $action] = explode('@', $handler);
                $fullControllerClass = "Api\\Controllers\\$controllerClass";
                if (class_exists($fullControllerClass)) {
                    $controller = new $fullControllerClass();
                    if (method_exists($controller, $action)) {
                        $controller->$action($params ?? []);
                        return;
                    }
                }
            }
        }
        header("HTTP/1.0 404 Not Found");
        echo "Página não encontrada";
    }
}
