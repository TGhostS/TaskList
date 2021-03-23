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
$Model = new Model();
$Controller = new Controller();
$Controller = new Tasklist();
if($_POST['controller']) {
    $class = trim(strip_tags($_POST['controller']));
}  
if($_POST['method']) {
 $method = trim(strip_tags($_POST['method']));
}
if(class_exists($class)) {
 
    $obj = new $class;
    $obj->{$method}($class);
}
if(!isset($_SESSION['user_id']))
    {
        Controller::show_page();
    }
    else
    {
        Tasklist::show_page();
    }
?>