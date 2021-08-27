<?php

namespace config;

use app\Service\Container;
use PDO;

function configContainer(Container &$container)
{
    $container->addRule(
        'PDO',
        [
            'constructParams' => [
                'dsn' => 'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME,
                'username' => DB_USER,
                'passwd' => DB_PASS,
                'options' => [PDO::ATTR_PERSISTENT => true]
            ]
        ]
    );
}