<?php
/*********************************************************/
/*                  Create Task menu                     */
/*********************************************************/
include "header.php";
?>
<form action="index.php" method="GET" name="ChangeTask">
<input type="text" name="NewTask" placeholder="Enter Text..." >
<input type="submit" name="AddTask" value="Add Task">
<p></p>
<input type="submit" name="RemoveAll" value="Remove All">
<input type="submit" name="ReadyAll" value="Ready All">
<input type="hidden" name="controller" value="ChangeTasks"/>
<input type="hidden" name="method" value="change_all_tasks"/>
<p></p>
</form>


