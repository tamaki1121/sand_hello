<?php session_start(); ?>
<!DOCTYPE html>
<html>

<head>
	<meta charset="UTF-8">
	<title>購入履歴画面</title>
	<link rel="stylesheet" href="style.css">
</head>

<body>

	<?php require 'menu.php'; ?>
	<?php
	if (!empty($_SESSION['customer'])) {
		$pdo;
		require 'db_connect.php';
		$sql = "
			SELECT purchase_id, name, count, price
			FROM purchase AS P
				INNER JOIN purchase_detail AS D
					ON P.id = D.purchase_id
					AND customer_id = :customer_id
				JOIN product AS PR
					ON PR.id = D.product_id;
				";
		$stm = $pdo->prepare($sql);
		$stm->bindValue(':customer_id', $_SESSION['customer']['id'], PDO::PARAM_INT);
		$result = $stm->execute();
		if (is_null($result)) {
			echo "購入履歴がありません";
		} else {
			$array = [];
			foreach ($stm as $row) {
				$array[$row['purchase_id']][] = [
					'name' => $row['name'],
					'count' => $row['count'],
					'price' => $row['price'],
					'subtotal' => $row['price'] * $row['count'],
				];
			}
		}
	?>
		<?php foreach ($array as $key => $val) :
			$total = 0;
			$color = $key % 2 == 0 ? "#DDDDDD" : "#CCFFFF"; ?>
			<table border="1">
				<caption style="background-color: <?= $color ?>;">注文番号 : <?= $key ?></caption>
				<tr>
					<th>商品名</th>
					<th>個数</th>
					<th>単価</th>
					<th>小計</th>
				</tr>
				<?php foreach ($val as $listVal) : ?>
					<tr>
						<?php foreach ($listVal as $itemVal) : ?>
							<td><?= $itemVal ?></td>
						<?php endforeach; ?>
					</tr>
				<?php $total += $listVal['subtotal'];
				endforeach; ?>
				<tr>
					<th colspan="2">合計金額</th>
					<td colspan="2"><?= $total ?> 円</td>
				</tr>
			</table>
	<?php endforeach;
	} else {
		echo "ログインしてください";
	} ?>
</body>

</html>