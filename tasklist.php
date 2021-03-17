<?php
/**********************************************************/
           /* Find id user,connect db */
require_once 'connection.php'; // подключаем скрипт
$link = mysqli_connect($host, $user, $password, $database) 
    or die("Ошибка " . mysqli_error($link)); 
$login = $_COOKIE['login'];
$password = $_COOKIE['password'];
if($login == "" || $password == "")
{
    header('location: register.php');
    exit();
} 
$query_find_id ="SELECT id FROM users Where '$login' = login and '$password' = password ";
$result = mysqli_query($link,$query_find_id);
if($result)
{
   $id = mysqli_fetch_row($result)[0];
   setcookie('id',$id);
}

/**********************************************************/
                /*Delete All Tasks */
if(isset($_POST['RemoveAll']))
{
    $query ="DELETE FROM tasks WHERE user_id = '$id'";
    mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link)); 
    header('location: tasklist.php');
}
/**********************************************************/
                /*Ready All Tasks */
if(isset($_POST['ReadyAll']))
{
    $query ="UPDATE tasks SET status = 1 WHERE '$id' = user_id";
    mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link)); 
    header('location: tasklist.php');
}
/**********************************************************/
        /*Delete and Ready || Unready chosen task*/
if(isset($_POST['ready']))
{
    if($_POST['status'] == 0)
    {
        $id = $_POST['Id'];
        $query ="UPDATE tasks SET status = 1 WHERE '$id' = id";
        $result_task = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link)); 
        header('location: tasklist.php');
    }
    if($_POST['status'] == 1)
    {
        $id = $_POST['Id'];
        $query ="UPDATE tasks SET status = 0 WHERE '$id' = id";
        $result_task = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link)); 
        header('location: tasklist.php');
    }
}
if(isset($_POST['delete']))
{
    $id = $_POST['Id'];
    $query ="DELETE FROM tasks Where '$id' = id";
    $result_task = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link)); 
    header('location: tasklist.php');
}
/**********************************************************/
                /*Create New Task */
if(isset($_POST['AddTask']))
{
    $date = date('Y-m-d');
    $NewTask = htmlentities(mysqli_real_escape_string($link, $_POST['NewTask']));
    $query = "INSERT INTO tasks (user_id,description,created_at) VALUES ('$id','$NewTask','$date')";
    $result_task = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link)); 
    header('location: tasklist.php');
}
/**********************************************************/
        /* Create function for create Tasks */
function CreateTasks($id,$link)
{
$query_find_tasks ="SELECT description,status,id FROM tasks Where '$id' = user_id ";
if($query_find_tasks != NULL)
    {
        $result = mysqli_query($link, $query_find_tasks) or die("Ошибка " . mysqli_error($link));
        if($result)
        {
            while ($row = mysqli_fetch_array($result)) 
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
CreateTasks($id,$link);
?>
