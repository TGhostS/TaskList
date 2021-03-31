<?php
class Model 
{
    protected $db;
    public  function __construct()
    {
        $db_host = '127.0.0.1'; // адрес сервера 
        $db_database = 'tasklist'; // имя базы данных
        $db_user = 'root'; // имя пользователя
        $db_password = 'root'; // пароль        
        // Подключение к базе данных
        $this -> db = new PDO("mysql:host=$db_host;dbname=$db_database", $db_user, $db_password);
        // Устанавливаем корректную кодировку
        $this -> db ->exec("set names utf8");
    }
    public   function get_user_id($password,$login)
    {
        $data = array( 'login' => $login, 'password' => $password ); 
        $query = $this -> db -> prepare("SELECT id FROM users WHERE login = :login and password = :password");
        $query->execute($data);
        return $query;
    }
    public  function add_user($password,$login)
    {
        $data = array( 'login' => $login, 'password' => $password,'date' => date("Y-m-d")); 
        $query = $this -> db -> prepare("INSERT INTO users (login,password,created_at) VALUES (:login,:password,:date)");
        $query->execute($data);
    } 
    public  function delete_alltasks_from_user($user_id)
    {
        $data = array('id' => $user_id);
        $query = $this -> db -> prepare("DELETE FROM tasks WHERE user_id = :id ");
        $query -> execute($data);
    }
    public  function set_readyall($user_id)
    {
        $data = array('id' => $user_id);
        $query = $this -> db -> prepare("UPDATE tasks SET status = 1 WHERE user_id = :id");
        $query->execute($data);
    }
    public  function delete_task_from_user($id,$user_id)
    {
        $data = array('id' => $id,'user_id' => $user_id);
        $query = $this -> db -> prepare("DELETE FROM tasks  WHERE id = :id and user_id = :user_id");
        $query->execute($data);
        unset($_SESSION['tasks']);
    }
    public  function set_ready_task($user_id,$id)
    {
        $data = array('id' => $id,'user_id' => $user_id);
        $query = $this -> db -> prepare("UPDATE tasks SET status = 1 WHERE id = :id and user_id = :user_id");
        $query->execute($data);
    }
    public  function set_unready_task($user_id,$id)
    {
        $data = array('id' => $id,'user_id' => $user_id);
        $query = $this -> db -> prepare("UPDATE tasks SET status = 0 WHERE id = :id and user_id = :user_id");
        $query->execute($data);
    }
    public  function get_all_tasks_from_user($user_id)
    {
        $data = array('user_id' => $user_id);
        $query = $this -> db ->prepare("SELECT description,status,id FROM tasks Where user_id = :user_id");
        $query->execute($data);
        return $query;
    }
    public  function add_task($user_id)
    {
        $date = date('Y-m-d');
        $NewTask = htmlentities($_GET['NewTask']);
        $data = array('user_id' => $user_id,'NewTask' => $NewTask,'date' => $date);
        $query = $this -> db-> prepare("INSERT INTO tasks (user_id,description,created_at) VALUES (:user_id,:NewTask,:date)");
        $query->execute($data);
    }
}
?>