<?php
/*********************************************************/
/*                  Create register menu                 */
/*********************************************************/
include 'header.php';
?>
<title>Register</title>
<form action="index.php?controller=login&method=auth" method="POST" name="form-register">
Имя:
<p></p>
<input type="text" name="login">
<p></p>
Пароль:
<p></p>
<input type="password" name="password">
<p></p>
<input type="submit" name="btn_submit_register" value="Войти или зарегистрироваться">
</form>
