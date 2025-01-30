<?php
function autoloader($classname){
    include_once __DIR__ . DIRECTORY_SEPARATOR . str_replace('\\', DIRECTORY_SEPARATOR, $classname) . '.php';
}
spl_autoload_register('autoloader');

include 'router.php';
include_once __DIR__ . '/functions.php';

$page = $_GET['page'] ?? 'main';
ob_start();
switch ($page) {
    case 'main':
        $controller = new \controllers\MainController();
        $controller->indexAction();
        break;
    case 'add';
        $controller = new \controllers\UserController();
        $controller->addAction();
        break;
    case 'show';
        $controller = new \controllers\UserController();
        $controller->showAction();
        break;
    case 'login';
        $controller = new \controllers\UserController();
        $controller->loginAction();
        break;
}
$content = ob_get_clean();
include_once __DIR__ . '/pages/layout.php';