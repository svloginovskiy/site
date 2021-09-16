<?php

namespace app\Controllers;

use app\Service\View;
use app\Utility\AuthorizationInspector;

class LogoutController extends Controller
{

    public function __construct(View $view, AuthorizationInspector $authCheck)
    {
        parent::__construct($view, $authCheck);
    }

    public function logout()
    {
        if ($this->authCheck->check()) {
            session_unset();
        }
        header('Location: /');
    }
}