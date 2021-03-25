<?php 
class OneTask extends Controller{
    public static function changetask()
    {
        $db = Controller::get_database();
        $user_id = $_SESSION['user_id'];
        if(isset($_POST['ready']))
        {
            $id = $_POST['Id'];
            if($_POST['status'] == 1)
            {
                model::set_unready_task($user_id,$id,$db);
                header('location: main.php');
            }
            if($_POST['status'] == 0)
            {  
                model::set_ready_task($user_id,$id,$db);
                header('location: main.php');
            }
        }
        if(isset($_POST['delete']))
        {
            $id = $_POST['Id'];
            model::delete_task_from_user($id,$user_id,$db);
            header('location: main.php');
        }
    }
}