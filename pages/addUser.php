    <div class="container">
        <div class="row">
            <?php
                $login = $_POST['login'] ?? false;
                $password = $_POST['password'] ?? false;
                $email = $_POST['email'] ?? false;
                $errors = [];

                if ($login || $password || $email):
                    if (strlen($login) < 3):
                        $errors['login'] = "Login must be at least 3 symbols length!";
                    endif;
                    if(!filter_var($email, FILTER_VALIDATE_EMAIL)):
                       $errors['email'] = 'Email must be email!';
                    endif;
                    if (count($errors) == 0):
                        addUser($login, $password, $email);
                        die('<h1>User successfully added!</h1>');
                    endif;
                endif; 
            ?>
            <form action="http://sites/mysite/addUser.php" method="post" class="col-6 offset-3 border rounded p-3 mt-3">

                <div class="row mt-3">
                    <div class="col-3"><label class="form-label" for="login">Login:</label></div>
                    <div class="col-9"><input id="login" name="login" class="form-control" type="text"></div>
                    <div class="col text-danger"><?= $errors['login'] ?? '' ?></div>
                </div>

                <div class="row mt-3">
                    <div><label for="">Password:</label></div>
                    <div><input id="password" name="password" class="form-control" type="password"></div>
                </div>

                <div class="row mt-3">
                    <div class="col-3"><label class="form-label" for="email">Email:</label></div>
                    <div class="col-9"><input id="email" name="email" class="form-control" type="email"></div>
                </div>

                <div class="d-grid mt-3">
                    <button class="btn btn-primary">Send</button>
                </div>
            </form>
        </div>
    </div>