<?php
	$id = $_GET['customer'];
	
	header("Refresh:3; url=up_del.php");
	printf("<p>%d</p>", $id);
	
	printf("<form>");
	printf("Заказчик удален");
	printf("</form>");
		
	if(!empty($_GET))
	{
		$host = "localhost";
		$login = "root";
		$passwd = "";
		$db = "z_db";
		global $conn;
		$conn = mysqli_connect($host, $login, $password, $db);
			
		$del = "DELETE FROM customer WHERE id = '$id'";
			
		$query = mysqli_query($conn, $del);
			
	}
?>
<!DOCTYPE html>
<head>
	<meta charset = "utf-8">
	<style>
body{
	font-size:26px;
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

</style>
</head>
<body>
<button onclick="document.location='up_del.php'">Назад</a></button>
</body>