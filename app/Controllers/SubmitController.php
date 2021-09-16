<?php

namespace app\Controllers;

use app\Models\Post;
use app\Repositories\PostRepository;
use app\Service\View;
use app\Utility\AuthorizationInspector;

class SubmitController extends Controller
{
    private $postRepo;

    public function __construct(View $view, PostRepository $postRepo, AuthorizationInspector $authCheck)
    {
        parent::__construct($view, $authCheck);
        $this->postRepo = $postRepo;
    }

    public function show()
    {
        if ($this->authCheck->check()) {
            $this->view->render('submit');
        } else {
            header('Location: /login');
        }
    }

    public function savePost()
    {
        $imagesDir = '/images/';
        if ($this->authCheck->check()) {
            $text = htmlspecialchars($_POST['text']);
            $title = htmlspecialchars($_POST['title']);
            $default_rating = 1;
            if (!$this->isTextValid($text)) {
                $this->view->render('submit', ['title' => $title, 'text' => $text, 'isTextValid' => false]);
                return;
            } elseif (!$this->isTitleValid($title)) {
                $this->view->render('submit', ['title' => $title, 'text' => $text, 'isTitleValid' => false]);
                return;
            }
            $text = preg_replace('/\n(?!$)/', '</p><p>', $text);
            $text = '<p>' . $text . '</p>';
            $user_id = $_SESSION['user_id'];
            if ($this->handleUploadedFile() != null) {
                $text .= "<img src=\"$imagesDir" . $_FILES['image']['name'] .
                    "\" class=\"img-fluid mb-3 mx-auto d-block\" alt=\"image\">";
            }
            $post = (new Post())->setId(0)->setText($text)->setTitle($title)->setUserId($user_id);
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
