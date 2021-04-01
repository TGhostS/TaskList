<?php
/*********************************************************/
/*                  Create main Controller               */
/*********************************************************/
abstract class Controller{ 
    protected $m;
    public function __construct()
    {
        $this -> m = new Tasklists();
    }
    public function showpage($view)
    {
        require "Views/".$view.".php";
    }
}
?>