<?php

namespace app\Controllers;

use app\Repositories\UserRepository;
use app\Service\View;
use app\Utility\AuthorizationInspector;

class LoginController extends Controller
{
    private $userRepo;

    public function __construct(View $view, UserRepository $userRepo, AuthorizationInspector $authCheck)
    {
        parent::__construct($view, $authCheck);
        $this->userRepo = $userRepo;
    }

    public function show()
    {
        if ($this->authCheck->check()) {
            header("Location: /");
        } else {
            $this->view->render('login');
        }
    }

    public function auth()
    {
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
