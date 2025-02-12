<?php
// Настройки подключения
$user = ""; // Если используется Windows-аутентификация (Trusted_Connection)
$password = "";

$dsn = "sqlsrv:Server=DESKTOP-NKNKVEQ\\SQLEXPRESS;Database=first;TrustServerCertificate=True";

// try {
    // Подключение к базе данных
    $pdo = new PDO($dsn, $user, $password, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false,
    ]);

//     // SQL-запрос для выбора 1000 записей из таблицы [User]
//     $sql = "SELECT TOP (1000) [id], [User], [password] FROM [dbo].[User]";
    
//     // Подготовка и выполнение запроса
//     $stmt = $pdo->query($sql);

//     // Вывод заголовка таблицы
//     echo "ID | Username | Password\n";
//     echo "-------------------------\n";

//     // Вывод данных в консоль
//     while ($row = $stmt->fetch()) {
//         echo "{$row['id']} | {$row['User']} | {$row['password']}\n";
//     }
    
// } catch (PDOException $e) {
//     // Обработка ошибок
//     echo "Ошибка подключения к базе данных: " . $e->getMessage();
// }
