<?php

require(__DIR__ . '/../autoload.php');



$container = new app\Container\Container();

$dbuser = 'vagrant';
$dbpwd = '';

$container->addRule('PDO', ['constructParams' => [
    'dsn' => 'mysql:host=localhost;dbname=site',
    'username' => $dbuser,
    'passwd' => $dbpwd,
    'options' => [PDO::ATTR_PERSISTENT => true]
]]);

try {
    $router = $container->create('routes\Router');
    $router->get('/login', function () use ($container) {
        $container->create('app\Controllers\LoginController')->show();
    });
    $router->get('/entries/([1-9]\\d*)', function ($number) use ($container) {
        $container->create('app\Controllers\EntryController')->showEntry($number);
    });
    $router->run();
} catch (Exception $exception) {
    echo $exception . '</br>';
}
