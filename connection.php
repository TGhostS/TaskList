<?php
$db_host = '127.0.0.1'; // адрес сервера 
$db_database = 'tasklist'; // имя базы данных
$db_user = 'root'; // имя пользователя
$db_password = 'root'; // пароль
try {
    // Подключение к базе данных
    $db = new PDO("mysql:host=$db_host;dbname=$db_database", $db_user, $db_password);
    // Устанавливаем корректную кодировку
    $db->exec("set names utf8");
} catch (PDOException $e) {
    // Если есть ошибка соединения, выводим её
    print "Ошибка!: " . $e->getMessage() . "<br/>";
}
?>