<?php

namespace app\Controllers;

use app\Repositories\PostRepository;
use app\Repositories\UserRepository;
use app\Service\View;
use app\Utility\AuthorizationInspector;

class AdminpageController extends Controller
{
    private $userRepo;
    private $postRepo;
    public function __construct(View $view, AuthorizationInspector $authCheck, UserRepository $userRepo, PostRepository $postRepo)
    {
        parent::__construct($view, $authCheck);
        $this->userRepo = $userRepo;
        $this->postRepo = $postRepo;
    }

    public function showUsers()
    {
        if ($this->authCheck->requestedByAdmin()) {
            $users = $this->userRepo->getUsersWithoutPassword();
            $vars = [
                'users' => $users
            ];
            $this->view->render('admin_users', $vars);
        } else {
            $this->view->render('404');
        }
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

    public function showPosts()
    {
        if ($this->authCheck->requestedByAdmin()) {
            $posts = $this->postRepo->getPostsAndCreators();
            $vars = ['posts' => $posts];
            $this->view->render('admin_posts', $vars);
        } else {
            $this->view->render('404');
        }
    }

    public function deletePost($post_id)
    {
        if ($this->authCheck->requestedByAdmin()) {
            return $this->postRepo->deletePost($post_id);
        }
    }
}