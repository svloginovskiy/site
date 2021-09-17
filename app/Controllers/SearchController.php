<?php


namespace app\Controllers;


use app\Repositories\PostRepository;
use app\Repositories\VoteRepository;
use app\Service\View;
use app\Utility\AuthorizationInspector;
use app\Utility\Paginator;

class SearchController extends Controller
{
    private $postRepo;
    private $voteRepo;

    public function __construct(
        View $view,
        AuthorizationInspector $authCheck,
        PostRepository $postRepo,
        VoteRepository $voteRepo
    ) {
        parent::__construct($view, $authCheck);
        $this->postRepo = $postRepo;
        $this->voteRepo = $voteRepo;
    }

    public function show()
    {
        $searchQuery = $_GET['q'];
        $postsWithMatchedTitle = $this->postRepo->getPostsByTitlePattern($searchQuery);
        $postsWithMatchedText = $this->postRepo->getPostsByTextPattern($searchQuery);
        $postObjs = array_merge($postsWithMatchedTitle, $postsWithMatchedText);
        $posts = [];
        foreach ($postObjs as $post) {
            $rating = $this->voteRepo->getRatingByPostId($post->getId());
            $posts[] = [
                'id' => $post->getId(),
                'title' => $post->getTitle(),
                'text' => $post->getText(),
                'user_id' => $post->getUserId(),
                'rating' => $rating
            ];
        }
        if (empty($posts)) {
            $vars = ['searchQuery' => $searchQuery];
            $this->view->render('no_posts_found', $vars);
        } else {
            $vars = ['posts' => $posts];
            $this->view->render('search', $vars);
        }
    }
}