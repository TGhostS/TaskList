<?php 
/*********************************************************/
/*            register or login new user                 */
/*********************************************************/
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
            $id = $this -> m ->get_user_id($password,$login);
            if(!empty($id))
            {
                echo $id;
                $_SESSION['user_id'] = $id;
            }
            else
            {
                $this -> m ->add_user($password,$login);
                session_start();
                $id = $this -> m ->get_user_id($login,$password);
                if(!empty($id))
                {
                    $_SESSION['user_id'] = $id;
                }
            }
            Header("Location: ?controller=tasklist&method=open_page");
        }
        else
        {
            echo "Поля не могут быть пустыми";
        }
        
            

        
    }
}
?>