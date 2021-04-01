<?php
/*********************************************************/
/*                  Create Tasks                         */
/*********************************************************/
foreach($this -> m ->get_all_tasks_from_user($_SESSION['user_id']) as $row)
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
    echo "<form action=\"index.php\" method=\"GET\" name=\"ChangeTask\">";
    echo $row['description'];
    echo "<p></p>";
    echo "<input type =\"submit\" value=\"$ready\" name=\"ready\">";
    echo "<input type=\"submit\" value=\"Delete\" name=\"delete\">";
    echo "<input type=\"hidden\" name=\"Id\" value=\"$task_id\"/>";
    echo "<input type=\"hidden\" name=\"status\" value=\"$status\"/>";
    echo "<input type=\"hidden\" name=\"controller\" value=\"ChangeTasks\"/>";
    echo "<input type=\"hidden\" name=\"method\" value=\"changetask\"/>";
    if($ready == "Unready")
    {
        echo "<img src=\"assets/green_circle.png\">";
    }
    else
    {
        echo "<img src=\"assets/red_circle.png\">";
    }
    echo "<p></p>";
    echo "</form>";  
}   

?>