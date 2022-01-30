<?php
	require_once "session.php";
	
	require_once "mysqli.php";
	
	$id = $_GET['product'];
	
	$host = "localhost";
	$clogin = "root";
	$cpasswd = "";
	$db = "z_db";
	global $conn;
	$conn = mysqli_connect($host, $clogin, $cpassword, $db);
		
	$sel = "SELECT * FROM login WHERE id='$id'";
		
	$res = mysqli_query($conn, $sel);
		
	while($row = mysqli_fetch_assoc($res))
	{
		$name = $row['name'];
		$login = $row['login'];

	}	
	
	if(!empty($_POST))
	{
		$fio = $_POST["fio"];
		$user = $_POST["login"];
		$password = $_POST["password"];
		$repeatpassword = $_POST["repeatpassword"];
		$status = $_POST["radio"];
			
		
				if (strcmp($password, $repeatpassword) === 0){
					if(!empty($password) || !empty($repeatpassword)){
						$salt = get_salt();
						$password = hash("sha256", $password . $salt);
						$query = "UPDATE login SET name = '$fio', login = '$user', password = '$password', salt = '$salt', status = '$status' WHERE id='$id'";
						$updquery = mysqli_query($conn, $query);
						header("Refresh:2; url=up_del.php");
						echo <<<_OUT
								<div id="msg-ok" class="ok">
									<p>Пользователь обновлён</p>
									<div class="closed" onclick="msgClose('msg-ok')">&#10006;</div>
								</div>
_OUT;
						
					} else{
						$error =  "Пароль не может быть пустым";
					$no = 1;}
				}else{
					$error =  "Пароли не совпадают";
				$no = 1;
				
				echo <<<_OUT
				<div id="msg-error" class="error">						
					$error
					<div class="closed" onclick="msgClose('msg-error')">&#10006;</div>
				</div>
		
_OUT;
			}
		
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
textarea{
	position: relative;
	width: 550px;
	height: 250px;
	margin: 10px;
	background: #b1dcfc;
	box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);
	resize: none;
	text-align:left;
}
.foto{
	position: relative;
	width: 350px;
	height: auto;
	margin: 10px;
	border-radius: 0px;

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
	
	
	}
</script>
</head>

<body >	
	<main>
	<img src="img/logo.jpg"></br>
    <button onclick="document.location='up_del.php'">Назад</a></button>
    </form>
		<form id="reg" method="post">
			<fieldset>
				<legend>Изменение информации о пользователе</legend>
								
				<input id="1" type="fio" name="fio" placeholder="Введите ФИО" value="<?php echo $name;?>" required><br>
				<input id="1" type="login" name="login" placeholder="Введите логин" value="<?php echo $login;?>" required><br>
				<input class="ra2" type="radio" name="radio" value="admin"  /> администратор
				<input class="ra2" type="radio" name="radio" value="user" checked="checked" /> пользователь<br>
				<input id="1" type="password" name="password" placeholder="Пароль" required><br>
				<input id="1" type="password" name="repeatpassword" placeholder="Повторите пароль" required><br>
				<input id="1" type="submit" value="Изменить данные">
			</fieldset>
		</form>
		
		
	</main>
	

</body>

</html>