<?php

namespace app\Controllers;

use app\Service\View;
use app\Utility\AuthorizationInspector;

class AboutController extends Controller
{

    public function __construct(View $view, AuthorizationInspector $authCheck)
    {
        parent::__construct($view, $authCheck);
    }

    public function show()
    {
        $this->view->render('about');
    }
}