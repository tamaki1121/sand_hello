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
		<p><label for="name">お名前 : </label><input type="text" name="name"></p>
		<p><label for="name">住所 : </label><input type="text" name="address"></p>
		<p><label for="name">ログイン名 : </label><input type="text" name="login"></p>
		<p><label for="name">パスワード: </label><input type="password" name="password"></p>
		<p><input type="submit" value="登録"></p>

	</form>
</body>

</html>