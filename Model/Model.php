<?php
class model {
	
	protected $db;
	
	public function __construct() {
		$this->db = mysqli_connect("127.0.0.1","root","root");
		if(!$this->db) {
			exit("Ошибка соединения с базой данных".mysqli_error($this->db));
		}
		if(!mysqli_select_db($this->db,"task")) {
			exit("Нет такой базы данных".mysqli_error($this->db));
		}
		mysqli_query($this->db,"SET NAMES 'UTF8'");
		
	}
	
	public function get_left_bar(){
		$query = "SELECT id_category,name_category FROM category";
		
		$result = mysqli_query($this->db,$query);
		if(!$result) {
			exit(mysqli_error($this->db));
		}
		
		for($i = 0;$i < mysqli_num_rows($result); $i++) {
			$row[] = mysqli_fetch_array($result);
		}
		
		return $row;
	}
	
	public function menu_array() {
		$query = "SELECT id_menu,name_menu FROM menu";
		
		$result = mysqli_query($this->db,$query);
		if(!$result) {
			exit(mysqli_error($this->db));
		}
		
		$row = array();
		
		for($i = 0;$i < mysqli_num_rows($result); $i++) {
			$row[] = mysqli_fetch_array($result);
		}
		return $row;
	}
	
	public function get_main_content() {
		
		$query = "SELECT id,title,discription,date,img_src FROM statti ORDER BY date DESC";
		$result = mysqli_query($this->db,$query);
		if(!$result) {
			exit(mysqli_error($this->db));
		}
		
		for($i = 0; $i < mysqli_num_rows($result);$i++) {
			$row[] = mysqli_fetch_array($result);
		}
		
		return $row;
	}
	
	public function get_cat($id_cat) {
		
		$query = "SELECT id,title,discription,date,img_src 
							FROM statti 
							WHERE cat='$id_cat' 
							ORDER BY date DESC";
				$result = mysqli_query($this->db,$query);
				if(!$result) {
					exit(mysqli_error($this->db));
				}
				
				$row = array();
				for($i = 0; $i < mysqli_num_rows($result);$i++) {
					$row[] = mysqli_fetch_array($result);
						
				}
				return $row;
	}
	
	public function get_menu($id_menu) {
		$query = "SELECT id_menu,name_menu,text_menu FROM menu WHERE id_menu='$id_menu'";
				$result = mysqli_query($this->db,$query);
				if(!$result) {
					exit(mysqli_error($this->db));
				}
				$row = mysqli_fetch_array($result);
			return $row;	
	}
	
	
}
?>