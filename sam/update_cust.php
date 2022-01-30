<?php
	require_once "session.php";
	
	require_once "mysqli.php";
	
	$id = $_GET['product'];
	
	$host = "localhost";
	$login = "root";
	$passwd = "";
	$db = "z_db";
	global $conn;
	$conn = mysqli_connect($host, $login, $password, $db);
		
	$sel = "SELECT * FROM customer WHERE id='$id'";
		
	$res = mysqli_query($conn, $sel);
		
	while($row = mysqli_fetch_assoc($res))
	{
		$type_cus = $row['type_cus'];
		$name_cus = $row['name_cus'];
		$adres = $row['adres'];
		$phone = $row['phone'];
	}	
	
	if(!empty($_POST))
	{
		$type = $_POST["type"];
		$name = $_POST["name"];
		$adres = $_POST["adres"];
		$phone = $_POST["phone"];
			
		$query = "UPDATE customer SET type_cus = '$type', name_cus = '$name', adres = '$adres', phone = '$phone' WHERE id='$id'";
		$updquery = mysqli_query($conn, $query);
		header("Refresh:2; url=up_del.php");
		echo <<<_OUT
				<div id="msg-ok" class="ok">
					<p>Пользователь обновлён</p>
					<div class="closed" onclick="msgClose('msg-ok')">&#10006;</div>
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
				<legend>Изменение информации о заказчике</legend>
				<select id="selectID" name="type" value="<?php echo $type_cus;?>">
					<option value="Физическое лицо">Физическое лицо</option>
					<option value="Юридическое лицо">Юридическое лицо</option>
				</select><br>
				
				<input id="1" type="name" name="name" placeholder="Наименование" value="<?php echo $name_cus;?>" required><br>
				
				<input id="1" type="login" name="adres" placeholder="Адрес" value="<?php echo $adres;?>" required><br>
				<input id="1" type="name" name="phone" maxlength=11 placeholder="Телефон" value="<?php echo $phone;?>" required><br>
				<input id="1" type="submit" value="Изменить данные">
			</fieldset>
		</form>
	
		
	</main>
</body>

</html>