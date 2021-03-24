<?php
class update_statti extends ACore_Admin {
	
	protected function obr() {
		
		if(!empty($_FILES['img_src']['tmp_name'])) {
			if(!move_uploaded_file($_FILES['img_src']['tmp_name'],'file/'.$_FILES['img_src']['name'])) {
				exit("Не удалось загрузить изображение");
			}
			$img_src = 'file/'.$_FILES['img_src']['name'];
		}
		
		$id = $_POST['id'];
		$title = $_POST['title'];
		$date = date("Y-m-d",time());
		$discription= $_POST['discription'];
		$text = $_POST['text'];
		$cat = $_POST['cat'];
		
		if(empty($title) || empty($text) || empty($discription)) {
			exit("Не заполнены обязательные поля");
		}
		
		$query = "UPDATE  statti SET title='$title',img_src='$img_src',date='$date',text='$text',discription='$discription',cat='$cat' WHERE id='$id'";
		if(!mysql_query($query)) {
			exit(mysql_error());
		}
		else {
			$_SESSION['res'] = "Изменения сохранены";
			header("Location:?option=admin");
			exit;
		}			
	}
	
	public function get_content() {
	
		if($_GET['id_text']) {
			$id_text = (int)$_GET['id_text'];
		}
		else {
			exit('НЕ правильные данные для этой страницы');
		}
		
		$text = $this->get_text_statti($id_text);
		echo "<div id='main'>";
		if($_SESSION['res']) {
			echo $_SESSION['res'];
			unset($_SESSION['res']);
		}
		$cat = $this->get_categories();
print <<<HEREDOC
<form enctype='multipart/form-data' action='' method='POST'>
<p>Заголовок статьи:<br />
<input type='text' name='title' style='width:420px;' value='$text[title]'>
<input type='hidden' name='id' style='width:420px;' value='$text[id]'>
</p>
<p>Изображение:<br />
<input type='file' name='img_src'>
</p>
<p>Краткое описание:<br />
<textarea name='discription' cols='50' rows='7'>$text[discription]</textarea>
</p>
<p>Текст:<br />
<textarea name='text' cols='50' rows='7'>$text[text]</textarea>
</p>
<select name='cat'>
HEREDOC;
foreach($cat as $item) {
	if($text['cat'] == $item['id_category']) {
		echo "<option selected value='".$item['id_category']."'>".$item['name_category']."</option>";
	}
	else {
		echo "<option value='".$item['id_category']."'>".$item['name_category']."</option>";
	}
	
}
echo "</select><p><input type='submit' name='button' value='Сохранить'></p></form></div>
			</div>";
	}
}
?>