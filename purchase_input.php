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
	<?php if (!empty($_SESSION['customer'])) {

		printf(
			"氏名 : %s様<br/>お届け先 : %s<br/>",
			$_SESSION['customer']['name'],
			$_SESSION['customer']['address']
		);
		require 'cart.php';
		if (!empty($_SESSION['product'])) {
			$_SESSION['token'] = random_int(1, 1000000000); ?>
			<form id="buy" action="purchase_output.php" method="POST">
				<input type="text" name="token" value="<?= $_SESSION['token'] ?>">
				<input type="submit" value="購入を確定する"><br />
			</form>
	<?php
		};
	} else {
		print("ログインしてください。<br/>");
	}
	?>

</body>

</html>