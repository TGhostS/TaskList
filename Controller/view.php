<?php
class view extends ACore {
	
	public function get_content() {
		
		echo '<div id="main">';
		
		if(!$_GET['id_text']) {
			echo 'Не правильные данные для вывода статьи';
		}
		else {
			$id_text = (int)$_GET['id_text'];
			if(!$id_text) {
				echo 'Не правильные данные для вывода статьи';
			}
			else {
				$query = "SELECT title,text,date,id,img_src FROM statti WHERE id='$id_text'";
				$result = mysqli_query(ACore::$m,$query);
				if(!$result) {
					exit(mysqli_error(ACore::$m));
				}
				$row = mysqli_fetch_array($result);
				printf("<p style='font-size:18px'>%s</p>
						<p>%s</p>
						<p><img style='margin-right:5px' width='150px' align='left' src='%s'>%s</p>"
						,$row['title'],$row['date'],$row['img_src'],$row['text']);
			}
		}
		echo '</div>
			</div>';
	}
}
?>