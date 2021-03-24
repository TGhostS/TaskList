<?php
class model {
 
 protected $db;
 
 public function __construct() {
 $this->db = mysqli_connect("127.0.0.1","root","root");
 if(!$this->db) {
 exit("Ошибка соединения с базой данных".mysqli_error(model::$db));
 }
 if(!mysqli_select_db(model::$db,$this->db)) {
 exit("Нет такой базы данных".mysqli_error(model::$db));
 }
 mysqli_query(model::$db,"SET NAMES 'UTF8'");
 
 }

public static function menu()
{ 
    $query = model::$db -> prepare("SELECT id FROM users");
    $query->execute();
    return $query;
}

}