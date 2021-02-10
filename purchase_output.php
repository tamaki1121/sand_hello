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
	if (!empty($_SESSION['customer']) && !empty($_SESSION['product'])) {
		if (isset($_POST['token']) && !empty($_SESSION['token'])) {
			if ($_POST['token'] == $_SESSION['token']) {
				$_SESSION['token'] = NULL;
				$id = $_SESSION['customer']['id'];
				$pdo;
				require 'db_connect.php';
				$sql = "INSERT INTO purchase(customer_id) VALUE(:customer_id); SELECT LAST_INSERT_ID();";
				$stm = $pdo->prepare($sql);
				$stm->bindValue(':customer_id', $id, PDO::PARAM_INT);
				$result = $stm->execute();
				var_dump($result);
			} else {
				echo "不正なトークンです";
				echo "購入ページからアクセスしてください。<br/>";
			}
		} else {
			echo "購入ページからアクセスしてください。<br/>";
		}
	} else {
		if (empty($_SESSION['customer'])) echo "ログインしてください。<br/>";
		if (empty($_SESSION['product'])) echo "カートに所品がありません<br/>";
	} ?>

</body>

</html>