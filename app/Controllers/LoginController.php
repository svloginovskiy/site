<?php

namespace app\Controllers;

use View;

class LoginController
{
    private $view;
    private $userRepo;

    public function __construct(\app\View\View $view, \app\Repositories\UserRepository $userRepo)
    {
        $this->view = $view;
        $this->userRepo = $userRepo;
    }

    public function show()
    {
        session_start();
        if ($_SESSION['logged_in']) {
            echo 'You are already logged in!';
        } else {
            $this->view->render("login.php");
        }
    }

    public function auth()
    {
        session_start();
        $name = $_POST['name'];
        $password = $_POST['password'];
        $user = $this->userRepo->getUserByName($name);
        if ($user == null) {
            $this->view->render("login.php");
            echo 'No such username!';
            //} elseif (password_verify($password, $user->getPassword())) {
        } elseif ($password == $user->getPassword()) {
            $_SESSION['logged_in'] = true;
            header("Location: /login");
        } else {
            $this->view->render("login.php");
            echo 'Wrong password!';
        }
    }
}
