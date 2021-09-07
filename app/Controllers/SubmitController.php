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
                return;
            } elseif (!$this->isTitleValid($title)) {
                $this->view->render('submit', ['title' => $title, 'text' => $text, 'isTitleValid' => false]);
                return;
            }
            $text = preg_replace('/\n(?!$)/', '</p><p>', $text);
            $text = '<p>' . $text . '</p>';
            $userId = $_SESSION['user_id'];
            if ($this->handleUploadedFile() != null) {
                $text .= "<img src=\"$imagesDir" . $_FILES['image']['name'] . "\" class=\"img-fluid mb-3\" alt=\"image\">";
            }
            $post = new Post(0, $text, $title, $userId);
            $id = $this->postRepo->save($post);
            Header('Location: /posts/' . $id);
        } else {
            header('Location: /login');
        }
    }

    private function handleUploadedFile(): ?string
    {
        $uploadDir = __DIR__ . '/../../public/images/';
        $uploadFile = $uploadDir . basename($_FILES['image']['name']);
        if (
            !empty($_FILES['image']['name']) &&
            (move_uploaded_file(
                $_FILES['image']['tmp_name'],
                $uploadFile
            ) || file_exists($uploadFile))
        ) {
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

    private function isTitleValid(string $title): bool
    {
        $MAX_TITLE_SIZE = 80;
        return strlen($title) < $MAX_TITLE_SIZE;
    }
}
