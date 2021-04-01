<?php
/*********************************************************/
/*       Working with requests from User Controller      */
/*********************************************************/
class User extends Model
{
    public function get_user_id($login,$password)
    {
        $data = array( 'login' => $login); 
        $query = $this -> db -> prepare("SELECT * FROM users WHERE login = :login");
        $query->execute($data);
        while ($row = $query->fetch(PDO::FETCH_ASSOC))
        {
            if(password_verify($password,$row['password']))
            {
                return $row['id'];
            }
        } 
    }
    public  function add_user($password,$login)
    {
        $password = password_hash($password,PASSWORD_BCRYPT);
        $data = array( 'login' => $login, 'password' => $password,'date' => date("Y-m-d")); 
        $query = $this -> db -> prepare("INSERT INTO users (login,password,created_at) VALUES (:login,:password,:date)");
        $query->execute($data);
    } 
}
?>