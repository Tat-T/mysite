<?php

namespace controllers;

use core\Controller;
use models\User;

class UserController extends Controller
{
    function addAction()
    {
        $login = $_POST['login'] ?? '';
        $password = $_POST['password'] ?? '';
        $email = $_POST['email'] ?? '';

        $user = new User($login, $password, $email);
        if (!empty($login) || !empty($password) || !empty($email)):
            if (strlen($login) < 3):
               $user->errors['login'] = "Login must be at least 3 symbols length!";
            endif;
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)):
               $user->errors['email'] = 'Email must be email!';
            endif;
            if (count($user->errors) == 0):
                $id = $user->addUser();
                return $this->redirect("user/show/$id");
                // $user->addUser();
                // die('<h1>User successfully added!</h1>');
            endif;
        endif;
        $this->render('addUser', ['errors' => $user->errors]);
    }

    function loginAction()
    {
        $login = $_POST['login'] ?? '';
        $password = $_POST['password'] ?? '';
        // var_dump($login, $password);

        $user = new User($login, $password);
        if ($user->login()) {
           $this->redirect();
           return;
        }

        $this->render('login', ['errors' => $user->errors]);
    }

    function showAction($id = 0)
    {
        $user = new User();
        $users = $user->readUsers($id);
        $this->render('showUsers', ['users' => $users]);
    }
}
