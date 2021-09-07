<?php

namespace app\Controllers;

use app\Repositories\PostRepository;
use app\Service\View;

class PostController
{
    private $view;
    private $entryRepo;

    public function __construct(View $view, PostRepository $entryRepo)
    {
        $this->view = $view;
        $this->entryRepo = $entryRepo;
    }

    public function show(int $number)
    {
        $post = $this->entryRepo->getById($number);
        if ($post == null) {
            $this->view->render('404');
        } else {
            $text = $post->getText();
            $title = $post->getTitle();

            $vars = [
                'VIEWTITLE' => $title,
                'title' => $title,
                'text' => $text
            ];
            $this->view->render('post', $vars);
        }
    }

}