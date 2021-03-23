<?php
class Controller {
    public static function register_or_login($password,$login,$db)
    {
        $query = model::get_user_id($password,$login,$db);
        if($query->rowCount() > 0)
        {
            return "login";
        }
        else
        {
            return "register";
        }
    }
    public static function set_session($password,$login,$db)
    {
        $query = model::get_user_id($password,$login,$db);
        if($query->rowCount() > 0)
        {
            while ($row = $query->fetch(PDO::FETCH_ASSOC)) 
            {
                $_SESSION['user_id'] = $row['id'];
                break;
            }
        }
    }
    public static function user_register($password,$login,$db)
    {
        model::add_user($password,$login,$db);
        Controller::set_session($password,$login,$db);

    }
    public static function user_login($password,$login,$db)
    {
        if(!isset($_SESSION['user_id']))
        {
            Controller::set_session($password,$login,$db);
            return true;
        }
        else
        {
            return null;
        }
    }
    public static function auth()
    {
        $db = model::get_database();
        if(!empty($_POST['login']) && !empty($_POST['password']))
        {
            $password=htmlspecialchars($_POST['password']);
            $login=htmlspecialchars($_POST['login']);
            if(Controller::register_or_login($password,$login,$db) == "register")
            {
                Controller::user_register($password,$login,$db);
                header('location: tasklist.php');
            }
            else
            {
                Controller::user_login($password,$login,$db);
                header('location: tasklist.php');
            }

        }
    }
    public static function changetask()
    {
        $db = model::get_database();
        $user_id = $_SESSION['user_id'];
        if(isset($_POST['ready']))
        {
            $id = $_POST['Id'];
            if($_POST['status'] == 1)
            {
                model::set_unready_task($user_id,$id,$db);
                header('location: tasklist.php');
            }
            if($_POST['status'] == 0)
            {  
                model::set_ready_task($user_id,$id,$db);
                header('location: tasklist.php');
            }
        }
        if(isset($_POST['delete']))
        {
            $id = $_POST['Id'];
            model::delete_task_from_user($id,$user_id,$db);
            header('location: tasklist.php');
        }
    }
    public static function change_all_tasks()
    {
        $db = model::get_database();
        $user_id = $_SESSION['user_id'];
        if(isset($_POST['AddTask']))
        {
            if(isset($_POST['NewTask']))
            {
                model::add_task($db,$user_id);
                header('location: tasklist.php');
            }
        }
        if(isset($_POST['RemoveAll']))
        {
            model::delete_alltasks_from_user($user_id,$db);
            header('location: tasklist.php');
        }
        if(isset($_POST['ReadyAll']))
        {
            model::set_readyall($user_id,$db);
            header('location: tasklist.php');
        }
    }
}