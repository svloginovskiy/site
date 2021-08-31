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
            '/posts/([1-9]\\d*)',
            function ($number) use ($container) {
                $container->create('app\Controllers\PostController')->show($number);
            }
        );

        $router->pathNotFound(
            function () use ($container) {
                $container->create('\app\Service\View')->render('404');
            }
        );
        $router->methodNotAllowed(
            function () use ($container) {
                $container->create('\app\Service\View')->render('405');
            }
        );
    } catch (Exception $e) {
    }
}