<?php

namespace app\Controllers;

use app\Repositories\UserRepository;
use app\Service\View;

class LoginController
{
    private $view;
    private $userRepo;

    public function __construct(View $view, UserRepository $userRepo)
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
            $this->view->render("login");
        }
    }

    public function auth()
    {
        session_start();
        $name = $_POST['name'];
        $password = $_POST['password'];
        $user = $this->userRepo->getUserByName($name);
        if ($user == null) {
            $this->view->render("login");
            echo 'No such username!';
        } elseif ($password == $user->getPassword()) { //TODO password_verify($password, $user->getPassword())
            $_SESSION['logged_in'] = true;
            header("Location: /login");
        } else {
            $this->view->render("login");
            echo 'Wrong password!';
        }
    }
}
