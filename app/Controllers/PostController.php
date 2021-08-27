<?php

namespace app\Controllers;

use app\Models\Post;
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

    public function showEntry(int $number)
    {
        $post = $this->entryRepo->getById($number);
        $text = $post->getText();
        $vars = [
            ":num" => $number,
            ":text" => $text
        ];
        $this->view->renderWithVars('post.php', $vars);
    }

}