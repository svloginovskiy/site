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
        include $this->resDir . $page;
    }
}
