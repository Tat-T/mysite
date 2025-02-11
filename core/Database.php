<?php
// $host = '127.0.0.1';
// $db = 'first';
// $user = 'root';
// $password = '123456780';
$user = ""; // Если используется Windows-аутентификация (Trusted_Connection)
$password = "";

$dsn = "sqlsrv:Server=DESKTOP-NKNKVEQ\\SQLEXPRESS;Database=first;TrustServerCertificate=True";
$pdo = new PDO($dsn, $user, $password, [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES => false,
]);

$username = $_GET['username'];
$query = "SELECT * FROM User WHERE 'username' = :username";

$stmt = $pdo->prepare($query);
$stmt->bindParam(':username', $username, PDO::PARAM_STR);
$stmt->execute();

while ($row = $stmt->fetch()){
    echo $row['username'] . ' ' . $row['password'] . "\n";
}