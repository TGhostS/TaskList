<?php
require_once 'connection.php'; // подключаем скрипт
 
// подключаемся к серверу
$link = mysqli_connect($host, $user, $password, $database) 
    or die("Ошибка " . mysqli_error($link));
 
// выполняем операции с базой данных
$login = htmlentities(mysqli_real_escape_string($link, $_POST['register_name']));
$password = htmlentities(mysqli_real_escape_string($link, $_POST['register_password']));

if(preg_match("/^[a-zA-Z0-9]+$/",$_POST['register_name']))
{
    if ($login != "" && $password != "")
    {
        $date = date('Y-m-d');
        $query = "INSERT INTO users (login,password,created_at) VALUES ('$login','$password','$date')";
        $result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link)); 
            if($result)
            {
                echo "Данные добавлены";
                mysqli_close($link);
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