<?php

namespace Core;

class Router
{
    private $routes = [];

    public function __construct()
    {
        $this->routes = include($_SERVER['DOCUMENT_ROOT'] . '/config/routes.php');
    }

    /**
     * @return string*
     */
    public function getURI()
    {
        if (!empty($_SERVER['REQUEST_URI'])) {
            return trim(str_replace('/controllers/index.php//', '', $_SERVER['REQUEST_URI']), '/');
        }
    }

    public function run()
    {
        //получить строку запроса
        $uri = $this->getURI();
        $uri = preg_replace('#\?page=[0-9]+#', '', $uri);

        //проверить наличие его в роутсах
        $error = false;
        foreach ($this->routes as $uriPattern => $path) {
            if (preg_match("#$uriPattern#", $uri)) {
                $internalRoute = preg_replace("#$uriPattern#", $path, $uri);
                $pathParts = explode('/', $internalRoute);
                $rootPath = ['controller' => $pathParts[0], 'action' => $pathParts[1]];
                $className = 'Core\\' . ucfirst(array_shift($pathParts)) . 'Controller';
                $actionName = 'action' . ucfirst(array_shift($pathParts));
                $error = true;
            }
        }
        if (!$error) {
            $pathParts = ['Error', 'notFound'];
            $rootPath = ['controller' => $pathParts[0], 'action' => $pathParts[1]];
            $className = 'Core\\' . ucfirst(array_shift($pathParts)) . 'Controller';
            $actionName = 'action' . ucfirst(array_shift($pathParts));
        }
        $parametrs = $pathParts;
        $fileName = $_SERVER['DOCUMENT_ROOT'] . '/Core/controllers/' . $className . '.php';

        $controllerObj = new $className($rootPath);

        $result = call_user_func_array(array($controllerObj, $actionName), $parametrs);

    }

}
