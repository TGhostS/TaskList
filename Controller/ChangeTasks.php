<?php
class ChangeTasks extends Controller
{
    protected $m;
    public function __construct()
    {
        $this -> m = new Tasklists();
    }
    public  function change_all_tasks()
    {
        $user_id = $_SESSION['user_id'];
        if(isset($_GET['AddTask']))
        {
            if(isset($_GET['NewTask']))
            {
                $this -> m -> add_task($user_id);
                header("Location: ?controller=tasklist&method=open_page");
            }
        }
        if(isset($_GET['RemoveAll']))
        {
            $this -> m ->delete_alltasks_from_user($user_id);
            Header("Location: ?controller=tasklist&method=open_page");
        }
        if(isset($_GET['ReadyAll']))
        {
            $this -> m ->set_readyall($user_id);
            Header("Location: ?controller=tasklist&method=open_page");
        }
    }
    public function changetask()
    {
        $user_id = $_SESSION['user_id'];
        if(isset($_GET['ready']))
        {
            $id = $_GET['Id'];
            if($_GET['status'] == 1)
            {
                $this -> m ->set_unready_task($user_id,$id);
                Header("Location: ?controller=tasklist&method=open_page");
            }
            if($_GET['status'] == 0)
            {  
                $this -> m ->set_ready_task($user_id,$id);
                Header("Location: ?controller=tasklist&method=open_page");
            }
        }
        if(isset($_GET['delete']))
        {
            $id = $_GET['Id'];
            $this -> m ->delete_task_from_user($id,$user_id);
            Header("Location: ?controller=tasklist&method=open_page");
        }
    }
}