<?php

namespace app\Controllers;

use app\Repositories\UserRepository;
use app\Service\View;
use app\Utility\AuthorizationInspector;

class AdminpageController extends Controller
{
    private $userRepo;
    public function __construct(View $view, AuthorizationInspector $authCheck, UserRepository $userRepo)
    {
        parent::__construct($view, $authCheck);
        $this->userRepo = $userRepo;
    }

    public function showUsers()
    {

        $users = $this->userRepo->getUsersWithoutPassword();
        $vars = [
            'users' => $users
        ];
        $this->view->render('admin_users', $vars);
    }

    public function deleteUser($user_id)
    {
        if ($this->authCheck->requestedByAdmin() && $this->userRepo->getById($user_id)->getRole() != 'admin') {
            $this->userRepo->deleteUser($user_id);
        }
    }

    public function changeRole($user_id)
    {
        if ($this->authCheck->requestedByAdmin()) {
            $this->userRepo->changeRole($user_id, $_POST['role']);
        }
    }
}