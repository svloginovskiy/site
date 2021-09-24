<?php

namespace app\Controllers;

use app\Repositories\PostRepository;
use app\Repositories\VoteRepository;
use app\Service\View;
use app\Utility\AuthorizationInspector;
use app\Utility\Paginator;

class CategoryController extends Controller
{
    private $postRepo;
    private $voteRepo;
    private $paginator;

    public function __construct(
        View $view,
        AuthorizationInspector $authCheck,
        PostRepository $postRepo,
        VoteRepository $voteRepo,
        Paginator $paginator
    ) {
        parent::__construct($view, $authCheck);
        $this->postRepo = $postRepo;
        $this->voteRepo = $voteRepo;
        $this->paginator = $paginator;
    }

    public function show(int $pageNum, string $category)
    {
        $POSTS_NUM = 5;
        $postsCount = $this->postRepo->getPostsCountByCategory($category);
        $posts = $this->postRepo->getPostsByCategoryNameWithAmountAndOffset(
            $category,
            $POSTS_NUM,
            ($pageNum - 1) * $POSTS_NUM
        );
        $user_id = $_SESSION['user_id'];
        foreach ($posts as &$post) {
            $post['category'] = $category;
            if ($this->authCheck->check()) {
                $userRating = $this->voteRepo->getRatingByPostIdAndUserId($post['id'], $user_id);
                if ($userRating == 1) {
                    $post['isUpvoted'] = true;
                } elseif ($userRating == -1) {
                    $post['isUpvoted'] = false;
                }
            }
        }
        $vars = [
            'posts' => $posts,
            'category' => $category,
            'isLoggedIn' => $this->authCheck->check(),
            'CUR_PATH' => '/' . $category . '/'
        ];
        $this->paginator->help($postsCount, $POSTS_NUM, $pageNum, $vars);
        $this->view->render('category', $vars);
    }
}