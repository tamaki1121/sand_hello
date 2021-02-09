<?php session_start(); ?>
<!DOCTYPE html>
<html>

<head>
	<meta charset="UTF-8">
	<title>購入画面</title>
	<link rel="stylesheet" href="style.css">
</head>

<body>
	<?php require 'menu.php'; ?>
	<?php
	$pdo;
	require 'db_connect.php';
	?>
	<?php
	if (!empty($_SESSION['customer']) && !empty($_SESSION['product'])) {
		if (isset($_POST['token']) && !empty($_SESSION['token'])) {
			if ($_POST['token'] == $_SESSION['token']) {
				$_SESSION['token'] = NULL;
				echo "処理をします";
			} else {
				echo $_SESSION['token'] . "不正なトークンです";
				echo $_POST['token'] . "購入ページからアクセスしてください。<br/>";
			}
		} else {
			echo "購入ページからアクセスしてください。<br/>";
		}
	} else {
		if (empty($_SESSION['customer'])) echo "ログインしてください。<br/>";
		if (empty($_SESSION['product'])) echo "ログインしてください。<br/>";
	} ?>

</body>

</html>