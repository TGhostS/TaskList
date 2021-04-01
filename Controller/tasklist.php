<?php
/*********************************************************/
/*       Open tasklist view or turn back to register     */
/*********************************************************/
class tasklist extends Controller
{
    public function open_page()
    {
        if(!empty($_SESSION['user_id']))
        {
            Controller::showpage("tasklist");
            Controller::showpage("tasks");
        }
        else
        {
            Header("Location: ?controller=main&method=choose_page");
        }
    }
}
?>