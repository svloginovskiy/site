<?php

namespace app\View;

class View
{
    public function __construct()
    {
    }

    public function render(string $page)
    {
        include __DIR__ . '../../resources/' . $page;
    }

}
