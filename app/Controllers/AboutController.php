<?php

namespace app\Controllers;

use app\Service\View;

class AboutController
{
    private $view;

    public function __construct(View $view)
    {
        $this->view = $view;
    }

    public function show()
    {
        $this->view->render('about');
    }
}