<?php
class Tasklist {
    public static function change_all_tasks()
    {
        $db = model::get_database();
        $user_id = $_SESSION['user_id'];
        if(isset($_GET['AddTask']))
        {
            if(isset($_GET['NewTask']))
            {
                model::add_task($db,$user_id);
                header('location: tasklist.php');
            }
        }
        if(isset($_GET['RemoveAll']))
        {
            model::delete_alltasks_from_user($user_id,$db);
            header('location: tasklist.php');
        }
        if(isset($_GET['ReadyAll']))
        {
            model::set_readyall($user_id,$db);
            header('location: tasklist.php');
        }
    }
    public static function changetask()
    {
        $db = model::get_database();
        $user_id = $_SESSION['user_id'];
        if(isset($_GET['ready']))
        {
            $id = $_GET['Id'];
            if($_GET['status'] == 1)
            {
                model::set_unready_task($user_id,$id,$db);
                header('location: tasklist.php');
            }
            if($_GET['status'] == 0)
            {  
                model::set_ready_task($user_id,$id,$db);
                header('location: tasklist.php');
            }
        }
        if(isset($_GET['delete']))
        {
            $id = $_GET['Id'];
            model::delete_task_from_user($id,$user_id,$db);
            header('location: tasklist.php');
        }
    }
}