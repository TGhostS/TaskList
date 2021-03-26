<?php
class Controller{ 
    public static function showpage($view)
    {
        require "Views/".$view.".php";
    }
}
?>