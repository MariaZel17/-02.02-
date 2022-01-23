<?php
	require_once "session.php";

	$status = $_SESSION["status"];
	
	//$lenTrash = count($_SESSION["trash"]);
	//$trash = $lenTrash != 0 ? "Корзина - $lenTrash товар" : "Корзина";
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
<body >
	
		<?php 
		require_once "session.php";
			
		$status = $_SESSION["status"];		
		//var_dump($status);
			switch($status): 
			case "admin" : 
			<input type="button" name="login" value="Добавление" ><br>
			<input type="button" name="login" value="Редактирование" ><br>
			<input type="button" name="login" value="Удаление" ><br>
		 case "user": 
			<input type="button" name="login" value="Товары" ><br>
		 endswitch; ?>
	
</body>
</html>