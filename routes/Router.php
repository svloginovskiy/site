<?php

namespace routes;

class Router
{
    private $routes = [];

    public function get(string $expression, callable $function)
    {
        $this->routes[] = ["expression" => $expression, "method" => "get", "function" => $function];
    }

    public function post(string $expression, callable $function)
    {
        $this->routes[] = ["expression" => $expression, "method" => "post", "function" => $function];
    }

    public function put(string $expression, callable $function)
    {
        $this->routes[] = ["expression" => $expression, "method" => "put", "function" => $function];
    }

    public function patch(string $expression, callable $function)
    {
        $this->routes[] = ["expression" => $expression, "method" => "patch", "function" => $function];
    }

    public function delete(string $expression, callable $function)
    {
        $this->routes[] = ["expression" => $expression, "method" => "delete", "function" => $function];
    }

    public function run()
    {
        $parsedUrl = parse_url($_SERVER['REQUEST_URI']);
        $path = $parsedUrl['path'];



        $method = $_SERVER['REQUEST_METHOD'];

        $pathMatchFound = false;

        $routeMatchFound = false;

        foreach ($this->routes as $route) {
            $expression = '^' . $route['expression'] . '$';

            if (preg_match('#' . $expression . '#', $path, $matches)) {
                $pathMatchFound = true;

                if (strtolower($method) == strtolower($route['method'])) {
                    array_shift($matches);
                    call_user_func_array($route['function'], $matches);
                    $routeMatchFound = true;
                    break;
                }
            }

            if (!$routeMatchFound) {
                if ($pathMatchFound) {
                    header("HTTP/1.0 405 Method Not Allowed");
                } else {
                    header("HTTP/1.0 404 Not Found");
                }
            }
        }
    }
}