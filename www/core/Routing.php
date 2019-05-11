<?php 
namespace Core;

class Routing
{
    public static $routeFile = 'routes.yml';

    public static function getRoute($slug)
    {
        $routes = yaml_parse_file(self::$routeFile);
        if (isset($routes[$slug])) {
            if (empty($routes[$slug]['controller']) || empty($routes[$slug]['action'])) {
                die('Il y a une erreur dans le fichier routes.yml');
            }
            $controller = ucfirst($routes[$slug]['controller']).'Controller';
            $action = $routes[$slug]['action'].'Action';
            $controllerPath = 'controllers/'.$controller.'.php';
        } else {
            return ['controller' => null, 'action' => null, 'controllerPath' => null];
        }

        return ['controller' => $controller, 'action' => $action, 'controllerPath' => $controllerPath];
    }

    public static function getSlug($controller, $action)
    {
        $routes = yaml_parse_file(self::$routeFile);

        foreach ($routes as $slug => $cAndA) {
            if (!empty($cAndA['controller']) &&
                !empty($cAndA['action']) &&
                $cAndA['controller'] == $controller &&
                $cAndA['action'] == $action) {
                return $slug;
            }
        }

        return null;
    }
}
