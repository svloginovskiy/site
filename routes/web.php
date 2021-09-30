<?php

namespace routes;

use app\Service\Container;
use Exception;

function initRoutes(Container $container)
{
    try {
        $router = $container->create('\app\Service\Router');

        $router->get(
            '/login',
            function () use ($container) {
                $container->create('\app\Controllers\LoginController')->show();
            }
        );
        $router->post(
            '/login',
            function () use ($container) {
                $container->create('\app\Controllers\LoginController')->auth();
            }
        );

        $router->get(
            '/signup',
            function () use ($container) {
                $container->create('\app\Controllers\SignupController')->show();
            }
        );
        $router->post(
            '/signup',
            function () use ($container) {
                $container->create('\app\Controllers\SignupController')->register();
            }
        );

        $router->get(
            '/posts/([1-9]\\d*)',
            function ($number) use ($container) {
                $container->create('\app\Controllers\PostController')->show($number);
            }
        );
        $router->get(
            '/submit',
            function () use ($container) {
                $container->create('\app\Controllers\SubmitController')->show();
            }
        );
        $router->post(
            '/submit',
            function () use ($container) {
                $container->create('\app\Controllers\SubmitController')->savePost();
            }
        );
        $router->get(
            '/logout',
            function () use ($container) {
                $container->create('\app\Controllers\LogoutController')->logout();
            }
        );
        $router->get(
            '/about',
            function () use ($container) {
                $container->create('\app\Controllers\AboutController')->show();
            }
        );
        $router->get(
            '',
            function () use ($container) {
                $container->create('\app\Controllers\FrontpageController')->show(1, 'time');
            }
        );
        $router->get(
            '/([1-9]\\d*)',
            function ($number) use ($container) {
                $container->create('\app\Controllers\FrontpageController')->show($number, 'time');
            }
        );
        $router->post(
            '/posts/([1-9]\\d*)/upvote',
            function ($number) use ($container) {
                $container->create('\app\Controllers\PostController')->upvote($number);
            }
        );
        $router->post(
            '/posts/([1-9]\\d*)/downvote',
            function ($number) use ($container) {
                $container->create('\app\Controllers\PostController')->downvote($number);
            }
        );
        $router->post(
            '/posts/([1-9]\\d*)/comment',
            function ($number) use ($container) {
                $container->create('\app\Controllers\PostController')->comment($number);
            }
        );
        $router->get(
            '/search',
            function () use ($container) {
                $container->create('\app\Controllers\SearchController')->show();
            }
        );
        $router->get(
            '/top',
            function () use ($container) {
                $container->create('\app\Controllers\FrontpageController')->show(1, 'rating');
            }
        );
        $router->get(
            '/top/([1-9]\\d*)',
            function ($number) use ($container) {
                $container->create('\app\Controllers\FrontpageController')->show($number, 'rating');
            }
        );
        $router->get(
            '/admin/users',
            function () use ($container) {
                $container->create('\app\Controllers\AdminpageController')->showUsers(1);
            }
        );
        $router->get(
            '/admin/users/([1-9]\\d*)',
            function ($number) use ($container) {
                $container->create('\app\Controllers\AdminpageController')->showUsers($number);
            }
        );
        $router->get(
            '/admin',
            function () use ($container) {
                $container->create('\app\Controllers\AdminpageController')->show();
            }
        );
        $router->post(
            '/admin/users/([1-9]\\d*)/delete',
            function ($number) use ($container) {
                $container->create('\app\Controllers\AdminpageController')->deleteUser($number);
            }
        );
        $router->post(
            '/admin/users/([1-9]\\d*)/edit',
            function ($number) use ($container) {
                $container->create('\app\Controllers\AdminpageController')->changeRole($number);
            }
        );
        $router->get(
            '/admin/posts',
            function () use ($container) {
                $container->create('\app\Controllers\AdminpageController')->showPosts(1);
            }
        );
        $router->get(
            '/admin/posts/([1-9]\\d*)',
            function ($number) use ($container) {
                $container->create('\app\Controllers\AdminpageController')->showPosts($number);
            }
        );
        $router->post(
            '/admin/posts/([1-9]\\d*)/delete',
            function ($number) use ($container) {
                $container->create('\app\Controllers\AdminpageController')->deletePost($number);
            }
        );
        $router->post(
            '/admin/posts/([1-9]\\d*)/edit',
            function ($number) use ($container) {
                $container->create('\app\Controllers\AdminpageController')->editPost($number);
            }
        );
        $router->get(
            '/u/(\w+)',
            function ($username) use ($container) {
                $container->create('\app\Controllers\UserpageController')->show($username);
            }
        );
        $router->get(
            '/u/(\w+)/settings',
            function ($username) use ($container) {
                $container->create('\app\Controllers\UserpageController')->showSettings($username);
            }
        );
        $router->post(
            '/u/(\w+)/settings/edit',
            function ($username) use ($container) {
                $container->create('\app\Controllers\UserpageController')->editUser($username);
            }
        );
        $router->get(
            '/news',
            function () use ($container) {
                $container->create('\app\Controllers\CategoryController')->show(1, 'news');
            }
        );
        $router->get(
            '/news/([1-9]\\d*)',
            function ($number) use ($container) {
                $container->create('\app\Controllers\CategoryController')->show($number, 'news');
            }
        );
        $router->get(
            '/memes',
            function () use ($container) {
                $container->create('\app\Controllers\CategoryController')->show(1, 'memes');
            }
        );
        $router->get(
            '/memes/([1-9]\\d*)',
            function ($number) use ($container) {
                $container->create('\app\Controllers\CategoryController')->show($number, 'memes');
            }
        );
        $router->get(
            '/u/(\w+)/settings/change-password',
            function ($username) use ($container) {
                $container->create('\app\Controllers\ChangePasswordController')->show($username);
            }
        );
        $router->get(
            '/json/posts',
            function () use ($container) {
                $container->create('\app\Controllers\JsonPostsController')->respond();
            }
        );
        $router->get(
            '/json/users',
            function () use ($container) {
                $container->create('\app\Controllers\JsonUsersController')->respond();
            }
        );
        $router->get(
            '/newadmin',
            function () use ($container) {
                $container->create('\app\Controllers\NewAdminController')->show();
            }
        );
        $router->post(
            '/newadmin/posts/([1-9]\\d*)/edit',
            function ($number) use ($container) {
                $container->create('\app\Controllers\NewAdminController')->editPost($number);
            }
        );
        $router->post(
            '/newadmin/users/([1-9]\\d*)/edit',
            function ($number) use ($container) {
                $container->create('\app\Controllers\NewAdminController')->editUser($number);
            }
        );
        $router->pathNotFound(
            function () use ($container) {
                $container->create('\app\Service\View')->render('404');
            }
        );
        $router->methodNotAllowed(
            function () use ($container) {
                $container->create('\app\Service\View')->render('405');
            }
        );
    } catch (Exception $e) {
    }
}
