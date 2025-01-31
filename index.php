<?php
function autoloader($classname){
    include_once __DIR__ . DIRECTORY_SEPARATOR . str_replace('\\', DIRECTORY_SEPARATOR, $classname) . '.php';
}
spl_autoload_register('autoloader');

include_once __DIR__ . '/functions.php';
include 'router.php';