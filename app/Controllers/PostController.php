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
        $text = $post->getText();
        $text = preg_replace("/\n/", '</p><p>', $text);
        $vars = [
            "num" => $number,
            "text" => $text
        ];
        $this->view->render('post', $vars);
    }

}