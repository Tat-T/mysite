<div class="container">
    <div class="row mt-3">
        <div class="col">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Login</th>
                        <th>Password</th>
                        <th>Email</th>
                        <th>Image</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($users as $user): ?>
                        <tr>
                            <td><?= htmlspecialchars($user->id) ?></td>
                            <td><?= htmlspecialchars($user->login) ?></td>
                            <td><?= htmlspecialchars($user->password) ?></td>
                            <td><?= htmlspecialchars($user->email) ?></td>
                            <td>
                                <?php if ($user->picture): ?>
                                    <img src="/src/images/<?= htmlspecialchars($user->picture) ?>" alt="User Image" width="100">
                                <?php else: ?>
                                    Нет изображения
                                <?php endif; ?>
                            </td>
                            <td>
                                <form class="mb-2" method="POST" action="http://mysite.ru/user/edit/<?= $user->id ?>">
                                    <input type="hidden" name="user_id" value="<?= htmlspecialchars($user->id) ?>">
                                    <button type="submit" class="btn btn-secondary">Редактировать</button>
                                </form>
                                <form method="POST" action="/src/pages/deleteUser.php">
                                    <input type="hidden" name="user_id" value="<?= htmlspecialchars($user->id) ?>">
                                    <button type="submit" class="btn btn-danger" onclick="return confirm('Вы уверены, что хотите удалить этого пользователя?')">Удалить</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
