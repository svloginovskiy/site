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
                $container->create('app\Controllers\EntryController')->showEntry($number);
            }
        );

    } catch (Exception $e) {
    }
}