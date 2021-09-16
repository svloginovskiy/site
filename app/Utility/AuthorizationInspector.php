<?php

namespace app\Utility;

class AuthorizationInspector
{
    public function __construct()
    {
    }

    public function check(): bool
    {
        return isset($_SESSION['logged_in']) && $_SESSION['logged_in'];
    }
}