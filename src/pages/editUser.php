<div class="container">
        <div class="row">
            <form action="http://mysite.ru/user/edit/<?= $user->id ?>" enctype="multipart/form-data" method="post" class="col-6 offset-3 border rounded p-3 mt-3 bg-light position-absolute top-50 start-0 translate-middle-y">

                <div class="row mt-3">
                    <div class="col-3"><label class="form-label" for="login">Login:</label></div>
                    <div class="col-9"><input id="login" name="login"  value ="<?= $user->login ?>"  class="form-control" type="text"></div>
                    <div class="col text-danger"><?= $errors['login'] ?? '' ?></div>
                </div>

                <div class="row mt-3">
                    <div class="col-3"><label class="form-label" for="email">Email:</label></div>
                    <div class="col-9"><input id="email" name="email" value ="<?= $user->email ?>" class="form-control" type="email"></div>
                    <div class="col text-danger"><?= $errors['email'] ?? '' ?></div>
                </div>

                <div class="row mt-3">
                    <div class="col-3"><label for="profile" class="form-label">Profile picture:</label></div>
                    <div class="col-9"><input type="file" name="profile" id="profile" class="form-control"></div>
                </div>

                <div class="d-grid mt-3">
                    <button class="btn btn-primary">Send</button>
                </div>
            </form>
        </div>
    </div>