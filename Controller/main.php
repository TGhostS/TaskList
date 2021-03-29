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
            tasklist::open_page();
        }
    }
}
?>