<?php

namespace app\Controllers;

use app\Models\User;
use app\Repositories\UserRepository;
use app\Service\View;

class SignupController
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
            echo 'You are logged in!'; //TODO
        } else {
            $this->view->render("signup");
        }
    }

    public function register()
    {
        $name = $_POST['name'];
        $password = $_POST['password'];
        $email = $_POST['email'];
        $userByName = $this->userRepo->getByName($name);
        $userByEmail = $this->userRepo->getByEmail($email);
        $vars = [];
        if ($userByName != null) {
            $vars['isNameAvailable'] = false;
        }
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $vars['isEmailValid'] = false;
        } elseif ($userByEmail != null) {
            $vars['isEmailAvailable'] = false;
        }
        if ($userByName == null && $userByEmail == null) {
            $user = new User(0, $name, $email, password_hash($password, PASSWORD_DEFAULT));
            $this->userRepo->save($user);
        } else {
            $this->view->render('signup', $vars);
        }
    }
}