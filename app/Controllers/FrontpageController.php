<?php

namespace app\Controllers;

use app\Repositories\CommentRepository;
use app\Repositories\PostRepository;
use app\Repositories\VoteRepository;
use app\Service\View;
use app\Utility\AuthorizationInspector;
use app\Utility\Paginator;

class FrontpageController extends Controller
{
    private $postRepo;
    private $voteRepo;
    private $commentRepo;
    private $paginator;

    public function __construct(
        View $view,
        PostRepository $postRepo,
        VoteRepository $voteRepo,
        CommentRepository $commentRepo,
        AuthorizationInspector $authCheck,
        Paginator $paginator
    ) {
        parent::__construct($view, $authCheck);
        $this->postRepo = $postRepo;
        $this->voteRepo = $voteRepo;
        $this->commentRepo = $commentRepo;
        $this->paginator = $paginator;
    }
    public function show(int $pageNum, string $sortedBy)
    {
        $POSTS_NUM = 5;
        $postsCount = $this->postRepo->getPostsCount();
        $posts = [];
        if ($sortedBy == 'time') {
            $posts = $this->postRepo->getPostsByAmountAndOffset(
                $POSTS_NUM,
                ($pageNum - 1) * $POSTS_NUM
            );
        } elseif ($sortedBy == 'rating') {
            $posts = $this->postRepo->getPostsSortedByRating(
                $POSTS_NUM,
                ($pageNum - 1) * $POSTS_NUM
            );
        }
        $user_id = $_SESSION['user_id'];
        foreach ($posts as &$post) {
            $rating = $this->voteRepo->getRatingByPostId($post['id']);
            if ($this->authCheck->check()) {
                $userRating = $this->voteRepo->getRatingByPostIdAndUserId($post['id'], $user_id);
                if ($userRating == 1) {
                    $post['isUpvoted'] = true;
                } elseif ($userRating == -1) {
                    $post['isUpvoted'] = false;
                }
            }
            $category = $this->postRepo->getCategoryOfPost($post['id']);
            $post['category'] = $category;
            $post['rating'] = $rating;
        }
        $vars = [
            'posts' => $posts,
            'sortedBy' => $sortedBy,
            'isLoggedIn' => $this->authCheck->check()
        ];
        $this->paginator->help($postsCount, $POSTS_NUM, $pageNum, $vars);
        $this->view->render('frontpage', $vars);
    }

}