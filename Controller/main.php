<?php
class main extends ACore {
	
	public function get_content() {
		
		$result = $this->m->get_main_content();
		return $result;
	
	}
}
?>