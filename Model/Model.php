<?php
/*********************************************************/
/*                  Create main Model                    */
/*********************************************************/
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
}
?>