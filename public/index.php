<?php


require(__DIR__ . '/../routes/web.php');
require(__DIR__ . '/../autoload.php');
require(__DIR__ . '/../config/config.php');
require(__DIR__ . '/../config/container_config.php');

$container = new app\Service\Container();
config\configContainer($container);
routes\initRoutes($container);
try {
    $container->create('\app\Service\Router')->run();
} catch (Exception $e) {
}

