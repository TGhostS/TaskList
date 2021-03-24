<?php
session_start();
header("Content-Type:text/html;charset=UTF-8");
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

if($_GET['option']) {
	$class = trim(strip_tags($_GET['option']));
}

if(class_exists($class)) {
	
	$obj = new $class;
	$obj->get_body($class);
}
else {
	exit("<p>Нет данные для входа</p>");
}

?>