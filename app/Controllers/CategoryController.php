<?php

namespace app\Controllers;

use app\Repositories\PostRepository;
use app\Service\View;
use app\Utility\AuthorizationInspector;

class CategoryController extends Controller
{
    private $postRepo;

    public function __construct(View $view, AuthorizationInspector $authCheck, PostRepository $postRepo)
    {
        parent::__construct($view, $authCheck);
        $this->postRepo = $postRepo;
    }

    public function show($category) {
        $posts = $this->postRepo->getPostsByCategoryName($category);
        foreach ($posts as &$post) {
            $post['category'] = $category;
        }
        $vars = [
            'posts' => $posts,
            'category' => $category
        ];
        $this->view->render('category', $vars);
    }
}