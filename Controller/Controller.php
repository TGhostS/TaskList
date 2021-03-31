<?php
abstract class Controller{ 
    protected $m;
    public function __construct()
    {
        $this -> m = new Model();
    }
    public function showpage($view)
    {
        require "Views/".$view.".php";
    }
}
?>