<?php
class ChangeAllTask extends Controller{
    public static function change_all_tasks()
    {
        $db = Controller::get_database();
        $user_id = $_SESSION['user_id'];
        if(isset($_POST['AddTask']))
        {
            if(isset($_POST['NewTask']))
            {
                model::add_task($db,$user_id);
                header('location: main.php');
            }
        }
        if(isset($_POST['RemoveAll']))
        {
            model::delete_alltasks_from_user($user_id,$db);
            header('location: main.php');
        }
        if(isset($_POST['ReadyAll']))
        {
            model::set_readyall($user_id,$db);
            header('location: main.php');
        }
    }
}