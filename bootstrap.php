<?php
// doctrine/orm doctrine/dbal symfony/cache
use Dotenv\Dotenv;
use Doctrine\ORM\ORMSetup;
use Doctrine\ORM\EntityManager;
use Doctrine\DBAL\DriverManager;

include_once __DIR__ . '/vendor/autoload.php';

//Загрузка переменных окружения из .env файла
$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

//Параметры подключения к базе данных из .env
$dbParams = [
    'driver'   => $_ENV['DB_DRIVER'],
    'user'     => $_ENV['DB_USER'],
    'password' => $_ENV['DB_PASSWORD'],
    'dbname'   => $_ENV['DB_NAME'],
    'host'     => $_ENV['DB_HOST'],
];

$paths = [__DIR__ . '/src/Entity'];
$isDevMode = true;
$config = ORMSetup::createAttributeMetadataConfiguration($paths, $isDevMode);
$connection = DriverManager::getConnection($dbParams, $config);
$entityManager = new EntityManager($connection, $config);
return $entityManager;