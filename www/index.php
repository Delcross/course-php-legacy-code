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
if (file_exists($cPath)) {
    include $cPath;
    if (class_exists('\\Controllers\\'.$c)) {
        //dynamically instantiate the controller
        $cObject = $container['Controllers\\'. $c]($container);
        //check that the method (action) exists
        if (method_exists($cObject, $a)) {
            //dynamic call of the method
            $cObject->$a();
        } else {
            die('La methode '.$a." n'existe pas");
        }
    } else {
        die('La class controller '.$c." n'existe pas");
    }
} else {
    die('Le fichier controller '.$c." n'existe pas");
}
