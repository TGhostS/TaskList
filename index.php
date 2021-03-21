<?php
session_start();
include "Controllers/class_controller.php";
include "Models/requests.php";
include "Views/class_view.php";
$model = new Model();
$controller = new Controller($model);
$view = new View($controller, $model);
$db = model::get_database();
if (!isset($_SESSION['user_id']))
{
    Controller::analize_POST_register($db);
    view::create_auth_page();
}
else
{
    Controller::analize_POST_tasklist($db,$_SESSION['user_id']);
    view::main_menu_tasks();
    view::create_tasks_menu($_SESSION['user_id'],$db);
}
?>