<?php
// $page = $_GET['page'] ?? 'main/index';
$page = $_SERVER['REQUEST_URI'];
$page = trim($page, '/');

// http://sites/mysite/index.php?page=user/show до настройки серверов
// http://sites/mysite/user/show

$parts = explode('/', $page);
$controllerName = array_shift($parts) ?: 'main';
$actionName = array_shift($parts) ?? 'index';
$params = $parts;

//[$controllerName, $actionName] = explode('/', $page); сокращение строк вышестоящих 5,6,7

$controllerName = ucfirst(strtolower($controllerName));
$controllerName = "\\controllers\\{$controllerName}Controller";
$actionName = strtolower($actionName);
$actionName .= 'Action';

include_once __DIR__ . '/bootstrap.php';
if (!file_exists(__DIR__ . '/src/' . str_replace('\\', DIRECTORY_SEPARATOR, $controllerName) . '.php')) {
    $controller = new  Tanya\Mysite\controllers\MainController($entityManager);
    $controller->notFoundAction();
    die();
}else{
    $controllerName = 'Tanya\\Mysite' . $controllerName;
    $controller = new $controllerName($entityManager);
}

if (!method_exists($controller, $actionName)) {
    $controller = new Tanya\Mysite\controllers\MainController($entityManager);
    $controller->notFoundAction();
    exit();
}
$controller->$actionName(...$params);