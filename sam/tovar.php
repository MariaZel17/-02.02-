<?php
	require_once "session.php";
	require_once "mysqli.php";	
?>
<!DOCTYPE html>
<html>

<head>
	<meta charset = "utf-8">
</head>

<body>
<button onclick="document.location='menu.php'">Назад</a></button>
	<?php	
		$host = "localhost";
		$login = "root";
		$passwd = "";
		$db = "z_db";
		global $conn;
		$conn = mysqli_connect($host, $login, $password, $db);
		$sel = mysqli_query($conn, "SELECT * FROM product ");
		
		while($row = mysqli_fetch_assoc($sel))
		{
			$cat = $row['category'];
			$name = $row['name_p'];
			$img = $row['img'];
			$descr = $row['decsription'];
			$pr = $row['price']
			$article =<<<_OUT
						<fieldset id="$id">
							<p>$cat $name </p>
							<div class="wrap">
								<figure>
									<img src="$img">
								</figure>
							
							<p class="description">$descr</p>
							</div>
							<div class="price">$pr</div>
							<a href="viewer.php?product=$id" class="btn">Посмотреть</a>
						</fieldset>
_OUT;
			printf("<tr><td>%d</td><td>%s</td><td>%s</td><td>%s</td><td>%d</td><td><a href = %s>Изменить</a></td><td><a href =  %s>Удалить</a></td></tr>", $row['id'], $row['category'], $row['name_p'], $row['availability'],$row['price'], $url1, $url);
			echo $article;
		}	
?>
	

</body>

</html>