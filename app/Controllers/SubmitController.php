<?php

namespace app\Controllers;

use app\Repositories\PostRepository;
use app\Service\View;

class SubmitController
{
    private $view;
    private $entryRepo;

    public function __construct(View $view, PostRepository $entryRepo)
    {
        $this->view = $view;
        $this->entryRepo = $entryRepo;
    }

    public function show()
    {
        session_start();
        if ($_SESSION['logged_in']) {
            $this->view->render('submit');
        } else {
            header('Location: /login');
        }
    }
}