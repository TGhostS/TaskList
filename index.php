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
$method = "choose_page";
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
echo $_SESSION['user_data'];
?>