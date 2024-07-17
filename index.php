<?php

session_start();

define('PATH_DIR', "http://localhost/project/");

require_once('controller/Controller.php');
require_once('library/RequirePage.php');
require_once __DIR__.'/vendor/autoload.php';
require_once('library/Template.php');


$url = isset($_GET["url"]) ? explode ('/', ltrim($_GET["url"], '/')) : '/';

$templateMain = '';
$path = PATH_DIR;


if($url == '/'){
    require_once('controller/ControllerHome.php');
    $controller = new ControllerHome;
    $templateMain = $controller->index(); 
} else {
    $requestURL = $url[0];
    $requestURL = ucfirst($requestURL);
    $controllerPath = __DIR__."/controller/Controller".$requestURL.".php";

    if(file_exists($controllerPath)){
        require_once( $controllerPath);
        $controllerName = 'Controller'.$requestURL;
        $controller = new $controllerName;

        if(isset($url[1])){
            $method = $url[1];
            if(isset($url[2])){
                echo $controller->$method($url[2]);
            }else{
                echo $controller->$method();
            }
        }else{
            $templateMain = $controller->index(); 
        }
    }else{
        require_once('controller/ControllerHome.php');
        $controller = new ControllerHome;
        echo $controller->error('404'); 
    }
}