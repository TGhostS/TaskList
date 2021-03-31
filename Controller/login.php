<?php 
class login extends Controller
{
    protected $m;
    public function __construct()
    {
        $this -> m = new User();
    }
    public function auth()
    {
        if(!empty($_POST['login']) && !empty($_POST['password']))
        {
            $login = htmlspecialchars($_POST['login']);
            $password = htmlspecialchars($_POST['password']);
            $query = $this -> t ->get_user_id($password,$login);
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
                $id = $this -> m ->get_user_id($password,$login);
                if(!empty($id))
                {
                    $_SESSION['user_id'] = $id;
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