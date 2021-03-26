<?php
class ChangeTasks extends Controller{
    public static function change_all_tasks()
    {
        $db = Model::get_database();
        $user_id = $_SESSION['user_id'];
        if(isset($_POST['AddTask']))
        {
            if(isset($_POST['NewTask']))
            {
                model::add_task($db,$user_id);
                Header("Refresh:0");
            }
        }
        if(isset($_POST['RemoveAll']))
        {
            model::delete_alltasks_from_user($user_id,$db);
            Header("Refresh:0");
        }
        if(isset($_POST['ReadyAll']))
        {
            model::set_readyall($user_id,$db);
            Header("Refresh:0");
        }
    }
    public static function changetask()
    {
        $db = Model::get_database();
        $user_id = $_SESSION['user_id'];
        if(isset($_POST['ready']))
        {
            $id = $_POST['Id'];
            if($_POST['status'] == 1)
            {
                model::set_unready_task($user_id,$id,$db);
                Header("Refresh:0");
            }
            if($_POST['status'] == 0)
            {  
                model::set_ready_task($user_id,$id,$db);
                Header("Refresh:0");
            }
        }
        if(isset($_POST['delete']))
        {
            $id = $_POST['Id'];
            model::delete_task_from_user($id,$user_id,$db);
            Header("Refresh:0");
        }
    }
}