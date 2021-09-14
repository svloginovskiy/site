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

    public function __construct(
        View $view,
        PostRepository $postRepo,
        VoteRepository $voteRepo,
        CommentRepository $commentRepo
    ) {
        $this->view = $view;
        $this->postRepo = $postRepo;
        $this->voteRepo = $voteRepo;
        $this->commentRepo = $commentRepo;
    }

    public function show(int $pageNum)
    {
        session_start();
        $POSTS_NUM = 5;
        $postsCount = $this->postRepo->getPostsCount();
        $posts = $this->postRepo->getByIdRange(
            $postsCount - $POSTS_NUM * $pageNum,
            $postsCount - $POSTS_NUM * ($pageNum - 1)
        );
        foreach ($posts as &$post) {
            $rating = $this->voteRepo->getRatingByPostId($post['id']);
            $post['rating'] = $rating;
        }
        $posts = array_reverse($posts);
        $lastPageNum = intdiv($postsCount, $POSTS_NUM) + ($postsCount % $POSTS_NUM == 0 ? 0 : 1);
        $vars = [
            'posts' => $posts,
            'last' => $lastPageNum
        ];

        if ($pageNum == 1) {
            $vars['prev'] = 1;
            $vars['current'] = 2;
            $vars['next'] = 3;
            $vars['prevActive'] = true;
        } elseif ($pageNum == $lastPageNum) {
            $vars['prev'] = $pageNum - 2;
            $vars['current'] = $pageNum - 1;
            $vars['next'] = $pageNum;
            $vars['nextActive'] = true;
        } else {
            $vars['prev'] = $pageNum - 1;
            $vars['current'] = $pageNum;
            $vars['next'] = $pageNum + 1;
            $vars['curActive'] = true;
        }
        $this->view->render('frontpage', $vars);
    }

}