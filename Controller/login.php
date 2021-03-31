<?php 
class login extends Controller{
    public function auth()
    {
        if(!empty($_GET['login']) && !empty($_GET['password']))
        {
            $login = htmlspecialchars($_GET['login']);
            $password = htmlspecialchars($_GET['password']);
            $query = $this -> m ->get_user_id($password,$login);
            if($query->rowCount() > 0)
            {
                session_start();
                while ($row = $query->fetch(PDO::FETCH_ASSOC))
                {
                    $_SESSION['user_id'] = $row['id'];
                    break;
                }
                Header("Location: ?controller=tasklist&method=open_page");
            }
            else
            {
                $this -> m ->add_user($password,$login);
                session_start();
                $query = $this -> m ->get_user_id($password,$login);
                while ($row = $query->fetch(PDO::FETCH_ASSOC))
                {
                    $_SESSION['user_id'] = $row['id'];
                    break;
                }
                Header("Location: ?controller=tasklist&method=open_page");
            }
        }
        else
        {
            echo "Поля не могут быть пустыми";
        }
        
            

        
    }
}
?>