<?php
abstract class ACore {
	
	
	protected $m;
	
	public function __construct() {
		$this->m = new model();;
	}
	
	protected function get_header() {
		return TRUE;
	}
	
	protected function get_left_bar() {
		$result = $this->m->get_left_bar();
		return $result;	
	}
	
	protected function get_menu() {
		$row = $this->m->menu_array();
		return $row;		
	}
	
	
	protected function get_footer() {
		$row = $this->m->menu_array();
		return $row;
	}
	
	
	public function get_body($tpl) {
		$this->get_header();
		$left_bar = $this->get_left_bar();
		$menu_top = $this->get_menu();
		$content = $this->get_content();
		$footer = $this->get_footer();
		//$tpl - template
		include "tpl/index.php";
	}
	
	abstract function get_content();
	
}

?>