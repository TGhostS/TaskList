<?php
class main extends Controller{ 
    public static function showpage()
    {
        if(isset($_SESSION['user_id']))
        {
            require_once 'Views/tasklist.php';
            require_once 'Views/tasks.php';
        }
        else
        {
            require_once "Views/register.php";
        }
    }
} 
?> 