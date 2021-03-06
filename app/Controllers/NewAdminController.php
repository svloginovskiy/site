<?php


namespace app\Controllers;


use app\Repositories\PostRepository;
use app\Repositories\UserRepository;
use app\Service\View;
use app\Utility\AuthorizationInspector;

class NewAdminController extends Controller
{
    private $postRepo;
    private $userRepo;

    public function __construct(View $view, AuthorizationInspector $authCheck, PostRepository $postRepo, UserRepository $userRepo)
    {
        parent::__construct($view, $authCheck);
        $this->postRepo = $postRepo;
        $this->userRepo = $userRepo;
    }

    public function show()
    {
        if ($this->authCheck->requestedByAdmin()) {
            $this->view->renderReact();
        } else {
            $this->view->render('404');
        }
    }

    public function editPost($id)
    {
        $post = [
            'id' => trim($_POST['id']),
            'text' => trim($_POST['text']),
            'title' => trim($_POST['title']),
            'category' => trim($_POST['category'])
        ];

        $this->postRepo->updatePost($post);
    }

    public function editUser($id)
    {
        $role = $_POST['role'];
        $this->userRepo->changeRole($id, $role);
    }
}