<?php
class view {
    private $model;
    private $controller;

    public function __construct($controller,$model) {
        $this->controller = $controller;
        $this->model = $model;
    }
    public static function create_auth_page()
    {
        include "register.php";
    }
    public static function main_menu_tasks()
    {
        echo "<form action=\"index.php\" method=\"POST\" name=\"ChangeTask\">";
        echo "<input type=\"text\" name=\"NewTask\" placeholder=\"Enter Text...\" >";
        echo "<input type=\"submit\" name=\"AddTask\" value=\"Add Task\">";
        echo "<p></p>";
        echo "<input type=\"submit\" name=\"RemoveAll\" value=\"Remove All\">";
        echo "<input type=\"submit\" name=\"ReadyAll\" value=\"Ready All\">";
        echo "<p></p>";
        echo "</form>";
    }
    public static function create_tasks_menu($user_id,$db)
    {
        include "header.php";
        if(model::get_all_tasks_from_user($user_id,$db)->rowCount() > 0)
        {
            $query = model::get_all_tasks_from_user($user_id,$db);
            while ($row = $query->fetch(PDO::FETCH_ASSOC)) 
            {
                view::create_task($row);
            }
        }
    }
    public static function create_task($row)
    {
        if($row['status'] == 1)
        {
            $ready = "Unready";
        }
        if($row['status'] == 0)
        {
            $ready = "Ready";
        }
        $task_id = $row['id'];
        $status = $row['status'];
        echo "<form action=\"tasklist.php\" method=\"POST\" name=\"ChangeTask\">";
        echo $row['description'];
        echo "<p></p>";
        echo "<input type =\"submit\" value=\"$ready\" name=\"ready\">";
        echo "<input type=\"submit\" value=\"Delete\" name=\"delete\">";
        echo "<input type=\"hidden\" name=\"Id\" value=\"$task_id\"/>";
        echo "<input type=\"hidden\" name=\"status\" value=\"$status\"/>";
        if($row['status'] == 1)
        {
            echo "<img src=\"Views/images/green_circle.png\">";
        }
        if($row['status'] == 0)
        {
            echo "<img src=\"Views/images/red_circle.png\">";
        }
        echo "<p></p>";
        echo "</form>";     
        
    }
}
?>