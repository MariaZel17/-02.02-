<!DOCTYPE html>
<html>

<head>
<?php
	$status = $_SESSION["status"];
	//$lenTrash = count($_SESSION["trash"]);
	//$trash = $lenTrash != 0 ? "Корзина - $lenTrash товар" : "Корзина";
	//var_dump($status);
?>
<meta charset="utf-8">
<style>
.logo{
	top: 0;
	height: 70px;	
	margin: 0 auto;	
	padding: 0;
}

.logo:before{
	content:'';
	display: block;
	height: 70px;
	width: 100%;
	background-color: #1E90FF;
	position: absolute;
	left: 0;
	
}

.logo_img{
	height: 70px;
	margin: 0 auto;
	position: absolute;
	right: 45%;
	padding: 0;
	
}

nav {
	width: 960px;
	margin: 0 auto;
	font-size: 18px;

}

nav:before {
	content:'';
	display: block;
	height: 50px;
	width: 100%;
	background-color: #1E90FF;
	position: absolute;
	left: 0;
	z-index: -1;
	opacity: 90%;
}
ul {
	margin: 0;
	padding: 0;
	list-style: none;
	height: 50px;
}

ul li {
	float: left;
	
}

ul li a {
	color: #000;
	display: block;
	height: 50px;
	padding: 0 30px;
	text-decoration: none;
	line-height: 50px;
}

ul li a:hover {
	background-color: #b1dcfc;
	color: #000;

}

.panel {
	height: 30px;	
	margin: 0 auto;	
	padding: 0;
	font-size: 18px;
	
}

.panel:before {
	content:'';
	height: 30px;
	width: 100%;
	background-color: #000 ;
	position: absolute;
	left: 0;
	z-index: -1;
	
}


.panel_li{
	float: right;
}

.panel_a {
	color: #fff;
	display:block;
	height: 30px;
	padding: 0 30px;
	text-decoration: none;
	line-height: 30px;	
}
</style>


	<ul class="panel">
	
		
				<li class="panel_li"><a class="panel_a" href="create.php">Новый пользователь</a></li>
					<li class="panel_li"><a class="panel_a" href="delete.php">Удаление</a></li>
					<li class="panel_li"><a class="panel_a" href="add.php">Добавление</a></li>
					<li class="panel_li"><a class="panel_a" href="edit.php">Редактирование</a></li>
			
			
				<li class="panel_li"><a class="panel_a" href="trash.php" id="trash-menu-txt"><?=$trash?></a></li>
				<li class="panel_li"><a class="panel_a" href="include/logout.php">Выход</a></li>
			
			<?php switch($status): 
				 case "0": ?>
				 <?php case "1": ?><?php endswitch; ?>
	</ul>

</head>
</html>