<?php


namespace Core;


abstract class Controller
{
    public $routes;
    public $view;

    public function __construct($pathRoutes)
    {
        $this->routes = $pathRoutes;
        $this->view = new View($this->routes);
    }
}