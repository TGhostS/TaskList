<?php
class add_category extends ACore_Admin {
	
	protected function obr() {
		
		$title = $_POST['title'];
		
		if(empty($title)) {
			exit("Не заполнены обязательные поля");
		}
		
		$query = " INSERT INTO category
						(name_category)
					VALUES ('$title')";
		if(!mysqli_query(acore_admin::$db,$query)) {
			exit(mysqli_error(acore_admin::$db));
		}
		else {
			$_SESSION['res'] = "Изменения сохранены";
			header("Location:?option=add_category");
			exit;
		}			
	}
	
	public function get_content() {
		echo "<div id='main'>";
		if($_SESSION['res']) {
			echo $_SESSION['res'];
			unset($_SESSION['res']);
		}
print <<<HEREDOC
<form action='' method='POST'>
<p>Заголовок категории:<br />
<input type='text' name='title' style='width:420px;'>
</p>
<p><input type='submit' name='button' value='Сохранить'></p></form></div></div>
HEREDOC;
	}
}
?>