<?php

namespace app\Controllers;

use app\Repositories\PostRepository;
use app\Repositories\UserRepository;
use app\Service\View;
use app\Utility\AuthorizationInspector;

class UserpageController extends Controller
{
    private $postRepo;
    private $userRepo;

    public function __construct(View $view, AuthorizationInspector $authCheck, PostRepository $postRepo, UserRepository $userRepo)
    {
        parent::__construct($view, $authCheck);
        $this->postRepo = $postRepo;
        $this->userRepo = $userRepo;
    }

    public function show($username)
    {
        $user = $this->userRepo->getUserByName($username);
        if ($user == null) {
            $this->view->render('404');
        }
        $posts = $this->postRepo->getPostsByUsername($username);
        foreach ($posts as &$post) {
            $category = $this->postRepo->getCategoryOfPost($post['id']);
            $post['category'] = $category;
        }
        $vars = [
            'posts' => $posts,
            'username' => $username,
            'description' => $user->getDescription()
        ];
        $this->view->render('userpage', $vars);
    }

    public function showSettings($username)
    {
        $user = $this->userRepo->getUserByName($username);
        if ($user->getId() == $_SESSION['user_id']) {
            $vars = [
                'username' => $username,
                'email' => $user->getEmail(),
                'description' => $user->getDescription(),
                'avatar' => $user->getAvatar()
            ];
            $this->view->render('user_settings', $vars);
        } else {
            $this->view->render('404');
        }
    }

    public function editUser($username)
    {
        $avatarDir = '/images/avatars/';
        $user = $this->userRepo->getUserByName($username);
        if ($user->getId() == $_SESSION['user_id']) {
            if (isset($_POST['username']) && !empty($_POST['username'])) {
                $user->setName($_POST['username']);
            }
            if (isset($_POST['email']) && !empty($_POST['email'])) {
                $user->setEmail($_POST['email']);
            }
            if (isset($_POST['password']) && !empty($_POST['password'])) {
                $user->setPassword(password_hash($_POST['password'], PASSWORD_DEFAULT));
            }
            $user->setDescription(trim(htmlspecialchars($_POST['description'])));

            if ($this->handleUploadedFile() != null) {
                $user->setAvatar($avatarDir . $_FILES['image']['name']);

            }

            $this->userRepo->updateUser($user);
            $vars = [
                'username' => $user->getName(),
                'email' => $_FILES,
                'description' => var_dump($_FILES)//$user->getDescription()
            ];
            var_dump($_FILES);
            //header('Location: /u/' . $user->getName() . '/settings');
        } else {
            $this->view->render('404');
        }
    }

    private function handleUploadedFile(): ?string
    {
        $uploadDir = __DIR__ . '/../../public/images/avatars/';
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
}