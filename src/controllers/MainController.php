<?php
namespace Tanya\Mysite\controllers;

use Tanya\Mysite\core\Controller;

class MainController extends Controller {
    function indexAction() {
        $this->render('main');
    }

    function notFoundAction() {
        $this->render('notFoundPage');
    }
}