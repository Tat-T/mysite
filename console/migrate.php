<?php
// Настройки подключения
$user = ""; // Если используется Windows-аутентификация (Trusted_Connection)
$password = "";

$migrationsDir = __DIR__ . '/../migrations/';

$dsn = "sqlsrv:Server=DESKTOP-NKNKVEQ\\SQLEXPRESS;Database=first;TrustServerCertificate=True";

// Подключение к базе данных
$pdo = new PDO($dsn, $user, $password, [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES => false,
]);

// Создание таблицы migrations, если она не существует
//для MySQL
// $createTableQuery = <<<SQL
// CREATE TABLE IF NOT EXISTS migrations (
//     id INT AUTO_INCREMENT PRIMARY KEY,
//     migration VARCHAR(255) NOT NULL,
//     applied_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
// ) ENGINE=InnoDB DEFAULT CHARSET=utf8;
// SQL;

//для SSMS

$createTableQuery = "
IF NOT EXISTS (SELECT * FROM sysobjects WHERE name='migrations' AND xtype='U')
CREATE TABLE migrations (
id INT IDENTITY(1,1) PRIMARY KEY,
migration VARCHAR(255) NOT NULL,
applied_at DATETIME DEFAULT GETDATE()
);
";

$pdo->exec($createTableQuery);

//Получение списка уже применённых миграций
$stmt = $pdo->query("SELECT migration FROM migrations");
$appliedMigrations = $stmt->fetchAll(PDO::FETCH_COLUMN);

//Получение списка файлов миграций
$migrationFiles = glob($migrationsDir . '*.sql') ?: [];

//Применение миграций
foreach ($migrationFiles as $file) {
    $migrationName = basename($file);

    //Проверка, была ли миграция уже применена
    if (in_array($migrationName, $appliedMigrations)){
        continue;
    }
    echo "применение миграции: $migrationName\n";

    //Чтение содержимого файла
    $sql = file_get_contents($file);

    try{
        //Начало транзакции
        $pdo->beginTransaction();

        //Выполнение SQL-запроса
        $pdo->exec($sql);

        //Фиксация миграции в таблице migrations
        $stmt = $pdo->prepare("INSERT INTO migrations (migration) VALUES (:migration)");
        $stmt->execute([':migration' => $migrationName]);

        //Подтверждение транзакции
        $pdo->commit();

        echo "Миграция успешно применена.\n";
    }catch (PDOException $e) {
        //Откат транзакции в случае ошибки
        echo "Ошибка при применении миграции: " . $e->getMessage();
        $pdo->rollBack();
        die();
    }
}
echo "Все миграции успешно применены.\n";