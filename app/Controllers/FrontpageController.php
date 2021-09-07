<?php

use app\Repositories\PostRepository;
use app\Service\View;

class FrontpageController
{
    private $view;
    private $postRepo;

    public function __construct(View $view, PostRepository $postRepo)
    {
        $this->view = $view;
        $this->postRepo = $postRepo;
    }

    public function show()
    {

    }

}