<?php
	require_once "session.php";

	$status = $_SESSION["status"];
	
	//var_dump($status);
?>
<!DOCTYPE html>
<html>

<head>

<meta charset="utf-8">
<style>
fieldset{
	font-size:26px;
	width: 900px;
	position:relative;
	margin: 40px auto;
}
input{
	position: relative;
	width: 350px;
	height: 50px;
	margin: 10px auto;
	background: #b1dcfc;
	box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);
	border-radius: 50px;
	font-size:26px;
	tex-align: center;
}
</style>

</head>
<body>
	
		<?php 
		require_once "session.php";
			
		$status = $_SESSION["status"];		
		//var_dump($status);
			switch($status): 
			case "admin" : ?>
			<input type="button" onclick="document.location='reg.php'" name="login" value="Добавление пользователя" ><br>
			<input type="button" onclick="document.location='reg_cus.php'" name="login" value="Добавление заказчика" ><br>
			<input type="button" onclick="document.location='add_product.php'" name="login" value="Добавление товара" ><br>
			<input type="button" onclick="document.location='up_del.php'" name="login" value="Удаление и изменение" ><br>
		<?php  case "user": ?>
			<input type="button" onclick="document.location='tovar.php'" name="login" value="Товары" ><br>
			
		<?php  endswitch; ?>
	
</body>
</html>