<?php
use Core\Routing;

function myAutoloader($class)
{
	//var_dump($class);
	$classname = substr($class, strpos($class, '\\') + 1);
    $classPath = 'Core/'.$classname.'.php';
    $classModel = 'Models/'.$classname.'.php';
    if (file_exists($classPath)) {
        include $classPath;
    } elseif (file_exists($classModel)) {
        include $classModel;
    }
}

// The myAutoloader function is launched on the called class is not found
spl_autoload_register('myAutoloader');

// Retrieving parameters from the url - Routing
$slug = explode('?', $_SERVER['REQUEST_URI'])[0];
$routes = Routing::getRoute($slug);
extract($routes);

$container = [];
$container['config'] = require 'config/global.php';
$container += require 'config/di.global.php';

// Checks the existence of the file and class to load the controller
if (file_exists($controllerPath)) {
    include $controllerPath;
    if (class_exists('\\Controllers\\'.$controller)) {
        //dynamically instantiate the controller
        $controllerObject = $container['Controllers\\'. $controller]($container);
        //check that the method (action) exists
        if (method_exists($controllerObject, $action)) {
            //dynamic call of the method
            $controllerObject->$action();
        } else {
            die('La methode '.$action." n'existe pas");
        }
    } else {
        die('La class controller '.$controller." n'existe pas");
    }
} else {
    die('Le fichier controller '.$controller." n'existe pas");
}
