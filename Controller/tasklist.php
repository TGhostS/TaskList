<?php
class tasklist extends Controller
{
    public static function open_page()
    {
        Controller::showpage("tasklist");
        $db = Model::get_database();
        $user_id = $_SESSION['user_id'];
        if(model::get_all_tasks_from_user($user_id,$db)->rowCount() > 0)
        {
            $query = model::get_all_tasks_from_user($user_id,$db);
            while ($row = $query->fetch(PDO::FETCH_ASSOC)) 
            {
                if($row['status'] == 1)
                {
                    $ready = "Unready";
                }
                if($row['status'] == 0)
                {
                    $ready = "Ready";
                }
                $task_id = $row['id'];
                $status = $row['status'];
                $info = $row['description'];
                include "Views/tasks.php";
            }
        }
    }
}
?>