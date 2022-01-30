<?php
	require_once "session.php";
	if($_SESSION["login"] != "") {

	}
	
	require_once "mysqli.php";
		
	if(!empty($_POST)) {
		if( !db_connect() ) {
			$name = htmlentities(mysqli_real_escape_string($conn, $_POST["name"]));		//значения для добавления товара
			$category = htmlentities(mysqli_real_escape_string($conn, $_POST["type"]));			
			$price = htmlentities(mysqli_real_escape_string($conn, $_POST["price"]));
			$description = htmlentities(mysqli_real_escape_string($conn, $_POST["description"]));
			var_dump($description);
			$availability = htmlentities(mysqli_real_escape_string($conn, $_POST["colvo"]));
			
			if ( is_uploaded_file($_FILES["img"]["tmp_name"])) {
						$tmpPath = $_FILES["img"]["tmp_name"];// путь к файлу
						$toBuffer = file_get_contents($tmpPath); // открываем весь файл полностью 
						$type = mime_content_type($tmpPath); // MIME тип файла
						// чтобы картинка в последствии отображалась в начале надо дописать следующее
						$img = "data:$type;base64," . base64_encode($toBuffer); // кодируем
						
						//echo "<img src='$img'>";
					} 
					
			add_product($name, $category, $price, $img, $description, $availability); //добавление товара
			
			$memory = htmlentities(mysqli_real_escape_string($conn, $_POST["memory"]));		//значения для добавления характеристик товара
			$screen = htmlentities(mysqli_real_escape_string($conn, $_POST["display"]));
			$camera = htmlentities(mysqli_real_escape_string($conn, $_POST["camera"]));
			$battery_capacity = htmlentities(mysqli_real_escape_string($conn, $_POST["accum"]));
			
			add_product_char($memory, $screen, $camera, $battery_capacity); //добавление характеристик товара
			
			if (!empty($name)){
				if (!db_check_usr($name)){ // <- Проверка на повторяющиеся логины
					
							// добавление пользлвателя
							add_cust($type, $name, $adres, $phone);
							$smsg = 1;
							// указываем в заголовочном файле перенправление на главную страницу через 2 секунды
							//header("Refresh: 2; url=index.php");										
				}else{ 
					$error =  "Пользователь с таким именем уже существует";
				$no = 1;}
			}else{
				$error =  "Логин не может быть пустым";
			$no = 1;}
			
			// закрываем соединение
			db_close();
			
		} else 
			$error = "Ошибка подключения";
	}
			if(isset($smsg))
			echo <<<_OUT
				<div id="msg-ok" class="ok">
					<p>Товар добавлен</p>
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
    <button onclick="document.location='menu.php'">Меню</a></button>
    </form>
		<form id="reg" method="post">
			<fieldset>
				<legend>Добавление товара</legend>				
				<input id="1" type="name" name="name" placeholder="Наименование" required><br>
				<?php
				categori();
				//$result_select = categori();
				
				/*<p><select size="1">
				<option disabled>Выберите товар</option>
				<?php while($object = mysql_fetch_object($result_select)):?>
				<option value ="<?=$object->name?>"><?=$object->name?></option>
				<?php endwhile;?>
			    </select></p>*/
				
				
				?>
				
				<select id="selectID" name="type">
					<option value="Смартфон">Смартфон</option>
					<option value="Планшет">Планшет</option>
					<option value="Часы">Часы</option>
				</select><br>
   
   
   
				
				<input id="1" type="price" name="price" placeholder="Цена" required><br>
				<textarea name="description" placeholder="Описание">
				</textarea >
				<input class=foto type="file" name="img" accept="image/jpeg,image/png"><br>
				<p>Характеристики</p>
				<input id="1" type="text" name="memory" placeholder="Память" required>
				<input id="1" type="text" name="display" placeholder="Дисплей" required><br>
				<input id="1" type="text" name="accum" placeholder="Аккумулятор" required>
				<input id="1" type="text" name="camera" placeholder="Камера" required><br>
				<input id="1" type="text" name="colvo" placeholder="Наличие" required><br>
				
				<input id="1" type="submit" value="Добавить товар">
			</fieldset>
		</form>
	
		
	</main>
	

</body>

</html>