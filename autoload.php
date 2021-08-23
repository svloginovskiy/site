<?php

    spl_autoload_register(function ($classname) {
        $filename = '';
        $namespace = '';

        if (false !== ($last = strripos($classname, '\\'))) {
            $namespace = substr($classname, 0, $last);
            $classname = substr($classname, $last + 1);
            $filename = str_replace('\\', DIRECTORY_SEPARATOR, $namespace) . DIRECTORY_SEPARATOR;
        }
        $filename .= str_replace('_', DIRECTORY_SEPARATOR, $classname) . '.php';
        $fullFilename = dirname(__FILE__) . DIRECTORY_SEPARATOR . $filename;
        if (file_exists($fullFilename)) {
            require $fullFilename;
        } else {
            echo 'Class "' . $classname . '" not found </br>';
        }
    });
