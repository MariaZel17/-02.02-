<?php
	require_once "session.php";
	if($_SESSION["login"] != "") {
		header("Location: /");
	}
	
	require_once "mysqli.php";
		
	if(!empty($_POST)) {
		if( !db_connect() ) {
			
			$fio = htmlentities(mysqli_real_escape_string($conn, $_POST["fio"]));
			$user = htmlentities(mysqli_real_escape_string($conn, $_POST["login"]));
			$password = htmlentities(mysqli_real_escape_string($conn, $_POST["password"]));
			$repeatpassword = htmlentities(mysqli_real_escape_string($conn, $_POST["repeatpassword"]));
			
			if (!empty($user)){
				if (!db_check_usr($user)){ // <- Проверка на повторяющиеся логины
					if (strcmp($password, $repeatpassword) === 0){
						if(!empty($password) || !empty($repeatpassword)){
							
							// добавление пользлвателя
							add_usr($fio, $user, $password);
							$smsg = 1;
							// указываем в заголовочном файле перенправление на главную страницу через 2 секунды
							header("Refresh: 2; url=sign-up.php");
							
						} else
							$error =  "Пароль не может быть пустым";
							$no = 1;
					}else
						$error =  "Пароли не совпадают";
						$no = 1;
						
				}else 
					$error =  "Пользователь с таким именем уже существует";
					$no = 1;
			}else
				$error =  "Логин не может быть пустым";
				$no = 1;
			
			// закрываем соединение
			db_close();
			
		} else 
			$error = "Ошибка подключения";
	}
			if(isset($smsg))
			echo <<<_OUT
				<div id="msg-ok" class="ok">
					<p>Вы успешно зарегистрировались</p>
					<div class="closed" onclick="msgClose('msg-ok')">&#10006;</div>
				</div>
_OUT;
			if(isset($no))
			echo <<<_OUT
					<div id="msg-error" class="error">						
						$error
						<div class="closed" onclick="msgClose('msg-error')">&#10006;</div>
					</div>
			
_OUT;
?>
<!DOCTYPE html>
<html>

<head>
<meta charset="utf-8">
<style>
fieldset{
font-size:26px;
background-color:white;
width: 600px;
position:relative;
margin: 40px auto;
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
	height:200px;
	width: 200px;
	right: 50px;
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
.id{
	position: absolute;
	width: 397px;
	height: 67px;

	background: #C1D6FF;
	box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);
	border-radius: 50px;

}
</style>
<script>
	"use strict";

	//удаление сообщения с экрана пользователя по нажатию на крестик в сообщении
	function msgClose(id) {
	
	var msg = document.getElementById(id);
	var my_parent = msg.parentElement;
	
	my_parent.removeChild(msg);
	
	
	}
</script>
</head>

<body >	
	<main>
	<form action="index.php" target="_blank">
    <button >Главная</button>
    </form>
		<form id="reg" method="post">
			<fieldset>
				<legend>Регистрация</legend>
				
				<input id="1" type="fio" name="fio" placeholder="Введите ФИО" required><br>
				<input id="1" type="login" name="login" placeholder="Введите логин" required><br>
				<input id="1" type="password" name="password" placeholder="Пароль" required><br>
				<input id="1" type="password" name="repeatpassword" placeholder="Повторите пароль" required><br>
				<input id="1" type="submit" value="Зарегистрироваться">
				<img src="ava.jpg">
			</fieldset>
		</form>
	
		
	</main>
	

</body>

</html>