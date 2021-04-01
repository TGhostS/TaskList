<?php
/*********************************************************/
/*      Create default request for open need page        */
/*********************************************************/
class main extends Controller{
    public  function choose_page()
    {
        if(empty($_SESSION['user_id']))
        {
            Controller::showpage("register");
        }
        else
        {
            header("Location: ?controller=tasklist&method=open_page");
        }
    }
}
?>