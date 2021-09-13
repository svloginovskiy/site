<?php

namespace app\Controllers;

use app\Repositories\PostRepository;
use app\Repositories\VoteRepository;
use app\Service\View;

class PostController
{
    private $view;
    private $postRepo;
    private $voteRepo;

    public function __construct(View $view, PostRepository $postRepo, VoteRepository $voteRepo)
    {
        $this->view = $view;
        $this->postRepo = $postRepo;
        $this->voteRepo = $voteRepo;
    }

    public function show(int $number)
    {
        session_start();
        $post = $this->postRepo->getById($number);
        if ($post == null) {
            $this->view->render('404');
        } else {
            $text = $post->getText();
            $title = $post->getTitle();
            $rating = $this->voteRepo->getRatingByPostId($number);

            $vars = [
                'VIEWTITLE' => $title,
                'title' => $title,
                'text' => $text,
                'rating' => $rating
            ];
            if ($_SESSION['logged_in']) {
                $userRating = $this->voteRepo->getRatingByPostIdAndUserId($number, $_SESSION['user_id']);
                if ($userRating == 1) {
                    $vars['isUpvoted'] = true;
                } elseif ($userRating == -1) {
                    $vars['isUpvoted'] = false;
                }
            }
            $this->view->render('post', $vars);
        }
    }

    public function upvote(int $post_id)
    {
        session_start();
        if ($_SESSION[logged_in]) {
            $user_id = $_SESSION['user_id'];
            //$rating = $this->voteRepo->getRatingByPostIdAndUserId($post_id, $user_id);
            $this->voteRepo->save($post_id, $user_id, 1);

        }
        echo $this->voteRepo->getRatingByPostId($post_id);
    }

    public function downvote(int $post_id)
    {
        session_start();
        if ($_SESSION[logged_in]) {
            $user_id = $_SESSION['user_id'];
            $this->voteRepo->save($post_id, $user_id, -1);

        }
        echo $this->voteRepo->getRatingByPostId($post_id);
    }

}