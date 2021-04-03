<?php
/*********************************************************/
/*       Open tasklist view or turn back to register     */
/*********************************************************/
class tasklist extends Controller
{
    public $row;
    public function open_page()
    {
        if(!empty($_SESSION['user_id']))
        {
            Controller::showpage("tasklist");
            foreach($this -> m ->get_all_tasks_from_user($_SESSION['user_id']) as $this -> row)
            {
                Controller::showpage("tasks");
            }
        }
    }
}
?>