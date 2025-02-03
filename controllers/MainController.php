<?php
namespace controllers;

use \core\Controller;

class MainController extends Controller {
    function indexAction() {
        $this->render('main');
    }

    function notFoundAction() {
        $this->render('notFoundPage');
    }
}