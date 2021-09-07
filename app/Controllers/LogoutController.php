<?php

namespace app\Controllers;

class LogoutController
{
    public function __construct()
    {
    }

    public function logout()
    {
        session_start();
        if ($_SESSION['logged_in']) {
            session_unset();
        }
        header('Location: /');
    }
}