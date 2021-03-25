<?php
class Model {
protected $db;
public static function get_database()
 {
    $db_host = '127.0.0.1'; // адрес сервера 
    $db_database = 'tasklist'; // имя базы данных
    $db_user = 'root'; // имя пользователя
    $db_password = 'root'; // пароль
    try {
        // Подключение к базе данных
        $db = new PDO("mysql:host=$db_host;dbname=$db_database", $db_user, $db_password);
        // Устанавливаем корректную кодировку
        $db->exec("set names utf8");
        return $db;
    } catch (PDOException $e) {
        // Если есть ошибка соединения, выводим её
        print "Ошибка!: " . $e->getMessage() . "<br/>";
    }
}
public static function get_user_id($password,$login,$db)
{
    $data = array( 'login' => $login, 'password' => $password ); 
    $query = $db -> prepare("SELECT id FROM users WHERE login = :login and password = :password");
    $query->execute($data);
    return $query;
}
public static function add_user($password,$login,$db)
{
    $data = array( 'login' => $login, 'password' => $password,'date' => date("Y-m-d")); 
    $query = $db -> prepare("INSERT INTO users (login,password,created_at) VALUES (:login,:password,:date)");
    $query->execute($data);
} 
public static function delete_alltasks_from_user($user_id,$db)
{
    $data = array('id' => $user_id);
    $query = $db -> prepare("DELETE FROM tasks WHERE user_id = :id ");
    $query -> execute($data);
}
public static function set_readyall($user_id,$db)
{
    $data = array('id' => $user_id);
    $query = $db -> prepare("UPDATE tasks SET status = 1 WHERE user_id = :id");
    $query->execute($data);
}
public static function delete_task_from_user($id,$user_id,$db)
{
    $data = array('id' => $id,'user_id' => $user_id);
    $query = $db -> prepare("DELETE FROM tasks  WHERE id = :id and user_id = :user_id");
    $query->execute($data);
}
public static function set_ready_task($user_id,$id,$db)
{
    $data = array('id' => $id,'user_id' => $user_id);
    $query = $db -> prepare("UPDATE tasks SET status = 1 WHERE id = :id and user_id = :user_id");
    $query->execute($data);
}
public static function set_unready_task($user_id,$id,$db)
{
    $data = array('id' => $id,'user_id' => $user_id);
    $query = $db -> prepare("UPDATE tasks SET status = 0 WHERE id = :id and user_id = :user_id");
    $query->execute($data);
}
public static function get_all_tasks_from_user($user_id,$db)
{
    $data = array('user_id' => $user_id);
    $query = $db ->prepare("SELECT description,status,id FROM tasks Where user_id = :user_id");
    $query->execute($data);
    return $query;
}
public static function add_task($db,$user_id)
{
    $date = date('Y-m-d');
    $NewTask = htmlentities($_POST['NewTask']);
    $data = array('user_id' => $user_id,'NewTask' => $NewTask,'date' => $date);
    $query = $db -> prepare("INSERT INTO tasks (user_id,description,created_at) VALUES (:user_id,:NewTask,:date)");
    $query->execute($data);
}
}
?>