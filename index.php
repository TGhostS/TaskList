<?php
session_start();

spl_autoload_register(function ($c) {
    if(file_exists("Controller/".$c.".php")) 
    {
        require_once "Controller/".$c.".php";
    }
    elseif(file_exists("Model/".$c.".php")) 
    {
        require_once "Model/".$c.".php";
    }
});
$class = "main";
$method = "show_page";
if($_GET['controller']) {
    $class = trim(strip_tags($_GET['controller']));
}  
if($_GET['method']) {
 $method = trim(strip_tags($_GET['method']));
}
if(class_exists($class)) {
 
    $obj = new $class;
    $obj->{$method}($class);
}
?>