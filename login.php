<?php
    include "header.php";
    include "functions.php";

    $login = $_POST['login'] ?? false;
    $password = $_POST['password'] ?? false;

    if ($login || $password) {
        $users = readUsers();
        $result = array_filter($users, function($user) use ($login, $password){
          return strtolower($user[0])  ==strtotime($login) && $user[1] = $password;
        });
        if (count($result) > 0) {
            echo "<h1>Авторизация прошла успешно!</h1>";
            include_once "footer.php";
            die();
        }else {
            $errors['login'] = 'Неверный логин или пароль';
        }
    }
?>
    <div class="container">
        <div class="row">
            <form action="http://sites/mysite/login.php" method="post" class="col-6 offset-3 border rounded p-3 mt-3">

                <div class="row mt-3">
                    <div class="col-3"><label class="form-label" for="login">Login:</label></div>
                    <div class="col-9"><input id="login" name="login" class="form-control" type="text"></div>
                    <div class="col text-danger"><?= $errors['login'] ?? '' ?></div>
                </div>

                <div class="row mt-3">
                    <div><label for="">Password:</label></div>
                    <div><input id="password" name="password" class="form-control" type="password"></div>
                </div>

                <div class="d-grid mt-3">
                    <button class="btn btn-primary">Log on</button>
                </div>
            </form>
        </div>
    </div>
<?php
    include "footer.php";