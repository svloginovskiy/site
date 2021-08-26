<?php

namespace app\View;

class View
{
    private $resDir;
    public function __construct()
    {
        $this->resDir = __DIR__ . '/../../resources/';
    }

    public function render(string $page)
    {
        include $this->resDir . $page;
    }

    public function renderWithVars(string $page, array $vars)
    {
        $file = file_get_contents($this->resDir . $page);
        foreach ($vars as $var => $value) {
            $var = '/' . $var . '/';
            $file = preg_replace($var, $value, $file);
        }
        echo $file;
    }
}