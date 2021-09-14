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
            header("Location: /");
        } else {
            $this->view->render('login');
        }
    }

    public function auth()
    {
        session_start();
        $name = strtolower(trim($_POST['name']));
        $password = $_POST['password'];
        $user = $this->userRepo->getByName($name);
        if ($user == null) {
            $this->view->render('login', ['authFailed' => true]);
        } elseif (password_verify($password, $user->getPassword())) {
            $_SESSION['logged_in'] = true;
            $_SESSION['username'] = $name;
            $_SESSION['user_id'] = $user->getId();
            header('Location: /login');
        } else {
            $this->view->render('login', ['authFailed' => true]);
        }
    }
}
