<?php

namespace Tanya\Mysite\models;

use PDO;
use PDOException;

require_once __DIR__ . '/../core/Database.php';

class User
{
    public $id;
    public $profile_pic;
    public $errors = [];
    private $db;

    function __construct(
        public $login = '',
        public $password = '',
        public $email = ''
    ) {
        $database = new \Database();
        $this->db = $database->connect("DESKTOP-NKNKVEQ\\SQLEXPRESS", "", "", "first");
    }

    function upload_image()
    {
        $uploads_dir = __DIR__ . '/../images';
        if (!is_dir($uploads_dir)) {
            mkdir($uploads_dir);
        }
        $error = $_FILES["profile"]["error"];
        if ($error == UPLOAD_ERR_OK) {
            $tmp_name = $_FILES["profile"]["tmp_name"];
            $extension = pathinfo($_FILES["profile"]["name"], PATHINFO_EXTENSION);
            $this->profile_pic = md5(date_create()->format('U')) . '.' . $extension;
            return move_uploaded_file($tmp_name, "$uploads_dir/{$this->profile_pic}");
        }
        return false;
    }

    function addUser()
    {
        try {
            $stmt = $this->db->prepare("INSERT INTO Users (login, password, email, picture) VALUES (:login, :password, :email, :picture)");
            $stmt->execute([
                ':login' => $this->login,
                ':password' => password_hash($this->password, PASSWORD_DEFAULT),
                ':email' => $this->email,
                ':picture' => $this->profile_pic
            ]);
            return $this->db->lastInsertId();
        } catch (PDOException $e) {
            die('Ошибка добавления пользователя: ' . $e->getMessage());
        }
    }

    function deleteUser($userId)
    {
        try {
            $stmt = $this->db->prepare("DELETE FROM Users WHERE id = :id");
            $stmt->execute([
                ':id' => $userId
            ]);
            return $stmt->rowCount();
        } catch (PDOException $e) {
            die('Ошибка удаления пользователя: ' . $e->getMessage());
        }
    }

    function readUsers($id = 0)
    {
        try {
            if ($id > 0) {
                $stmt = $this->db->prepare("SELECT * FROM Users WHERE id = :id");
                $stmt->execute([':id' => $id]);
                return $stmt->fetch(PDO::FETCH_ASSOC);
            } else {
                $stmt = $this->db->query("SELECT * FROM Users");
                return $stmt->fetchAll(PDO::FETCH_ASSOC);
            }
        } catch (PDOException $e) {
            die('Ошибка получения пользователей: ' . $e->getMessage());
        }
    }

    public function login(): bool
    {
        try {
            $stmt = $this->db->prepare("SELECT * FROM Users WHERE login = :login");
            $stmt->execute([':login' => $this->login]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($user && password_verify($this->password, $user['password'])) {
                $_SESSION['user'] = $this->login;
                return true;
            }
            // $this->errors['login'] = 'Неверный логин или пароль';
            return false;
        } catch (PDOException $e) {
            die('Ошибка входа: ' . $e->getMessage());
        }
    }

    public function validate()
    {
        if (!empty($this->login) && !empty($this->password) && !empty($this->email)) {
            if (strlen($this->login) < 3) {
                $this->errors['login'] = "Login must be at least 3 symbols length!";
            }
            if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
                $this->errors['email'] = 'Email must be email!';
            }
            return count($this->errors) == 0;
        }
        return false;
    }
}
