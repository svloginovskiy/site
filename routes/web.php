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
                $container->create('\app\Controllers\AdminpageController')->showUsers();
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
                $container->create('\app\Controllers\AdminpageController')->showPosts();
            }
        );
        $router->post(
            '/admin/posts/([1-9]\\d*)/delete',
            function ($number) use ($container) {
                $container->create('\app\Controllers\AdminpageController')->deletePost($number);
            }
        );
        $router->get(
            '/u/(\w+)',
            function ($username) use ($container) {
                $container->create('\app\Controllers\UserpageController')->show($username);
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