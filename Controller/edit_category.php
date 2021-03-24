<?php
class edit_category extends ACore_Admin {
	
	public function get_content() {
		
		$query = "SELECT id_category,name_category FROM category";
		$result = mysqli_query(acore_admin::$db,$query);
		if(!$result) {
			exit(mysqli_error(acore_admin::$db));
		}
		
		echo "<div id='main'>";
		echo "<a style='color:red' href='?option=add_category'>Добавить новую категорию</a><hr>";
		if($_SESSION['res']) {
			echo $_SESSION['res'];
			unset($_SESSION['res']);
		}
		
		$row = array();
		for($i = 0; $i < mysqli_num_rows($result);$i++) {
			$row = mysqli_fetch_array($result,"MYSQL_ASSOC");
			printf("<p style='font-size:14px;'>
						<a style='color:#585858' href='?option=update_category&id_text=%s'>%s</a> |
						<a style='color:red' href='?option=delete_category&del=%s'>Удалить</a>
					</p>",$row['id_category'],$row['name_category'],$row['id_category']);
		}
		
		echo '</div>
			</div>';
	}
}
?>