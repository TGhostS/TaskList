<?php
include 'header.php';
?>
<title>Register</title>
<form action="index.php" method="GET" name="form-register">
Имя:
<p></p>
<input type="text" name="login">
<p></p>
Пароль:
<p></p>
<input type="password" name="password">
<p></p>
<input type="hidden" name="controller" value="login"/>
<input type="hidden" name="method" value="auth"/>
<input type="submit" name="btn_submit_register" value="Войти или зарегистрироваться">
</form>
