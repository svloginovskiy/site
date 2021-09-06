<?php

namespace app\Controllers;

use app\Models\Post;
use app\Repositories\PostRepository;
use app\Service\View;

class SubmitController
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
        session_start();
        if ($_SESSION['logged_in']) {
            $this->view->render('submit');
        } else {
            header('Location: /login');
        }
    }

    public function savePost()
    {
        session_start();
        $imagesDir = '/images/';
        if ($_SESSION['logged_in']) {
            $text = htmlspecialchars($_POST['text']);
            $title = htmlspecialchars($_POST['title']);
            if (!$this->isTextValid($text)) {
                $this->view->render('submit', ['title' => $title, 'text' => $text, 'isTextValid' => false]);
            }
            $userId = $_SESSION['user_id'];
            if ($this->handleUploadedFile() != null) {
                $text .= "</p> <img src=\"$imagesDir" . $_FILES['image']['name'] . "\" alt=\"image\" > <p>";
            }
            $post = new Post(0, $text, $title, $userId);
            $this->postRepo->save($post);
        } else {
            header('Location: /login');
        }
    }

    private function handleUploadedFile() : ?string
    {
        $uploadDir = __DIR__ . '/../../public/images/';
        $uploadFile = $uploadDir . basename($_FILES['image']['name']);
        if (move_uploaded_file($_FILES['image']['tmp_name'], $uploadFile) || file_exists($uploadFile)) {
            return $uploadFile;
        } else {
            return null;
        }
    }

    private function isTextValid(string $text): bool
    {
        $MAX_TEXT_SIZE = 65000;
        return strlen($text) < $MAX_TEXT_SIZE;
    }
}