<?php session_start(); ?>

<!DOCTYPE html>
<html>

<head>
	<meta charset="UTF-8">
	<title>会員登録画面</title>
	<link rel="stylesheet" href="style.css">
</head>

<body>
	<?php require 'menu.php'; ?>
	<form action="customer_output.php" method="POST">
		<p>名前 : <input type="text" name="name"></p>
		<p>住所 : <input type="text" name="address"></p>
		<p>ログインID : <input type="text" name="login"></p>
		<p>パスワード : <input type="text" name="password"></p>
		<p><input type="submit" value="登録"></p>

	</form>
</body>

</html>