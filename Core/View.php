<?php


namespace Core;


class View
{
    public $path;
    public $routes;
    public $layout = 'default';

    public function __construct($routes)
    {
        $this->routes = $routes;
        $this->path = $this->routes['controller'] . DIRECTORY_SEPARATOR . $this->routes['action'];
        //print_r($this->path);
    }

    public function render($title, $vars = [])
    {
        extract($vars);
        if (file_exists($_SERVER['DOCUMENT_ROOT'] . '/view/' . $this->path . '.php')) {
            ob_start();
            require $_SERVER['DOCUMENT_ROOT'] . '/view/' . $this->path . '.php';
            $content = ob_get_clean();
            require $_SERVER['DOCUMENT_ROOT'] . '/view/layout/' . $this->layout . '.php';
        } else {
            echo 'Вид не найден' . $_SERVER['DOCUMENT_ROOT'] . '/view/' . $this->path . '.php';
        }
    }
}