<?php
	$id = $_GET['product'];
	
	$host = "localhost";
	$clogin = "root";
	$cpasswd = "";
	$db = "z_db";
	global $conn;
	$conn = mysqli_connect($host, $clogin, $cpassword, $db);
		
	$sel = "SELECT * FROM product WHERE id='$id'";
		
	$res = mysqli_query($conn, $sel);
		
	while($row = mysqli_fetch_assoc($res))
	{
		$name = $row['name_p'];
		$categ = $row['category'];
		$price = $row['price'];
		$description = $row['description']; 
		$availability = $row['availability'];
		$img = $row['img'];
	}	
	
	$sel2 = "SELECT * FROM characteristic WHERE id='$id'";
		
	$res2 = mysqli_query($conn, $sel2);
		
	while($row2 = mysqli_fetch_assoc($res2))
	{
		$memory = $row2['memory'];
		$screen = $row2['screen'];
		$camera = $row2['camera'];
		$battery_capacity = $row2['battery_capacity']; 
	}	
		
	if(!empty($_POST))
	{
		$name_p = $_POST['name'];
		$type = $_POST['type'];
		$price = $_POST['price'];
		$description = $_POST['description'];
		$img = $_POST['img'];
		$colvo = $_POST['colvo'];
		$upd = "UPDATE product SET name_p = '$name_p', category = '$type', price = $price, img = '$img', description = '$description', availability = $colvo WHERE id='$id'";
		$updquery = mysqli_query($conn, $upd);
		
		$memory = $_POST['memory'];
		$screen = $_POST['display'];
		$accum = $_POST['accum'];
		$camera = $_POST['camera'];
		$upd2 = "UPDATE characteristic SET memory = '$memory', screen = '$screen', camera = '$camera', battery_capacity = '$accum' WHERE id='$id'";
		$updquery = mysqli_query($conn, $upd2);
		header("Refresh:3; url=up_del.php");
		echo <<<_OUT
				<div id="msg-ok" class="ok">
					<p>Товар обновлён</p>
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
				<legend>Изменение информации о товаре</legend>				
				<input id="1" type="name" name="name" placeholder="Наименование" value="<?php echo $name;?>" required><br>
				<?php
				//categori();
				//$result_select = categori();
				
				/*<p><select size="1">
				<option disabled>Выберите товар</option>
				<?php while($object = mysql_fetch_object($result_select)):?>
				<option value ="<?=$object->name?>"><?=$object->name?></option>
				<?php endwhile;?>
			    </select></p>*/
				
				
				?>
				
				<select id="selectID" name="type" value="<?php echo $categ;?>">
					<option value="Смартфон">Смартфон</option>
					<option value="Планшет">Планшет</option>
					<option value="Часы">Часы</option>
				</select><br>
   
   
   
				
				<input id="1" type="text" name="price" placeholder="Цена" value="<?php echo $price;?>" required><br>
				<textarea name="description" value="<?php echo $description;?>" placeholder="Описание">
				</textarea >
				<input class=foto type="file" name="img" value="<?php echo $img;?>" accept="image/jpeg,image/png"><br>
				<p>Характеристики</p>
				<input id="1" type="text" name="memory" placeholder="Память" value="<?php echo $memory;?>" required>
				<input id="1" type="text" name="display" placeholder="Дисплей" value="<?php echo $screen;?>" required><br>
				<input id="1" type="text" name="accum" placeholder="Аккумулятор" value="<?php echo $camera;?>" required>
				<input id="1" type="text" name="camera" placeholder="Камера" value="<?php echo $battery_capacity;?>" required><br>
				<input id="1" type="text" name="colvo" placeholder="Наличие" value="<?php echo $availability;?>" required><br>
				
				<input id="1" type="submit" value="Изменить информацию">
			</fieldset>
		</form>
	
		
	</main>
	

</body>

</html>