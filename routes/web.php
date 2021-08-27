<?php

namespace routes;

use app\Service\Container;
use Exception;

function initRoutes(Container $container)
{
    try {
        $router = $container->create('\app\Service\Router');

        $router->get(
            '/login',
            function () use ($container) {
                $container->create('\app\Controllers\LoginController')->show();
            }
        );
        $router->post(
            '/login',
            function () use ($container) {
                $container->create('\app\Controllers\LoginController')->auth();
            }
        );

        $router->get(
            '/entries/([1-9]\\d*)',
            function ($number) use ($container) {
                $container->create('app\Controllers\PostController')->showEntry($number);
            }
        );

        $router->pathNotFound(
            function () use ($container) {
                $container->create('\app\Service\View')->render('404.php');
            }
        );
        $router->methodNotAllowed(
            function () use ($container) {
                $container->create('\app\Service\View')->render('405.php');
            }
        );
    } catch (Exception $e) {
    }
}