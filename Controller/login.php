<?php

class login extends ACore{
	
	protected function obr() {
		$login = strip_tags(mysqli_real_escape_string(ACore::$m,$_POST['login']));
		$password = strip_tags(mysqli_real_escape_string(ACore::$m,$_POST['password']));

		if(!empty($login) AND !empty($password)) {
			$password = md5($password);
			$query = "SELECT id FROM users WHERE login='$login' AND pass = '$password'";
			
			if(!$result = mysqli_query(ACore::$m,$query)) {
				exit(mysqli_error(ACore::$m));
			}
			
			if(mysqli_num_rows($result) == 1) {
				$_SESSION['user'] = 'REG';
				header("Location:?option=admin");
				exit;
			}
			else {
				exit("Таого пользователя нет");
			}
		}
		else {
			exit("Заолните обязательные поля");
		}
	}
	
	public function get_content() {
		echo "<div id='main'>";
		
print <<<ECHO
<form action='' method='POST'>
<p>Login:<br />
<input type='text' name='login'>
</p>
<p>Password:<br />
<input type='password' name='password'>
</p>
<p>
<p><input type='submit' name='button' value='Войти'></p></form>
ECHO;
		echo "</div></div>";		
	}
}
?>