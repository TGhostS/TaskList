<?php
session_start();

spl_autoload_register(function ($class) {
    if ($class  == "Model")
    {
        include 'Model/' . $class .'.php';
    }
    if ($class == "Controller")
    {
        include 'Controller/' . $class .'.php';
    }
    
});
$Model = new Model();
$Controller = new Controller();
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
if (!isset($_SESSION['user_id']))
{
    include "Views/register.php";
}
else
{
    include "Views/tasklist.php";
    include "Views/tasks.php";
}

?>