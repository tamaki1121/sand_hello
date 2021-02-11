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
	if (empty($_SESSION['customer']) || empty($_SESSION['product'])) {
		if (empty($_SESSION['customer'])) echo "ログインしてください。<br/>";
		if (empty($_SESSION['product'])) echo "カートに所品がありません<br/>";
	} elseif (!isset($_POST['token']) || empty($_SESSION['token'])) {
		echo "購入ページからアクセスしてください。<br/>";
	} elseif ($_POST['token'] != $_SESSION['token']) {
		echo "不正なトークンです";
		echo "購入ページからアクセスしてください。<br/>";
	} else {
		unset($_SESSION['token']);
		$customerId = $_SESSION['customer']['id'];
		$pdo;
		require 'db_connect.php';

		$maxId = 1;
		foreach ($pdo->query("SELECT max(id) FROM purchase;") as $row) {
			$maxId = $row['max(id)'] + 1;
		}
		$purchaseSql =  'INSERT INTO purchase(id, customer_id) VALUES(:id, :customer_id);';
		$purchaseStm = $pdo->prepare($purchaseSql);
		$purchaseStm->bindValue(':id', $maxId, PDO::PARAM_INT);
		$purchaseStm->bindValue(':customer_id', $_SESSION['customer']['id'], PDO::PARAM_INT);
		if ($purchaseStm->execute()) {
			$detailStm;
			$detailSql =
				'INSERT INTO purchase_detail(purchase_id, product_id, count) VALUES(:purchase_id, :product_id, :count);';
			foreach ($_SESSION["product"] as $key => $value) {
				$detailStm = $pdo->prepare($detailSql);
				$detailStm->bindValue(':purchase_id', $maxId, PDO::PARAM_INT);
				$detailStm->bindValue(':product_id', $key, PDO::PARAM_INT);
				$detailStm->bindValue(':count', $value['count'], PDO::PARAM_INT);
				$detailStm->execute();
			}
			unset($_SESSION['product']);
			echo "成功しました。";
		} else {
			echo "失敗。<br/>";
		}
	}
	?>

</body>

</html>