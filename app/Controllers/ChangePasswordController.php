<?php


namespace app\Controllers;


use app\Repositories\UserRepository;
use app\Service\View;
use app\Utility\AuthorizationInspector;

class ChangePasswordController extends Controller
{
    private $userRepo;

    public function __construct(View $view, AuthorizationInspector $authCheck, UserRepository $userRepo)
    {
        parent::__construct($view, $authCheck);
        $this->userRepo = $userRepo;
    }


}