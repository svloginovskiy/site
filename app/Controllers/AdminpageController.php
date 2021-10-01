<?php

namespace app\Controllers;

use app\Repositories\PostRepository;
use app\Repositories\UserRepository;
use app\Service\View;
use app\Utility\AuthorizationInspector;
use app\Utility\Paginator;

class AdminpageController extends Controller
{
    private $userRepo;
    private $postRepo;
    private $paginator;

    public function __construct(
        View $view,
        AuthorizationInspector $authCheck,
        UserRepository $userRepo,
        PostRepository $postRepo,
        Paginator $paginator
    ) {
        parent::__construct($view, $authCheck);
        $this->userRepo = $userRepo;
        $this->postRepo = $postRepo;
        $this->paginator = $paginator;
    }

    public function showUsers($pageNum)
    {
        if ($this->authCheck->requestedByAdmin()) {
            $POSTS_NUM = 14;
            $usersCount = $this->userRepo->getUsersCount();
            $users = $this->userRepo->getUsersByAmountAndOffset($POSTS_NUM, ($pageNum - 1) * $POSTS_NUM);
            $vars = [
                'users' => $users,
                'CUR_PATH' => '/admin/users/'
            ];
            $this->paginator->help($usersCount, $POSTS_NUM, $pageNum, $vars);
            $this->view->render('admin_users', $vars);
        } else {
            $this->view->render('404');
        }
    }

    public function deleteUser($user_id)
    {
        if ($this->authCheck->requestedByAdmin()) {
            $this->userRepo->deleteUser($user_id);
        }
    }

    public function changeRole($user_id)
    {
        if ($this->authCheck->requestedByAdmin()) {
            $this->userRepo->changeRole($user_id, $_POST['role']);
        }
    }

    public function showPosts($pageNum)
    {
        if ($this->authCheck->requestedByAdmin()) {
            $POSTS_NUM = 14;
            $postsCount = $this->postRepo->getPostsCount();
            $posts = $this->postRepo->getPostsAndCreatorsWithAmountAndOffset($POSTS_NUM, ($pageNum - 1) * $POSTS_NUM);
            foreach ($posts as &$post) {
                $category = $this->postRepo->getCategoryOfPost($post['id']);
                $post['category'] = $category;
            }
            $vars = [
                'posts' => $posts,
                'CUR_PATH' => '/admin/posts/'
            ];
            $this->paginator->help($postsCount, $POSTS_NUM, $pageNum, $vars);
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

    public function editPost($post_id)
    {
        if ($this->authCheck->requestedByAdmin()) {
            $this->postRepo->changeCategory($post_id, $_POST['category']);
        }
    }

    public function show()
    {
        if ($this->authCheck->requestedByAdmin()) {
            header('Location: /admin/users');
        }
    }
}