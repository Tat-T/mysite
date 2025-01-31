    <div class="container">
        <div class="row">
            <form action="http://sites/mysite/login.php" method="post" class="col-6 offset-3 border rounded p-3 mt-3 bg-light position-absolute top-50 start-0 translate-middle-y">

                <div class="row mt-3">
                    <div class="col-3"><label class="form-label" for="login">Login:</label></div>
                    <div class="col-9"><input id="login" name="login" class="form-control" type="text"></div>
                    <div class="col text-danger"><?= $errors['login'] ?? '' ?></div>
                </div>

                <div class="row mt-3">
                    <div class="col-3"><label for="">Password:</label></div>
                    <div class="col-9"><input id="password" name="password" class="form-control" type="password"></div>
                </div>

                <div class="d-grid mt-3">
                    <button class="btn btn-primary">Log on</button>
                </div>
            </form>
        </div>
    </div>