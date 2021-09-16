<?php


namespace app\Controllers;


use app\Service\View;
use app\Utility\AuthorizationInspector;

class Controller
{
    protected $view;
    protected $authCheck;

    public function __construct(View $view, AuthorizationInspector $authCheck)
    {
        $this->view = $view;
        $this->authCheck = $authCheck;
    }
}