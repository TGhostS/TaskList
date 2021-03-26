<?php
class main extends Controller{
    public static function choose_page()
    {
        if(empty($_SESSION['user_id']))
        {
            Controller::showpage("register");
        }
        else
        {
            Controller::showpage("tasklist");
            Controller::showpage("tasks");
        }
    }
}
?>