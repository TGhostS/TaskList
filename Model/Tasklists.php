<?php
/*********************************************************/
/*   Working with requests from ChangeTask Controller    */
/*********************************************************/
class Tasklists extends Model
{
    public  function delete_alltasks_from_user($user_id)
    {
        $data = array('id' => $user_id);
        $query = $this -> db -> prepare("DELETE FROM tasks WHERE user_id = :id ");
        $query -> execute($data);
    }
    public  function set_readyall($user_id)
    {
        $data = array('id' => $user_id);
        $query = $this -> db -> prepare("UPDATE tasks SET status = 1 WHERE user_id = :id");
        $query->execute($data);
    }
    public  function delete_task_from_user($id,$user_id)
    {
        $data = array('id' => $id,'user_id' => $user_id);
        $query = $this -> db -> prepare("DELETE FROM tasks  WHERE id = :id and user_id = :user_id");
        $query->execute($data);
    }
    public  function set_ready_task($user_id,$id)
    {
        $data = array('id' => $id,'user_id' => $user_id);
        $query = $this -> db -> prepare("UPDATE tasks SET status = 1 WHERE id = :id and user_id = :user_id");
        $query->execute($data);
    }
    public  function set_unready_task($user_id,$id)
    {
        $data = array('id' => $id,'user_id' => $user_id);
        $query = $this -> db -> prepare("UPDATE tasks SET status = 0 WHERE id = :id and user_id = :user_id");
        $query->execute($data);
    }
    public  function get_all_tasks_from_user($user_id)
    {
        $data = array('user_id' => $user_id);
        $query = $this -> db ->prepare("SELECT description,status,id FROM tasks Where user_id = :user_id");
        $query->execute($data);
        $output = array();
        while ($row = $query->fetch(PDO::FETCH_ASSOC))
        {
            $output[] = $row;
        }
        return $output;
    }
    public  function add_task($user_id,$NewTask)
    {
        $date = date('Y-m-d');
        $data = array('user_id' => $user_id,'NewTask' => $NewTask,'date' => $date);
        $query = $this -> db-> prepare("INSERT INTO tasks (user_id,description,created_at) VALUES (:user_id,:NewTask,:date)");
        $query->execute($data);
    }
}
?>