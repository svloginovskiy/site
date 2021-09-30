<?php


namespace app\Controllers;


use app\Repositories\PostRepository;
use app\Service\View;
use app\Utility\AuthorizationInspector;

class JsonPostsController extends Controller
{
    private $postRepo;

    public function __construct(View $view, AuthorizationInspector $authCheck, PostRepository $postRepo)
    {
        parent::__construct($view, $authCheck);
        $this->postRepo = $postRepo;
    }

    public function respond()
    {
        if (true || $this->authCheck->requestedByAdmin()) {
            header('Content-Type: application/json');
            $totalCount = $this->postRepo->getPostsCount();
            header('x-total-count: ' . $totalCount);
            $limit = $_GET['limit'];
            $page = $_GET['page'];
            $posts = $this->postRepo->getPostsAndCreatorsWithAmountAndOffset($limit, ($page - 1) * $limit);
            foreach ($posts as &$post) {
                $category = $this->postRepo->getCategoryOfPost($post['id']);
                $post['category'] = $category;
            }
            echo json_encode($posts);
        }
    }
}