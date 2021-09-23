<?php

namespace app\Utility;

use app\Repositories\UserRepository;

class AuthorizationInspector
{
    private $userRepo;

    public function __construct(UserRepository $userRepo)
    {
        $this->userRepo = $userRepo;
    }

    public function check(): bool
    {
        return isset($_SESSION['logged_in']) && $_SESSION['logged_in'];
    }
    public function requestedByAdmin(): bool
    {
        if (!$this->check()) {
            return false;
        } else {
            $user = $this->userRepo->getById($_SESSION['user_id']);
            return $user->getRole() == 'admin';
        }
    }
}