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
                /*Create New Task */
if(isset($_POST['NewTask']))
{
    $date = date('Y-m-d');
    $NewTask = htmlentities(mysqli_real_escape_string($link, $_POST['NewTask']));
    $query = "INSERT INTO tasks (user_id,description,created_at) VALUES ('$id','$NewTask','$date')";
    $result_task = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link)); 
    header('location: tasklist.php');
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
    $query ="UPDATE tasks SET status = 1 WHERE '$id' = user_id" ;
    mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link)); 
    header('location: tasklist.php');
}
/**********************************************************/
        /* Create function for create Tasks */
function CreateTasks($id,$link)
{
    $query_find_tasks ="SELECT description,status FROM tasks Where '$id' = user_id ";
    if($query_find_tasks != NULL)
        {
        $result = mysqli_query($link, $query_find_tasks) or die("Ошибка " . mysqli_error($link));
        if($result)
        {
            while ($row = mysqli_fetch_array($result)) {
                
                echo $row['description'];
                echo "<p></p>";
                echo "<input type =\"submit\" value=\"$ready\" name=$start><input type=\"submit\" value=\"Delete\" name=$delete>";
                if($row['status'] == 1)
                {
                    echo "<img src=\"green_circle.png\">";
                }
                if($row['status'] == 0)
                {
                    echo "<img src=\"red_circle.png\">";
                }
                
            }
        }
    }
}

?>
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
    </form>
</body>
</html>
<?php
CreateTasks($id,$link)
?>
