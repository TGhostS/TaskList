<?php
/**********************************************************/
           /* Find id user,connect db */
require_once 'connection.php'; // подключаем скрипт
session_start();
if(!isset($_SESSION["user_id"]))
{
    header("location:index.php");
}
$user_id = $_SESSION["user_id"];

/**********************************************************/
                /*Delete All Tasks */
if(isset($_POST['RemoveAll']))
{
    $data = array('id' => $id);
    $query = $db -> prepare("DELETE FROM tasks WHERE user_id = :id ");
    $query -> execute($data);
    header('location: tasklist.php');
}
/**********************************************************/
                /*Ready All Tasks */
if(isset($_POST['ReadyAll']))
{
    $data = array('id' => $id);
    $query = $db -> prepare("UPDATE tasks SET status = 1 WHERE user_id = :id");
    $query->execute($data);
    header('location: tasklist.php');
}
/**********************************************************/
        /*Delete and Ready || Unready chosen task*/
if(isset($_POST['ready']))
{
    if($_POST['status'] == 0)
    {
        $id = $_POST['Id'];
        $data = array('id' => $id,'user_id' => $user_id);
        $query = $db -> prepare("UPDATE tasks SET status = 1 WHERE id = :id and user_id = :user_id");
        $query->execute($data);
        header('location: tasklist.php');
    }
    if($_POST['status'] == 1)
    {
        $id = $_POST['Id'];
        $data = array('id' => $id,'user_id' => $user_id);
        $query = $db -> prepare("UPDATE tasks SET status = 0 WHERE id = :id and user_id = :user_id");
        $query->execute($data);
        header('location: tasklist.php');
    }
}
if(isset($_POST['delete']))
{
    $id = $_POST['Id'];
    $data = array('id' => $id,'user_id' => $user_id);
    $query = $db -> prepare("DELETE FROM tasks  WHERE id = :id and user_id = :user_id");
    $query->execute($data);
    header('location: tasklist.php');
}
/**********************************************************/
                /*Create New Task */
if(isset($_POST['AddTask']))
{
    $date = date('Y-m-d');
    $NewTask = htmlentities($_POST['NewTask']);
    $data = array('user_id' => $user_id,'NewTask' => $NewTask,'date' => $date);
    $query = $db -> prepare("INSERT INTO tasks (user_id,description,created_at) VALUES (:user_id,:NewTask,:date)");
    $query->execute($data);
    header('location: tasklist.php');
}
/**********************************************************/
        /* Create function for create Tasks */
function CreateTasks($user_id,$db)
{
$data = array('user_id' => $user_id);
$query = $db ->prepare("SELECT description,status,id FROM tasks Where $user_id = :user_id");
$query->execute($data);
if($query->rowCount() > 0)
   {
       return $query;
   }
}
?>
<!----------------------------------------------------->
            <!-- HTML CODE -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>tasklist</title>
</head>
<body>
    <form action="tasklist.php" method="POST" name="ChangeTask">
    <input type="text" name="NewTask" placeholder="Enter Text..." >
    <input type="submit" name="AddTask" value="Add Task">
    <p></p>
    <input type="submit" name="RemoveAll" value="Remove All">
    <input type="submit" name="ReadyAll" value="Ready All">
    <p></p>
    </form>
</body>
</html>
<!----------------------------------------------------->
            <!-- HTML CODE -->
            
<?php
$query = CreateTasks($user_id,$db);
if(isset($query))
{
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
            echo "<img src=\"green_circle.png\">";
        }
        if($row['status'] == 0)
        {
            echo "<img src=\"red_circle.png\">";
        }
        echo "<p></p>";
        echo "</form>";     
    }
}
?>
