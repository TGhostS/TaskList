<?php
require_once 'connection.php'; // подключаем скрипт
 
// подключаемся к серверу
$link = mysqli_connect($host, $user, $password, $database) 
    or die("Ошибка " . mysqli_error($link));
 
// выполняем операции с базой данных
$login = htmlentities(mysqli_real_escape_string($link, $_POST['register_name']));
$password = htmlentities(mysqli_real_escape_string($link, $_POST['register_password']));
/********************************************/
            /*Login*/
$query ="SELECT login,password FROM users Where '$login' = login and '$password' = password";
$result_task = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link)); 
if($result_task)
{
    while ($row = mysqli_fetch_array($result_task)) 
    {
        if($row['login'] != null && $row['password'] != null)
        {
            setcookie("login",$row['login']);
            setcookie("password",$row['password']);
            header('location: tasklist.php');
            exit();
        }
    }
      
}
/********************************************/
            /*Register*/
if(preg_match("/^[a-zA-Z0-9]+$/",$_POST['register_name']))
{
    if ($login != "" && $password != "")
    {
        $date = date('Y-m-d');
        $query = "INSERT INTO users (login,password,created_at) VALUES ('$login','$password','$date')";
        $result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link)); 
            if($result)
            {
                mysqli_close($link);
                setcookie("login",$login);
                setcookie("password",$password);
                header('location: tasklist.php');
                exit();
            }
            
    }
    else
    {
        echo "Логин или пароль отсутствуют";
        mysqli_close($link);
    }
}
else
{
    echo "Логин может содержать только буквы английского алфавита";
    mysqli_close($link);
}

?>