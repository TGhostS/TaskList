<?php
class Register extends Controller{
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
        Register::set_session($password,$login,$db);

    }
    public static function user_login($password,$login,$db)
    {
        if(!isset($_SESSION['user_id']))
        {
            Register::set_session($password,$login,$db);
        }
    }
    public static function auth()
    {
        $db = model::get_database();
        if(!empty($_POST['login']) && !empty($_POST['password']))
        {
            $password=htmlspecialchars($_POST['password']);
            $login=htmlspecialchars($_POST['login']);
            if(Register::register_or_login($password,$login,$db) == "register")
            {
                Register::user_register($password,$login,$db);
                header('location: tasklist.php');
            }
            else
            {
                Register::user_login($password,$login,$db);
                header('location: tasklist.php');
            }

        }
    }
    public static function show_page(){
        include "Views/register.php";
    }
}