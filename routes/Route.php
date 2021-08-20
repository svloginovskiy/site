<?php

namespace routes\Route;

class Route
{
    private static $routes = [];

    public static function get(string $expression, callable $function)
    {
        self::routes[$expression] = ["method" => "get", "function" => $function];
    }

    public static function post(string $expression, callable $function)
    {
        self::routes[$expression] = ["method" => "post", "function" => $function];
    }

    public static function put(string $expression, callable $function)
    {
        self::routes[$expression] = ["method" => "put", "function" => $function];
    }

    public static function patch(string $expression, callable $function)
    {
        self::routes[$expression] = ["method" => "patch", "function" => $function];
    }

    public static function delete(string $expression, callable $function)
    {
        self::routes[$expression] = ["method" => "delete", "function" => $function];
    }

    public static function run() {
        $parsedUrl = parse_url($_SERVER['REQUEST_URI']);
        $path = $parsedUrl['path'];

        $method = $_SERVER['REQUEST_METHOD'];


    }

}
