<?php

namespace app\Controllers;

use app\Repositories\CommentRepository;
use app\Repositories\PostRepository;
use app\Repositories\VoteRepository;
use app\Service\View;

class FrontpageController
{
    private $view;
    private $postRepo;
    private $voteRepo;
    private $commentRepo;

    public function __construct(View $view, PostRepository $postRepo, VoteRepository $voteRepo, CommentRepository $commentRepo)
    {
        $this->view = $view;
        $this->postRepo = $postRepo;
        $this->voteRepo = $voteRepo;
        $this->commentRepo = $commentRepo;
    }

    public function show()
    {
        $POSTS_NUM = 5;
        $postsCount = $this->postRepo->getPostsCount();
        $posts = $this->postRepo->getByIdRange($postsCount - $POSTS_NUM, $postsCount);
        foreach ($posts as &$post) {
            $rating = $this->voteRepo->getRatingByPostId($post['id']);
            $post['rating'] = $rating;
        }
        $posts= array_reverse($posts);
        $vars = [
            'posts' => $posts
        ];
        $this->view->render('frontpage', $vars);
    }

}