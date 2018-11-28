<?php
/**
 * Created by PhpStorm.
 * User: valeriishinkar
 * Date: 11/20/18
 * Time: 13:03
 */

namespace ValeriyShinkar\Core;

class Route
{

    public static function start()
    {
        // controller and action by default
        $controllerName = 'Index';
        $actionName = 'Index';

        $routes = explode('/', $_SERVER['REQUEST_URI']);

        // get controller name
        if (!empty($routes[1])) {
            $controllerName = $routes[1];
        }

        // get action name
        if (!empty($routes[2])) {
            $actionName = ucfirst($routes[2]);
        }

        // compiling names
        $modelName = $controllerName . 'Model';
        $controllerName = $controllerName . 'Controller';
        $actionName = 'action' . $actionName;

        // create controller
        $name = '\ValeriyShinkar\Controllers\\' . $controllerName;

        $controller = class_exists($name) ? new $name : null;

        if ($controller && method_exists($controller, $actionName)) {
            // call controller action
            $controller->$actionName();
        } else {
            // page not found
            Route::ErrorPage404();
        }

    }

    public static function ErrorPage404()
    {
        $host = 'http://' . $_SERVER['HTTP_HOST'] . '/';

        header('HTTP/1.1 404 Not Found');
        header("Status: 404 Not Found");
        header('Location:' . $host . '404');
    }
}