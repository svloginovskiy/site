<?php

//require_once(__DIR__ . '/../app/Container/Container.php');

spl_autoload_register(function ($classname) {
    require(__DIR__ . '../app/Container/' . $classname . '.php');
});



$container = new app\Container\Container();
