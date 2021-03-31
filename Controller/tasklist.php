<?php
class tasklist extends Controller
{
    public function open_page()
    {
        if(!empty($_SESSION['user_id']))
            {
            Controller::showpage("tasklist");
            $user_id = $_SESSION['user_id'];
            if($this -> m ->get_all_tasks_from_user($user_id)->rowCount() > 0)
            {
                $query = $this -> m ->get_all_tasks_from_user($user_id);
                while ($row = $query->fetch(PDO::FETCH_ASSOC)) 
                {
                    $_SESSION['tasks'] = $row;
                    Controller::showpage("tasks");
                }
            }
        }
        else
        {
            Header("Location: ?controller=main&method=choose_page");
        }
    }
}
?>