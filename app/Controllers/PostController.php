<?php

namespace app\Controllers;

use app\Models\Comment;
use app\Repositories\CommentRepository;
use app\Repositories\PostRepository;
use app\Repositories\VoteRepository;
use app\Service\View;

class PostController
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
            $comments = $this->commentRepo->getCommentsByPostId($number);

            $vars = [
                'VIEWTITLE' => $title,
                'title' => $title,
                'text' => $text,
                'rating' => $rating,
                'post_id' => $number,
                'isLoggedIn' => $_SESSION['logged_in'],
                'comments' => $comments
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
        if ($_SESSION['logged_in']) {
            $user_id = $_SESSION['user_id'];
            $oldRating = $this->voteRepo->getRatingByPostIdAndUserId($post_id, $user_id);
            $newRating = 0;
            if ($oldRating == 0 || $oldRating == -1) {
                $newRating = 1;
            }
            $this->voteRepo->save($post_id, $user_id, $newRating);
        }
        echo $this->voteRepo->getRatingByPostId($post_id);
    }

    public function downvote(int $post_id)
    {
        session_start();
        if ($_SESSION['logged_in']) {
            $user_id = $_SESSION['user_id'];
            $oldRating = $this->voteRepo->getRatingByPostIdAndUserId($post_id, $user_id);
            $newRating = 0;
            if ($oldRating == 0 || $oldRating == 1) {
                $newRating = -1;
            }
            $this->voteRepo->save($post_id, $user_id, $newRating);
        }
        echo $this->voteRepo->getRatingByPostId($post_id);
    }

    public function comment(int $post_id)
    {
        session_start();
        if (!$_SESSION['logged_in']) {
            return;
        }
        $user_id = $_SESSION['user_id'];
        $text = htmlspecialchars($_POST['comment']);
        $comment = new Comment(0, $post_id, $user_id, $text);
        $this->commentRepo->save($comment);
        header('Location: /posts/' . $post_id);
    }

    private function isTextValid(string $text): bool
    {
        $MAX_TEXT_SIZE = 65000;
        return strlen($text) < $MAX_TEXT_SIZE;
    }
}