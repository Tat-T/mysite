<?php

namespace models;

class User
{
    public $id;
    public $profile_pic;
    public $errors = [];

    function __construct(
        public $login = '',
        public $password = '',
        public $email = ''
    ) {}

    function upload_image()
    {
        $uploads_dir = __DIR__ . '/images';
        if (!is_dir($uploads_dir)) {
            mkdir($uploads_dir);
        }
        $error = $_FILES["profile"]["error"];
        if ($error == UPLOAD_ERR_OK) {
            $tmp_name = $_FILES["profile"]["tmp_name"];
            $extension = pathinfo($_FILES["profile"]["name"], PATHINFO_EXTENSION);
            $this->profile_pic = md5(date_create()->format('Unix Timestamp'));
            return move_uploaded_file($tmp_name, "$uploads_dir/{$this->profile_pic}.$extension");
        }
        return false;
    }
    private function openUsers(string $mode)
    {
        // var_dump(__DIR__);
        $fd = @fopen(__DIR__ . '/../users.csv', $mode) or die('Нет запрашиваемого вами файла!');
        return $fd;
    }

    function readUsers($id = 0)
    {
        $users = [];
        $fd = $this->openUsers('r');
        while (!feof($fd)) {
            $user = fgets($fd);
            if ($user) {
                $user = rtrim($user);
                $users[] = explode(',', $user);
                if ($id > 0) {
                    $result = preg_match('!^(\d+),.!', $user, $matches);
                    if ($result && $matches[1] == $id) {
                        fclose($fd);
                        return [explode(',', $user)];
                    }
                }
            }
        }
        fclose($fd);
        return $users;
    }

    function addUser()
    {
        $users = $this->readUsers('r');
        if (in_array($this->login, array_column($users, 0)) || in_array($this->email, array_column($users, 2))) {
            die('пользователь с такими учётными данными уже зарегистрирован!');
        }
        $fd = $this->openUsers('a');
        $last_id = array_pop($users)[0];
        fputcsv(stream: $fd, fields: [
            $last_id + 1,
            $this->login,
            password_hash($this->password, PASSWORD_DEFAULT),
            $this->email
        ], escape: "\\");
        fclose($fd);
        return $last_id + 1;
    }

    public function login() : bool
    {
        if ($this->login == '' || $this->password == '') {
            return false;
        }
        $users = $this->readUsers();
        $result = array_filter($users, [$this, 'checkPassword']);
        if (count($result) > 0) {
            echo "<h1>Авторизация прошла успешно!</h1>";
            $_SESSION['user'] = $this->login;
            return true;
        }
        $this->errors['login'] = 'Неверный логин или пароль';
        return false;
    }
    private function checkPassword($user)
    {
        return strtolower($user[1]) == strtolower($this->login)
            && password_verify($this->password, $user[2]);
    }
}
