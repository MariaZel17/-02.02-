<meta charset = "utf-8">
<!DOCTYPE html>
<head>
	<meta charset = "utf-8">
	
<style >
body{
	font-size:26px;
	position:relative;
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
img{
	width: 550px;
	position:relative;
	margin: 0px 35%;
}
</style>
</head>
<body>

	<img src="img/logo.jpg"></br>
	<button onclick="document.location='menu.php'">Меню</a></button>
	
	

<?php	
		$host = "localhost";
		$login = "root";
		$passwd = "";
		$db = "z_db";
		global $conn;
		$conn = mysqli_connect($host, $login, $password, $db);
		$sel = mysqli_query($conn, "SELECT * FROM product ORDER BY id DESC LIMIT 20");
		
		printf("<form>");
		printf("<table id='tabl1' border = '2'>");
		printf("<tr><td>Категория</td><td>Наименование</td><td>Наличие</td><td>Цена</td></tr>");
		while($row = mysqli_fetch_assoc($sel))
		{
			$url = "delete.php?product=" .$row['id'];
			$url1 = "update.php?product=" .$row['id'];
			
			printf("<tr><td>%s</td><td>%s</td><td>%s</td><td>%d</td><td><a href = %s>Изменить</a></td><td><a href =  %s>Удалить</a></td></tr>", $row['category'], $row['name_p'], $row['availability'],$row['price'], $url1, $url);
		}	
?>
	<p>Товары</p>
	
	<?php	
		
		$sel2 = mysqli_query($conn, "SELECT * FROM login ORDER BY id DESC LIMIT 20");
		
		printf("<form>");
		printf("<table id='tabl1' border = '2'>");
		printf("<tr><td>ФИО</td><td>Логин</td><td>Статус</td></tr>");
		while($row2 = mysqli_fetch_assoc($sel2))
		{
			$url2 = "delete_log.php?product=" .$row2['id'];
			$url3 = "update_log.php?product=" .$row2['id'];
			
			printf("<tr><td>%s</td><td>%s</td><td>%s</td><td><a href = %s>Изменить</a></td><td><a href =  %s>Удалить</a></td></tr>", $row2['name'], $row2['login'], $row2['status'], $url3, $url2);
		}	
?>
	<p>Пользователи</p>
<?php	
		
		$sel3 = mysqli_query($conn, "SELECT * FROM customer ORDER BY id DESC LIMIT 20");
		
		printf("<form>");
		printf("<table id='tabl1' border = '2'>");
		printf("<tr><td>Тип заказчика</td><td>Наименование/ФИО</td><td>Адрес</td><td>Телефон</td></tr>");
		while($row3 = mysqli_fetch_assoc($sel3))
		{
			$url4 = "delete_cust.php?product=" .$row3['id'];
			$url5 = "update_cust.php?product=" .$row3['id'];
			
			printf("<tr><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td><a href = %s>Изменить</a></td><td><a href =  %s>Удалить</a></td></tr>", $row3['type_cus'], $row3['name_cus'], $row3['adres'], $row3['phone'], $url5, $url4);
		}	
?>
	<p>Заказчики</p>
</body>