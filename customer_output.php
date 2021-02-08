<?php session_start(); ?>
<!DOCTYPE html>
<html>

<head>
	<meta charset="UTF-8">
	<title>会員登録画面</title>
	<link rel="stylesheet" href="style.css">
</head>

<body>

	<?php
	require 'menu.php';
	$name = isset($_POST["name"]) ? htmlspecialchars($_POST["name"]) : false;
	$address = isset($_POST["address"]) ? htmlspecialchars($_POST["address"]) : false;
	$login = isset($_POST["login"]) ? htmlspecialchars($_POST["login"]) : false;
	$pass = isset($_POST["password"]) ? htmlspecialchars($_POST["password"]) : false;
	if ($name !== false && $address !== false && $login !== false && $pass !== false) {
		$pdo;
		require 'db_connect.php';
		try {
			$sql = "INSERT INTO CUSTOMER (NAME, ADDRESS, LOGIN, PASSWORD) VALUE (:name, :address, :login, :password)";
			$stmt = $pdo->prepare($sql);
			$stmt->bindValue(':name', $name, PDO::PARAM_STR);
			$stmt->bindValue(':address', $address, PDO::PARAM_STR);
			$stmt->bindValue(':login', $login, PDO::PARAM_STR);
			$stmt->bindValue(':password', $pass, PDO::PARAM_STR);
			$result = $stmt->execute();
			if ($result === true) {
				print("登録に成功しました" . "<br/>");
			} else {
				print("登録に失敗しました" . "<br/>");
			}
		} catch (Exception $e) {
			print("error" . "<br/>");
			print $e->getMessage() . "<br/>";
			exit();
		}
		$pdo = NULL;
	}
	// $dbUser = "kadai";
	// $dbPass = "kadai";
	// $dbName = "kadai";
	// $host = "localhost";
	// $dsn = "mysql:host={$host};dbname={$dbName};charset=utf8";

	// $name = isset($_POST["name"]) ? htmlspecialchars($_POST["name"]) : false;
	// $address = isset($_POST["address"]) ? htmlspecialchars($_POST["address"]) : false;
	// $login = isset($_POST["login"]) ? htmlspecialchars($_POST["login"]) : false;
	// $password = isset($_POST["password"]) ? htmlspecialchars($_POST["password"]) : false;
	// if ($name !== false && $address !== false && $login !== false && $password !== false) {
	// 	$pdo;
	// 	try {
	// 		$pdo = new PDO($dsn, $dbUser, $dbPass);
	// 		$pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
	// 		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	// 		echo "接続{$dbName}";
	// 		$sql = "INSERT INTO CUSTOMER (NAME, ADDRESS, LOGIN, PASSWORD) VALUE (:name, :address, :login, :password)";
	// 		$stmt = $pdo->prepare($sql);
	// 		$params = array(
	// 			':name' => "{$name}",
	// 			':address' => "{$address}",
	// 			':login' => "{$login}",
	// 			':password' => "{$password}"
	// 		);
	// 		$result = $stmt->execute($params);
	// 	} catch (Exception $e) {
	// 		echo "error";
	// 		echo $e->getMessage();
	// 		exit();
	// 	}
	// 	$pdo = NULL;
	// }

	?>


</body>

</html>