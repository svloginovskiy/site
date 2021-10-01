<?php


namespace app\Controllers;


use app\Repositories\UserRepository;
use app\Service\View;
use app\Utility\AuthorizationInspector;

class JsonUsersController extends Controller
{
    private $userRepo;
    public function __construct(View $view, AuthorizationInspector $authCheck, UserRepository $userRepo)
    {
        parent::__construct($view, $authCheck);
        $this->userRepo = $userRepo;
    }

    public function respond()
    {
        if ($this->authCheck->requestedByAdmin()) {
            header('Content-Type: application/json');
            $totalCount = $this->userRepo->getUsersCount();
            header('x-total-count: ' . $totalCount);
            $limit = $_GET['limit'];
            $page = $_GET['page'];
            $users = $this->userRepo->getUsersByAmountAndOffset($limit, ($page - 1) * $limit);
            foreach ($users as &$user) {
                unset($user['password']);
            }
            echo json_encode($users);
        }
    }
}