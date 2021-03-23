<?php
$db = Model::get_database();
$user_id = $_SESSION['user_id'];
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
        echo "<form action=\"index.php\" method=\"POST\" name=\"ChangeTask\">";
        echo $row['description'];
        echo "<p></p>";
        echo "<input type =\"submit\" value=\"$ready\" name=\"ready\">";
        echo "<input type=\"submit\" value=\"Delete\" name=\"delete\">";
        echo "<input type=\"hidden\" name=\"Id\" value=\"$task_id\"/>";
        echo "<input type=\"hidden\" name=\"status\" value=\"$status\"/>";
        echo "<input type=\"hidden\" name=\"controller\" value=\"Tasklist\"/>";
        echo "<input type=\"hidden\" name=\"method\" value=\"changetask\"/>";
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
?>