<?php

namespace app\Controllers;

use app\Repositories\PostRepository;
use app\Repositories\UserRepository;
use app\Service\View;
use app\Utility\AuthorizationInspector;

class UserpageController extends Controller
{
    private $postRepo;
    private $userRepo;

    public function __construct(View $view, AuthorizationInspector $authCheck, PostRepository $postRepo, UserRepository $userRepo)
    {
        parent::__construct($view, $authCheck);
        $this->postRepo = $postRepo;
        $this->userRepo = $userRepo;
    }

    public function show($username)
    {
        if ($this->userRepo->getUserByName($username) == null) {
            $this->view->render('404');
        }
        $posts = $this->postRepo->getPostsByUsername($username);
        $vars = [
            'posts' => $posts,
            'username' => $username
        ];
        $this->view->render('userpage', $vars);
    }
}