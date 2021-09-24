<?php

namespace app\Controllers;

use app\Models\Comment;
use app\Repositories\CommentRepository;
use app\Repositories\PostRepository;
use app\Repositories\VoteRepository;
use app\Service\View;
use app\Utility\AuthorizationInspector;

class PostController extends Controller
{
    private $postRepo;
    private $voteRepo;
    private $commentRepo;

    public function __construct(
        View $view,
        PostRepository $postRepo,
        VoteRepository $voteRepo,
        CommentRepository $commentRepo,
        AuthorizationInspector $authCheck
    ) {
        parent::__construct($view, $authCheck);
        $this->postRepo = $postRepo;
        $this->voteRepo = $voteRepo;
        $this->commentRepo = $commentRepo;
    }

    public function show(int $number)
    {
        $post = $this->postRepo->getById($number);
        if ($post == null) {
            $this->view->render('404');
        } else {
            $text = $post->getText();
            $title = $post->getTitle();
            $rating = $this->voteRepo->getRatingByPostId($number);
            $comments = $this->commentRepo->getCommentsByPostId($number);
            $category = $this->postRepo->getCategoryOfPost($number);

            $vars = [
                'VIEWTITLE' => $title,
                'title' => $title,
                'text' => $text,
                'rating' => $rating,
                'post_id' => $number,
                'isLoggedIn' => $this->authCheck->check(),
                'comments' => $comments,
                'category' => $category
            ];
            if ($this->authCheck->check()) {
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
        if ($this->authCheck->check()) {
            $user_id = $_SESSION['user_id'];
            $oldRating = $this->voteRepo->getRatingByPostIdAndUserId($post_id, $user_id);
            $newRating = 0;
            if ($oldRating == 0 || $oldRating == -1) {
                $newRating = 1;
            }
            $this->voteRepo->saveVote($post_id, $user_id, $newRating);
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
            $this->voteRepo->saveVote($post_id, $user_id, $newRating);
        }
        echo $this->voteRepo->getRatingByPostId($post_id);
    }

    public function comment(int $post_id)
    {
        if (!$this->authCheck->check()) {
            return;
        }
        $user_id = $_SESSION['user_id'];
        $text = trim(htmlspecialchars($_POST['comment']));
        if ($this->isTextValid($text)) {
            $comment = (new Comment())->setId(0)->setPostId($post_id)->setUserId($user_id)->setText($text);
            $this->commentRepo->save($comment);
        }
        header('Location: /posts/' . $post_id);
    }

    private function isTextValid(string $text): bool
    {
        $MAX_TEXT_SIZE = 400;
        return !empty($text) && strlen($text) < $MAX_TEXT_SIZE;
    }
}