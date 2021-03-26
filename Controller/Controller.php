<?php
class Controller{ 
    public static function showpage()
    {
        if(isset($_SESSION['user_id']))
        {
            require 'Views/tasklist.php';
            require 'Views/tasks.php';
        }
        else
        {
            require "Views/register.php";
        }
    }
}
?>