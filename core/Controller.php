<?php

namespace core;

class Controller
{
    function render(string $view, $data = [], string $layout = 'layout')
    {
        extract($data);
        ob_start();
        include_once __DIR__ . "/../pages/$view.php";
        $content = ob_get_clean();
        include_once __DIR__ . "/../pages/$layout.php";
    }
}
