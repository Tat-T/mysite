<?php
namespace controllers;

class UserController
{
    function addAction()
    {
        $login = $_POST['login'] ?? false;
        $password = $_POST['password'] ?? false;
        $email = $_POST['email'] ?? false;
        $errors = [];

        if ($login || $password || $email):
            if (strlen($login) < 3):
                $errors['login'] = "Login must be at least 3 symbols length!";
            endif;
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)):
                $errors['email'] = 'Email must be email!';
            endif;
            if (count($errors) == 0):
                addUser($login, $password, $email);
                die('<h1>User successfully added!</h1>');
            endif;
        endif;
        include_once __DIR__ . '/../pages/addUser.php';
    }

    function loginAction() {
        $login = $_POST['login'] ?? false;
        $password = $_POST['password'] ?? false;
        // var_dump($login, $password);
        if ($login || $password) {
            $users = readUsers();
            $result = array_filter($users, function($user) use ($login, $password){
              return strtolower($user[0])  == strtolower($login) && password_verify($password, $user[1]);
            });
            if (count($result) > 0) {
                echo "<h1>Авторизация прошла успешно!</h1>";
                $_SESSION['user'] = $login;
                include_once "footer.php";
                die();
            }else {
                $errors['login'] = 'Неверный логин или пароль';
            }
        }
        include_once __DIR__ . '/../pages/login.php';
    }

    function showAction()
    {
        include_once __DIR__ . '/../pages/showUsers.php';
    }
}
