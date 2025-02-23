<?php
require_once __DIR__ . '/../models/User.php'; // Подключаем файл с классом User

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["user_id"])) {
    $userId = intval($_POST["user_id"]); // Приводим к числу для безопасности

    $user = new User(); // Создаем объект класса User
    $deleted = $user->deleteUser($userId);

    if ($deleted) {
        header("Location: index.php?message=Пользователь успешно удален");
        exit();
    } else {
        header("Location: index.php?error=Ошибка удаления пользователя");
        exit();
    }
} else {
    header("Location: index.php?error=Неверный запрос");
    exit();
}
?>
