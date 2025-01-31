<?php
$page = $_GET['page'] ?? 'main/index';
// http://sites/mysite/index.php?page=user/show до настройки серверов

$parts = explode('/', $page);
$controllerName = $parts[0] ?? 'main';
$actionName = $parts[1] ?? 'index';
//[$controllerName, $actionName] = explode('/', $page); сокращение строк вышестоящих 5,6,7

$controllerName = ucfirst(strtolower($controllerName));
$controllerName = "\\controllers\\{$controllerName}Controller";
$actionName = strtolower($actionName);
$actionName .= 'Action';

$controller = new $controllerName();
$controller->$actionName();