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
$model = new Model();
$controller = new Controller($model);
$db = model::get_database();
if (!isset($_SESSION['user_id']))
{
    Controller::analize_POST_register($db);
    include "Views/register.php";
}
else
{
    Controller::analize_POST_tasklist($db,$_SESSION['user_id']);
    include "Views/tasklist.php";
    include "Views/tasks.php";
    view_tasks($_SESSION['user_id'],$db);
}
?>