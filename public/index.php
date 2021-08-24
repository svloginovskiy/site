<?php

require(__DIR__ . '/../autoload.php');



$container = new app\Container\Container();

try {
    $router = $container->create('routes\Router');
    $router->get('/login', function () use ($container) {
        $container->create('app\Controllers\LoginController')->show();

    });
    $router->run();
} catch (Exception $exception) {
    echo 'test';
    echo $exception . '</br>';
}

