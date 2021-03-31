<?php
class User extends Model
{
    public function get_user_id($password,$login)
    {
        $data = array( 'login' => $login, 'password' => $password ); 
        $query = $this -> db -> prepare("SELECT id FROM users WHERE login = :login and password = :password");
        $query->execute($data);
        $output = array();
        while ($row = $query->fetch(PDO::FETCH_ASSOC))
        {
            return $output;
            break;
        }   
    }
    public  function add_user($password,$login)
    {
        $data = array( 'login' => $login, 'password' => $password,'date' => date("Y-m-d")); 
        $query = $this -> db -> prepare("INSERT INTO users (login,password,created_at) VALUES (:login,:password,:date)");
        $query->execute($data);
    } 
}
?>