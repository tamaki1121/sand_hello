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
	<?php if (!empty($_SESSION['product'])) {

		// if (!empty($_SESSION['customer'])) {
		printf(
			"氏名 : %s様<br/>お届け先 : %s<br/>",
			$_SESSION['customer']['name'],
			$_SESSION['customer']['address']
		);
		require 'cart.php';
		print('<a href="purchase_output.php">購入を確定する</a><br/>');
		// } else {
		print("ログインしてください。<br/>");
		// }
	} else {
		print('カートに商品がありません。<br/>');
	}
	?>

</body>

</html>