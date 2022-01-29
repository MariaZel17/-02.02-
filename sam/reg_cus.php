<?php
	require_once "session.php";
	if($_SESSION["login"] != "") {

	}
	
	require_once "mysqli.php";
		
	if(!empty($_POST)) {
		if( !db_connect() ) {
			$type = htmlentities(mysqli_real_escape_string($conn, $_POST["type"]));
			$name = htmlentities(mysqli_real_escape_string($conn, $_POST["name"]));
			$adres = htmlentities(mysqli_real_escape_string($conn, $_POST["adres"]));
			$phone = htmlentities(mysqli_real_escape_string($conn, $_POST["phone"]));
			
			
			if (!empty($name)){
				if (!db_check_cust($name)){ // <- Проверка на повторяющиеся логины
					
							// добавление пользлвателя
							add_cust($type, $name, $adres, $phone);
							$smsg = 1;
							// указываем в заголовочном файле перенправление на главную страницу через 2 секунды
							header("Refresh: 2; url=menu.php");										
				}else{ 
					$error =  "Пользователь с таким именем уже существует";
				$no = 1;}
			}else{
				$error =  "Логин не может быть пустым";
			$no = 1;}
			
			// закрываем соединение
			db_close();
			
		} else {
		$error = "Ошибка подключения";}
	}
			if(isset($smsg))
			echo <<<_OUT
				<div id="msg-ok" class="ok">
					<p>Вы успешно зарегистрировались</p>
					<div class="closed" onclick="msgClose('msg-ok')">&#10006;</div>
				</div>
_OUT;
			if($no == 1)
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
	height:200px;
	width: 200px;
	right: 50px;
	top:20px;
}
.ok{
	height:60px;
	background-color:green;
	color: white;
	text-align:center;
}
.error{
	height:60px;
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
input{
	position: relative;
	width: 350px;
	height: 50px;
	margin: 10px;
	background: #b1dcfc;
	box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);
	border-radius: 50px;

}
a{
	text-decoration:none;
	color:black;
}
button{
	position: relative;
	width: 100px;
	height: 30px;
	margin: 10px;
	background: #b1dcfc;
	box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);
	border-radius: 50px;
}
select{
	position: relative;
	width: 350px;
	height: 50px;
	margin: 10px;
	background: #b1dcfc;
	box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);
	border-radius: 50px;
	font-size:24px;
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
    <button onclick="document.location='menu.php'">Меню</a></button>
    </form>
		<form id="reg" method="post">
			<fieldset>
				<legend>Регистрация заказчика</legend>
				<select id="selectID" name="type">
					<option value="Физическое лицо">Физическое лицо</option>
					<option value="Юридическое лицо">Юридическое лицо</option>
				</select><br>
				
				<input id="1" type="name" name="name" placeholder="Наименование" required><br>
				
				<input id="1" type="login" name="adres" placeholder="Адрес" required><br>
				<input id="1" type="name" name="phone" maxlength=11 placeholder="Телефон" required><br>
				<input id="1" type="submit" value="Зарегистрировать">
			</fieldset>
		</form>
	
		
	</main>
	

</body>

</html>
