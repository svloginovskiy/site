<?php

namespace app\Service;

class View
{
    private $resDir;
    public function __construct()
    {
        $this->resDir = __DIR__ . '/../../resources/';
    }

    public function render(string $VIEWNAME, array $vars = [])
    {
        $page = $VIEWNAME . '.php';
        extract($vars);
        /*$file = file_get_contents($this->resDir . $page);
        foreach ($vars as $var => $value) {
            $var = '/' . $var . '/';
            $value = preg_replace("/\n/", '</p><p>', $value);
            $file = preg_replace($var, $value, $file);
        }

        echo $file;*/
        include $this->resDir . $page;
    }
}
