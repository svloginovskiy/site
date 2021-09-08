<?php

namespace app\Controllers;

use app\Repositories\PostRepository;
use app\Service\View;

class PostController
{
    private $view;
    private $postRepo;

    public function __construct(View $view, PostRepository $postRepo)
    {
        $this->view = $view;
        $this->postRepo = $postRepo;
    }

    public function show(int $number)
    {
        $post = $this->postRepo->getById($number);
        if ($post == null) {
            $this->view->render('404');
        } else {
            $text = $post->getText();
            $title = $post->getTitle();
            $rating = $post->getRating();
            $vars = [
                'VIEWTITLE' => $title,
                'title' => $title,
                'text' => $text,
                'rating' => $rating
            ];
            $this->view->render('post', $vars);
        }
    }

}