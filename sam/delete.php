<?php
	$id = $_GET['product'];
	
	header("Refresh:2; url=up_del.php");
	printf("<p>%d</p>", $id);
	
	printf("<form>");
	printf("Пользователь удален");
	printf("</form>");
		
	if(!empty($_GET))
	{
		$host = "localhost";
		$login = "root";
		$passwd = "";
		$db = "z_db";
		global $conn;
		$conn = mysqli_connect($host, $login, $password, $db);
			
		$del = "DELETE FROM product WHERE id = '$id'";
			
		$query = mysqli_query($conn, $del);
		
		$del2 = "DELETE FROM customer WHERE id = '$id'";
			
		$query2 = mysqli_query($conn, $del2);
		

	}
?>
<!DOCTYPE html>
<head>
	<meta charset = "utf-8">
</head>
<body>
<button onclick="document.location='up_del.php'">Назад</a></button>
</body>