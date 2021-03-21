<?php
require_once 'connection.php'; // подключаем скрипт
session_start();
if(isset($_SESSION["user_id"]))
{
    header("Location: tasklist.php");
}
/**********************************************************/
                /*Login user */
if(!empty($_POST['login']) && !empty($_POST['password']))
{
    $password=htmlspecialchars($_POST['password']);
    $login=htmlspecialchars($_POST['login']);
    $data = array( 'login' => $login, 'password' => $password ); 
    $query = $db -> prepare("SELECT id FROM users WHERE login = :login and password = :password");
    $query->execute($data);
    if($query->rowCount() > 0)
    {
        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
            $_SESSION['user_id'] = $row['id'];
            header('location: tasklist.php');
        }
    }
    else
    {
        /**********************************************************/
                            /*register user */
        $data = array( 'login' => $login, 'password' => $password,'date' => date("Y-m-d")); 
        $query = $db -> prepare("INSERT INTO users (login,password,created_at) VALUES (:login,:password,:date)");
        $query->execute($data);
        $data = array( 'login' => $login, 'password' => $password ); 
        $query = $db -> prepare("SELECT id FROM users WHERE login = :login and password = :password");
        $query->execute($data);
        if($query->rowCount() > 0)
        {
            while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
                $_SESSION['user_id'] = $row['id'];
                header('location: tasklist.php');
            }
        }
    }
}
else
{
    echo "Поля не могут быть пустыми";
}
?>