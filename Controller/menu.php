<?php
class menu extends ACore {
	
	public function get_content() {
		
		
		if(!$_GET['id_menu']) {
			echo 'Не правильные данные для вывода меню';
		}
		else {
			$id_menu = (int)$_GET['id_menu'];
			if(!$id_menu) {
				echo 'Не правильные данные для вывода меню';
			}
			else {
				$row = $this->m->get_menu($id_menu);
				return $row;
			}
		}
	}
	

}
?>