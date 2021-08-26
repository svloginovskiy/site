<?php

namespace app\Controllers;

use View;

class LoginController
{
    private $view;

    public function __construct(\app\View\View $view)
    {
        $this->view = $view;
    }

    public function show()
    {
        $this->view->render("login.php");
    }

    public function auth()
    {

    }

}