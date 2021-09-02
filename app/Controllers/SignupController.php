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
        $name = strtolower(trim($_POST['name']));
        $password = $_POST['password'];
        $email = strtolower(trim($_POST['email']));
        $userByName = $this->userRepo->getByName($name);
        $userByEmail = $this->userRepo->getByEmail($email);
        $vars = [];
        $vars['name'] = $name;
        $this->view->render('signup_welcome', $vars);
        if (
            $userByName == null && $userByEmail == null && $this->isNameValid($name) &&
            $this->isPasswordValid($password) && $this->isEmailValid($email)
        ) {

            $user = new User(0, $name, $email, password_hash($password, PASSWORD_DEFAULT));
            $this->userRepo->save($user);
            $vars['name'] = $name;
            $this->view->render('signup_welcome', $vars);
        } else {
            $vars['isNameValid'] = $this->isNameValid($name);
            $vars['isPasswordValid'] = $this->isPasswordValid($password);
            $vars['isEmailValid'] = $this->isEmailValid($email);
            $vars['isNameAvailable'] = ($userByName == null);
            $vars['isEmailAvailable'] = ($userByEmail == null);
            $vars['name'] = $name;
            $vars['email'] = $email;
            $vars['password'] = $password;
            $this->view->render('signup', $vars);
        }
    }

    private function isNameValid($name): bool
    {
        $minNameLength = 3;
        $maxNameLength = 30;
        return strlen($name) >= $minNameLength &&
            strlen($name) <= $maxNameLength &&
            preg_match(
                '#^\w+$#',
                $name
            ) == 1;
    }

    private function isEmailValid($email): bool
    {
        return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
    }

    private function isPasswordValid($password): bool
    {
        $minPasswordLength = 8;
        return strlen($password) >= $minPasswordLength;
    }
}
