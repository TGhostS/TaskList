<?php
function view_tasks($user_id,$db)
{
    if(model::get_all_tasks_from_user($user_id,$db)->rowCount() > 0)
        {
            $query = model::get_all_tasks_from_user($user_id,$db);
            while ($row = $query->fetch(PDO::FETCH_ASSOC)) 
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
                    echo "<img src=\"assets/green_circle.png\">";
                }
                if($row['status'] == 0)
                {
                    echo "<img src=\"assets/red_circle.png\">";
                }
                echo "<p></p>";
                echo "</form>";     
            }
        }
}
?>