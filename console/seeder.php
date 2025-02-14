<?php
include_once __DIR__ . '/../vendor/autoload.php';

$faker = Faker\Factory::create();
// echo $faker->name();
include_once __DIR__ . '/../core/Database.php';

//для MySQL
// $stmt = $pdo->prepare("INSERT INTO `Users` (`login`, `password`, `email`) VALUES (?, ?, ?)");
// for ($i = 0; $i < 20; $i++) {
//     $login = $faker->name();
//     $password = password_hash('123456', PASSWORD_DEFAULT);
//     $email = $faker->email();
//     $stmt->execute([$login, $password, $email]);
// }
// для SSMS
$stmt = $pdo->prepare("INSERT INTO Users (login, password, email) VALUES (?, ?, ?)");

for ($i = 0; $i < 20; $i++) {
    $login = $faker->name();
    $password = password_hash('123456', PASSWORD_DEFAULT);
    $email = $faker->email();
    $stmt->execute([$login, $password, $email]);
}
