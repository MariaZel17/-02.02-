<?php

	$host = "localhost";
	$login = "root";	
	$password = "";
	$db = "z_db";	


	$conn = FALSE; 
	
	
	/* Подключение к БД */
	function db_connect($host = "localhost", $login = "root", $password = "", $db = "z_db") {
		global $conn;
		$err = false; // ошибок нет
		
		$conn = @mysqli_connect($host, $login, $password, $db);
		if($conn) 
			return $err;
		else {
			
			return $err = true; 
		}
	}
	
	/* Закрытие соединения */
	function db_close() {
		@mysqli_close($GLOBALS["conn"]);
	}
	
	/* Регистрация пользователя */
	function add_usr($fio, $login, $password, $status) {
		global $conn;
		$salt = get_salt();
		$password = hash("sha256", $password . $salt);
		
		$query = "INSERT INTO login VALUES(NULL, '$fio', '$login', '$password', '$salt', '$status')";
		mysqli_query($conn, $query, $db);
	}
	
	/* Регистрация заказчика */
	function add_cust($type, $name, $adres, $phone) {
		global $conn;
		
		$query = "INSERT INTO customer VALUES(NULL, '$type', '$name', '$adres', '$phone')";
		mysqli_query($conn, $query, $db);
	}
	
		
	// проверка пары логин/пароль
	function db_login($login, $password) {
		global $conn;
		$query = "SELECT * FROM login WHERE login = '$login'";
		
		$result = mysqli_query($conn, $query);
		if( mysqli_num_rows($result) != 0 ) {
			
			$row = mysqli_fetch_assoc($result);
			$password = hash("sha256", $password . $row["salt"]);
			
			return strcmp($password, $row["password"]);
		} else
			return TRUE;
	}
	
	
	
	//проверка на существование пользователя
	function db_check_usr($login) {
		global $conn;
		$query = "SELECT * FROM login WHERE login = '$login'";
		
		$result = mysqli_query($conn, $query);
		
		return mysqli_num_rows($result) != 0; // смотрим на количество строк результирующего запроса
	}
	
	//проверка на существование заказчика
	function db_check_cust($name) {
		global $conn;
		$query = "SELECT * FROM customer WHERE name = '$name'";
		
		$result = mysqli_query($conn, $query);
		
		return mysqli_num_rows($result) != 0; // смотрим на количество строк результирующего запроса
	}
	
	// уникальная соль
	function get_salt() {
		return md5(uniqid() . time . mt_rand());
	}
	
	//получаем статус пользователя
	function get_login_status($login) {
		global $conn;
		$query = "SELECT status FROM login WHERE login = '$login'";
				
		$result = mysqli_query($conn, $query);
		
		return mysqli_fetch_array($result)["status"];
	}
	
	//вывести список категорий товаров
	function categori(){
		global $conn;
		$sql = "SELECT name FROM category";
 
		$result = mysqli_query($conn,$sql);
		return $result;
	}
	
	//добавление товара в таблицу товара 
	function add_product($name, $category, $price, $img, $description, $availability) {
		global $conn;
		
		$query = "INSERT INTO product VALUES(NULL, '$name', '$category', $price, '$img', '$description', $availability)";
		mysqli_query($conn, $query, $db);
	}
	
	//добавление товара в таблицу товара 
	function add_product_char($memory, $screen, $camera, $battery_capacity) {
		global $conn;
		
		$query = "INSERT INTO characteristic VALUES(NULL, '$memory', '$screen', '$camera', '$battery_capacity')";
		mysqli_query($conn, $query, $db);
	}
	
?>