<?php
//ini_set('display_errors', 'on');
//error_reporting(E_ALL);

spl_autoload_register(function ($class) {
    $root = $_SERVER['DOCUMENT_ROOT'];
    $ds = DIRECTORY_SEPARATOR;
    $filename = $root . $ds . str_replace('\\', $ds, $class) . '.php';
    if (!file_exists($filename)) {
        $arr = explode('\\', $class);
        $filename = $root . $ds . 'Core' . $ds . 'controllers' . $ds . $arr[1] . '.php';
        unset($arr);
    }
    if (!file_exists($filename)) {
        $arr = explode('\\', $class);
        $filename = $root . $ds . 'Core' . $ds . 'models' . $ds . $arr[1] . '.php';
        unset($arr);
    }
    require($filename);
});

$router = new Core\Router();
$router->run();