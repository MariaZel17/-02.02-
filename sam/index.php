<?php
	require_once "session.php";
	require_once "mysqli.php";

	//проверка пользователя
	if(!empty($_POST))
		if( !db_connect() ) {
			
			$usr= htmlentities(mysqli_real_escape_string($conn,$_POST["login"]));
			$passwd = htmlentities(mysqli_real_escape_string($conn,$_POST["password"]));
			
			
			if (!empty($usr))
				if (!db_login($usr, $passwd)) {
						
						
						$usr1 = $usr;
						$_SESSION["login"] = $usr; //сохраняем имя пользователя
						$_SESSION["status"] = get_login_status($usr); //права пользователя								
						$smsg = 1;
						$ok = "Welcome!!";						
						header("Refresh: 2; url=menu.php");
						echo <<<_OUT
						<div id="msg-ok" class="ok">
							$ok
							<div class="closed" onclick="msgClose('msg-ok')">&#10006;</div>
						</div>
_OUT;
				} else {
					$error = "Не правильный логин или пароль";
					echo <<<_OUT
					<div id="msg-error" class="error">						
						$error
						<div class="closed" onclick="msgClose('msg-error')">&#10006;</div>
					</div>
				
_OUT;
				}
			else {
			$error = "Логин не может быть пустым";
				echo <<<_OUT
				<div id="msg-error" class="error">						
					$error
					<div class="closed" onclick="msgClose('msg-error')">&#10006;</div>
				</div>
			
_OUT;
			}
			// закрываем соединение
			db_close();			
		} 
		else{ 
			$error = "Ошибка подключения";
			echo <<<_OUT
				<div id="msg-error" class="error">						
					$error
					<div class="closed" onclick="msgClose('msg-error')">&#10006;</div>
				</div>
			
_OUT;
		}	
?>
<!DOCTYPE html>
<html>

<head>
<meta charset="utf-8">
<style>
fieldset{
	font-size:26px;
	background-color:white;
	width: 900px;
	position:relative;
	margin: 40px auto;
	text-align:center;
}
input{
	font-size:20px;
	margin: 10px;	
}
.ava{
	position: absolute;
}
fieldset img{
	position: absolute;
	height:270px;
	width: 270px;
	right: 100px;
	top:20px;
}
.ok{
	height:50px;
	background-color:green;
	color: white;
	text-align:center;
}
.error{
	height:50px;
	background-color:red;
	color: white;
	text-align:center;
}
input{
	position: relative;
	width: 350px;
	height: 50px;
	margin: 20px;
	background: #b1dcfc;
	box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);
	border-radius: 50px;

}
a{
	text-decoration:none;	
}
img{
	width: 550px;
	position:relative;
	margin: 0px 35%;
}
</style>	
<script>
"use strict";

//удаление сообщения с экрана пользователя по нажатию на крестик в сообщении
function msgClose(id) {
	
	var msg = document.getElementById(id);
	var my_parent = msg.parentElement;
	
	my_parent.removeChild(msg);
	
	//<a href="reg.php">Зарегистрироваться</a><br>
}
</script>
</head>

<body>
	
	<main>
		<img src="img/logo.jpg"></br>
		<form id="sign-up" method="POST">
		<fieldset>
				<legend>Авторизация</legend>
				<input type="login" name="login" placeholder="Логин" required><br>
				<input type="password" name="password" placeholder="Пароль" required><br>
				
				<input type="submit" name="sign-up-submit" value="Вход"><br>
			</fieldset>
		</form>
		
	</main>

</body>

</html>